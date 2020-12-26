<?php

namespace App\Service;

use App\Entity\Player;
use App\Entity\PlayerActivation;
use App\Entity\PlayerNotification;
use App\Model\Request\Register\RegisterRequest;
use App\Util\TextUtil;
use DateTime;
use Doctrine\DBAL\ConnectionException;

class RegisterService extends BaseService
{
    /**
     * @param RegisterRequest $registerRequest
     * @return Player|null
     */
    public function register(RegisterRequest $registerRequest): ?Player
    {
        $player = null;
        $this->entityManager->getConnection()->beginTransaction();

        // TODO send mail for activation code !!!

        try {
            $player = (new Player())
                ->setEmail($registerRequest->getEmail())
                ->setPassword(md5($registerRequest->getPassword()))
                ->setUsername($registerRequest->getUsername())
                ->setCreatedDate(new DateTime());

            $playerActivation = (new PlayerActivation())
                ->setPlayer($player)
                ->setActivationCode(TextUtil::generateActivationCode())
                ->setIsActive(false)
                ->setRequestDate(new DateTime())
                ->setActivationDate(null);

            $playerNotification = (new PlayerNotification())
                ->setPlayer($player)
                ->setBuildNotification(true)
                ->setMessageNotification(true);

            $player
                ->setActivation($playerActivation)
                ->setNotification($playerNotification);

            $this->entityManager->persist($playerActivation);
            $this->entityManager->persist($playerNotification);
            $this->entityManager->persist($player);
            $this->entityManager->flush();
            $this->entityManager->getConnection()->commit();
        } catch (\Exception $exception) {
            try {
                $this->entityManager->getConnection()->rollBack();
            } catch (ConnectionException $e) {
                return null;
            }
            return null;
        }

        return $player;
    }
}