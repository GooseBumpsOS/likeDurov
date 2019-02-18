<?php

namespace App\Repository;

use App\Entity\ChatData;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method ChatData|null find($id, $lockMode = null, $lockVersion = null)
 * @method ChatData|null findOneBy(array $criteria, array $orderBy = null)
 * @method ChatData[]    findAll()
 * @method ChatData[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ChatDataRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, ChatData::class);
    }

    // /**
    //  * @return ChatData[] Returns an array of ChatData objects
    //  */
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
    public function findOneBySomeField($value): ?ChatData
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
