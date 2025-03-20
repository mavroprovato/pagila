<?php

declare(strict_types=1);

namespace App\Controller\Api;

use App\Model\PaginatedResponse;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

/**
 * The base controller.
 */
abstract class BaseController extends AbstractController
{
    /** @var EntityManagerInterface The entity manager */
    private EntityManagerInterface $entityManager;

    /**
     * Create the controller.
     *
     * @param EntityManagerInterface $entityManager The entity manager.
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * Returns the fully qualified name of the entity class.
     *
     * @return string The fully qualified name of the entity class.
     */
    public abstract function getEntityClass(): string;

    /**
     * List entities.
     *
     * @return Response The response.
     */
    public function list(int $page = 1, int $perPage = 100): Response
    {
        $repository = $this->entityManager->getRepository($this->getEntityClass());
        $alias = $this->getEntityAlias();

        // Get the paginated results
        $firstResult = ($page - 1) * $perPage;
        $queryBuilder = $repository->createQueryBuilder($alias);
        $results = $queryBuilder->select($alias)
            ->orderBy("$alias.id")->setFirstResult($firstResult)->setMaxResults($perPage)
            ->getQuery()->getResult();

        // Get the total number of results
        $queryBuilder = $repository->createQueryBuilder($alias);
        $total = $queryBuilder->select("COUNT($alias.id)")
            ->getQuery()->getSingleScalarResult();

        return $this->json(new PaginatedResponse($results, $total));
    }

    private function getEntityAlias(): string
    {
        return lcfirst(substr($this->getEntityClass(), strrpos($this->getEntityClass(), "\\") + 1));
    }
}