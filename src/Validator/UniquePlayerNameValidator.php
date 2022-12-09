<?php

namespace App\Validator;

use App\Repository\PlayerRepository;
use App\Validator\Constraint\UniquePlayerName;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;
use Symfony\Component\Validator\Exception\UnexpectedValueException;

class UniquePlayerNameValidator extends ConstraintValidator
{
    public function __construct(
        private readonly PlayerRepository $playerRepository
    ) {
    }

    public function validate($value, Constraint $constraint)
    {
        if (!$constraint instanceof UniquePlayerName) {
            throw new UnexpectedTypeException($constraint, UniquePlayerName::class);
        }

        if (null === $value || "" === $value) {
            return;
        }

        if (!is_string($value)) {
            throw new UnexpectedValueException($value, "string");
        }

        if (!empty($this->playerRepository->findOneBy(["name" => $value]))) {
            $this->context->buildViolation($constraint->message)
                ->setParameter("{{ value }}", $value)
                ->addViolation();
        }
    }
}
