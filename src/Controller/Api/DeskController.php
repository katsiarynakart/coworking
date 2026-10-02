<?php

declare(strict_types=1);

namespace App\Controller\Api;

use App\Controller\Api\Dto\DeskOutputDto;
use App\Enum\DeskTypeEnum;
use App\Repository\DeskRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Attribute\MapQueryParameter;
use Symfony\Component\ObjectMapper\ObjectMapperInterface;
use Symfony\Component\Routing\Attribute\Route;

final class DeskController extends AbstractController
{
    public function __construct(
        private readonly DeskRepository        $deskRepository,
        private readonly ObjectMapperInterface $objectMapper,
    ) {
    }

    #[Route(
        '/api/desks',
        name: 'api_desks',
        methods: ['GET'],
        format: 'json'
    )]
    public function index(
        #[MapQueryParameter] ?DeskTypeEnum $type = null
    ): JsonResponse {
        $desks = $type !== null
            ? $this->deskRepository->findBy(['type' => $type])
            : $this->deskRepository->findAll();

        $deskDtoArr = [];

        foreach ($desks as $desk) {
            $deskDtoArr[] = $this->objectMapper->map($desk, DeskOutputDto::class);
        }

        return $this->json($deskDtoArr);
    }
}
