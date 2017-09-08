<?php
declare(strict_types=1);

namespace Enm\JsonApi\Server\ResourceMappers\Mapper;

use Enm\JsonApi\Model\Common\KeyValueCollectionInterface;
use Enm\JsonApi\Server\Model\Request\FetchRequestInterface;
use Enm\JsonApi\Server\ResourceMappers\Model\Entity\EntityInterface;

/**
 * @author Philipp Marien <marien@eosnewmedia.de>
 */
trait NoAttributesTrait
{
    /**
     * Default implementation to avoid implementing empty methods in your mapper
     *
     * @param EntityInterface $entity
     * @param FetchRequestInterface $request
     * @param KeyValueCollectionInterface $attributes
     *
     * @return void
     */
    protected function mapAttributesToResource(
        EntityInterface $entity,
        FetchRequestInterface $request,
        KeyValueCollectionInterface $attributes
    ) {

    }
}
