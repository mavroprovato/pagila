<?php

declare(strict_types=1);

namespace App\Controller\Api;

use App\Entity\Inventory;
use Doctrine\ORM\QueryBuilder;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapQueryParameter;
use Symfony\Component\Routing\Attribute\Route;

/**
 * The inventory controller
 */
#[Route('/api/inventory')]
class InventoryController extends BaseController
{

    /**
     * {@inheritDoc}
     */
    public function getEntityClass(): string
    {
        return Inventory::class;
    }

    /**
     * List inventory.
     *
     * @param int $page The page to fetch.
     * @param int $perPage The number of results to fetch per page.
     * @return Response The response.
     */
    #[Route('/', name: 'inventory_list')]
    public function list(#[MapQueryParameter] int $page = 1, #[MapQueryParameter] int $perPage = 100): Response
    {
        return parent::list($page, $perPage);
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

    /**
     * {@inheritDoc}
     */
    protected function getQueryBuilder(): QueryBuilder
    {
        $queryBuilder = parent::getQueryBuilder();

        $alias = $this->getEntityAlias();
        $queryBuilder->leftJoin("{$alias}.film", "film")->addSelect("film");
        $queryBuilder->leftJoin("film.language", "filmLanguage")->addSelect("filmLanguage");
        $queryBuilder->leftJoin("film.originalLanguage", "filmOriginalLanguage")->addSelect("filmOriginalLanguage");
        $queryBuilder->leftJoin("{$alias}.store", "store")->addSelect("store");
        $queryBuilder->leftJoin("store.address", "storeAddress")->addSelect("storeAddress");
        $queryBuilder->leftJoin("storeAddress.city", "storeAddressCity")->addSelect("storeAddressCity");
        $queryBuilder->leftJoin("storeAddressCity.country", "storeAddressCountry")->addSelect("storeAddressCountry");

        return $queryBuilder;
    }
}