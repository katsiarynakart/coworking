<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\BookingRepository;
use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BookingRepository::class)]
class Booking
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'bookings')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Desk $desk = null;

    #[ORM\ManyToOne(inversedBy: 'bookings')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    #[ORM\Column]
    private DateTimeImmutable $startTime;

    #[ORM\Column]
    private DateTimeImmutable $endTime;

    #[ORM\Column]
    private int $totalPrice;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDesk(): ?Desk
    {
        return $this->desk;
    }

    public function setDesk(?Desk $desk): static
    {
        $this->desk = $desk;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUserId(?User $user): static
    {
        $this->user = $user;

        return $this;
    }

    public function getStartTime(): DateTimeImmutable
    {
        return $this->startTime;
    }

    public function setStartTime(DateTimeImmutable $startTime): static
    {
        $this->startTime = $startTime;

        return $this;
    }

    public function getEndTime(): DateTimeImmutable
    {
        return $this->endTime;
    }

    public function setEndTime(DateTimeImmutable $endTime): static
    {
        $this->endTime = $endTime;

        return $this;
    }

    public function getTotalPrice(): int
    {
        return $this->totalPrice;
    }

    public function setTotalPrice(int $totalPrice): static
    {
        $this->totalPrice = $totalPrice;

        return $this;
    }

    public function calculateTotalPrice(): static
    {
        $this->totalPrice = $this->desk->getPricePerHour() * $this->endTime->diff($this->startTime)->h;

        return $this;
    }
}
