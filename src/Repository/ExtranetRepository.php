<?php

namespace App\Repository;

use App\Entity\Extranet;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Extranet>
 *
 * @method Extranet|null find($id, $lockMode = null, $lockVersion = null)
 * @method Extranet|null findOneBy(array $criteria, array $orderBy = null)
 * @method Extranet[]    findAll()
 * @method Extranet[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ExtranetRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Extranet::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(Extranet $entity, bool $flush = true): void
    {
        $this->_em->persist($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function remove(Extranet $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }
}
