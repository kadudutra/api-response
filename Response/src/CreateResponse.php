<?php

declare(strict_types=1);

namespace Response;

use JMS\Serializer\SerializationContext;
use JMS\Serializer\Serializer;
use Psr\Container\ContainerInterface;
use Response\DTO\Error;
use Response\DTO\ResponseData;
use Response\Filters\RequestFilters;
use Zend\Diactoros\Stream;

/**
 * Class CreateResponse
 * @package Response
 */
class CreateResponse
{
    /**
     * @var Stream
     */
    private $body;

    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * @var Serializer
     */
    private $jms;

    /**
     * @var mixed
     */
    private $data;

    /**
     * @var int
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
     * @var SerializationContext
     */
    private $serializationContext;

    public function __construct($data, int $statusCode, ?RequestFilters $params = null, bool $serializeNull = true)
    {
        $this->data = $data;
        $this->statusCode = $statusCode;
        $this->params = $params;
        $this->serializeNull = $serializeNull;
    }

    /**
     * @return ResponseData
     */
    private function createResponse(): ResponseData
    {
        $response = new ResponseData();
        $response->setStatuscode($this->statusCode);
        $response->setParams($this->params);
        if ((TypeResponse::getType($this->statusCode))) {
            $response->setData($this->data);
            return $response;
        }
        $response->setError($this->createError($this->data));
        return $response;
    }

    /**
     * @param $data
     * @return array
     */
    private function createError($data): array
    {
        if (!is_array($data)) {
            $error = new Error();
            $error->setMessageerror("Ocorreu um erro inesperado na aplicação!");
            $error->setInternalMessageError($data);
            $error->setInternalCodeError(-1);
            return [$error];
        }
        return $data;
    }

    /**
     * @return Stream
     */
    public function getBody(): Stream
    {
        $this->container = require "config/container.php";
        $this->jms = $this->container->get("serializer");
        $this->serializationContext = (new SerializationContext())->setSerializeNull($this->serializeNull);

        $this->body = new Stream("php://temp", "wb+");
        $this->body->write($this->jms->serialize($this->createResponse(), "json", $this->serializationContext));
        $this->body->rewind();
        return $this->body;
    }
}