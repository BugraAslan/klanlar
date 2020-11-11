<?php

namespace App\Repository;

use App\Entity\Player;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
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

    /**
     * @param string $username
     * @return int
     */
    public function findPlayerCountByUsername(string $username)
    {
        return $this->createQueryBuilder('player')
            ->select('COUNT(player.id)')
            ->where('LOWER(player.username) = :username')
            ->setParameter('username', strtolower($username))
            ->getQuery()
            ->getSingleScalarResult();
    }

    /**
     * @param string $email
     * @return int
     */
    public function findPlayerCountByEmail(string $email)
    {
        return $this->createQueryBuilder('player')
            ->select('COUNT(player.id)')
            ->where('LOWER(player.email) = :email')
            ->setParameter('email', strtolower($email))
            ->getQuery()
            ->getSingleScalarResult();
    }
}
