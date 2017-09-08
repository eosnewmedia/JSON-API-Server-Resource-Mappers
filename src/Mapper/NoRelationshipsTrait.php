<?php
declare(strict_types=1);

namespace Enm\JsonApi\Server\ResourceMappers\Mapper;

use Enm\JsonApi\Model\Resource\Relationship\RelationshipCollectionInterface;
use Enm\JsonApi\Server\Model\Request\FetchRequestInterface;
use Enm\JsonApi\Server\ResourceMappers\Model\Entity\EntityInterface;

/**
 * @author Philipp Marien <marien@eosnewmedia.de>
 */
trait NoRelationshipsTrait
{
    /**
     * Default implementation to avoid implementing empty methods in your mapper
     *
     * @param EntityInterface $entity
     * @param FetchRequestInterface $request
     * @param RelationshipCollectionInterface $relationships
     *
     * @return void
     */
    protected function mapRelationshipsToResource(
        EntityInterface $entity,
        FetchRequestInterface $request,
        RelationshipCollectionInterface $relationships
    ) {

    }
}
