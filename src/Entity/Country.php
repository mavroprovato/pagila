<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\CountryRepository;
use DateTimeImmutable;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

/**
 * The country entity
 */
#[ORM\Entity(repositoryClass: CountryRepository::class)]
class Country
{
    /** @var int|null The country internal identifier */
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: 'country_id')]
    private ?int $id = null;

    /** @var string|null The country name */
    #[ORM\Column(length: 255)]
    private ?string $country = null;

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
     * Get the country name.
     *
     * @return string|null The country name.
     */
    public function getCountry(): ?string
    {
        return $this->country;
    }

    /**
     * Set the country name.
     *
     * @param string $country The country name.
     * @return $this The country.
     */
    public function setCountry(string $country): static
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Return the country last update.
     *
     * @return DateTimeImmutable|null The country last update.
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
    public function setLastUpdate(DateTimeImmutable $lastUpdate): static
    {
        $this->lastUpdate = $lastUpdate;

        return $this;
    }
}
