<?php

declare(strict_types=1);

namespace App\Controller\Api\Dto;

use Symfony\Component\ObjectMapper\Attribute\Map;
use Symfony\Component\ObjectMapper\Transform\MapCollection;

class DeskOutputDto
{
    public function __construct(
        public string $id,
        public string $name,
        public string $type,
        public int    $pricePerHour,
        #[Map(transform: new MapCollection())]
        /** @var BookingOutputDto[] */
        public array  $bookings,
    ) {
    }
}
