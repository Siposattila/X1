<?php

namespace App\Validator\Constraint;

use App\Validator\UniqueGameIdValidator;
use Symfony\Component\Validator\Constraint;

#[\Attribute(\Attribute::TARGET_PROPERTY)]
class UniqueGameId extends Constraint
{
    public string $message = "The game id \"{{ value }}\" is not valid!";

    public function __construct(
        mixed $options = null,
        ?array $groups = null,
        mixed $payload = null
    )
    {
        parent::__construct($options, $groups, $payload);
    }

    public function validatedBy(): string
    {
        return UniqueGameIdValidator::class;
    }
}
