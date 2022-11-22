<?php

namespace App\Entity;

use App\Repository\ScooterRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Uuid;

#[ORM\Entity(repositoryClass: ScooterRepository::class)]

class Scooter
{
    const STATUS_AVAILABLE = 1;
    const STATUS_OCCUPIED = 2;
    const STATUS_OUT_OF_SERVICE = 3;

    #[ORM\Column(type: 'string', unique: true)]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[ORM\CustomIdGenerator(class: 'doctrine.uuid_generator')]
    private string $uuid;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 8)]
    private ?string $current_lat = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 11, scale: 8)]
    private ?string $current_lng = null;

    #[ORM\Column(type: Types::SMALLINT)]
    private ?int $status = null;

    #[ORM\Column(length: 50)]
    private ?string $created_at = null;

    #[ORM\Column(length: 50)]
    private ?string $updated_at = null;

    public function __construct() {
        $this->uuid = Uuid::v1();
        $this->created_at = strtotime(date('d-m-Y h:i:s'));
        $this->updated_at = strtotime(date('d-m-Y h:i:s'));
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUuid(): ?string
    {
        return $this->uuid;
    }

    public function setUuid(Uuid $uuid): self
    {
        $this->uuid = $uuid;

        return $this;
    }

    public function getCurrentLat(): ?string
    {
        return $this->current_lat;
    }

    public function setCurrentLat(string $current_lat): self
    {
        $this->current_lat = $current_lat;

        return $this;
    }

    public function getCurrentLng(): ?string
    {
        return $this->current_lng;
    }

    public function setCurrentLng(string $current_lng): self
    {
        $this->current_lng = $current_lng;

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
