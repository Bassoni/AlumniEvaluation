<?php

namespace App\Repository;

use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method User|null find($id, $lockMode = null, $lockVersion = null)
 * @method User|null findOneBy(array $criteria, array $orderBy = null)
 * @method User[]    findAll()
 * @method User[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }

    public function search( $degree , $year ){

        //utilisation de la methode createQueryBuilder pour effectuer des requete sql avec symfony
        $qb=$this->createQueryBuilder('u');
        //partie de la requete qui permet la jonction
        $qb->innerJoin('u.promotions','p');


        //partie de la requete qui permet de mettre une clause where  et application d'une configuration des parametres
        $qb->andWhere('p.degree = :degree_id')->setParameter('degree_id' , $degree);

        $qb->andWhere('p.year = :year_id')->setParameter('year_id' , $year);

        return $qb->getQuery()->getResult();

    }

    // /**
    //  * @return user[] Returns an array of user objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('u.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?user
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
