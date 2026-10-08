<?php

declare(strict_types=1);

namespace App\Entity;

use App\Enum\DeskTypeEnum;
use App\Repository\DeskRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DeskRepository::class)]
class Desk
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, unique: true)]
    private string $number;

    #[ORM\Column(enumType: DeskTypeEnum::class)]
    private DeskTypeEnum $type;

    #[ORM\Column]
    private int $pricePerHour;

    /**
     * @var Collection<int, Booking>
     */
    #[ORM\OneToMany(
        targetEntity: Booking::class,
        mappedBy: 'desk',
        cascade: ['persist', 'remove'],
        orphanRemoval: true
    )]
    private Collection $bookings;

    public function __construct()
    {
        $this->bookings = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumber(): string
    {
        return $this->number;
    }

    public function setNumber(string $number): static
    {
        $this->number = $number;

        return $this;
    }

    public function getType(): DeskTypeEnum
    {
        return $this->type;
    }

    public function setType(DeskTypeEnum $type): static
    {
        $this->type = $type;

        return $this;
    }

    public function getPricePerHour(): int
    {
        return $this->pricePerHour;
    }

    public function setPricePerHour(int $pricePerHour): static
    {
        $this->pricePerHour = $pricePerHour;

        return $this;
    }

    /**
     * @return Collection<int, Booking>
     */
    public function getBookings(): Collection
    {
        return $this->bookings;
    }

    public function addBooking(Booking $booking): static
    {
        if (!$this->bookings->contains($booking)) {
            $this->bookings->add($booking);
            $booking->setDesk($this);
        }

        return $this;
    }

    public function removeBooking(Booking $booking): static
    {
        if ($this->bookings->removeElement($booking)) {
            // set the owning side to null (unless already changed)
            if ($booking->getDesk() === $this) {
                $booking->setDesk(null);
            }
        }

        return $this;
    }
}
