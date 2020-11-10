<?php

namespace App\Repository;

use App\Entity\PlayerToken;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PlayerToken|null find($id, $lockMode = null, $lockVersion = null)
 * @method PlayerToken|null findOneBy(array $criteria, array $orderBy = null)
 * @method PlayerToken[]    findAll()
 * @method PlayerToken[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PlayerTokenRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PlayerToken::class);
    }

    public function findActivePlayerToken(string $accessToken)
    {
        try {
            return $this->createQueryBuilder('player_token')
                ->select('player_token')
                ->innerJoin('player_token.player', 'playerEntity')
                ->where('player_token.accessToken = :accessToken')
                ->andWhere('player_token.expireDate > :nowDate')
                ->setParameters([
                    'accessToken' => $accessToken,
                    'nowDate' => new \DateTime()
                ])
                ->getQuery()
                ->getOneOrNullResult();
        } catch (NonUniqueResultException $e) {
            return null;
        }
    }
}
