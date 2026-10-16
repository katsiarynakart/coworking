<?php

declare(strict_types=1);

namespace App\Controller\Api\Dto;

use App\Enum\DeskTypeEnum;
use Symfony\Component\ObjectMapper\Attribute\Map;
use Symfony\Component\ObjectMapper\Transform\MapCollection;

class DeskOutputDto
{
    public function __construct(
        public int $id,
        public string $number,
        public DeskTypeEnum $type,
        public int    $pricePerHour,
        #[Map(transform: new MapCollection(targetClass: BookingOutputDto::class))]
        /** @var BookingOutputDto[] */
        public array $bookings,
    ) {
    }
}
