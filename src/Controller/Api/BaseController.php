<?php

declare(strict_types=1);

namespace App\Controller\Api;

use App\Model\PaginatedResponse;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\QueryBuilder;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

/**
 * The base controller.
 */
abstract class BaseController extends AbstractController
{
    /** @var EntityManagerInterface The entity manager */
    protected EntityManagerInterface $entityManager;

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
     * @param int $page The page to fetch.
     * @param int $perPage The number of results to fetch per page.
     * @return Response The response.
     */
    public function list(int $page = 1, int $perPage = 100): Response
    {
        $alias = $this->getEntityAlias();

        // Get the paginated results
        $firstResult = ($page - 1) * $perPage;
        $queryBuilder = $this->getQueryBuilder();
        $queryBuilder->orderBy("$alias.id")->setFirstResult($firstResult)->setMaxResults($perPage);
        $results = $queryBuilder->getQuery()->getResult();

        // Get the total number of results
        $queryBuilder = $this->getQueryBuilder();
        $total = $queryBuilder->select("COUNT($alias.id)")->getQuery()->getSingleScalarResult();

        return $this->json(new PaginatedResponse($results, $total));
    }

    /**
     * Return the alias for the entity.
     *
     * @return string The alias for the entity.
     */
    protected function getEntityAlias(): string
    {
        return lcfirst(substr($this->getEntityClass(), strrpos($this->getEntityClass(), "\\") + 1));
    }

    /**
     * Get the query builder for the
     * @return QueryBuilder
     */
    protected function getQueryBuilder(): QueryBuilder
    {
        $repository = $this->entityManager->getRepository($this->getEntityClass());
        $alias = $this->getEntityAlias();
        $queryBuilder = $repository->createQueryBuilder($alias);

        return $queryBuilder->select($alias);
    }
}
