<?php

declare(strict_types=1);

namespace App\Controller\Api;

use App\Controller\Api\Dto\BookingInputDto;
use App\Entity\Booking;
use App\Repository\BookingRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\ObjectMapper\ObjectMapperInterface;
use Symfony\Component\Routing\Attribute\Route;

final class BookingController extends AbstractController
{
    public function __construct(
        private readonly ObjectMapperInterface $objectMapper,
        private readonly BookingRepository     $bookingRepository,
    )
    {
    }

    #[Route(
        '/api/booking',
        name: 'app_booking',
        methods: ['POST'],
        format: 'json'
    )]
    public function create(
        #[MapRequestPayload] BookingInputDto $bookingInputDto
    ): Response {
        /** @var Booking $booking */
        $booking = $this->objectMapper->map($bookingInputDto, Booking::class);
        $booking->calculateTotalPrice();

        $this->bookingRepository->save($booking, true);

        return $this->json([
            'id' => $booking->getId(),
            'status' => 'created',
        ], Response::HTTP_CREATED);
    }
}
