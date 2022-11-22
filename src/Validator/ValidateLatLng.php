<?php

namespace App\Validator;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

trait ValidateLatLng
{
    /**
     * Validates a given latitude $lat
     *
     * @param float|int|string $lat Latitude
     * @return bool `true` if $lat is valid, `false` if not
     */
    function validateLatitude($lat) {
        return preg_match('/^(\+|-)?((\d((\.)|\.\d{1,6})?)|(0*?[0-8]\d((\.)|\.\d{1,6})?)|(0*?90((\.)|\.0{1,6})?))$
/', $lat);
    }

    /**
     * Validates a given longitude $long
     *
     * @param float|int|string $long Longitude
     * @return bool `true` if $long is valid, `false` if not
     */
    function validateLongitude($long) {
        return preg_match('/^(\+|-)?((\d((\.)|\.\d{1,6})?)|(0*?\d\d((\.)|\.\d{1,6})?)|(0*?1[0-7]\d((\.)|\.\d{1,6})?)|(0*?180((\.)|\.0{1,6})?))$
/', $long);
    }
}