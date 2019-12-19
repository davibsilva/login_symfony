<?php

namespace App\Repository;

use App\Entity\UserTable;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method UserTable|null find($id, $lockMode = null, $lockVersion = null)
 * @method UserTable|null findOneBy(array $criteria, array $orderBy = null)
 * @method UserTable[]    findAll()
 * @method UserTable[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserTableRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UserTable::class);
    }
    

    // /**
    //  * @return UserTable[] Returns an array of UserTable objects
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
    public function findOneBySomeField($value): ?UserTable
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    public function findAllGreaterThanPrice ( $price , $includeUnavailableProducts = false ) : array
{
    // automatically knows to select Products
    // the "p" is an alias you'll use in the rest of the query
    $qb = $this -> createQueryBuilder ( 'p' )
        -> where ( 'p.price > :price' )
        -> setParameter ( 'price' , $price )
        -> orderBy ( 'p.price' , 'ASC' );

    if ( ! $includeUnavailableProducts ) {
        $qb -> andWhere ( 'p.available = TRUE' );
    }

    $query = $qb -> getQuery ();

    return $query -> execute ();

    // to get just one result:
    // $product = $query->setMaxResults(1)->getOneOrNullResult();
}

    
}

