<?php

namespace App\Controller;

use App\Entity\Player;
use App\Manager\Response\OverviewResponseManager;
use App\Manager\Response\VillageResponseManager;
use App\Manager\Response\WorldResponseManager;
use App\Model\Request\Login\PlayRequest;
use App\Service\LoginService;
use App\Service\PlayerService;
use App\Service\VillageService;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\ConstraintViolationList;

class PlayerController extends BaseController
{
    /** @var PlayerService */
    private $playerService;

    /** @var LoginService */
    private $loginService;

    /** @var VillageService */
    private $villageService;

    /** @var WorldResponseManager */
    private $worldResponseManager;

    /** @var OverviewResponseManager */
    private $overviewResponseManager;

    /** @var VillageResponseManager */
    private $villageResponseManager;

    /**
     * PlayerController constructor.
     * @param PlayerService $playerService
     * @param LoginService $loginService
     * @param VillageService $villageService
     * @param WorldResponseManager $worldResponseManager
     * @param OverviewResponseManager $overviewResponseManager
     * @param VillageResponseManager $villageResponseManager
     */
    public function __construct(
        PlayerService $playerService,
        LoginService $loginService,
        VillageService $villageService,
        WorldResponseManager $worldResponseManager,
        OverviewResponseManager $overviewResponseManager,
        VillageResponseManager $villageResponseManager
    ) {
        $this->playerService = $playerService;
        $this->loginService = $loginService;
        $this->villageService = $villageService;
        $this->worldResponseManager = $worldResponseManager;
        $this->overviewResponseManager = $overviewResponseManager;
        $this->villageResponseManager = $villageResponseManager;
    }

    public function playerWorld(): Response
    {
        /** @var Player $player */
        $player = $this->getUser();

        return $this->successResponse(
            $this->worldResponseManager->buildPlayerWorldResponse(
                $player,
                $this->playerService->getPlayerWorld($player)
            )
        );
    }

    /**
     * @param PlayRequest $playRequest
     * @param ConstraintViolationList $validationErrors
     * @ParamConverter("playRequest", converter="fos_rest.request_body")
     * @return Response
     */
    public function play(PlayRequest $playRequest, ConstraintViolationList $validationErrors): Response
    {
        if ($validationErrors->count()) {
            return $this->validationErrorResponse($validationErrors);
        }

        /** @var Player $player */
        $player = $this->getUser();

        if ($playRequest->isPlaying()) {
            $playerVillage = $this->villageService->getPlayerVillageByWorld($player);
            if (!count($playerVillage)) {
                return $this->notFoundErrorResponse('Köy Bulunamadı!');
            }

            if (count($playerVillage) > 1) {
                $response = $this->overviewResponseManager->buildDefaultOverviewResponseCollection(
                    $playerVillage
                );
            } else {
                $playerVillage = array_shift($playerVillage);
                $response = $this->villageResponseManager->buildVillageInfoResponse(
                    $this->villageService->getVillageInfoById(
                        $player->getId(),
                        $player->getWorldId(),
                        $playerVillage->getId()
                    )
                );
            }
        } else {
            $playerVillage = $this->loginService->firstLoginInWorld($player);
            if (!$playerVillage) {
                return $this->customErrorResponse(
                    'Köy Oluşturulamadı!',
                    Response::HTTP_NOT_MODIFIED
                );
            }
            $response = $this->villageResponseManager->buildVillageInfoResponse($playerVillage);
        }

        return $this->successResponse($response);
    }

    public function profile()
    {

    }
}