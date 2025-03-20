<?php

declare(strict_types=1);

namespace App\Controller\Api;

use App\Entity\Category;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapQueryParameter;
use Symfony\Component\Routing\Attribute\Route;

/**
 * The category controller
 */
#[Route('/api/categories')]
class CategoryController extends BaseController
{

    /**
     * {@inheritDoc}
     */
    public function getEntityClass(): string
    {
        return Category::class;
    }

    /**
     * List categories.
     *
     * @param int $page The page to fetch.
     * @param int $perPage The number of results to fetch per page.
     * @return Response The response.
     */
    #[Route('/', name: 'categories_list')]
    public function list(#[MapQueryParameter] int $page = 1, #[MapQueryParameter] int $perPage = 100): Response
    {
        return parent::list($page, $perPage);
    }

    /**
     * Return a category.
     *
     * @param Category $category The category.
     * @return Response The response.
     */
    #[Route('/{id}', name: 'categories_read')]
    public function show(Category $category): Response
    {
        return $this->json($category);
    }
}
