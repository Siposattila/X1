<?php

namespace App\Exception;
use Symfony\Component\Validator\ConstraintViolationListInterface;

class ValidationException extends \RuntimeException
{
    private $constraintViolationList;

    public function __construct(ConstraintViolationListInterface $constraintViolationList, string $message = '', int $code = 0, \Exception $previous = null)
    {
        $this->constraintViolationList = $constraintViolationList;

        //parent::__construct($message ?: $this->__toString(), $code, $previous);
        parent::__construct($message ?: $this->onlyOneMessage(), $code, $previous);
    }

    public function getConstraintViolationList(): ConstraintViolationListInterface
    {
        return $this->constraintViolationList;
    }

    public function onlyOneMessage(): string
    {
        $message='';

        $violation = $this->constraintViolationList[0];
        if ($propertyPath = $violation->getPropertyPath()) {
            $message .= "$propertyPath: ";
        }
        $message .= $violation->getMessage();
        return $message;

    }

    public function __toString(): string
    {
        $message = '';
        foreach ($this->constraintViolationList as $violation) {
            if ('' !== $message) {
                $message .= "\n";
            }
            if ($propertyPath = $violation->getPropertyPath()) {
                $message .= "$propertyPath: ";
            }

            $message .= $violation->getMessage();
        }

        return $message;
    }

}
