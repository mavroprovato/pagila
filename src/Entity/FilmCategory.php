<?php

declare(strict_types=1);

namespace App\Entity;

use App\Entity\Traits\LastUpdate;
use Doctrine\ORM\Mapping as ORM;

/**
 * The film category entity
 */
#[ORM\Entity]
class FilmCategory
{
    use LastUpdate;

    /** @var Film|null The film */
    #[ORM\Id]
    #[ORM\ManyToOne(targetEntity: Film::class)]
    #[ORM\JoinColumn(referencedColumnName: 'film_id', nullable: false)]
    private ?Film $film = null;

    /** @var Category|null The category */
    #[ORM\Id]
    #[ORM\ManyToOne(targetEntity: Category::class)]
    #[ORM\JoinColumn(referencedColumnName: 'category_id', nullable: false)]
    private ?Category $category = null;
}