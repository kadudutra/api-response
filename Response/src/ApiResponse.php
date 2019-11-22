<?php

declare(strict_types=1);

namespace Response;

use Response\DTO\RequestFilters;
use Zend\Diactoros\Response;
use Zend\Diactoros\Response\InjectContentTypeTrait;
use Zend\Diactoros\Stream;

/**
 * API Response allows you to handle exceptions simply and custom.
 * It is designed to be used with the base-exception library.
 *
 * @copyright (c) 2019.
 * @link <https://github.com/GustavoSantosBr/api-response.git>
 * @link <https://github.com/GustavoSantosBr/base-exception.git>
 * @author Gustavo Santos <gustavo.freze@gmail.com>
 */
class ApiResponse extends Response
{
    use InjectContentTypeTrait;

    /**
     * @var mixed
     */
    private $data;

    /**
     * @var int|null
     */
    private $statusCode;

    /**
     * @var RequestFilters|null
     */
    private $params;

    /**
     * @var bool
     */
    private $serializeNull;

    /**
     * @var Stream
     */
    private $body;

    public function __construct($data, ?int $statusCode = null,
                                ?RequestFilters $params = null, bool $serializeNull = true,
                                string $content = "application/json")
    {
        $this->data = $data;
        $this->statusCode = $this->checkStatusCode($statusCode);
        $this->params = $params;
        $this->serializeNull = $serializeNull;
        $this->body = (new CreateResponse($this->data, $this->statusCode, $this->params, $serializeNull))->getBody();
        parent::__construct($this->body, $this->statusCode, $this->injectContentType($content, []));
    }

    /**
     * Checks if the http code was entered, if null, empty, 0 or negative, returns a 500
     * @param int|null $statusCode
     * @return int
     */
    private function checkStatusCode(?int $statusCode): int
    {
        return (empty($statusCode) || $statusCode < 0) ? 500 : $statusCode;
    }
}