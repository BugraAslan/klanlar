<?php

namespace App\Controller;

use App\Model\Request\Login\LoginRequest;
use App\Service\LoginService;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\ConstraintViolationList;

/**
 * Class LoginController
 * @package App\Controller
 */
class LoginController extends BaseController
{
    /** @var LoginService */
    private $loginService;

    /**
     * LoginController constructor.
     * @param LoginService $loginService
     */
    public function __construct(LoginService $loginService)
    {
        $this->loginService = $loginService;
    }

    /**
     * @param LoginRequest $loginRequest
     * @param ConstraintViolationList $validationErrors
     * @ParamConverter("loginRequest", converter="fos_rest.request_body")
     * @return Response
     */
    public function login(LoginRequest $loginRequest, ConstraintViolationList $validationErrors)
    {
        if ($validationErrors->count()){
            return $this->validationErrorResponse($validationErrors);
        }

        $playerToken = $this->loginService->login($loginRequest);

        return new JsonResponse([
            'message' => 'tebrikler giriş yaptınız!',
            'token' => $playerToken->getAccessToken(),
            'expireDate' => $playerToken->getExpireDate()
        ]);
    }
}