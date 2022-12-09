<?php

namespace App\Validator\Constraint;

use App\Validator\UniquePlayerNameValidator;
use Symfony\Component\Validator\Constraint;

#[\Attribute(\Attribute::TARGET_PROPERTY)]
class UniquePlayerName extends Constraint
{
    public string $message = "The player name \"{{ value }}\" is already occupied!";

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
        return UniquePlayerNameValidator::class;
    }
}
