<?php

namespace App\Service\Interface;

interface IRideService
{
    /**
     * @param array $data
     * @return string
     */
    public function addRide(array $data): string;

    /**
     * @param array $data
     * @return int
     */
    public function endRide(array $data): int;

    /**
     * @param string $scooterUuid
     * @param string $userUuid
     * @param string $rideUuid
     * @return void
     */
    public function isRideOn(string $scooterUuid, string $userUuid, string $rideUuid): void;

}