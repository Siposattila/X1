<?php

namespace App\Validator;

use App\Repository\GameRepository;
use App\Validator\Constraint\UniqueGameId;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;
use Symfony\Component\Validator\Exception\UnexpectedValueException;

class UniqueGameIdValidator extends ConstraintValidator
{
    public function __construct(
        private readonly GameRepository $gameRepository
    ) {
    }

    public function validate($value, Constraint $constraint)
    {
        if (!$constraint instanceof UniqueGameId) {
            throw new UnexpectedTypeException($constraint, UniqueGameId::class);
        }

        if (null === $value || "" === $value) {
            return;
        }

        if (!is_string($value)) {
            throw new UnexpectedValueException($value, "string");
        }

        if (!empty($this->gameRepository->findOneBy(["gameId" => $value]))) {
            $this->context->buildViolation($constraint->message)
                ->setParameter("{{ value }}", $value)
                ->addViolation();
        }
    }
}
