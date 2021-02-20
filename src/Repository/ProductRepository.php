<?php

namespace App\Repository;

use App\Entity\Product;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Product|null find($id, $lockMode = null, $lockVersion = null)
 * @method Product|null findOneBy(array $criteria, array $orderBy = null)
 * @method Product[]    findAll()
 * @method Product[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Product::class);
    }

    public function create(Product $product): void
    {
        $entityManager = $this->getEntityManager();
        try
        {
            $entityManager->persist($product);
            $entityManager->flush();
        }
        catch (OptimisticLockException | ORMException $e)
        {
        }
    }
    /**
     * @param $value
     * @return Product[] Returns an array of Product objects
     */
    public function findByField($value): array
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult();
    }
    /*
    public function findOneBySomeField($value): ?Product
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    /*
    public function update()
    {

    }*/
    public function delete(Product $product): void
    {
        $entityManager = $this->getEntityManager();
        try
        {
            $entityManager->remove($product);
            $entityManager->flush();
        }
        catch (OptimisticLockException | ORMException $e)
        {
        }
    }

}
