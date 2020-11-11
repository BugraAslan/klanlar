<?php

namespace App\Controller;

use App\Model\Request\Register\RegisterRequest;
use App\Service\RegisterService;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\ConstraintViolationList;

/**
 * Class RegisterController
 * @package App\Controller
 */
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
     * @param RegisterRequest $registerRequest
     * @param ConstraintViolationList $validationErrors
     * @ParamConverter("registerRequest", converter="fos_rest.request_body")
     * @return Response
     */
    public function register(RegisterRequest $registerRequest, ConstraintViolationList $validationErrors)
    {
        if ($validationErrors->count()){
            return $this->validationErrorResponse($validationErrors);
        }

        //$this->registerService->register($registerRequest);
        return $this->successResponse(['register endpoint']);
    }
}