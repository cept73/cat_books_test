<?php

namespace common\helpers;

use common\models\Book;
use yii\base\InvalidArgumentException;

class UrlHelper
{
    public const BASE_URL_BOOK = '/book/';
    
    /**
     * @return string
     */
    public static function getHomePage(): string
    {
        return '/';
    }

    /**
     * @param Book $book
     * @return string
     */
    public static function getBookViewUrl(Book $book): string
    {
        return self::BASE_URL_BOOK . $book->getPath();
    }

    /**
     * @param Book $book
     * @return string
     */
    public static function getBookEditUrl(Book $book): string
    {
        return self::BASE_URL_BOOK . $book->getPath() . '/edit';
    }

    /**
     * @return string
     */
    public static function getBookCreateUrl(): string
    {
        return '/book/create';
    }

    /**
     * @param Book $book
     * @return string
     */
    public static function getBookDeleteUrl(Book $book): string
    {
        return self::BASE_URL_BOOK . $book->getPath() . '/delete';
    }

    /**
     * @param Book $book
     * @return string
     */
    public static function getBookSubscribeUrl(Book $book): string
    {
        return self::BASE_URL_BOOK . $book->getPath() . '/subscribe';
    }

    public static function getBookActionUrl($action, Book $book): string
    {
        // TODO: refactor
        switch ($action) {
            case 'view': return self::getBookViewUrl($book);
            case 'edit': return self::getBookEditUrl($book);
            case 'delete': return self::getBookDeleteUrl($book);
            case 'create': return self::getBookCreateUrl();
            case 'subscribe': return self::getBookSubscribeUrl($book);
        }

        throw new InvalidArgumentException();
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
     * @return int|null
     */
    public static function getPathIdentifier(string $path): ?int
    {
        [$id, ] = self::getPathParts($path);

        return $id;
    }
}
