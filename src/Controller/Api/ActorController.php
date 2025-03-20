<?php

declare(strict_types=1);

namespace App\Controller\Api;

use App\Entity\Actor;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapQueryParameter;
use Symfony\Component\Routing\Attribute\Route;

/**
 * The country controller
 */
#[Route('/api/actors')]
class ActorController extends BaseController
{

    /**
     * {@inheritDoc}
     */
    public function getEntityClass(): string
    {
        return Actor::class;
    }

    /**
     * List actors.
     *
     * @param int $page The page to fetch.
     * @param int $perPage The number of results to fetch per page.
     * @return Response The response.
     */
    #[Route('/', name: 'actors_list')]
    public function list(#[MapQueryParameter] int $page = 1, #[MapQueryParameter] int $perPage = 100): Response
    {
        return parent::list($page, $perPage);
    }

    /**
     * Return an actor.
     *
     * @param Actor $actor The actor.
     * @return Response The response.
     */
    #[Route('/{id}', name: 'actors_read')]
    public function show(Actor $actor): Response
    {
        return $this->json($actor);
    }
}
