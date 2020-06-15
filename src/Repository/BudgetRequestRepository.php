<?php

namespace App\Repository;

use App\Entity\BudgetRequest;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method BudgetRequest|null find($id, $lockMode = null, $lockVersion = null)
 * @method BudgetRequest|null findOneBy(array $criteria, array $orderBy = null)
 * @method BudgetRequest[]    findAll()
 * @method BudgetRequest[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BudgetRequestRepository extends ServiceEntityRepository
{
    /**
     * BudgetRequestRepository constructor.
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BudgetRequest::class);
    }

    /**
     * @param BudgetRequest $budgetRequest
     */
    public function save(BudgetRequest $budgetRequest)
    {
        try {
            $this->_em->persist($budgetRequest);
            $this->_em->flush();
        } catch (OptimisticLockException $e) {
        } catch (ORMException $e) {
        }
    }

    // /**
    //  * @return BudgetRequest[] Returns an array of BudgetRequest objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('b.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?BudgetRequest
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
