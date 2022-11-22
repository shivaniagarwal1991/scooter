<?php

namespace App\Entity;

use App\Repository\RideRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Uuid;

#[ORM\Entity(repositoryClass: RideRepository::class)]
class Ride
{
    const STATUS_ONGOING = 1;
    const STATUS_COMPLETED = 2;

    #[ORM\Column(type: 'string', unique: true)]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[ORM\CustomIdGenerator(class: 'doctrine.uuid_generator')]
    private string $ride_uuid;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $scooter_uuid;

    #[ORM\Column(length: 50)]
    private ?string $client_uuid;

    #[ORM\Column(type: Types::SMALLINT)]
    private ?int $status = null;

    #[ORM\Column(length: 50)]
    private ?string $start_time = null;

    #[ORM\Column(length: 50)]
    private ?string $end_time = null;

    #[ORM\Column(length: 50)]
    private ?string $created_at = null;

    #[ORM\Column(length: 50)]
    private ?string $updated_at = null;

    public function __construct() {
        $this->ride_uuid = Uuid::v1();
        $this->created_at = strtotime(date('d-m-Y h:i:s'));
        $this->updated_at = strtotime(date('d-m-Y h:i:s'));
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRideUuid(): ?string
    {
        return $this->ride_uuid;
    }

    public function setRideUuid(string $ride_uuid): self
    {
        $this->ride_uuid = $ride_uuid;

        return $this;
    }
    public function getClientUuid(): ?string
    {
        return $this->client_uuid;
    }

    public function setClientUuid(string $client_uuid): self
    {
        $this->client_uuid = $client_uuid;

        return $this;
    }
    public function getScooterUuid(): ?string
    {
        return $this->scooter_uuid;
    }

    public function setScooterUuid(string $scooter_uuid): self
    {
        $this->scooter_uuid = $scooter_uuid;

        return $this;
    }

    public function getStatus(): ?int
    {
        return $this->status;
    }

    public function setStatus(int $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getStartTime(): ?string
    {
        return $this->start_time;
    }

    public function setStartTime(string $start_time): self
    {
        $this->start_time = $start_time;

        return $this;
    }

    public function getEndTime(): ?string
    {
        return $this->end_time;
    }

    public function setEndTime(?string $end_time): self
    {
        $this->end_time = $end_time;

        return $this;
    }

    public function getCreatedAt(): ?string
    {
        return $this->created_at;
    }

    public function setCreatedAt(string $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getUpdatedAt(): ?string
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(string $updated_at): self
    {
        $this->updated_at = $updated_at;

        return $this;
    }
}
