<?php

namespace App\Repository;

use App\Entity\Scooter;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Scooter>
 *
 * @method Scooter|null find($id, $lockMode = null, $lockVersion = null)
 * @method Scooter|null findOneBy(array $criteria, array $orderBy = null)
 * @method Scooter[]    findAll()
 * @method Scooter[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ScooterRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Scooter::class);
    }

    public function save(Scooter $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Scooter $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function findByLatLong(int $startLat, int $startLng, int $endLat, int $endLng, int $status = Scooter::STATUS_AVAILABLE): ?array
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.status = '. $status)
            ->andWhere('s.current_lat BETWEEN :startLat AND :endLat')
            ->andWhere('s.current_lng BETWEEN :startLng AND :endLng')
            ->setParameter('startLat', $startLat)
            ->setParameter('endLat', $endLat)
            ->setParameter('startLng', $startLng)
            ->setParameter('endLng', $endLng)
            ->getQuery()
            ->getResult();
    }

    public function findByFields(array $keyValPairs): ?array
    {
        $query =  $this->createQueryBuilder('s');
        foreach ($keyValPairs as $key => $value) {
            $query->andWhere("s.$key = :$key")->setParameter($key , $value);
        }
        return $query->getQuery()->getResult();
    }

    public function updateScooterStatus(string $uuid, int $status): ?int
    {
        $currentTime = strtotime(date('d-m-Y h:i:s'));
        return $this->createQueryBuilder('s')
            ->update()
            ->set('s.status', ':status')
            ->setParameter('status', $status)
            ->set('s.updated_at', ':updatedAt')
            ->setParameter('updatedAt', $currentTime)
            ->where('s.uuid = :uuid')
            ->setParameter('uuid', $uuid)
            ->getQuery()
            ->getSingleScalarResult();
    }

    public function updateScooterLatLngAndStatus(string $uuid, int $status, int $lat, int $lng): ?int
    {
        $currentTime = strtotime(date('d-m-Y h:i:s'));
        return $this->createQueryBuilder('s')
            ->update()
            ->set('s.current_lat', ':lat')
            ->setParameter('lat', $lat)
            ->set('s.current_lng', ':lng')
            ->setParameter('lng', $lng)
            ->set('s.status', ':status')
            ->setParameter('status', $status)
            ->set('s.updated_at', ':updatedAt')
            ->setParameter('updatedAt', $currentTime)
            ->where('s.uuid = :uuid')
            ->setParameter('uuid', $uuid)
            ->getQuery()
            ->getSingleScalarResult();
    }


//    /**
//     * @return Scooter[] Returns an array of Scooter objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('s.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Scooter
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
