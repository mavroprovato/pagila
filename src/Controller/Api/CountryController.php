<?php

declare(strict_types=1);

namespace App\Controller\Api;

use App\Entity\Country;
use App\Model\PaginatedResponse;
use App\Repository\CountryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
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
    #[Route('/', name: 'countries_list')]
    public function list(CountryRepository $repository): Response
    {
        $queryBuilder = $repository->createQueryBuilder('country');
        $results = $queryBuilder->select('country')
            ->orderBy('country.id')->setMaxResults(100)
            ->getQuery()->getResult();
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
    #[Route('/{id}', name: 'countries_read')]
    public function show(Country $country): Response
    {
        return $this->json($country);
    }
}