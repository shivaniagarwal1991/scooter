<?php

namespace App\Constant;

class ScooterStatus
{
    const STATUS_OCCUPIED = 'Occupied';
    const STATUS_AVAILABLE = 'Available';
    const STATUS_OUT_OF_SERVICE = 'Out Of Service';

    /**
     * @param int $key
     * @return string
     */
    static function getStatus(int $key = 1): string
    {
        $status = [
            1 => ScooterStatus::STATUS_AVAILABLE,
            2 => ScooterStatus::STATUS_OCCUPIED,
            3 => ScooterStatus::STATUS_OUT_OF_SERVICE,
        ];
        return $status[$key];
    }
}
