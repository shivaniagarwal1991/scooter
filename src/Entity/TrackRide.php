<?php

namespace App\Entity;

use App\Repository\TrackRideRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TrackRideRepository::class)]
class TrackRide
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $ride_uuid;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 8)]
    private ?string $lat = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 11, scale: 8)]
    private ?string $lng = null;

    #[ORM\Column(length: 50)]
    private ?string $event_time = null;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRideUuid(): string
    {
        return $this->ride_uuid;
    }

    public function setRideUuid(string $ride_uuid): self
    {
        $this->ride_uuid = $ride_uuid;

        return $this;
    }

    public function getLat(): ?string
    {
        return $this->lat;
    }

    public function setLat(string $lat): self
    {
        $this->lat = $lat;

        return $this;
    }

    public function getLng(): ?string
    {
        return $this->lng;
    }

    public function setLng(string $lng): self
    {
        $this->lng = $lng;

        return $this;
    }

    public function getEventTime(): ?string
    {
        return $this->event_time;
    }

    public function setEventTime(string $event_time): self
    {
        $this->event_time = $event_time;

        return $this;
    }
}
