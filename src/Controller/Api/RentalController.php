<?php

declare(strict_types=1);

namespace App\Controller\Api;

use App\Entity\Rental;
use Doctrine\ORM\QueryBuilder;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapQueryParameter;
use Symfony\Component\Routing\Attribute\Route;

/**
 * The rental controller
 */
#[Route('/api/rentals')]
class RentalController extends BaseController
{

    public function getEntityClass(): string
    {
        return Rental::class;
    }

    /**
     * List rentals.
     *
     * @param int $page The page to fetch.
     * @param int $perPage The number of results to fetch per page.
     * @return Response The response.
     */
    #[Route('/', name: 'rentals_list')]
    public function list(#[MapQueryParameter] int $page = 1, #[MapQueryParameter] int $perPage = 100): Response
    {
        return parent::list($page, $perPage);
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

    /**
     * {@inheritDoc}
     */
    protected function getQueryBuilder(): QueryBuilder
    {
        $queryBuilder = parent::getQueryBuilder();

        $alias = $this->getEntityAlias();
        $queryBuilder->leftJoin("{$alias}.inventory", "inventory")->addSelect("inventory");

        $queryBuilder->leftJoin("inventory.film", "inventoryFilm")->addSelect("inventoryFilm");
        $queryBuilder->leftJoin("inventoryFilm.language", "inventoryFilmLanguage")->addSelect("inventoryFilmLanguage");
        $queryBuilder->leftJoin("inventoryFilm.originalLanguage", "inventoryFilmOriginalLanguage")
            ->addSelect("inventoryFilmOriginalLanguage");

        $queryBuilder->leftJoin("inventory.store", "inventoryStore")->addSelect("inventoryStore");
        $queryBuilder->leftJoin("inventoryStore.address", "inventoryStoreAddress")->addSelect("inventoryStoreAddress");
        $queryBuilder->leftJoin("inventoryStoreAddress.city", "inventoryStoreAddressCity")
            ->addSelect("inventoryStoreAddressCity");
        $queryBuilder->leftJoin("inventoryStoreAddressCity.country", "inventoryStoreAddressCityCountry")
            ->addSelect("inventoryStoreAddressCityCountry");

        $queryBuilder->leftJoin("{$alias}.customer", "customer")->addSelect("customer");
        $queryBuilder->leftJoin("customer.address", "customerAddress")->addSelect("customerAddress");
        $queryBuilder->leftJoin("customerAddress.city", "customerAddressCity")->addSelect("customerAddressCity");
        $queryBuilder->leftJoin("customerAddressCity.country", "customerAddressCityCountry")
            ->addSelect("customerAddressCityCountry");

        $queryBuilder->leftJoin("{$alias}.staff", "staff")->addSelect("staff");
        $queryBuilder->leftJoin("staff.address", "staffAddress")->addSelect("staffAddress");
        $queryBuilder->leftJoin("staffAddress.city", "staffAddressCity")->addSelect("staffAddressCity");
        $queryBuilder->leftJoin("staffAddressCity.country", "staffAddressCityCountry")
            ->addSelect("staffAddressCityCountry");

        $queryBuilder->leftJoin("staff.store", "staffStore")->addSelect("staffStore");
        $queryBuilder->leftJoin("staffStore.address", "staffStoreAddress")->addSelect("staffStoreAddress");
        $queryBuilder->leftJoin("staffStoreAddress.city", "staffStoreAddressCity")->addSelect("staffStoreAddressCity");
        $queryBuilder->leftJoin("staffStoreAddressCity.country", "staffStoreAddressCityCountry")
            ->addSelect("staffStoreAddressCityCountry");

        return $queryBuilder;
    }
}
