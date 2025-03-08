<?php

declare(strict_types=1);

namespace App\Entity;

use App\Entity\Traits\LastUpdate;
use App\Repository\CityRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * The city entity
 */
#[ORM\Entity(repositoryClass: CityRepository::class)]
class City
{
    use LastUpdate;

    /** @var int|null The city internal identifier */
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: 'city_id')]
    private ?int $id = null;

    /** @var string|null The city name */
    #[ORM\Column(length: 50)]
    private ?string $city = null;

    /** @var Country|null The country for the city */
    #[ORM\ManyToOne(targetEntity: Country::class)]
    #[ORM\JoinColumn(referencedColumnName: 'country_id')]
    private ?Country $country;

    /**
     * Return the city internal identifier.
     *
     * @return int|null The city internal identifier.
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Get the city name.
     *
     * @return string|null The city name.
     */
    public function getCity(): ?string
    {
        return $this->city;
    }

    /**
     * Set the city name.
     *
     * @param string $city The city name.
     * @return $this The city.
     */
    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get the country for the city.
     *
     * @return Country|null The country.
     */
    public function getCountry(): ?Country
    {
        return $this->country;
    }

    /**
     * Set the country for the city.
     *
     * @param Country|null $country The country.
     * @return $this The city.
     */
    public function setCountry(?Country $country): City
    {
        $this->country = $country;

        return $this;
    }
}
