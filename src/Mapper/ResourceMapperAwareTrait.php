<?php
declare(strict_types=1);

namespace Enm\JsonApi\Server\ResourceMappers\Mapper;

use Enm\JsonApi\Exception\JsonApiException;

/**
 * @author Philipp Marien <marien@eosnewmedia.de>
 */
trait ResourceMapperAwareTrait
{
    /**
     * @var ResourceMapperInterface
     */
    private $resourceMapper;

    /**
     * @param ResourceMapperInterface $resourceMapper
     *
     * @return void
     */
    public function setResourceMapper(ResourceMapperInterface $resourceMapper)
    {
        $this->resourceMapper = $resourceMapper;
    }

    /**
     * @return ResourceMapperInterface
     * @throws JsonApiException
     */
    protected function resourceMapper(): ResourceMapperInterface
    {
        if (!$this->resourceMapper instanceof ResourceMapperInterface) {
            throw new JsonApiException('Resource mapper is not available!');
        }

        return $this->resourceMapper;
    }
}
