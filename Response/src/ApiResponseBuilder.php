<?php

declare(strict_types=1);

namespace Response;

use Throwable;

/**
 * Class ApiResponseBuilder
 * @package Response
 */
class ApiResponseBuilder
{
    /**
     * @var mixed
     */
    private $data;

    /**
     * @var int|null
     */
    private $statusCode;

    /**
     * @var mixed
     */
    private $params;

    /**
     * @var bool
     */
    private $serializeNull = false;

    /**
     * @var string
     */
    private $content = "application/json";

    /**
     * @var Throwable
     */
    private $throwable;

    /**
     * @return ApiResponse
     */
    public function build(): ApiResponse
    {
        return new ApiResponse(
            $this->data, $this->statusCode,
            $this->params, $this->serializeNull, $this->content, $this->throwable);
    }

    /**
     * @param mixed $data
     * @return ApiResponseBuilder
     */
    public function setData($data)
    {
        $this->data = $data;
        return $this;
    }

    /**
     * @param int|null $statusCode
     * @return ApiResponseBuilder
     */
    public function setStatusCode(?int $statusCode): ApiResponseBuilder
    {
        $this->statusCode = $statusCode;
        return $this;
    }

    /**
     * @param mixed $params
     * @return ApiResponseBuilder
     */
    public function setParams($params)
    {
        $this->params = $params;
        return $this;
    }

    /**
     * @param bool $serializeNull
     * @return ApiResponseBuilder
     */
    public function setSerializeNull(bool $serializeNull): ApiResponseBuilder
    {
        $this->serializeNull = $serializeNull;
        return $this;
    }

    /**
     * @param string $content
     * @return ApiResponseBuilder
     */
    public function setContent(string $content): ApiResponseBuilder
    {
        $this->content = $content;
        return $this;
    }

    /**
     * @param Throwable $throwable
     * @return ApiResponseBuilder
     */
    public function setThrowable(Throwable $throwable): ApiResponseBuilder
    {
        $this->throwable = $throwable;
        return $this;
    }
}