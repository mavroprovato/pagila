<?php

declare(strict_types=1);

namespace App\Controller\Api;

use App\Entity\Actor;
use App\Repository\ActorRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

/**
 * The country controller
 */
#[Route('/api/actors')]
class ActorController extends AbstractController
{

    /**
     * List actors.
     *
     * @param ActorRepository $repository The actor repository.
     * @return Response The response.
     */
    #[Route('/', name: 'actors_list')]
    public function list(ActorRepository $repository): Response
    {
        return $this->json($repository->findAll());
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