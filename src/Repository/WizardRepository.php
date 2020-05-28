<?php

namespace App\Repository;

use App\Entity\Wizard;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Wizard|null find($id, $lockMode = null, $lockVersion = null)
 * @method Wizard|null findOneBy(array $criteria, array $orderBy = null)
 * @method Wizard[]    findAll()
 * @method Wizard[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class WizardRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Wizard::class);
    }

    // /**
    //  * @return Wizard[] Returns an array of Wizard objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('w')
            ->andWhere('w.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('w.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Wizard
    {
        return $this->createQueryBuilder('w')
            ->andWhere('w.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
