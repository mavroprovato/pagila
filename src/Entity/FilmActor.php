<?php

declare(strict_types=1);

namespace App\Entity;

use App\Entity\Traits\LastUpdate;
use Doctrine\ORM\Mapping as ORM;

/**
 * The film actor entity
 */
#[ORM\Entity]
class FilmActor
{
    use LastUpdate;

    /** @var Film|null The film */
    #[ORM\Id]
    #[ORM\ManyToOne(targetEntity: Film::class)]
    #[ORM\JoinColumn(referencedColumnName: 'film_id')]
    private ?Film $film = null;

    /** @var Actor|null The actor */
    #[ORM\Id]
    #[ORM\ManyToOne(targetEntity: Actor::class)]
    #[ORM\JoinColumn(referencedColumnName: 'actor_id')]
    private ?Actor $actor = null;
}