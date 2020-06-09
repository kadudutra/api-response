<?php

declare(strict_types=1);

namespace Response\Jms;

use Doctrine\Common\Annotations\AnnotationRegistry;
use JMS\Serializer\Naming\IdenticalPropertyNamingStrategy;
use JMS\Serializer\Naming\SerializedNameAnnotationStrategy;
use JMS\Serializer\SerializationContext;
use JMS\Serializer\SerializerBuilder;
use JMS\Serializer\SerializerInterface;

class JmsFactory
{
    private const NAMESPACE = "Symfony\Component\Validator\Constraints";

    private const DIRS = "/vendor/symfony/validator";

    private const FORMAT = "json";

    /**
     * @var SerializerInterface
     */
    private $jms;

    public function __construct()
    {
        $this->registerLoader();
        $this->jms = $this->buildJms();
    }

    private function registerLoader(): void
    {
        $loader = require __DIR__ . "/../../../vendor/autoload.php";
        AnnotationRegistry::registerLoader([$loader, "loadClass"]);
        AnnotationRegistry::registerAutoloadNamespace(self::NAMESPACE, self::DIRS);
    }

    /**
     * @return SerializerInterface
     */
    private function buildJms(): SerializerInterface
    {
        return SerializerBuilder::create()
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