<?php
declare(strict_types=1);

namespace Enm\JsonApi\Server\ResourceMappers\Mapper;

/**
 * @author Philipp Marien <marien@eosnewmedia.de>
 */
interface ResourceMapperAwareInterface
{
    /**
     * @param ResourceMapperInterface $resourceMapper
     *
     * @return void
     */
    public function setResourceMapper(ResourceMapperInterface $resourceMapper);
}
