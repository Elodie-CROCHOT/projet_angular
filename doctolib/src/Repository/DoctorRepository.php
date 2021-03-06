<?php

namespace App\Repository;

use App\Entity\Doctor;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @method Doctor|null find($id, $lockMode = null, $lockVersion = null)
 * @method Doctor|null findOneBy(array $criteria, array $orderBy = null)
 * @method Doctor[]    findAll()
 * @method Doctor[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DoctorRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Doctor::class);
    }

    public function searchBySpecialty($value)
    {
        return $this->createQueryBuilder('d')
            ->select('d')
            ->where('d.specialty = :value')
            ->setParameter('value', $value)
            ->getQuery()
            ->getResult();
    }

    public function searchByEmail($value1, $value2)
    {
        return $this->createQueryBuilder('d')
            ->select('d')
            ->where('d.email = :email')
            ->andWhere('d.password = :password')
            ->setParameter('email', $value1)
            ->setParameter('password', $value2)
            ->getQuery()
            ->getResult();
    }

    // /**
    //  * @return Doctor[] Returns an array of Doctor objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Doctor
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
