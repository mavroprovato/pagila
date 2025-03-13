<?php

declare(strict_types=1);

namespace App\Controller\Api;

use App\Entity\Rental;
use App\Repository\RentalRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

/**
 * The rental controller
 */
#[Route('/api/rentals')]
class RentalController extends AbstractController
{

    /**
     * List rentals.
     *
     * @param RentalRepository $repository The country repository.
     * @return Response The response.
     */
    #[Route('/', name: 'rentals_list')]
    public function list(RentalRepository $repository): Response
    {
        $results = $repository->createQueryBuilder('rental')
            ->select(
                'rental', 'inventory', 'inventoryFilm', 'inventoryFilmLanguage', 'inventoryFilmOriginalLanguage',
                'inventoryStore', 'inventoryStoreAddress', 'inventoryStoreCity', 'inventoryStoreCountry',
                'rentalCustomer', 'rentalCustomerAddress', 'rentalCustomerCity', 'rentalCustomerCountry', 'staff',
                'staffAddress', 'staffCity', 'staffCountry'
            )
            ->leftJoin('rental.inventory', 'inventory')
            ->leftJoin('inventory.film', 'inventoryFilm')
            ->leftJoin('inventoryFilm.language', 'inventoryFilmLanguage')
            ->leftJoin('inventoryFilm.originalLanguage', 'inventoryFilmOriginalLanguage')
            ->leftJoin('inventory.store', 'inventoryStore')
            ->leftJoin('inventoryStore.address', 'inventoryStoreAddress')
            ->leftJoin('inventoryStoreAddress.city', 'inventoryStoreCity')
            ->leftJoin('inventoryStoreCity.country', 'inventoryStoreCountry')
            ->leftJoin('rental.customer', 'rentalCustomer')
            ->leftJoin('rentalCustomer.address', 'rentalCustomerAddress')
            ->leftJoin('rentalCustomerAddress.city', 'rentalCustomerCity')
            ->leftJoin('rentalCustomerCity.country', 'rentalCustomerCountry')
            ->leftJoin('rental.staff', 'staff')
            ->leftJoin('staff.address', 'staffAddress')
            ->leftJoin('staffAddress.city', 'staffCity')
            ->leftJoin('staffCity.country', 'staffCountry')
            ->setMaxResults(1000)
            ->getQuery()->getResult();

        return $this->json($results);
    }

    /**
     * Return a rental.
     *
     * @param Rental $rental The rental.
     * @return Response The response.
     */
    #[Route('/{id}', name: 'rentals_read')]
    public function show(Rental $rental): Response
    {
        return $this->json($rental);
    }
}