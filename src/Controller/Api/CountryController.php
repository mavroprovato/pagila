<?php

declare(strict_types=1);

namespace App\Controller\Api;

use App\Entity\Country;
use App\Model\PaginatedResponse;
use App\Repository\CountryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapQueryParameter;
use Symfony\Component\Routing\Attribute\Route;

/**
 * The country controller
 */
#[Route('/api/countries')]
class CountryController extends AbstractController
{

    /**
     * List countries.
     *
     * @param CountryRepository $repository The country repository.
     * @return Response The response.
     */
    #[Route(path: '/', name: 'countries_list')]
    public function list(
        CountryRepository $repository,
        #[MapQueryParameter] int $page = 1,
        #[MapQueryParameter] int $perPage = 100,
    ): Response
    {
        // Get the paginated results
        $firstResult = ($page - 1) * $perPage;
        $queryBuilder = $repository->createQueryBuilder('country');
        $results = $queryBuilder->select('country')
            ->orderBy('country.id')->setFirstResult($firstResult)->setMaxResults($perPage)
            ->getQuery()->getResult();

        // Get the total number of results
        $queryBuilder = $repository->createQueryBuilder('country');
        $total = $queryBuilder->select('COUNT(country.id)')
            ->getQuery()->getSingleScalarResult();

        return $this->json(new PaginatedResponse($results, $total));
    }

    /**
     * Return a county.
     *
     * @param Country $country The country.
     * @return Response The response.
     */
    #[Route(path: '/{id}', name: 'countries_read')]
    public function show(Country $country): Response
    {
        return $this->json($country);
    }
}