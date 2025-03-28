<?php

declare(strict_types=1);

namespace App\Controller\Api;

use App\Entity\Film;
use Doctrine\ORM\QueryBuilder;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapQueryParameter;
use Symfony\Component\Routing\Attribute\Route;

/**
 * The film controller
 */
#[Route('/api/films')]
class FilmController extends BaseController
{

    /**
     * {@inheritDoc}
     */
    public function getEntityClass(): string
    {
        return Film::class;
    }

    /**
     * List films.
     *
     * @param int $page The page to fetch.
     * @param int $perPage The number of results to fetch per page.
     * @return Response The response.
     */
    #[Route('/', name: 'films_list')]
    public function list(#[MapQueryParameter] int $page = 1, #[MapQueryParameter] int $perPage = 100): Response
    {
        return parent::list($page, $perPage);
    }

    /**
     * Return a film.
     *
     * @param Film $film The film.
     * @return Response The response.
     */
    #[Route('/{id}', name: 'film_read')]
    public function show(Film $film): Response
    {
        return $this->json($film);
    }

    /**
     * {@inheritDoc}
     */
    protected function getQueryBuilder(): QueryBuilder
    {
        $queryBuilder = parent::getQueryBuilder();

        $alias = $this->getEntityAlias();
        $queryBuilder->leftJoin("{$alias}.language", "language")->addSelect("language");
        $queryBuilder->leftJoin("{$alias}.originalLanguage", "originalLanguage")->addSelect("originalLanguage");

        return $queryBuilder;
    }
}
