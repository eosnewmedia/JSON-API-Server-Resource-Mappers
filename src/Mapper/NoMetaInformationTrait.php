<?php
declare(strict_types=1);

namespace Enm\JsonApi\Server\ResourceMappers\Mapper;

use Enm\JsonApi\Model\Common\KeyValueCollectionInterface;
use Enm\JsonApi\Server\Model\Request\FetchRequestInterface;
use Enm\JsonApi\Server\ResourceMappers\Model\Entity\EntityInterface;

/**
 * @author Philipp Marien <marien@eosnewmedia.de>
 */
trait NoMetaInformationTrait
{
    /**
     * Default implementation to avoid implementing empty methods in your mapper
     *
     * @param EntityInterface $entity
     * @param FetchRequestInterface $request
     * @param KeyValueCollectionInterface $metaInformation
     *
     * @return void
     */
    protected function mapMetaInformationToResource(
        EntityInterface $entity,
        FetchRequestInterface $request,
        KeyValueCollectionInterface $metaInformation
    ) {

    }
}
