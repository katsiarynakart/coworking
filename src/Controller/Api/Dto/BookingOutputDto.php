<?php

declare(strict_types=1);

namespace App\Controller\Api\Dto;

use App\Entity\User;
use Symfony\Component\ObjectMapper\Attribute\Map;

class BookingOutputDto
{
    public function __construct(
        public int $id,
        #[Map(source: 'user', transform: [self::class, 'userId'])]
        public int $userId,
        public int $totalPrice,
    ) {
    }

    public static function userId(User $user): int
    {
        return $user->getId();
    }
}
