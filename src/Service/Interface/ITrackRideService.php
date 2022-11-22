<?php

namespace App\Service\Interface;

interface ITrackRideService
{
    /**
     * @param array $data
     * @return array
     */
    public function addTrackRide(array $data): array;

}