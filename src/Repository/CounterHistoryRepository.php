<?php

namespace App\Repository;

use App\Entity\CounterHistory;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method CounterHistory|null find($id, $lockMode = null, $lockVersion = null)
 * @method CounterHistory|null findOneBy(array $criteria, array $orderBy = null)
 * @method CounterHistory[]    findAll()
 * @method CounterHistory[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CounterHistoryRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, CounterHistory::class);
    }

//    /**
//     * @return CounterHistory[] Returns an array of CounterHistory objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?CounterHistory
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
