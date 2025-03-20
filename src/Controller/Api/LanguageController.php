<?php

declare(strict_types=1);

namespace App\Controller\Api;

use App\Entity\Language;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapQueryParameter;
use Symfony\Component\Routing\Attribute\Route;

/**
 * The language controller
 */
#[Route('/api/languages')]
class LanguageController extends BaseController
{

    /**
     * {@inheritDoc}
     */
    public function getEntityClass(): string
    {
        return Language::class;
    }

    /**
     * List languages.
     *
     * @param int $page The page to fetch.
     * @param int $perPage The number of results to fetch per page.
     * @return Response The response.
     */
    #[Route('/', name: 'languages_list')]
    public function list(#[MapQueryParameter] int $page = 1, #[MapQueryParameter] int $perPage = 100): Response
    {
        return parent::list($page, $perPage);
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
