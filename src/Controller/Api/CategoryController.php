<?php

declare(strict_types=1);

namespace App\Controller\Api;

use App\Entity\Category;
use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

/**
 * The category controller
 */
#[Route('/api/categories')]
class CategoryController extends AbstractController
{

    /**
     * List categories.
     *
     * @param CategoryRepository $repository The category repository.
     * @return Response The response.
     */
    #[Route('/', name: 'categories_list')]
    public function list(CategoryRepository $repository): Response
    {
        return $this->json($repository->findAll());
    }

    /**
     * Return a category.
     *
     * @param Category $category The categories.
     * @return Response The response.
     */
    #[Route('/{id}', name: 'categories_read')]
    public function show(Category $category): Response
    {
        return $this->json($category);
    }
}