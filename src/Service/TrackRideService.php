<?php

namespace App\Service;

use Symfony\Component\HttpFoundation\Response;
use App\Service\Interface\ITrackRideService;
use App\Entity\TrackRide as TrackRideEntity;
use App\Repository\TrackRideRepository;
use App\Service\Interface\IRideService;

class TrackRideService implements ITrackRideService
{
    private TrackRideRepository $trackRideRepository;

    private IRideService $rideService;

    public function __construct(TrackRideRepository $trackRideRepository,
                                IRideService $rideService)
    {
        $this->rideService = $rideService;
        $this->trackRideRepository = $trackRideRepository;
    }

    /**
     * @param array $data
     * @return array
     */
    public function addTrackRide(array $data): array
    {
        /*check ride exist or not*/
        $this->rideService->isRideOn($data['scooterUuid'], $data['userUuid'], $data['rideUuid']);

        $trackRide = new TrackRideEntity();
        $trackRide->setLat($data['lat']);
        $trackRide->setLng($data['lng']);
        $trackRide->setRideUuid($data['rideUuid']);
        $trackRide->setEventTime(strtotime($data['dateTime']));
        $this->trackRideRepository->save($trackRide, true);
        return [
            'lat' => $trackRide->getLat(),
            'lng' => $trackRide->getLng(),
            'rideUuid' => $trackRide->getRideUuid()
        ];
    }


}