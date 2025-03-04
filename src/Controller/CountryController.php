<?php

declare(strict_types=1);

namespace App\Controller;

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
        $result = [];
        foreach ($repository->findAll() as $country) {
            $result[]= [
                'id' => $country->getId(), 'country' => $country->getCountry(),
                'last_update' => $country->getLastUpdate()
            ];
        }

        return $this->json($result);
    }
}