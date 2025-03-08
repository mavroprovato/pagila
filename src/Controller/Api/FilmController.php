<?php

declare(strict_types=1);

namespace App\Controller\Api;

use App\Entity\Film;
use App\Repository\FilmRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

/**
 * The film controller
 */
#[Route('/api/films')]
class FilmController extends AbstractController
{

    /**
     * List films.
     *
     * @param FilmRepository $repository The film repository.
     * @return Response The response.
     */
    #[Route('/', name: 'films_list')]
    public function list(FilmRepository $repository): Response
    {
        return $this->json($repository->findAll());
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
}