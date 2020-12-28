<?php

namespace App\Service;

use App\Entity\Building;
use App\Entity\Player;
use App\Entity\PlayerProfile;
use App\Entity\PlayerToken;
use App\Entity\PlayerVillage;
use App\Entity\PlayerWorld;
use App\Entity\VillageBuilding;
use App\Entity\VillageResource;
use App\Entity\World;
use App\Model\Request\Login\LoginRequest;
use App\Security\JwtTokenGenerator;
use App\Util\VillageUtil;
use Doctrine\ORM\ORMException;

class LoginService extends BaseService
{
    /** @var JwtTokenGenerator */
    private $jwtTokenGenerator;

    /**
     * LoginService constructor.
     * @param JwtTokenGenerator $jwtTokenGenerator
     */
    public function __construct(JwtTokenGenerator $jwtTokenGenerator)
    {
        $this->jwtTokenGenerator = $jwtTokenGenerator;
    }

    /**
     * @param LoginRequest $loginRequest
     * @return PlayerToken|null
     */
    public function login(LoginRequest $loginRequest): ?PlayerToken
    {
        $player = $this->entityManager->getRepository(Player::class)->findOneBy([
            'username' => $loginRequest->getUsername(),
            'password' => md5($loginRequest->getPassword())
        ]);

        $playerToken = null;
        if ($player instanceof Player){
            $playerToken = $this->entityManager->getRepository(PlayerToken::class)->findOneBy([
                'player' => $player->getId()
            ]);

            $accessToken = $this->jwtTokenGenerator->generateToken();
            $refreshToken = $this->jwtTokenGenerator->generateRefreshToken($player->getId());
            $expireDate = (new \DateTime())->modify($this->container->getParameter('default_expire_time'));

            if ($playerToken instanceof PlayerToken){
                $playerToken
                    ->setAccessToken($accessToken)
                    ->setRefreshToken($refreshToken)
                    ->setExpireDate($expireDate);
            } else {
                $playerToken = (new PlayerToken())
                    ->setAccessToken($accessToken)
                    ->setRefreshToken($refreshToken)
                    ->setPlayer($player)
                    ->setExpireDate($expireDate);
            }

            try {
                $this->entityManager->persist($playerToken);
                $this->entityManager->flush($playerToken);
            } catch (ORMException $e) {
                return null;
            }
        }

        return $playerToken;
    }

    public function firstLoginInWorld(Player $player, int $worldId): ?PlayerVillage
    {
        try {
            $this->entityManager->getConnection()->beginTransaction();

            $playerVillage = (new PlayerVillage())
                ->setPlayer($player)
                ->setName(ucfirst($player->getUsername()) . ' Köyü')
                ->setContinent(random_int(1, 100)) // TODO change !!!
                ->setCoordinateX(random_int(1, 100)) // TODO change !!!
                ->setCoordinateY(random_int(1, 100)) // TODO change !!!
                ->setLoyalty(100)
                ->setScore(VillageUtil::DEFAULT_VILLAGE_SCORE);
            $this->entityManager->persist($playerVillage);

            $playerWorld = (new PlayerWorld())
                ->setPlayer($player)
                ->setWorld($this->entityManager->getRepository(World::class)->find($worldId));
            $this->entityManager->persist($playerWorld);

            $villageResource = (new VillageResource())
                ->setVillage($playerVillage)
                ->setWood(VillageUtil::DEFAULT_RESOURCE)
                ->setIron(VillageUtil::DEFAULT_RESOURCE)
                ->setClay(VillageUtil::DEFAULT_RESOURCE)
                ->setPopulation(VillageUtil::DEFAULT_POPULATION)
                ->setWarehouse(VillageUtil::DEFAULT_WAREHOUSE);
            $this->entityManager->persist($villageResource);

            $playerProfile = (new PlayerProfile())
                ->setWorldId($worldId)
                ->setPlayer($player);
            $this->entityManager->persist($playerProfile);

            $defaultBuildings = $this->entityManager->getRepository(Building::class)->findBy([
                'minLevel' => 1
            ]);

            foreach ($defaultBuildings as $building) {
                $villageBuilding = (new VillageBuilding())
                    ->setVillage($playerVillage)
                    ->setBuilding($building)
                    ->setBuildingLevel($building->getMinLevel());
                $this->entityManager->persist($villageBuilding);
            }

            $this->entityManager->flush();
            $this->entityManager->getConnection()->commit();
        } catch (\Exception $e) {
            $this->entityManager->getConnection()->rollBack();
            return null;
        }

        return $playerVillage;
    }
}