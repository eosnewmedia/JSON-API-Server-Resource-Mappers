JSON API Server / Resource Mappers
==================================
[![Build Status](https://travis-ci.org/eosnewmedia/JSON-API-Server-Resource-Mappers.svg)](https://travis-ci.org/eosnewmedia/JSON-API-Server-Resource-Mappers)
[![SensioLabsInsight](https://insight.sensiolabs.com/projects/c35400c9-8a5d-4860-9bce-fb0011db441c/mini.png)](https://insight.sensiolabs.com/projects/c35400c9-8a5d-4860-9bce-fb0011db441c)

This abstract library is an extension for [enm/json-api-server](https://eosnewmedia.github.io/JSON-API-Server/) which adds 
an implementation to standardize mapping between json api resources and entities.

1. [Motivation](#motivation)
1. [Installation](#installation)
1. [Usage](#usage)

## Motivation
The motivation for this library was the recurring requirement to map attributes between entities (for example with doctrine or elasticsearch)
and json api resources, provided by [enm/json-api-server](https://eosnewmedia.github.io/JSON-API-Server/).

It has been shown that the structure of the mappers and the associated registry between different projects actually do not change.

## Installation

```bash
composer require enm/json-api-server-resource-mappers
```

## Usage
Resource mappers are meant to be used in your resource handlers or providers to decouple resources and entities from handlers.

You should always use the registry which offers access to all mappers without requiring your implementation to know
about how and where an entity is mapped to a resource and back.

```php
$resourceMapper = new ResourceMapperRegistry();
// add your resource mappers to the registry
$resourceMapper->addMapper(new \CustomMapper());
```

in your request handlers method `fetchResource`:

```php
// fetch entity into $entity

if($resourceMapper instanceof JsonApiAwareInterface){
    $resourceMapper->setJsonApi($this->jsonApi());
}

$resource = $this->jsonApi()->resource('examples','1');
$resourceMapper->toResource($entity, $request, $resource);

// return your document containing the resource
```

### Resource Mappers
Your resource mapper has to implement `Enm\JsonApi\Server\ResourceMappers\Mapper\ResourceMapperInterface`:

| Method                                                                                           | Return Type | Description                                                                                                                              |
|--------------------------------------------------------------------------------------------------|-------------|------------------------------------------------------------------------------------------------------------------------------------------|
| supportsEntity(EntityInterface $entity)                                                          | bool        | Indicates if this mapper can handle the given entity                                                                                     |
| toResource(EntityInterface $entity, FetchRequestInterface $request, ResourceInterface $resource) | void        | Maps the given entity to the given (empty) api resource                                                                                  |
| toEntityFull(ResourceInterface $resource, EntityInterface $entity)                               | void        | Maps all fields of the given api resource from post request to the given entity and throws an exception if required elements are missing |
| toEntityPartial(ResourceInterface $resource, EntityInterface $entity)                            | void        | Maps only available fields of the given api resource from patch request to the given entity                                              |

To simplify usage your mapper can extend `Enm\JsonApi\Server\ResourceMappers\Mapper\AbstractResourceMapper`, which already
implements `Enm\JsonApi\JsonApiAwareInterface` and `Enm\JsonApi\Server\ResourceMappers\Mapper\ResourceMapperAwareInterface`.

The abstract mapper also implements the method `toResource` but requires your mapper to implement `mapAttributesToResource`,
`mapMetaInformationToResource` and `mapRelationshipsToResource`.

If your mapper does not need one of these methods, these traits contain default (empty) implementations and can be used:
* `Enm\JsonApi\Server\ResourceMappers\Mapper\NoAttributesTrait`
* `Enm\JsonApi\Server\ResourceMappers\Mapper\NoMetaInformationTrait`
* `Enm\JsonApi\Server\ResourceMappers\Mapper\NoRelationshipsTrait`

### Resource Mapper Aware
If you want to use nested resource mapping (for example with json api relationships and includes) your mapper can implement
`Enm\JsonApi\Server\ResourceMappers\Mapper\ResourceMapperAwareInterface` and use the `Enm\JsonApi\Server\ResourceMappers\Mapper\ResourceMapperAwareTrait`,
which offers the method `resourceMapper` to access the resource mapper registry.

### Json Api Aware
If you want to use json api (for example for relationships) your mapper can implement
`Enm\JsonApi\JsonApiAwareInterface` and use the `Enm\JsonApi\JsonApiAwareTrait`,
which offers the method `jsonApi` to access the json api. As alternative you could extend the abstract mapper, which implements json api aware.

If one of your mappers use json api aware it's required to set the json api into the mapper (registry) from request handler,
which then also have to implement `Enm\JsonApi\JsonApiAwareInterface`.
