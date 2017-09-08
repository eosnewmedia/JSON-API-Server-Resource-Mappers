<?php
declare(strict_types=1);

namespace Enm\JsonApi\Server\ResourceMappers\Tests;

use Enm\JsonApi\Model\Resource\ResourceInterface;
use Enm\JsonApi\Server\Model\Request\FetchRequestInterface;
use Enm\JsonApi\Server\ResourceMappers\Mapper\ResourceMapperInterface;
use Enm\JsonApi\Server\ResourceMappers\Mapper\ResourceMapperRegistry;
use Enm\JsonApi\Server\ResourceMappers\Model\Entity\EntityInterface;
use PHPUnit\Framework\TestCase;

/**
 * @author Philipp Marien <marien@eosnewmedia.de>
 */
class ResourceMapperRegistryTest extends TestCase
{

    public function testSupportsEntity()
    {
        /** @var ResourceMapperInterface $mapper */
        $mapper = $this->createConfiguredMock(ResourceMapperInterface::class, ['supportsEntity' => true]);
        /** @var EntityInterface $entity */
        $entity = $this->createMock(EntityInterface::class);

        $registry = new ResourceMapperRegistry();
        $registry->addMapper($mapper);

        self::assertTrue($registry->supportsEntity($entity));
    }

    public function testNotSupportsEntity()
    {
        /** @var EntityInterface $entity */
        $entity = $this->createMock(EntityInterface::class);

        $registry = new ResourceMapperRegistry();

        self::assertFalse($registry->supportsEntity($entity));
    }

    public function testToResourceSupported()
    {
        /** @var ResourceMapperInterface $mapper */
        $mapper = $this->createConfiguredMock(ResourceMapperInterface::class, ['supportsEntity' => true]);
        /** @var EntityInterface $entity */
        $entity = $this->createMock(EntityInterface::class);
        /** @var FetchRequestInterface $request */
        $request = $this->createMock(FetchRequestInterface::class);
        /** @var ResourceInterface $resource */
        $resource = $this->createMock(ResourceInterface::class);

        $registry = new ResourceMapperRegistry();
        $registry->addMapper($mapper);

        $registry->toResource($entity, $request, $resource);

        self::assertTrue(true);
    }

    /**
     * @expectedException \Enm\JsonApi\Exception\UnsupportedTypeException
     */
    public function testToResourceUnsupported()
    {
        /** @var EntityInterface $entity */
        $entity = $this->createMock(EntityInterface::class);
        /** @var FetchRequestInterface $request */
        $request = $this->createMock(FetchRequestInterface::class);
        /** @var ResourceInterface $resource */
        $resource = $this->createMock(ResourceInterface::class);

        $registry = new ResourceMapperRegistry();

        $registry->toResource($entity, $request, $resource);
    }

    public function testToEntityFullSupported()
    {
        /** @var ResourceMapperInterface $mapper */
        $mapper = $this->createConfiguredMock(ResourceMapperInterface::class, ['supportsEntity' => true]);
        /** @var ResourceInterface $resource */
        $resource = $this->createMock(ResourceInterface::class);
        /** @var EntityInterface $entity */
        $entity = $this->createMock(EntityInterface::class);

        $registry = new ResourceMapperRegistry();
        $registry->addMapper($mapper);

        $registry->toEntityFull($resource, $entity);

        self::assertTrue(true);
    }

    /**
     * @expectedException \Enm\JsonApi\Exception\UnsupportedTypeException
     */
    public function testToEntityFullUnsupported()
    {
        /** @var ResourceInterface $resource */
        $resource = $this->createMock(ResourceInterface::class);
        /** @var EntityInterface $entity */
        $entity = $this->createMock(EntityInterface::class);

        $registry = new ResourceMapperRegistry();

        $registry->toEntityFull($resource, $entity);
    }

    public function testToEntityPartialSupported()
    {
        /** @var ResourceMapperInterface $mapper */
        $mapper = $this->createConfiguredMock(ResourceMapperInterface::class, ['supportsEntity' => true]);
        /** @var ResourceInterface $resource */
        $resource = $this->createMock(ResourceInterface::class);
        /** @var EntityInterface $entity */
        $entity = $this->createMock(EntityInterface::class);

        $registry = new ResourceMapperRegistry();
        $registry->addMapper($mapper);

        $registry->toEntityPartial($resource, $entity);

        self::assertTrue(true);
    }

    /**
     * @expectedException \Enm\JsonApi\Exception\UnsupportedTypeException
     */
    public function testToEntityPartialUnsupported()
    {
        /** @var ResourceInterface $resource */
        $resource = $this->createMock(ResourceInterface::class);
        /** @var EntityInterface $entity */
        $entity = $this->createMock(EntityInterface::class);

        $registry = new ResourceMapperRegistry();

        $registry->toEntityPartial($resource, $entity);
    }
}
