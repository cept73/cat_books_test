<?php
/** @noinspection PhpUnused */

namespace common\models;

use common\exceptions\AccessDeniedException;
use common\helpers\MatchHelper;
use common\helpers\RbacPermissionHelper;
use common\services\RbacService;
use Exception;
use Yii;
use yii\base\InvalidConfigException;
use yii\behaviors\SluggableBehavior;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

/**
 * @property int $id
 * @property string $slug
 * @property string $title
 * @property int $year_publish
 * @property string $description
 * @property string $isbn
 * @property string $photo_cover
 * @property string $_photo_cover_file
 * @property string $_authors
 */
class Book extends ActiveRecord
{
    public ?string $_photo_cover_file = null;
    public ?array $_authors = null;

    /**
     * @return array
     */
    public function attributeLabels(): array
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'slug' => Yii::t('app', 'Адрес страницы'),
            'title' => Yii::t('app', 'Название'),
            'year_publish' => Yii::t('app', 'Год выпуска'),
            'description' => Yii::t('app', 'Описание'),
            'isbn' => Yii::t('app', 'ISBN'),
            'photo_cover' => Yii::t('app', 'Фото главной страницы книги'),
            '_photo_cover_file' => Yii::t('app', 'Файл с фото главной страницы книги'),
            '_authors' => Yii::t('app', 'Авторы'),
        ];
    }

    /**
     * @noinspection SpellCheckingInspection
     */
    public function rules(): array
    {
        return [
            [['title', 'year_publish', 'description', 'isbn'], 'required'],
            ['title', 'match', 'pattern' => MatchHelper::bookTitle(), 'message' => Yii::t('app', 'wrong')],
            ['year_publish', 'integer', 'min' => 1900, 'max' => date('Y')],
            ['photo_cover', 'string'],
            [['isbn'], 'k-isbn'],
            ['isbn', 'trim'],
            ['isbn', 'unique', 'message'=>'Book with this {attribute} already exists'],
            [
                '_photo_cover_file',
                'file',
                'extensions' => ['png', 'jpg', 'jpeg'],
                'mimeTypes' => ['image/jpeg', 'image/pjpeg', 'image/png'],
                'maxSize' => 1024 * 1024 * 10,
                'wrongMimeType' => 'Ошибка при загрузке файла, неверный тип изображения',
                'tooBig' => 'Максимальный размер загружаемого файла - 10 МБ',
                'skipOnEmpty' => true,
            ],
            ['_authors', 'each', 'rule' => ['integer']],
        ];
    }

    /**
     * @return array[]
     */
    public function behaviors(): array
    {
        return [
            [
                'class' => SluggableBehavior::class,
                'attribute' => 'title',
                'slugAttribute' => 'slug',
            ],
        ];
    }

    /**
     * @throws Exception
     */
    public function beforeSave($insert): bool
    {
        if (!$this->isNewRecord && !RbacService::isUserCan(RbacPermissionHelper::getChangeBookPermission($this))) {
            throw new AccessDeniedException();
        }

        return parent::beforeSave($insert);
    }

    /**
     * @throws Exception
     */
    public function afterSave($insert, $changedAttributes)
    {
        if ($insert) {
            (new RbacService())->createPermissionToChangeBook($this, Yii::$app->user->id);
        }

        parent::afterSave($insert, $changedAttributes);
    }

    /**
     * @throws AccessDeniedException
     */
    public function beforeDelete(): bool
    {
        if (!RbacService::isUserCan(RbacPermissionHelper::getChangeBookPermission($this))) {
            throw new AccessDeniedException();
        }

        AuthorBook::deleteAll(['book_id' => $this->id]);

        return parent::beforeDelete();
    }

    /**
     * @throws InvalidConfigException
     */
    public function authorsQuery(): ActiveQuery
    {
        return $this
            ->hasMany(Author::class, ['id' => 'author_id'])
            ->viaTable(AuthorBook::tableName(), ['book_id' => 'id']);
    }

    /**
     * @return Author[]
     * @throws InvalidConfigException
     */
    public function authors(): array
    {
        return $this->authorsQuery()->all();
    }

    /**
     * @throws InvalidConfigException
     */
    public function authorsIds(): array
    {
        return ArrayHelper::getColumn($this->authors(), 'id');
    }

    /**
     * @throws InvalidConfigException
     */
    public function getAuthorsLabel(): string
    {
        $authorsList = $this->authorsQuery()->select('author.last_name')->column();

        return implode(', ', $authorsList);
    }

    /**
     * @return string
     */
    public function getPath(): string
    {
        return $this->id . '-' . $this->slug;
    }

    /**
     * @return array
     * @throws InvalidConfigException
     */
    public function getInformation(): array
    {
        $informationRaw = [
            'authors' => $this->getAuthorsLabel(),
            'year' => $this->year_publish,
            'isbn' => $this->isbn
        ];

        $information = [];
        foreach ($informationRaw as $key => $value) {
            $information[$this->getAttributeLabel($key)] = $value;
        }

        return $information;
    }
}
