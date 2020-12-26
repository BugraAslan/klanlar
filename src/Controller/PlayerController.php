<?php

namespace App\Controller;

use App\Manager\Response\WorldResponseManager;
use App\Service\PlayerService;
use Symfony\Component\HttpFoundation\Response;

class PlayerController extends BaseController
{
    /** @var PlayerService */
    private $playerService;

    /** @var WorldResponseManager */
    private $worldResponseManager;

    /**
     * PlayerController constructor.
     * @param PlayerService $playerService
     * @param WorldResponseManager $worldResponseManager
     */
    public function __construct(PlayerService $playerService, WorldResponseManager $worldResponseManager)
    {
        $this->playerService = $playerService;
        $this->worldResponseManager = $worldResponseManager;
    }

    public function worldLogin(): Response
    {
        $worldLoginCollection = $this->playerService->getWorldLogin($this->getUser()->getId());

        return $this->successResponse(
            $this->worldResponseManager->buildWorldLoginResponse(
                $worldLoginCollection->get('player'),
                $worldLoginCollection->get('availableWorlds')
            )
        );
    }

    public function profile()
    {

    }
}