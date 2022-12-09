<?php

namespace App\ParamResolver;

use Symfony\Component\Validator\Constraints\GroupSequence;

#[\Attribute(\Attribute::TARGET_PARAMETER)]
final class Param
{
    public function __construct(
        public bool $validate = false,
        public string $attribute = "id",
        public string $attributeType = "int",
        public string|GroupSequence|array|null $groups = null,
        public bool $getEntity = true,
        public bool $merge = true
    ) {
    }
}
