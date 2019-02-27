<?php

namespace App\Repository;

use App\Entity\Excercise;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Excercise|null find($id, $lockMode = null, $lockVersion = null)
 * @method Excercise|null findOneBy(array $criteria, array $orderBy = null)
 * @method Excercise[]    findAll()
 * @method Excercise[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ExcerciseRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Excercise::class);
    }

    public function findAll()
    {
        return $this->findBy(array('status' => 1));
    }

    /*
    public function findOneBySomeField($value): ?Excercise
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
