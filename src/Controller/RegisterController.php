<?php

namespace App\Controller;

use App\Model\Request\Register\RegisterRequest;
use App\Service\RegisterService;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Validator\ConstraintViolationList;

class RegisterController extends BaseController
{
    /** @var RegisterService */
    private $registerService;

    /**
     * RegisterController constructor.
     * @param RegisterService $registerService
     */
    public function __construct(RegisterService $registerService)
    {
        $this->registerService = $registerService;
    }

    /**
     * @ParamConverter("registerRequest", converter="fos_rest.request_body")
     * @param RegisterRequest $registerRequest
     * @param ConstraintViolationList $validationErrors
     * @return JsonResponse
     */
    public function register(RegisterRequest $registerRequest, ConstraintViolationList $validationErrors)
    {
        $this->registerService->register($registerRequest);
        return new JsonResponse(['tebrikler üye oldunuz!']);
    }
}