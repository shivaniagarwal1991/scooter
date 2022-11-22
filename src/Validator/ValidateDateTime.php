<?php

namespace App\Validator;

use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

trait ValidateDateTime
{
    /**
     * @param string $dateTime
     * @return void
     */
    protected function isValidDateTime(string $dateTime): void
    {
        $delayDateTime = date("d-m-Y h:i:s", strtotime("-5 minutes"));
        $currentDateTime = date("d-m-Y h:i:s");
        if(strtotime($delayDateTime) > strtotime($dateTime)) {
            throw new BadRequestHttpException("Datetime should be greater than or equal to current datetime: $currentDateTime ");
        }

    }
}