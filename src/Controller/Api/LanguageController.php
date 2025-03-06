<?php

declare(strict_types=1);

namespace App\Controller\Api;

use App\Entity\Language;
use App\Repository\LanguageRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

/**
 * The language controller
 */
#[Route('/api/languages')]
class LanguageController extends AbstractController
{

    /**
     * List languages.
     *
     * @param LanguageRepository $repository The language repository.
     * @return Response The response.
     */
    #[Route('/', name: 'languages_list')]
    public function list(LanguageRepository $repository): Response
    {
        return $this->json($repository->findAll());
    }

    /**
     * Return a language.
     *
     * @param Language $language The language.
     * @return Response The response.
     */
    #[Route('/{id}', name: 'languages_read')]
    public function show(Language $language): Response
    {
        return $this->json($language);
    }
}