<?php

namespace App\Controller;

use App\Entity\Player;
use App\Manager\Response\WorldResponseManager;
use App\Model\Request\Login\PlayRequest;
use App\Service\LoginService;
use App\Service\PlayerService;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\ConstraintViolationList;

class PlayerController extends BaseController
{
    /** @var PlayerService */
    private $playerService;

    /** @var LoginService */
    private $loginService;

    /** @var WorldResponseManager */
    private $worldResponseManager;

    /**
     * PlayerController constructor.
     * @param PlayerService $playerService
     * @param LoginService $loginService
     * @param WorldResponseManager $worldResponseManager
     */
    public function __construct(
        PlayerService $playerService,
        LoginService $loginService,
        WorldResponseManager $worldResponseManager
    ) {
        $this->playerService = $playerService;
        $this->loginService = $loginService;
        $this->worldResponseManager = $worldResponseManager;
    }

    public function playerWorld(): Response
    {
        $worldLoginCollection = $this->playerService->getPlayerWorld($this->getUser()->getId());

        return $this->successResponse(
            $this->worldResponseManager->buildPlayerWorldResponse(
                $worldLoginCollection->get('player'),
                $worldLoginCollection->get('availableWorlds')
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

        $isPlaying = false;
        if ($playRequest->isPlaying()) {
            $isPlaying = $this->playerService->hasPlayingInWorld($player->getId(), $playRequest->getWorldId());
        }

        // TODO change
        if ($isPlaying) {
            $playerVillageCount = $this->playerService->getPlayerVillageCountByWorld($player->getId(), $playRequest->getWorldId());
        } else {
            $playerVillage = $this->loginService->firstLoginInWorld($player, $playRequest->getWorldId());
        }

        // TODO overview villages or village info
        return $this->successResponse([]);
    }

    public function profile()
    {

    }
}