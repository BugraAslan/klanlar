<?php

namespace App\Validator\Constraints;

use App\Service\PlayerService;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class UniqueUsernameValidator extends ConstraintValidator
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
     * @param mixed $username
     * @param Constraint $constraint
     */
    public function validate($username, Constraint $constraint)
    {
        if (!$this->context->getViolations()->count() &&
            $this->playerService->checkUniqueUsername(trim($username))
        ){
            $this->context->buildViolation($constraint->message)
                ->setCode(UniqueUsername::UNIQUE_USERNAME_ERROR)
                ->addViolation();
        }
    }
}