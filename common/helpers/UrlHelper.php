<?php

namespace common\helpers;

use common\models\Book;
use yii\base\InvalidArgumentException;

class UrlHelper
{
    /**
     * @param Book $book
     * @return string
     */
    public static function getBookViewUrl(Book $book): string
    {
        return 'book/' . $book->getPath() . '/view';
    }

    /** @noinspection PhpDuplicateSwitchCaseBodyInspection */
    public static function getBookActionUrl($action, Book $book): string
    {
        // TODO: change
        switch ($action) {
            case 'view': return self::getBookViewUrl($book);
            case 'edit': return self::getBookViewUrl($book);
            case 'delete': return self::getBookViewUrl($book);
            case 'create': return self::getBookViewUrl($book);
            case 'subscribe': return self::getBookViewUrl($book);
            default:
                throw new InvalidArgumentException();
        }
    }

    /**
     * @param string $path
     * @return array [$id, $slug]
     */
    public static function getPathParts(string $path): array
    {
        $id = null;
        $slug = null;

        $dividerPos = strpos($path, '-');
        if ($dividerPos > 0) {
            $firstPathPart = substr($path, 0, $dividerPos);
            if (is_numeric($firstPathPart) && $id = intval($firstPathPart)) {
                $slug = substr($path, $dividerPos + 1);
            }
        }

        return [$id, $slug];
    }

    /**
     * @param string $path
     * @return mixed
     */
    public static function getPathIdentifier(string $path)
    {
        [$id, ] = self::getPathParts($path);

        return $id;
    }
}
