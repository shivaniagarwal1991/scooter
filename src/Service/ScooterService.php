<?php

namespace App\Service;

use http\Exception\RuntimeException;
use Symfony\Component\HttpFoundation\Response;
use App\Service\Interface\IScooterService;
use App\Entity\Scooter as ScooterEntity;
use App\Repository\ScooterRepository;
use App\Constant\Contract;
use App\Constant\ScooterStatus;
use Symfony\Component\Uid\Uuid;

class ScooterService implements IScooterService
{
    private ScooterRepository $scooterRepository;

    public function __construct(ScooterRepository $scooterRepository)
    {
        $this->scooterRepository = $scooterRepository;
    }

    /**
     * @param string $startLat
     * @param string $startLng
     * @param string $userUuid
     * @return array
     */
    public function searchScooter(array $requestParam): array
    {
        $startLat = $requestParam['lat'];
        $startLng = $requestParam['lng'];
        $status = ScooterEntity::STATUS_AVAILABLE;

        if(!empty($requestParam['status'])) {
            $getStatus = strtolower($requestParam['status']);
            $statusArray = ScooterStatus::getStatus();
            foreach ($statusArray as $key => $val) {
                if (strtolower($val) == $getStatus) {
                    $status = $key;
                    break;
                }
            }
        }

        $extendLatRang = (int) $startLat + Contract::EXPEND_LAT;
        $extendLngRang = (int) $startLng + Contract::EXPEND_LNG;

        /*Fetch scooter based on geographically rectangular*/
        $scooters = $this->scooterRepository->findByLatLong((int) $startLat , (int) $startLng, $extendLatRang, $extendLngRang, $status);
        return [
            'count' => count($scooters),
            'scooter'=> $this->formatScooterObject($scooters)
        ];
    }

    /**
     * @param array $data
     * @return string
     */
    public function addScooter(array $data): string
    {
        $scooter = new ScooterEntity();
        $scooter->setCurrentLng($data['lng']);
        $scooter->setStatus(ScooterEntity::STATUS_AVAILABLE);
        $scooter->setCurrentLat($data['lat']);
        $this->scooterRepository->save($scooter, true);
        return $scooter->getUuid();
    }

    /**
     * @param array $data
     * @return int
     */
    public function addScooterWithUuid(array $data): int
    {
        $scooter = new ScooterEntity();
        $uuid = Uuid::fromString($data['scooterUuid']);
        $scooter->setUuid($uuid);
        $scooter->setCurrentLng($data['lng']);
        $scooter->setStatus(ScooterEntity::STATUS_AVAILABLE);
        $scooter->setCurrentLat($data['lat']);
        $this->scooterRepository->save($scooter, true);
        return Response::HTTP_CREATED;
    }

    /**
     * @param array $scooters
     * @return array
     */
    private function formatScooterObject(array $scooters): array
    {
        $records = [];
        if (!empty($scooters)) {
            foreach ($scooters as $scooter) :
                $data = [];
                $data['scooterUuid'] = $scooter->getUuid();
                $data['latitude'] = $scooter->getCurrentLat();
                $data['longitude'] = $scooter->getCurrentLng();
                $data['status'] = ScooterStatus::getStatus($scooter->getStatus());
                $records[] = $data;
            endforeach;
        }
        return $records;
    }

    /**
     * @param string $status
     * @param string $uuid
     * @return void
     */
    public function updateScooterStatus(string $status, string $uuid): void
    {
        if(empty($status) || empty($uuid)) {
            throw new RuntimeException("Invalid parameter for update the scooter.");
        }
        $this->scooterRepository->updateScooterStatus($uuid, $status);
    }

    /**
     * @param string $status
     * @param string $uuid
     * @param int $lat
     * @param int $lng
     * @return void
     */
    public function updateScooterLatLngAndStatus(string $status, string $uuid, int $lat, int $lng): void
    {
        if(empty($status) || empty($uuid) || empty($lat) || empty($lng)) {
            throw new RuntimeException("Invalid parameter for update the scooter.");
        }
        $this->scooterRepository->updateScooterLatLngAndStatus($uuid, $status, $lat, $lng);
    }

    /**
     * @param array $data
     * @return void
     */
    public function isScooterNotExistThenAdd(array $data): void
    {
        $isScooterAvailable = $this->scooterRepository->findByFields(['uuid' => $data['scooterUuid']]);
        if(count($isScooterAvailable) == 0) {
            $this->addScooterWithUuid($data);
        }
    }

}