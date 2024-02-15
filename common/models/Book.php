<?php
namespace common\models;

use Yii;
use yii\base\InvalidConfigException;
use yii\behaviors\SluggableBehavior;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * @property int $id
 * @property string $slug
 * @property string $title
 * @property int $year_publish
 * @property string $description
 * @property string $isbn
 * @property string $photo_cover
 */
class Book extends ActiveRecord
{
    public $photo_cover_file = null;

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
            'photo_cover_file' => Yii::t('app', 'Файл с фото главной страницы книги'),
        ];
    }

    /**
     * @noinspection SpellCheckingInspection
     */
    public function rules(): array
    {
        return [
            [['title', 'year_publish', 'description', 'isbn'], 'required'],
            ['year_publish', 'integer', 'min' => 1900, 'max' => date('Y')],
            ['photo_cover', 'string'],
            [['isbn'], 'k-isbn'],
            ['isbn', 'trim'],
            [
                'photo_cover_file',
                'file',
                'extensions' => ['png', 'jpg', 'jpeg'],
                'mimeTypes' => ['image/jpeg', 'image/pjpeg', 'image/png'],
                'maxSize' => 1024 * 1024 * 10,
                'wrongMimeType' => 'Ошибка при загрузке файла, неверный тип изображения',
                'tooBig' => 'Максимальный размер загружаемого файла - 10 МБ',
                'skipOnEmpty' => true,
            ],
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
     * @throws InvalidConfigException
     */
    public function authors(): ActiveQuery
    {
        return $this
            ->hasMany(Author::class, ['id' => 'author_id'])
            ->viaTable(AuthorBook::tableName(), ['book_id' => 'id']);
    }

    /**
     * @throws InvalidConfigException
     */
    public function getAuthorsLabel(): string
    {
        $authorsList = $this->authors()->select('author.last_name')->column();

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
