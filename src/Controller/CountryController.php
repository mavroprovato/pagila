<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Country;
use Doctrine\ORM\EntityManagerInterface;
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
     * @param EntityManagerInterface $entityManager The entity manager interface.
     * @return Response The response.
     */
    #[Route('/', name: 'countries_list')]
    public function list(EntityManagerInterface $entityManager): Response
    {
        $result = [];
        foreach ($entityManager->getRepository(Country::class)->findAll() as $country) {
            $result[]= [
                'id' => $country->getId(), 'country' => $country->getCountry(),
                'last_update' => $country->getLastUpdate()
            ];
        }

        return $this->json($result);
    }
}