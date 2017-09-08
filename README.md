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
$resourceMappers = new ResourceMapperRegistry();
// add your resource mappers to the registry
$resourceMappers->addMapper(new \CustomMapper());

```

in your request handlers method `fetchResource`:

```php
// fetch entity into $entity

$resource = $this->jsonApi()->resource('examples','1');
$resourceMappers->toResource($entity, $request, $resource);

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

### Resource Mapper Aware
If you want to use nested resource mapping (for example with json api relationships and includes) your mapper can implement
`Enm\JsonApi\Server\ResourceMappers\Mapper\ResourceMapperAwareInterface` and use the `Enm\JsonApi\Server\ResourceMappers\Mapper\ResourceMapperAwareTrait`,
which offers the method `resourceMapper` to access the resource mapper registry.
