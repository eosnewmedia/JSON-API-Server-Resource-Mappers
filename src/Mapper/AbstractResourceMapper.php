<?php
declare(strict_types=1);

namespace Enm\JsonApi\Server\ResourceMappers\Mapper;

use Enm\JsonApi\Exception\JsonApiException;
use Enm\JsonApi\JsonApiAwareInterface;
use Enm\JsonApi\JsonApiAwareTrait;
use Enm\JsonApi\Model\Common\KeyValueCollectionInterface;
use Enm\JsonApi\Model\Resource\Relationship\RelationshipCollectionInterface;
use Enm\JsonApi\Model\Resource\ResourceInterface;
use Enm\JsonApi\Server\Model\Request\FetchRequestInterface;
use Enm\JsonApi\Server\ResourceMappers\Model\Entity\EntityInterface;

/**
 * @author Philipp Marien <marien@eosnewmedia.de>
 */
abstract class AbstractResourceMapper implements ResourceMapperInterface, JsonApiAwareInterface, ResourceMapperAwareInterface
{
    use JsonApiAwareTrait;
    use ResourceMapperAwareTrait;

    /**
     * Maps the given entity to the given (empty) api resource
     *
     * @param EntityInterface $entity
     * @param FetchRequestInterface $request
     * @param ResourceInterface $resource
     *
     * @return void
     * @throws JsonApiException
     */
    public function toResource(EntityInterface $entity, FetchRequestInterface $request, ResourceInterface $resource)
    {
        if ($request->requestedResourceBody()) {
            $this->mapAttributesToResource($entity, $request, $resource->attributes());
        }

        if ($request->requestedRelationships()) {
            $this->mapRelationshipsToResource($entity, $request, $resource->relationships());
        }

        $this->mapMetaInformationToResource($entity, $request, $resource->metaInformation());
    }

    /**
     * Maps attributes from an entity to a json resource
     *
     * @param EntityInterface $entity
     * @param FetchRequestInterface $request
     * @param KeyValueCollectionInterface $attributes
     *
     * @return void
     */
    abstract protected function mapAttributesToResource(
        EntityInterface $entity,
        FetchRequestInterface $request,
        KeyValueCollectionInterface $attributes
    );

    /**
     * Maps meta information from an entity to a json resource
     *
     * @param EntityInterface $entity
     * @param FetchRequestInterface $request
     * @param KeyValueCollectionInterface $metaInformation
     *
     * @return void
     */
    abstract protected function mapMetaInformationToResource(
        EntityInterface $entity,
        FetchRequestInterface $request,
        KeyValueCollectionInterface $metaInformation
    );

    /**
     * Maps relationships of an entity to a json resource
     *
     * @param EntityInterface $entity
     * @param FetchRequestInterface $request
     * @param RelationshipCollectionInterface $relationships
     *
     * @return void
     */
    abstract protected function mapRelationshipsToResource(
        EntityInterface $entity,
        FetchRequestInterface $request,
        RelationshipCollectionInterface $relationships
    );
}
