<?php

declare(strict_types=1);

namespace Response;

/**
 * Class TypeResponse
 * @package Response
 */
class TypeResponse
{
    /**
     * @param int $statusCode
     * @return bool
     */
    public static function getType(int $statusCode): bool
    {
        return ($statusCode >= 200 && $statusCode <= 226);
    }
}