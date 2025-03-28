<?php

declare(strict_types=1);

namespace App\Controller\Api;

use App\Entity\Staff;
use Doctrine\ORM\QueryBuilder;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapQueryParameter;
use Symfony\Component\Routing\Attribute\Route;

/**
 * The staff controller
 */
#[Route('/api/staff')]
class StaffController extends BaseController
{

    /**
     * {@inheritDoc}
     */
    public function getEntityClass(): string
    {
        return Staff::class;
    }

    /**
     * List staff.
     *
     * @param int $page The page to fetch.
     * @param int $perPage The number of results to fetch per page.
     * @return Response The response.
     */
    #[Route('/', name: 'staff_list')]
    public function list(#[MapQueryParameter] int $page = 1, #[MapQueryParameter] int $perPage = 100): Response
    {
        return parent::list($page, $perPage);
    }

    /**
     * Return a staff.
     *
     * @param Staff $staff The staff.
     * @return Response The response.
     */
    #[Route('/{id}', name: 'staff_read')]
    public function show(Staff $staff): Response
    {
        return $this->json($staff);
    }

    /**
     * {@inheritDoc}
     */
    protected function getQueryBuilder(): QueryBuilder
    {
        $queryBuilder = parent::getQueryBuilder();

        $alias = $this->getEntityAlias();
        $queryBuilder->leftJoin("{$alias}.address", "address")->addSelect("address");
        $queryBuilder->leftJoin("address.city", "addressCity")->addSelect("addressCity");
        $queryBuilder->leftJoin("addressCity.country", "addressCityCountry")->addSelect("addressCityCountry");
        $queryBuilder->leftJoin("{$alias}.store", "store")->addSelect("store");
        $queryBuilder->leftJoin("store.address", "storeAddress")->addSelect("storeAddress");
        $queryBuilder->leftJoin("storeAddress.city", "storeAddressCity")->addSelect("storeAddressCity");
        $queryBuilder->leftJoin("storeAddressCity.country", "storeAddressCityCountry")
            ->addSelect("storeAddressCityCountry");

        return $queryBuilder;
    }
}