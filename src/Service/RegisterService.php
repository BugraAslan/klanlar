<?php

namespace App\Service;

use App\Entity\Player;
use App\Entity\PlayerActivation;
use App\Entity\PlayerNotification;
use App\Entity\PlayerProfile;
use App\Model\Request\Register\RegisterRequest;
use App\Model\Response\Register\RegisterResponse;
use App\Util\TextUtil;
use DateTime;

class RegisterService extends BaseService
{
    /**
     * @param RegisterRequest $registerRequest
     * @return RegisterResponse|null
     */
    public function register(RegisterRequest $registerRequest)
    {
        $registerResponse = null;
        $this->entityManager->getConnection()->beginTransaction();

        // TODO change !!!!
        // TODO send mail for activation code
        // TODO response !!!

        try {
            $player = (new Player())
                ->setEmail($registerRequest->getEmail())
                ->setPassword(md5($registerRequest->getPassword()))
                ->setUsername($registerRequest->getUsername())
                ->setCreatedDate(new DateTime());
            $this->entityManager->persist($player);

            $playerActivation = (new PlayerActivation())
                ->setPlayer($player)
                ->setActivationCode(TextUtil::generateActivationCode())
                ->setIsActive(false)
                ->setRequestDate(new DateTime())
                ->setActivationDate(null);
            $this->entityManager->persist($playerActivation);

            $playerProfile = (new PlayerProfile())->setPlayer($player);
            $this->entityManager->persist($playerProfile);

            $playerNotification = (new PlayerNotification())
                ->setPlayer($player)
                ->setBuildNotification(true)
                ->setMessageNotification(true);
            $this->entityManager->persist($playerNotification);

            $this->entityManager->flush();
            $this->entityManager->getConnection()->commit();

            $registerResponse = (new RegisterResponse())
                ->setActivationCode($playerActivation->getActivationCode())
                ->setUsername($player->getUsername())
                ->setId($player->getId());

        } catch (\Exception $exception){
            $this->entityManager->getConnection()->rollBack();
        }

        return $registerResponse;
    }
}