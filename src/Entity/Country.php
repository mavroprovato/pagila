<?php

declare(strict_types=1);

namespace App\Entity;

use App\Entity\Traits\LastUpdate;
use App\Repository\CountryRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * The country entity
 */
#[ORM\Entity(repositoryClass: CountryRepository::class)]
class Country
{
    use LastUpdate;

    /** @var int|null The country internal identifier */
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: 'country_id')]
    private ?int $id = null;

    /** @var string|null The name of the country */
    #[ORM\Column(length: 50)]
    private ?string $country = null;

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
     * Get the name of the country.
     *
     * @return string|null The name of the country.
     */
    public function getCountry(): ?string
    {
        return $this->country;
    }

    /**
     * Set the name of the country.
     *
     * @param string $country The name of the country.
     * @return $this The country.
     */
    public function setCountry(string $country): self
    {
        $this->country = $country;

        return $this;
    }
}
