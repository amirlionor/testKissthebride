<?php

namespace App\Repository;

use App\Entity\NoteFrais;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManagerInterface;

/**
 * @extends ServiceEntityRepository<NoteFrais>
 *
 * @method NoteFrais|null find($id, $lockMode = null, $lockVersion = null)
 * @method NoteFrais|null findOneBy(array $criteria, array $orderBy = null)
 * @method NoteFrais[]    findAll()
 * @method NoteFrais[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NoteFraisRepository extends ServiceEntityRepository
{
    public function __construct(
        ManagerRegistry $registry,
        EntityManagerInterface $manager
    )
    {
        parent::__construct($registry, NoteFrais::class);
        $this->manager = $manager;
    }

//    /**
//     * @return NoteFrais[] Returns an array of NoteFrais objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('n')
//            ->andWhere('n.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('n.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?NoteFrais
//    {
//        return $this->createQueryBuilder('n')
//            ->andWhere('n.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
/**
 *
 */
    public function removeNote(NoteFrais $noteFrais): void
    {
        $this->manager->remove($noteFrais);
        $this->manager->flush();
    }
    public function saveNoteFrais(NoteFrais $noteFrais) : void
    {
        $this->manager->persist($noteFrais);
        $this->manager->flush();
    }
}
