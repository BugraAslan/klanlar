<?php

namespace App\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class UniqueUsername extends Constraint
{
    const UNIQUE_USERNAME_ERROR = '518572c1-db7e-463d-9227-b6902fdb51a1';

    protected static $errorNames = [
        self::UNIQUE_USERNAME_ERROR => 'UNIQUE_USERNAME_ERROR'
    ];

    public $message = 'Kullanıcı adı sistemde kayıtlı';

    public function validatedBy()
    {
        return 'unique_username_validator';
    }
}