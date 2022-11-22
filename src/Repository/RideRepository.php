<?php

namespace App\Repository;

use App\Entity\Ride;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
/**
 * @extends ServiceEntityRepository<Ride>
 *
 * @method Ride|null find($id, $lockMode = null, $lockVersion = null)
 * @method Ride|null findOneBy(array $criteria, array $orderBy = null)
 * @method Ride[]    findAll()
 * @method Ride[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RideRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Ride::class);
    }

    public function save(Ride $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Ride $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function findRidesWithScooterAndClient(string $scooterUuid, string $clientUuid): ?array
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.scooter_uuid = :scooterUuid')
            ->orWhere('r.client_uuid = :clientUuid')
            ->andWhere('r.status ='. Ride::STATUS_ONGOING)
            ->setParameter('scooterUuid', $scooterUuid)
            ->setParameter('clientUuid', $clientUuid)
            ->getQuery()
            ->getResult();
    }

    public function findByFields(array $keyValPairs): ?array
    {
        $query =  $this->createQueryBuilder('r');
        foreach ($keyValPairs as $key => $value) {
            $query->andWhere("r.$key = :$key")->setParameter($key , $value);
        }
        return $query->getQuery()->getResult();
    }

    public function updateRideStatusAndTime(string $rideUuid, int $status, string $endTime): ?int
    {
        $currentTime = strtotime(date('d-m-Y h:i:s'));
        return $this->createQueryBuilder('r')
            ->update()
            ->set('r.status', ':status')
            ->setParameter('status', $status)
            ->set('r.end_time', ':endTime')
            ->setParameter('endTime', $endTime)
            ->set('r.updated_at', ':updatedAt')
            ->setParameter('updatedAt', $currentTime)
            ->where('r.ride_uuid = :rideUuid')
            ->setParameter('rideUuid', $rideUuid)
            ->getQuery()
            ->getSingleScalarResult();
    }

//    /**
//     * @return Ride[] Returns an array of Ride objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('r.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Ride
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
