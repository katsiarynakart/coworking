<?php

declare(strict_types=1);

namespace App\Controller\Api\Dto;

use Symfony\Component\Validator\Constraints as Assert;

class BookingInputDto
{
    public function __construct(
        #[Assert\NotBlank]
        #[Assert\Positive]
        public string $deskId,
        #[Assert\NotBlank]
        #[Assert\Positive]
        public string $userId,
        #[Assert\NotBlank]
        #[Assert\DateTime]
        public string $startDate,
        #[Assert\NotBlank]
        #[Assert\DateTime]
        public string $endDate,
    ) {
    }
}
