<?php

declare(strict_types=1);

namespace Response;

use JMS\Serializer\SerializationContext;
use Laminas\Diactoros\Stream;
use Response\DTO\Error;
use Response\DTO\ResponseData;
use Response\Jms\JmsFactory;

/**
 * Class CreateResponse
 * @package Response
 */
class CreateResponse
{
    /**
     * @var mixed
     */
    private $data;

    /**
     * @var int
     */
    private $statusCode;

    /**
     * @var mixed
     */
    private $params;

    /**
     * @var bool
     */
    private $serializeNull;

    public function __construct($data, int $statusCode, $params = null, bool $serializeNull = true)
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
            $error->setInternalCodeError(-1);

            if (is_string($data)) {
                $error->setInternalMessageError($data);
            }
            return [$error];
        }
        return $data;
    }

    /**
     * @return Stream
     */
    public function getBody(): Stream
    {
        $jms = new JmsFactory();
        $serializationContext = (new SerializationContext())->setSerializeNull($this->serializeNull);

        $body = new Stream("php://temp", "wb+");
        $body->write($jms->serialize($this->createResponse(), $serializationContext));
        $body->rewind();
        return $body;
    }
}