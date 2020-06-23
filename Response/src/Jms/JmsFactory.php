<?php

declare(strict_types=1);

namespace Response\Jms;

use JMS\Serializer\Naming\IdenticalPropertyNamingStrategy;
use JMS\Serializer\Naming\SerializedNameAnnotationStrategy;
use JMS\Serializer\SerializationContext;
use JMS\Serializer\SerializerBuilder;
use JMS\Serializer\SerializerInterface;
use JMS\Serializer\Visitor\Factory\JsonDeserializationVisitorFactory;
use JMS\Serializer\Visitor\Factory\JsonSerializationVisitorFactory;

/**
 * Class JmsFactory
 * @package Response\Jms
 */
class JmsFactory
{
    private const FORMAT = "json";

    /**
     * @var SerializerInterface
     */
    private $jms;

    public function __construct()
    {
        $this->jms = $this->buildJms();
    }

    /**
     * @return SerializerInterface
     */
    private function buildJms(): SerializerInterface
    {
        $serializationVisitorFactory = new JsonSerializationVisitorFactory();
        $serializationVisitorFactory->setOptions(JSON_UNESCAPED_UNICODE);

        $deserializationVisitorFactory = new JsonDeserializationVisitorFactory();
        $deserializationVisitorFactory->setOptions(JSON_UNESCAPED_UNICODE);

        return SerializerBuilder::create()
            ->setSerializationVisitor(self::FORMAT, $serializationVisitorFactory)
            ->setDeserializationVisitor(self::FORMAT, $deserializationVisitorFactory)
            ->setPropertyNamingStrategy(new SerializedNameAnnotationStrategy(new IdenticalPropertyNamingStrategy()))
            ->build();
    }

    /**
     * @param $data
     * @param SerializationContext|null $context
     * @return string
     */
    public function serialize($data, ?SerializationContext $context = null): string
    {
        return $this->jms->serialize($data, self::FORMAT, $context);
    }

    /**
     * @param $data
     * @param string $class
     * @param string $format
     * @return mixed
     */
    public function deserialize($data, string $class, string $format = self::FORMAT)
    {
        return $this->jms->deserialize($data, $class, $format);
    }
}