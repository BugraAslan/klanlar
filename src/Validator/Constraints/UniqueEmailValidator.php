<?php

namespace App\Validator\Constraints;

use App\Service\PlayerService;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class UniqueEmailValidator extends ConstraintValidator
{
    /** @var PlayerService */
    private $playerService;

    /**
     * UsernameValidator constructor.
     * @param PlayerService $playerService
     */
    public function __construct(PlayerService $playerService)
    {
        $this->playerService = $playerService;
    }

    /**
     * @param mixed $email
     * @param Constraint $constraint
     */
    public function validate($email, Constraint $constraint)
    {
        if (!$this->context->getViolations()->count() &&
            $this->playerService->checkUniqueEmail(trim($email))
        ){
            $this->context->buildViolation($constraint->message)
                ->setCode(UniqueEmail::UNIQUE_EMAIL_ERROR)
                ->addViolation();
        }
    }
}