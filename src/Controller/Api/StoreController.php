<?php

declare(strict_types=1);

namespace App\Controller\Api;

use App\Entity\Store;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapQueryParameter;
use Symfony\Component\Routing\Attribute\Route;

/**
 * The store controller
 */
#[Route('/api/stores')]
class StoreController extends BaseController
{

    /**
     * {@inheritDoc}
     */
    public function getEntityClass(): string
    {
        return Store::class;
    }

    /**
     * List stores.
     *
     * @param int $page The page to fetch.
     * @param int $perPage The number of results to fetch per page.
     * @return Response The response.
     */
    #[Route('/', name: 'stores_list')]
    public function list(#[MapQueryParameter] int $page = 1, #[MapQueryParameter] int $perPage = 100): Response
    {
        return parent::list($page, $perPage);
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

    /**
     * {@inheritDoc}
     */
    protected function getRelated(): array
    {
        return ['address'];
    }
}
