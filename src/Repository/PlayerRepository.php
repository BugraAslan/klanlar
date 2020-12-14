<?php

namespace App\Repository;

use App\Entity\Player;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Player|null find($id, $lockMode = null, $lockVersion = null)
 * @method Player|null findOneBy(array $criteria, array $orderBy = null)
 * @method Player[]    findAll()
 * @method Player[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PlayerRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Player::class);
    }

    public function findPlayerCountByUsername(string $username): ?int
    {
        try {
            return $this->createQueryBuilder('player')
                ->select('COUNT(player.id)')
                ->where('LOWER(player.username) = :username')
                ->setParameter('username', strtolower($username))
                ->getQuery()
                ->getSingleScalarResult();
        } catch (NoResultException | NonUniqueResultException $e) {
            return null;
        }
    }

    public function findPlayerCountByEmail(string $email): ?int
    {
        try {
            return $this->createQueryBuilder('player')
                ->select('COUNT(player.id)')
                ->where('LOWER(player.email) = :email')
                ->setParameter('email', strtolower($email))
                ->getQuery()
                ->getSingleScalarResult();
        } catch (NoResultException | NonUniqueResultException $e) {
            return null;
        }
    }

    public function findPlayerWorldByPlayerId(int $playerId): ?Player
    {
        try {
            return $this->createQueryBuilder('player')
                ->addSelect('playerWorlds')
                ->addSelect('world')
                ->join('player.worlds', 'playerWorlds')
                ->join('playerWorlds.world', 'world')
                ->where('player.id = :playerId')
                ->setParameter('playerId', $playerId)
                ->getQuery()
                ->getOneOrNullResult();
        } catch (NonUniqueResultException $e) {
            return null;
        }
    }
}
