<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

/**
 * The country controller
 */
#[Route('/api/countries')]
class CountryController extends AbstractController
{

    #[Route('/', name: 'countries_list')]
    public function list(): Response
    {
        return $this->json(['id' => 1, 'country' => 'Afghanistan']);
    }
}