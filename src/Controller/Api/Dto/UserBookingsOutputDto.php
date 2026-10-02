<?php

declare(strict_types=1);

namespace App\Controller\Api\Dto;

class UserBookingsOutputDto
{
    public function __construct(
        public string $id,
        public int $deskId,
        public string $startDate,
        public string $endDate,
        public int $totalPrice,
    ) {
    }
}
