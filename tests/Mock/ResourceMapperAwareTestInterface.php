<?php
declare(strict_types=1);

namespace Enm\JsonApi\Server\ResourceMappers\Tests\Mock;

use Enm\JsonApi\Server\ResourceMappers\Mapper\ResourceMapperAwareInterface;
use Enm\JsonApi\Server\ResourceMappers\Mapper\ResourceMapperInterface;

/**
 * @author Philipp Marien <marien@eosnewmedia.de>
 */
interface ResourceMapperAwareTestInterface extends ResourceMapperInterface, ResourceMapperAwareInterface
{

}
