<?php

declare(strict_types=1);

namespace App\Entity\Traits;

use DateTimeImmutable;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

/**
 * Trait for entities that track the last update date.
 */
trait LastUpdate
{
    /** @var DateTimeImmutable|null The last update date for the entity */
    #[ORM\Column(name: 'last_update', type: Types::DATETIMETZ_IMMUTABLE, options: ['default' => 'CURRENT_TIMESTAMP'])]
    private ?DateTimeImmutable $lastUpdate = null;

    /**
     * Return the last update for the entity.
     *
     * @return DateTimeImmutable|null The last update for the entity.
     */
    public function getLastUpdate(): ?DateTimeImmutable
    {
        return $this->lastUpdate;
    }
}