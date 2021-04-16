<?php

namespace Source\Models;

use CoffeeCode\DataLayer\DataLayer;

abstract class Model extends DataLayer {
    abstract static function getAttributes(): array;
    abstract static function validate($data): ?string;

    function __construct(string $entity_name, array $attributes, string $id_name = 'id', bool $timestamps = false)
    {
        parent::__construct($entity_name, $attributes, $id_name, $timestamps);
    }
}