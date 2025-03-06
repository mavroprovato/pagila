<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\CategoryRepository;
use DateTimeImmutable;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

/**
 * The category entity
 */
#[ORM\Entity(repositoryClass: CategoryRepository::class)]
class Category
{
    /** @var int|null The category internal identifier */
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: 'country_id')]
    private ?int $id = null;

    /** @var string|null The category name */
    #[ORM\Column(length: 255)]
    private ?string $name = null;

    /** @var DateTimeImmutable|null The last update date for the country */
    #[ORM\Column(name: 'last_update', type: Types::DATETIMETZ_IMMUTABLE)]
    private ?DateTimeImmutable $lastUpdate = null;

    /**
     * Return the country internal identifier.
     *
     * @return int|null The country internal identifier.
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Get the category name.
     *
     * @return string|null The category name.
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * Set the category name.
     *
     * @param string $name The category name.
     * @return $this The category.
     */
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Return the category last update.
     *
     * @return DateTimeImmutable|null The category last update.
     */
    public function getLastUpdate(): ?DateTimeImmutable
    {
        return $this->lastUpdate;
    }

    /**
     * Set the country last update.
     *
     * @param DateTimeImmutable $lastUpdate The country last update.
     * @return $this The country.
     */
    public function setLastUpdate(DateTimeImmutable $lastUpdate): self
    {
        $this->lastUpdate = $lastUpdate;

        return $this;
    }
}
