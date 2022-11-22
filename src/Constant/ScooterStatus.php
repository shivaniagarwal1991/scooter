<?php

namespace App\Constant;

class ScooterStatus
{
    const STATUS_OCCUPIED = 'Occupied';
    const STATUS_AVAILABLE = 'Available';
    const STATUS_OUT_OF_SERVICE = 'Out Of Service';

    /**
     * @param int $key
     * @return string|array
     */
    static function getStatus(int $key = 0): string|array
    {
        $status = [
            1 => ScooterStatus::STATUS_AVAILABLE,
            2 => ScooterStatus::STATUS_OCCUPIED,
            3 => ScooterStatus::STATUS_OUT_OF_SERVICE,
        ];
        return ($key == 0)? $status : $status[$key];
    }
}
