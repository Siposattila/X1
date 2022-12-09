<?php

namespace App\Validator;

use App\Repository\PlayerRepository;
use App\Validator\Constraint\UniquePlayerEmail;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;
use Symfony\Component\Validator\Exception\UnexpectedValueException;

class UniquePlayerEmailValidator extends ConstraintValidator
{
    public function __construct(
        private readonly PlayerRepository $playerRepository
    ) {
    }

    public function validate($value, Constraint $constraint)
    {
        if (!$constraint instanceof UniquePlayerEmail) {
            throw new UnexpectedTypeException($constraint, UniquePlayerEmail::class);
        }

        if (null === $value || "" === $value) {
            return;
        }

        if (!is_string($value)) {
            throw new UnexpectedValueException($value, "string");
        }

        $helper = explode("@", $value);
        if (!empty($this->playerRepository->findOneBy(["email" => str_replace(".", "", strtolower($helper[0]))."@".strtolower($helper[1])]))) {
            $this->context->buildViolation($constraint->message)
                ->setParameter("{{ value }}", $value)
                ->addViolation();
        }
    }
}
