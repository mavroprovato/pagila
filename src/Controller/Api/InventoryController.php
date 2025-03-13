<?php

declare(strict_types=1);

namespace App\Controller\Api;

use App\Entity\Inventory;
use App\Entity\Staff;
use App\Repository\InventoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

/**
 * The inventory controller
 */
#[Route('/api/inventory')]
class InventoryController extends AbstractController
{

    /**
     * List inventory.
     *
     * @param InventoryRepository $repository The inventory repository.
     * @return Response The response.
     */
    #[Route('/', name: 'inventory_list')]
    public function list(InventoryRepository $repository): Response
    {
        $results = $repository->createQueryBuilder('inventory')
            ->select(
                'inventory', 'inventoryFilm', 'inventoryFilmLanguage', 'inventoryFilmOriginalLanguage',
                'inventoryStore', 'inventoryStoreAddress', 'inventoryStoreAddressCity', 'inventoryStoreAddressCountry',
                'inventoryStoreManagerStaff', 'inventoryStoreManagerStaffAddress', 'inventoryStoreManagerStaffCity',
                'inventoryStoreManagerStaffCountry'
            )
            ->leftJoin('inventory.film', 'inventoryFilm')
            ->leftJoin('inventoryFilm.language', 'inventoryFilmLanguage')
            ->leftJoin('inventoryFilm.originalLanguage', 'inventoryFilmOriginalLanguage')
            ->leftJoin('inventory.store', 'inventoryStore')
            ->leftJoin('inventoryStore.address', 'inventoryStoreAddress')
            ->leftJoin('inventoryStoreAddress.city', 'inventoryStoreAddressCity')
            ->leftJoin('inventoryStoreAddressCity.country', 'inventoryStoreAddressCountry')
            ->leftJoin('inventoryStore.managerStaff', 'inventoryStoreManagerStaff')
            ->leftJoin('inventoryStoreManagerStaff.address', 'inventoryStoreManagerStaffAddress')
            ->leftJoin('inventoryStoreManagerStaffAddress.city', 'inventoryStoreManagerStaffCity')
            ->leftJoin('inventoryStoreManagerStaffCity.country', 'inventoryStoreManagerStaffCountry')
            ->setMaxResults(1000)
            ->getQuery()->getResult();

        return $this->json($results);
    }

    /**
     * Return an inventory.
     *
     * @param Inventory $inventory The inventory.
     * @return Response The response.
     */
    #[Route('/{id}', name: 'inventory_read')]
    public function show(Inventory $inventory): Response
    {
        return $this->json($inventory);
    }
}