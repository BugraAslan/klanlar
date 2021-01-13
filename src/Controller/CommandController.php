<?php

namespace App\Controller;

use App\Manager\Response\CommandResponseManager;
use App\Model\Request\Command\BuildingCommandRequest;
use App\Model\Request\Command\UnitCommandRequest;
use App\Service\CommandService;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\ConstraintViolationList;

class CommandController extends BaseController
{
    /** @var CommandResponseManager */
    private $commandResponseManager;

    /** @var CommandService */
    private $commandService;

    /**
     * CommandController constructor.
     * @param CommandResponseManager $commandResponseManager
     * @param CommandService $commandService
     */
    public function __construct(CommandResponseManager $commandResponseManager, CommandService $commandService)
    {
        $this->commandResponseManager = $commandResponseManager;
        $this->commandService = $commandService;
    }

    /**
     * @param UnitCommandRequest $unitCommandRequest
     * @param ConstraintViolationList $validationErrors
     * @ParamConverter("unitCommandRequest", converter="fos_rest.request_body")
     * @return Response
     */
    public function unitCommandAction(
        UnitCommandRequest $unitCommandRequest,
        ConstraintViolationList $validationErrors
    ): Response
    {
        if ($validationErrors->count()) {
            return $this->validationErrorResponse($validationErrors);
        }

        $unitCommand = $this->commandService->unitCommand($unitCommandRequest);
        if (!$unitCommand) {
            return $this->customErrorResponse('Komut Oluşturulamadı!', Response::HTTP_NOT_ACCEPTABLE);
        }

        return $this->successResponse(
            $this->commandResponseManager->buildPostCommandResponse($unitCommand)
        );
    }

    /**
     * @param BuildingCommandRequest $buildingCommandRequest
     * @param ConstraintViolationList $validationErrors
     * @ParamConverter("buildingCommandRequest", converter="fos_rest.request_body")
     * @return Response
     */
    public function buildingCommandAction(
        BuildingCommandRequest $buildingCommandRequest,
        ConstraintViolationList $validationErrors
    ): Response
    {
        if ($validationErrors->count()) {
            return $this->validationErrorResponse($validationErrors);
        }

        $buildingCommand = $this->commandService->buildingCommand($buildingCommandRequest);
        if (!$buildingCommand) {
            return $this->customErrorResponse('Komut Oluşturulamadı!', Response::HTTP_NOT_ACCEPTABLE);
        }

        return $this->successResponse(
            $this->commandResponseManager->buildPostCommandResponse($buildingCommand)
        );
    }

    public function cancelCommandAction()
    {

    }
}