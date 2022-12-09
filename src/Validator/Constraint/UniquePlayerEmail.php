<?php

namespace App\Validator\Constraint;

use App\Validator\UniquePlayerEmailValidator;
use Symfony\Component\Validator\Constraint;

#[\Attribute(\Attribute::TARGET_PROPERTY)]
class UniquePlayerEmail extends Constraint
{
    public string $message = "The email \"{{ value }}\" is already occupied!";

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
        return UniquePlayerEmailValidator::class;
    }
}
