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
     * @param StoreRepository $repository The store repository.
     * @return Response The response.
     */
    #[Route('/', name: 'stores_list')]
    public function list(StoreRepository $repository): Response
    {
        $results = $repository->createQueryBuilder('store')
            ->select(
                'store', 'storeAddress', 'storeCity', 'storeCountry', 'managerStaff', 'managerStaffAddress',
                'managerStaffCity', 'managerStaffCountry'
            )
            ->leftJoin('store.address', 'storeAddress')
            ->leftJoin('storeAddress.city', 'storeCity')
            ->leftJoin('storeCity.country', 'storeCountry')
            ->leftJoin('store.managerStaff', 'managerStaff')
            ->leftJoin('managerStaff.address', 'managerStaffAddress')
            ->leftJoin('managerStaffAddress.city', 'managerStaffCity')
            ->leftJoin('managerStaffCity.country', 'managerStaffCountry')
            ->getQuery()->getResult();

        return $this->json($results);
    }

    /**
     * Return a store.
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