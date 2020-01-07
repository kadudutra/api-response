<?php

declare(strict_types=1);

namespace Response;

use Http\StatusHttp;

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
        return ($statusCode >= StatusHttp::OK && $statusCode <= StatusHttp::IM_USED);
    }
}