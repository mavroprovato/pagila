<?php

declare(strict_types=1);

namespace App\Controller\Api;

use App\Entity\Store;
use App\Repository\StoreRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

/**
 * The store controller
 */
#[Route('/api/stores')]
class StoreController extends AbstractController
{

    /**
     * List stores.
     *
     * @param StoreRepository $repository The language repository.
     * @return Response The response.
     */
    #[Route('/', name: 'stores_list')]
    public function list(StoreRepository $repository): Response
    {
        $results = $repository->createQueryBuilder('store')
            ->select('store', 'address', 'city', 'country')
            ->leftJoin('store.address', 'address')
            ->leftJoin('address.city', 'city')
            ->leftJoin('city.country', 'country')
            ->getQuery()->getResult();

        return $this->json($results);
    }

    /**
     * Return a language.
     *
     * @param Store $store The store.
     * @return Response The response.
     */
    #[Route('/{id}', name: 'stores_read')]
    public function show(Store $store): Response
    {
        return $this->json($store);
    }
}