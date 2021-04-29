<?php

namespace App\Controller;

use App\Manager\Response\LoginResponseManager;
use App\Model\Request\Login\LoginRequest;
use App\Model\Request\Login\PlayRequest;
use App\Service\LoginService;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\ConstraintViolationList;

class LoginController extends BaseController
{
    /** @var LoginService */
    private $loginService;

    /** @var LoginResponseManager */
    private $loginResponseManager;

    /**
     * LoginController constructor.
     * @param LoginService $loginService
     * @param LoginResponseManager $loginResponseManager
     */
    public function __construct(LoginService $loginService, LoginResponseManager $loginResponseManager)
    {
        $this->loginService = $loginService;
        $this->loginResponseManager = $loginResponseManager;
    }

    /**
     * @param LoginRequest $loginRequest
     * @param ConstraintViolationList $validationErrors
     * @ParamConverter("loginRequest", converter="fos_rest.request_body")
     * @return Response
     */
    public function login(LoginRequest $loginRequest, ConstraintViolationList $validationErrors): Response
    {
        if ($validationErrors->count()){
            return $this->validationErrorResponse($validationErrors);
        }

        $playerToken = $this->loginService->login($loginRequest);
        if (!$playerToken){
            return $this->customErrorResponse(
                'Üye bulunamadı, şifrenizi mi unuttunuz ?',
                Response::HTTP_NOT_ACCEPTABLE
            );
        }

        return $this->successResponse(
            $this->loginResponseManager->buildLoginResponse($playerToken)
        );
    }

    /**
     * @param PlayRequest $playRequest
     * @param ConstraintViolationList $validationErrors
     * @ParamConverter("playRequest", converter="fos_rest.request_body")
     * @return Response
     */
    public function worldLogin(PlayRequest $playRequest, ConstraintViolationList $validationErrors): Response
    {
        if ($validationErrors->count()) {
            return $this->validationErrorResponse($validationErrors);
        }

        $playerToken = $this->loginService->worldLogin(
            $this->getUser()->getId(),
            $playRequest->getWorldId()
        );

        if (!$playerToken){
            return $this->customErrorResponse(
                'Dünyaya giriş yapılamadı!',
                Response::HTTP_NOT_ACCEPTABLE
            );
        }

        return $this->successResponse(
            $this->loginResponseManager->buildLoginResponse($playerToken)
        );
    }
}