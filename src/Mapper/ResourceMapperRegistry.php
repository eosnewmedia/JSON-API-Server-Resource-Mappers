<?php
declare(strict_types=1);

namespace Enm\JsonApi\Server\ResourceMappers\Mapper;

use Enm\JsonApi\Exception\JsonApiException;
use Enm\JsonApi\Exception\UnsupportedTypeException;
use Enm\JsonApi\Model\Resource\ResourceInterface;
use Enm\JsonApi\Server\Model\Request\FetchRequestInterface;
use Enm\JsonApi\Server\ResourceMappers\Model\Entity\EntityInterface;

/**
 * @author Philipp Marien <marien@eosnewmedia.de>
 */
class ResourceMapperRegistry implements ResourceMapperInterface
{
    /**
     * @var ResourceMapperInterface[]
     */
    private $mappers = [];

    /**
     * @param ResourceMapperInterface $mapper
     */
    public function addMapper(ResourceMapperInterface $mapper)
    {
        $this->mappers[] = $mapper;
    }

    /**
     * Indicates if this mapper can handle the given entity
     *
     * @param EntityInterface $entity
     *
     * @return bool
     */
    public function supportsEntity(EntityInterface $entity): bool
    {
        foreach ($this->mappers as $mapper) {
            if ($mapper->supportsEntity($entity)) {
                return true;
            }
        }

        return false;
    }

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
        foreach ($this->mappers as $mapper) {
            if ($mapper->supportsEntity($entity)) {
                $this->configureResourceMapperAware($mapper);
                $mapper->toResource($entity, $request, $resource);

                return;
            }
        }

        throw new UnsupportedTypeException($resource->type());
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
        foreach ($this->mappers as $mapper) {
            if ($mapper->supportsEntity($entity)) {
                $this->configureResourceMapperAware($mapper);
                $mapper->toEntityFull($resource, $entity);

                return;
            }
        }

        throw new UnsupportedTypeException($resource->type());
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
        foreach ($this->mappers as $mapper) {
            if ($mapper->supportsEntity($entity)) {
                $this->configureResourceMapperAware($mapper);
                $mapper->toEntityPartial($resource, $entity);

                return;
            }
        }

        throw new UnsupportedTypeException($resource->type());
    }

    /**
     * @param ResourceMapperInterface $resourceMapper
     */
    private function configureResourceMapperAware(ResourceMapperInterface $resourceMapper)
    {
        if ($resourceMapper instanceof ResourceMapperAwareInterface) {
            $resourceMapper->setResourceMapper($this);
        }
    }
}
