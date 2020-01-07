<?php

declare(strict_types=1);

namespace Response\DTO;

use JMS\Serializer\Annotation\Type;

/**
 * Class Error
 * @package Response\DTO
 */
class Error
{
    /**
     * @var string
     * @Type("string")
     */
    private $messageerror;

    /**
     * @var string
     * @Type("string")
     */
    private $internalmessageerror;

    /**
     * @var int
     * @Type("int")
     */
    private $internalcodeerror;

    /**
     * @return string
     */
    public function getMessageError(): string
    {
        return $this->messageerror;
    }

    /**
     * @param string $messageerror
     */
    public function setMessageError(string $messageerror): void
    {
        $this->messageerror = $messageerror;
    }

    /**
     * @return string
     */
    public function getInternalMessageError(): string
    {
        return $this->internalmessageerror;
    }

    /**
     * @param string $internalmessageerror
     */
    public function setInternalMessageError(string $internalmessageerror): void
    {
        $this->internalmessageerror = $internalmessageerror;
    }

    /**
     * @return int
     */
    public function getInternalCodeError(): int
    {
        return $this->internalcodeerror;
    }

    /**
     * @param int $internalcodeerror
     */
    public function setInternalCodeError(int $internalcodeerror): void
    {
        $this->internalcodeerror = $internalcodeerror;
    }
}