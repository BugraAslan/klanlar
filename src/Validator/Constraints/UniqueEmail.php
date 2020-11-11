<?php

namespace App\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class UniqueEmail extends Constraint
{
    const UNIQUE_EMAIL_ERROR = '518572c1-db7e-463d-9227-b6902fdb51a2';

    protected static $errorNames = [
        self::UNIQUE_EMAIL_ERROR => 'UNIQUE_EMAIL_ERROR'
    ];

    // TODO böyle bir email olup olmadığını öğrenmeleri sakıncalı mıdır ?
    public $message = 'Email sistemde kayıtlı';

    public function validatedBy()
    {
        return 'unique_email_validator';
    }
}