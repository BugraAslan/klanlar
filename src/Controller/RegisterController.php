<?php

namespace App\Controller;

use App\Manager\Response\RegisterResponseManager;
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

    /** @var RegisterResponseManager */
    private $registerResponseManager;

    /**
     * RegisterController constructor.
     * @param RegisterService $registerService
     * @param RegisterResponseManager $registerResponseManager
     */
    public function __construct(RegisterService $registerService, RegisterResponseManager $registerResponseManager)
    {
        $this->registerService = $registerService;
        $this->registerResponseManager = $registerResponseManager;
    }

    /**
     * @param RegisterRequest $registerRequest
     * @param ConstraintViolationList $validationErrors
     * @ParamConverter("registerRequest", converter="fos_rest.request_body")
     * @return Response
     */
    public function register(RegisterRequest $registerRequest, ConstraintViolationList $validationErrors): Response
    {
        if ($validationErrors->count()){
            return $this->validationErrorResponse($validationErrors);
        }

        $player = $this->registerService->register($registerRequest);
        if (!$player){
            return $this->customErrorResponse(
                'Üye kaydı oluşturulamadı',
                Response::HTTP_NOT_ACCEPTABLE
            );
        }

        return $this->successResponse(
            $this->registerResponseManager->buildRegisterResponse($player),
            Response::HTTP_CREATED
        );
    }
}