<?php

namespace App\Validator;

use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\Uid\Uuid;

trait ValidateRequestParams
{
    use ValidateLatLngWithErrorMessage;
    use ValidateDateTime;

    /**
     * @param array $params
     * @return void
     */
    protected function hasValidSearchParams(array $params): void
    {
        $msg = "Expecting mandatory and valid body parameters lat, lng, and userUuid";
        if (count($params)) {
            if (empty($params['lat']) || empty($params['lng']) || empty($params['userUuid'])) {
                $this->throwRequestError($msg);
            }
            if(!Uuid::isValid($params['userUuid'])) {
                $this->throwRequestError('Expecting valid value of query parameter `userUuid`.');
            }
            $this->hasValidateLongitude($params['lng']);
            $this->hasValidateLatitude($params['lat']);
            return;
        }
        $this->throwRequestError($msg);
    }

    /**
     * @param array $params
     * @return void
     */
    protected function hasValidStartParams(array $params): array
    {
        $msg = "Expecting mandatory and valid body parameters lat, lng, scooterUuid, dateTime(d-m-Y h:i:s) and userUuid";
        if (count($params)) {
            if (empty($params['lat']) || empty($params['lng']) || empty($params['scooterUuid']) || empty($params['dateTime']) || empty($params['userUuid'])) {
                $this->throwRequestError($msg);
            }
            if(!Uuid::isValid($params['scooterUuid']) && !Uuid::isValid($params['userUuid'])) {
                $this->throwRequestError('Expecting valid value of query parameter userUuid and scooterUuid');
            }
            $this->isValidDateTime($params['dateTime']);
            $this->hasValidateLongitude($params['lng']);
            $this->hasValidateLatitude($params['lat']);
            return $this->transformStartParams($params);
        }
        $this->throwRequestError($msg);
    }

    /**
     * @param array $params
     * @return array
     */
    private function transformStartParams(array $params) {
        $transformParams = [];
        $transformParams['lat'] = $params['lat'];
        $transformParams['lng'] = $params['lng'];
        $transformParams['scooterUuid'] = $params['scooterUuid'];
        $transformParams['dateTime'] = $params['dateTime'];
        $transformParams['userUuid'] = $params['userUuid'];
        return $transformParams;
    }

    /**
     * @param array $params
     * @return void
     */
    protected function hasValidEndParams(array $params): void
    {
        $msg = "Expecting mandatory and valid body parameters lat, lng, scooterUuid, dateTime(d-m-Y h:i:s), rideUuid and userUuid";
        if (count($params)) {
            if (empty($params['lat']) || empty($params['lng']) || empty($params['scooterUuid']) || empty($params['dateTime']) || empty($params['userUuid']) || empty($params['rideUuid'])) {
                $this->throwRequestError($msg);
            }
            if(!Uuid::isValid($params['scooterUuid']) && !Uuid::isValid($params['userUuid']) && !Uuid::isValid($params['rideUuid'])) {
                $this->throwRequestError('Expecting valid value of query parameter userUuid, rideUuid and scooterUuid');
            }
            $this->isValidDateTime($params['dateTime']);
            $this->hasValidateLongitude($params['lng']);
            $this->hasValidateLatitude($params['lat']);
            return;
        }
        $this->throwRequestError($msg);
    }

    /**
     * @param array $params
     * @return void
     */
    protected function hasValidTrackParams(array $params): void
    {
        $msg = "Expecting mandatory and valid body parameters lat, lng, scooterUuid, dateTime(d-m-Y h:i:s) and rideUuid";
        if (count($params)) {
            if (empty($params['lat']) || empty($params['lng']) || empty($params['scooterUuid']) || empty($params['dateTime']) || empty($params['rideUuid'])) {
                $this->throwRequestError($msg);
            }
            if(!Uuid::isValid($params['scooterUuid']) && !Uuid::isValid($params['rideUuid'])) {
                $this->throwRequestError('Expecting valid value of query parameter userUuid, rideUuid and scooterUuid');
            }
            $this->isValidDateTime($params['dateTime']);
            $this->hasValidateLongitude($params['lng']);
            $this->hasValidateLatitude($params['lat']);
            return;
        }
        $this->throwRequestError($msg);
    }

    /**
     * @param string $message
     * @return void
     */
    private function throwRequestError(string $message): void
    {
        throw new BadRequestHttpException($message);
    }

}