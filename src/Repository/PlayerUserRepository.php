<?php

namespace App\Repository;

use App\Entity\User\PlayerUser;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<PlayerUser>
 *
 * @method PlayerUser|null find($id, $lockMode = null, $lockVersion = null)
 * @method PlayerUser|null findOneBy(array $criteria, array $orderBy = null)
 * @method PlayerUser[]    findAll()
 * @method PlayerUser[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PlayerUserRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PlayerUser::class);
    }

    public function save(PlayerUser $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(PlayerUser $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
}
