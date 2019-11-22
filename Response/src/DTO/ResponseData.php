<?php

declare(strict_types=1);

namespace Response\DTO;

use JMS\Serializer\Annotation\Type;

class ResponseData
{
    /**
     * @var int
     * @Type("int")
     */
    private $statuscode;

    /**
     * @var RequestFilters
     * @Type("Response\DTO\RequestFilters")
     */
    private $params;

    /**
     * @var mixed
     */
    private $data;

    /**
     * @var mixed
     */
    private $error;

    /**
     * @return int
     */
    public function getStatusCode(): int
    {
        return $this->statuscode;
    }

    /**
     * @param int $statuscode
     */
    public function setStatusCode(int $statuscode): void
    {
        $this->statuscode = $statuscode;
    }

    /**
     * @return RequestFilters|null
     */
    public function getParams(): ?RequestFilters
    {
        return $this->params;
    }

    /**
     * @param RequestFilters|null $params
     */
    public function setParams(?RequestFilters $params): void
    {
        $this->params = $params;
    }

    /**
     * @return mixed
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param $data
     */
    public function setData($data): void
    {
        $this->data = $data;
    }

    /**
     * @return mixed
     */
    public function getError()
    {
        return $this->error;
    }

    /**
     * @param $error
     */
    public function setError($error): void
    {
        $this->error = $error;
    }
}