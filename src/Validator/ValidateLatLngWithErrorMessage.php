<?php

namespace App\Validator;

use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

trait ValidateLatLngWithErrorMessage
{
    use ValidateLatLng;

    private function hasValidLngAndLat(array|null $latLong): void
    {
        if (empty($latLong) || empty($latLong['lat']) || empty($latLong['lng'])) {
            $this->throwLatLngError('Expecting longitude in `lng` key and latitude in `lat` key');
        }
        $this->hasValidateLongitude($latLong['lng']);
        $this->hasValidateLatitude($latLong['lat']);
    }

    private function hasValidateLongitude(string $longitude): void
    {
        if($this->validateLongitude($longitude)) {
            $this->throwLatLngError('Expecting longitude in `lng` key with valid value');
        }
    }


    private function hasValidateLatitude(string $latitude): void
    {

        if($this->validateLatitude($latitude)) {
            $this->throwLatLngError('Expecting latitude in `lat` key with valid value');
        }
    }

    /**
     * @param string $message
     * @return void
     */
    private function throwLatLngError(string $message): void
    {
        throw new BadRequestHttpException($message);
    }

}