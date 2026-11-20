<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\BookingRepository;
use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: BookingRepository::class)]
class Booking
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'bookings')]
    #[ORM\JoinColumn(nullable: false)]
    private Desk $desk;

    #[ORM\ManyToOne(inversedBy: 'bookings')]
    #[ORM\JoinColumn(
        nullable: false,
        onDelete: 'CASCADE'
    )]
    private User $user;

    #[ORM\Column]
    private DateTimeImmutable $startTime;

    #[ORM\Column]
    #[Assert\GreaterThan(
        propertyPath: 'startTime',
        message: 'The end time must be after the start time.'
    )]
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

    public function setDesk(Desk $desk): static
    {
        $this->desk = $desk;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(User $user): static
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

    public function calculateTotalPrice(): static
    {
        $seconds = $this->endTime->getTimestamp() - $this->startTime->getTimestamp();
        $hours = (int)ceil($seconds / 3600);

        $this->totalPrice = $this->desk->getPricePerHour() * $hours;

        return $this;
    }
}
