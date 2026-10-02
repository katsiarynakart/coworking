<?php

declare(strict_types=1);

namespace App\Controller\Api\Dto;

class BookingOutputDto
{
    public function __construct(
        public int $id,
        public int $userId,
        public int $totalPrice,
    ) {
    }
}
