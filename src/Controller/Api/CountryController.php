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
class CountryController extends BaseController
{

    /**
     * {@inheritDoc}
     */
    public function getEntityClass(): string
    {
        return Country::class;
    }

    /**
     * List countries.
     *
     * @return Response The response.
     */
    #[Route(path: '/', name: 'countries_list')]
    public function list(#[MapQueryParameter] int $page = 1, #[MapQueryParameter] int $perPage = 100): Response
    {
        return parent::list($page, $perPage);
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
