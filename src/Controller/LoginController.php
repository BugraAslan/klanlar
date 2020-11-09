<?php

namespace App\Controller;

use App\Model\Request\Login\LoginRequest;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\Validator\ConstraintViolationList;

/**
 * Class LoginController
 * @package App\Controller
 */
class LoginController extends BaseController
{
    /**
     * @ParamConverter("loginRequest", converter="fos_rest.request_body")
     * @param LoginRequest $loginRequest
     * @param ConstraintViolationList $validationErrors
     */
    public function loginAction(LoginRequest $loginRequest, ConstraintViolationList $validationErrors)
    {
        if($validationErrors->count()){
            echo (string)$validationErrors;
        }
        exit;
        var_dump($loginRequest);
        echo 'asd';
        exit;
    }
}