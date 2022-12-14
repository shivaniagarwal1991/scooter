<?php

namespace App\Service\Interface;

interface IScooterService
{
    /**
     * @param array $data
     * @return string
     */
    public function addScooter(array $data): string;

    /**
     * @param array $requestParam
     * @return array
     */
    public function searchScooter(array $requestParam): array;

    /**
     * @param array $data
     * @return int
     */
    public function addScooterWithUuid(array $data): int;

    /**
     * @param string $status
     * @param string $uuid
     * @return void
     */
    public function updateScooterStatus(string $status, string $uuid): void;

    /**
     * @param string $status
     * @param string $uuid
     * @param int $lat
     * @param int $lng
     * @return void
     */
    public function updateScooterLatLngAndStatus(string $status, string $uuid, int $lat, int $lng): void;

    /**
     * @param array $data
     * @return void
     */
    public function isScooterNotExistThenAdd(array $data): void;

}