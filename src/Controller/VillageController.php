<?php

namespace App\Controller;

use App\Entity\Player;
use App\Manager\Response\VillageResponseManager;
use App\Model\Request\Village\VillageIdRequest;
use App\Service\VillageService;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\ConstraintViolationList;

class VillageController extends BaseController
{
    /** @var VillageService */
    private $villageService;

    /** @var VillageResponseManager */
    private $villageResponseManager;

    /**
     * VillageController constructor.
     * @param VillageService $villageService
     * @param VillageResponseManager $villageResponseManager
     */
    public function __construct(VillageService $villageService, VillageResponseManager $villageResponseManager)
    {
        $this->villageService = $villageService;
        $this->villageResponseManager = $villageResponseManager;
    }

    /**
     * @ParamConverter("villageIdRequest", converter="fos_rest.request_body")
     * @param VillageIdRequest $villageIdRequest
     * @param ConstraintViolationList $validationErrors
     * @return Response
     */
    public function villageInfo(VillageIdRequest $villageIdRequest, ConstraintViolationList $validationErrors): Response
    {
        if ($validationErrors->count()) {
            return $this->validationErrorResponse($validationErrors);
        }

        /** @var Player $player */
        $player = $this->getUser();
        $villageInfo = $this->villageService->getVillageInfoById(
            $player->getId(),
            $player->getWorldId(),
            $villageIdRequest->getVillageId()
        );

        if (!$villageInfo){
            return $this->notFoundErrorResponse('Köy bilgileri bulunamadı!');
        }

        return $this->successResponse(
            $this->villageResponseManager->buildVillageInfoResponse($villageInfo)
        );
    }
}