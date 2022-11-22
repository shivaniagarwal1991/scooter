<?php

namespace App\Service;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use App\Service\Interface\IRideService;
use App\Entity\Ride as RideEntity;
use App\Entity\Scooter as ScooterEntity;
use App\Repository\RideRepository;
use App\Service\Interface\IScooterService;

class RideService implements IRideService
{
    private RideRepository $rideRepository;

    private IScooterService $scooterService;

    public function __construct(RideRepository $rideRepository,
                                IScooterService $scooterService)
    {
        $this->rideRepository = $rideRepository;
        $this->scooterService = $scooterService;
    }

    /**
     * @param array $data
     * @return string
     */
    public function addRide(array $data): string
    {
        /*check scooter exist or not if not then add it*/
        $this->scooterService->isScooterNotExistThenAdd($data);

        $isScooterClientFreeForRide = $this->rideRepository->findRidesWithScooterAndClient($data['scooterUuid'], $data['userUuid']);
        if(count($isScooterClientFreeForRide) != 0) {
            throw new BadRequestException("Requested scooter and client are already on rides");
        }

        $ride = new RideEntity();
        $ride->setStatus(RideEntity::STATUS_ONGOING);
        $ride->setClientUuid($data['userUuid']);
        $ride->setScooterUuid($data['scooterUuid']);
        $ride->setStartTime(strtotime($data['dateTime']));
        $this->rideRepository->save($ride, true);

        /*update scooter status*/
        $this->scooterService->updateScooterStatus( ScooterEntity::STATUS_OCCUPIED, $data['scooterUuid']);
        return $ride->getRideUuid();
    }

    /**
     * @param array $data
     * @return int
     */
    public function endRide(array $data): int
    {
        /*check ride exist or not*/
        $this->isRideOn($data['scooterUuid'], $data['userUuid'], $data['rideUuid']);
        $this->rideRepository->updateRideStatusAndTime($data['rideUuid'], RideEntity::STATUS_COMPLETED, strtotime($data['dateTime']));
        $this->scooterService->updateScooterLatLngAndStatus( ScooterEntity::STATUS_AVAILABLE, $data['scooterUuid'], $data['lat'], $data['lng']);
        return Response::HTTP_CREATED;

    }

    /**
     * @param string $scooterUuid
     * @param string $userUuid
     * @param string $rideUuid
     * @return void
     */
    public function isRideOn(string $scooterUuid, string $userUuid, string $rideUuid): void
    {
        $filterBy = ['scooter_uuid' => $scooterUuid,
                    'status' => RideEntity::STATUS_ONGOING,
                    'ride_uuid' => $rideUuid,
                    'client_uuid' => $userUuid];

        $isRideOn = $this->rideRepository->findByFields($filterBy);
        if(count($isRideOn) == 0) {
            throw new BadRequestException("Ride has already overed.");
        }
    }


}