<?php

declare(strict_types=1);

namespace App\Entity;

use App\Entity\Traits\LastUpdate;
use App\Repository\AddressRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * The address entity
 */
#[ORM\Entity(repositoryClass: AddressRepository::class)]
class Address
{
    use LastUpdate;

    /** @var int|null The address internal identifier */
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: 'address_id')]
    private ?int $id = null;

    /** @var string|null The first line of the address */
    #[ORM\Column(length: 50)]
    private ?string $address = null;

    /** @var string|null The second line of the address */
    #[ORM\Column(length: 50, nullable: true)]
    private ?string $address2 = null;

    /** @var string|null The district of the address */
    #[ORM\Column(length: 20)]
    private ?string $district = null;

    /** @var string|null The postal code or ZIP code of the address */
    #[ORM\Column(name: 'postal_code', length: 10, nullable: true)]
    private ?string $postalCode = null;

    /** @var string|null The telephone number for the address */
    #[ORM\Column(length: 20)]
    private ?string $phone = null;

    /** @var City|null The city for the address */
    #[ORM\ManyToOne(targetEntity: City::class)]
    #[ORM\JoinColumn(referencedColumnName: 'city_id', nullable: false)]
    private ?City $city = null;

    /**
     * Get the address internal identifier.
     *
     * @return int|null The address internal identifier
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Get the first line of the address.
     *
     * @return string|null The first line of the address.
     */
    public function getAddress(): ?string
    {
        return $this->address;
    }

    /**
     * Set the first line of the address.
     *
     * @param string|null $address The first line of the address.
     * @return $this The address.
     */
    public function setAddress(?string $address): Address
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get the second line of the address.
     *
     * @return string|null The second line of the address.
     */
    public function getAddress2(): ?string
    {
        return $this->address2;
    }

    /**
     * Set the second line of the address.
     *
     * @param string|null $address2 The second line of the address.
     * @return $this The address.
     */
    public function setAddress2(?string $address2): Address
    {
        $this->address2 = $address2;

        return $this;
    }

    /**
     * Get the district of the address.
     *
     * @return string|null The restrict of the address.
     */
    public function getDistrict(): ?string
    {
        return $this->district;
    }

    /**
     * Set the district of the address.
     *
     * @param string|null $district The district of the address.
     * @return $this
     */
    public function setDistrict(?string $district): Address
    {
        $this->district = $district;

        return $this;
    }

    /**
     * Get the postal code or ZIP code of the address.
     *
     * @return string|null The postal code or ZIP code of the address.
     */
    public function getPostalCode(): ?string
    {
        return $this->postalCode;
    }

    /**
     * Set the postal code or ZIP code of the address.
     *
     * @param string|null $postalCode The postal code or ZIP code of the address.
     * @return $this The address.
     */
    public function setPostalCode(?string $postalCode): Address
    {
        $this->postalCode = $postalCode;

        return $this;
    }

    /**
     * Get the telephone number for the address.
     *
     * @return string|null The telephone number for the address.
     */
    public function getPhone(): ?string
    {
        return $this->phone;
    }

    /**
     * Set the telephone number for the address.
     *
     * @param string|null $phone The telephone number for the address.
     * @return $this The address.
     */
    public function setPhone(?string $phone): Address
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get the city of the address.
     *
     * @return City The city of the address.
     */
    public function getCity(): City
    {
        return $this->city;
    }

    /**
     * Set the city of the address.
     *
     * @param City $city The city of the address.
     * @return $this The address.
     */
    public function setCity(City $city): Address
    {
        $this->city = $city;

        return $this;
    }
}