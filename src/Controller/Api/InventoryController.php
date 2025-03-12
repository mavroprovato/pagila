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
            ->select('inventory', 'film', 'store', 'language', 'originalLanguage', 'address', 'city', 'country')
            ->leftJoin('inventory.film', 'film')
            ->leftJoin('film.language', 'language')
            ->leftJoin('film.originalLanguage', 'originalLanguage')
            ->leftJoin('inventory.store', 'store')
            ->leftJoin('store.address', 'address')
            ->leftJoin('address.city', 'city')
            ->leftJoin('city.country', 'country')
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