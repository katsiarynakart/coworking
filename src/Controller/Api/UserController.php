<?php

declare(strict_types=1);

namespace App\Controller\Api;

use App\Controller\Api\Dto\BookingOutputDto;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Attribute\MapEntity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\ObjectMapper\ObjectMapperInterface;
use Symfony\Component\Routing\Attribute\Route;

final class UserController extends AbstractController
{
    public function __construct(
        private readonly ObjectMapperInterface $objectMapper,
    ) {
    }

    #[Route(
        '/api/user/{id}/bookings',
        name: 'api_user_bookings',
        methods: ['GET'],
        format: 'json'
    )]
    public function index(
        #[MapEntity(id: 'id')]User $user
    ): JsonResponse {
        $bookings = $user->getBookings();

        $bookingDtoArr = [];

        foreach ($bookings as $booking) {
            $bookingDtoArr[] = $this->objectMapper->map($booking, BookingOutputDto::class);
        }

        return $this->json($bookingDtoArr);
    }
}
