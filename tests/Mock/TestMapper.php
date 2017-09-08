<?php
declare(strict_types=1);

namespace Enm\JsonApi\Server\ResourceMappers\Tests\Mock;

use Enm\JsonApi\Exception\JsonApiException;
use Enm\JsonApi\Model\Resource\ResourceInterface;
use Enm\JsonApi\Server\ResourceMappers\Mapper\AbstractResourceMapper;
use Enm\JsonApi\Server\ResourceMappers\Mapper\NoAttributesTrait;
use Enm\JsonApi\Server\ResourceMappers\Mapper\NoMetaInformationTrait;
use Enm\JsonApi\Server\ResourceMappers\Mapper\NoRelationshipsTrait;
use Enm\JsonApi\Server\ResourceMappers\Model\Entity\EntityInterface;

/**
 * @author Philipp Marien <marien@eosnewmedia.de>
 */
class TestMapper extends AbstractResourceMapper
{
    use NoAttributesTrait;
    use NoMetaInformationTrait;
    use NoRelationshipsTrait;

    /**
     * Indicates if this mapper can handle the given entity
     *
     * @param EntityInterface $entity
     *
     * @return bool
     */
    public function supportsEntity(EntityInterface $entity): bool
    {
        return true;
    }

    /**
     * Maps all fields of the given api resource from post request to the given entity and throws an exception if required elements are missing
     *
     * @param ResourceInterface $resource
     * @param EntityInterface $entity
     *
     * @return void
     * @throws JsonApiException
     */
    public function toEntityFull(ResourceInterface $resource, EntityInterface $entity)
    {
        throw new JsonApiException('Not implemented');
    }

    /**
     * Maps only available fields of the given api resource from patch request to the given entity
     *
     * @param ResourceInterface $resource
     * @param EntityInterface $entity
     *
     * @return void
     * @throws JsonApiException
     */
    public function toEntityPartial(ResourceInterface $resource, EntityInterface $entity)
    {
        throw new JsonApiException('Not implemented');
    }
}
