<?php
declare(strict_types=1);

namespace Enm\JsonApi\Server\ResourceMappers\Mapper;

use Enm\JsonApi\Exception\JsonApiException;
use Enm\JsonApi\Model\Resource\ResourceInterface;
use Enm\JsonApi\Server\Model\Request\FetchRequestInterface;
use Enm\JsonApi\Server\ResourceMappers\Model\Entity\EntityInterface;

/**
 * @author Philipp Marien <marien@eosnewmedia.de>
 */
interface ResourceMapperInterface
{
    /**
     * Indicates if this mapper can handle the given entity
     *
     * @param EntityInterface $entity
     *
     * @return bool
     */
    public function supportsEntity(EntityInterface $entity): bool;

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
    public function toResource(EntityInterface $entity, FetchRequestInterface $request, ResourceInterface $resource);

    /**
     * Maps all fields of the given api resource from post request to the given entity and throws an exception if required elements are missing
     *
     * @param ResourceInterface $resource
     * @param EntityInterface $entity
     *
     * @return void
     * @throws JsonApiException
     */
    public function toEntityFull(ResourceInterface $resource, EntityInterface $entity);

    /**
     * Maps only available fields of the given api resource from patch request to the given entity
     *
     * @param ResourceInterface $resource
     * @param EntityInterface $entity
     *
     * @return void
     * @throws JsonApiException
     */
    public function toEntityPartial(ResourceInterface $resource, EntityInterface $entity);
}
