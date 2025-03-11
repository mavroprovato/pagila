<?php

declare(strict_types=1);

namespace App\Controller\Api;

use App\Entity\City;
use App\Repository\CityRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

/**
 * The city controller
 */
#[Route('/api/cities')]
class CityController extends AbstractController
{

    /**
     * List cities.
     *
     * @param CityRepository $repository The city repository.
     * @return Response The response.
     */
    #[Route('/', name: 'cities_list')]
    public function list(CityRepository $repository): Response
    {
        $results = $repository->createQueryBuilder('city')
            ->select('city', 'country')
            ->leftJoin('city.country', 'country')
            ->getQuery()->getResult();

        return $this->json($results);
    }

    /**
     * Return a city.
     *
     * @param City $city The city.
     * @return Response The response.
     */
    #[Route('/{id}', name: 'cities_read')]
    public function show(City $city): Response
    {
        return $this->json($city);
    }
}