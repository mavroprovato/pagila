<?php

declare(strict_types=1);

namespace App\Controller\Api;

use App\Entity\City;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

/**
 * The city controller
 */
#[Route('/api/cities')]
class CityController extends BaseController
{

    /**
     * {@inheritDoc}
     */
    public function getEntityClass(): string
    {
        return City::class;
    }

    /**
     * List cities.
     *
     * @param int $page The page to fetch.
     * @param int $perPage The number of results to fetch per page.
     * @return Response The response.
     */
    #[Route('/', name: 'cities_list')]
    public function list(int $page = 1, int $perPage = 100): Response
    {
        return parent::list($page, $perPage);
    }

    /**
     * {@inheritDoc}
     */
    protected function getRelated(): array
    {
        return ['country'];
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
