<?php
declare(strict_types=1);

namespace Enm\JsonApi\Server\ResourceMappers\Tests;

use Enm\JsonApi\Server\ResourceMappers\Mapper\ResourceMapperAwareTrait;
use Enm\JsonApi\Server\ResourceMappers\Mapper\ResourceMapperInterface;
use PHPUnit\Framework\TestCase;

/**
 * @author Philipp Marien <marien@eosnewmedia.de>
 */
class ResourceMapperAwareTraitTest extends TestCase
{
    public function testResourceMapper()
    {
        /** @var ResourceMapperAwareTrait $mapperAware */
        $mapperAware = $this->getMockForTrait(ResourceMapperAwareTrait::class);
        /** @var ResourceMapperInterface $mapper */
        $mapper = $this->createMock(ResourceMapperInterface::class);

        $mapperAware->setResourceMapper($mapper);

        $reflection = new \ReflectionObject($mapperAware);

        $resourceMapper = $reflection->getMethod('resourceMapper');
        $resourceMapper->setAccessible(true);

        self::assertSame($mapper, $resourceMapper->invoke($mapperAware));
    }

    /**
     * @expectedException \Enm\JsonApi\Exception\JsonApiException
     */
    public function testResourceMapperNotAvailable()
    {
        /** @var ResourceMapperAwareTrait $mapperAware */
        $mapperAware = $this->getMockForTrait(ResourceMapperAwareTrait::class);

        $reflection = new \ReflectionObject($mapperAware);

        $resourceMapper = $reflection->getMethod('resourceMapper');
        $resourceMapper->setAccessible(true);

        $resourceMapper->invoke($mapperAware);
    }
}
