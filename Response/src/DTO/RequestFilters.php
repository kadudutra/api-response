<?php

declare(strict_types=1);

namespace Response\DTO;

use JMS\Serializer\Annotation\Type;

class RequestFilters
{
    /**
     * @var string
     * @Type("string")
     */
    private $orderby;

    /**
     * @var int
     * @Type("int")
     */
    private $limit;

    /**
     * @var int
     * @Type("int")
     */
    protected $offset;

    /**
     * @return string
     */
    public function getOrderBy(): string
    {
        return $this->orderby;
    }

    /**
     * @param string $orderby
     */
    public function setOrderBy(string $orderby): void
    {
        $this->orderby = $orderby;
    }

    /**
     * @return int
     */
    public function getLimit(): int
    {
        return $this->limit;
    }

    /**
     * @param int $limit
     */
    public function setLimit(int $limit): void
    {
        $this->limit = $limit;
    }

    /**
     * @return int
     */
    public function getOffSet(): int
    {
        return $this->offset;
    }

    /**
     * @param int $offset
     */
    public function setOffSet(int $offset): void
    {
        $this->offset = $offset;
    }
}