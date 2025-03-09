<?php

declare(strict_types=1);

namespace App\Entity;

use App\Entity\Traits\LastUpdate;
use App\Repository\CategoryRepository;
use DateTimeImmutable;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

/**
 * The customer entity
 */
#[ORM\Entity]
class Customer
{
    use LastUpdate;

    /** @var int|null The customer internal identifier */
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: 'customer_id')]
    private ?int $id = null;

    /** @var string|null The first name of the customer */
    #[ORM\Column(name: 'first_name', length: 45)]
    private ?string $firstName = null;

    /** @var string|null The last name of the customer */
    #[ORM\Column(name: 'last_name', length: 45)]
    private ?string $lastName = null;

    /** @var string|null The customer email address */
    #[ORM\Column(length: 50)]
    private ?string $email = null;

    /** @var bool|null Whether this is an active customer */
    #[ORM\Column(name: 'activebool', type: Types::BOOLEAN)]
    private ?bool $activeBool = null;

    /** @var int|null Whether this is an active customer */
    #[ORM\Column(name: 'active', type: Types::SMALLINT)]
    private ?int $active = null;

    /** @var DateTimeImmutable|null The creation date for the customer */
    #[ORM\Column(name: 'create_date', type: Types::DATETIMETZ_IMMUTABLE)]
    private ?DateTimeImmutable $createDate = null;

    /** @var Address|null The customer address */
    #[ORM\ManyToOne(targetEntity: Address::class)]
    #[ORM\JoinColumn(referencedColumnName: 'address_id')]
    private ?Address $address = null;

    /** @var Address|null The customer store */
    #[ORM\ManyToOne(targetEntity: Store::class)]
    #[ORM\JoinColumn(referencedColumnName: 'store_id')]
    private ?Address $store = null;

    /**
     * Return the customer internal identifier.
     *
     * @return int|null The store internal identifier.
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Return the customer address.
     *
     * @return Address|null The customer address.
     */
    public function getAddress(): ?Address
    {
        return $this->address;
    }

    /**
     * Set the customer address.
     *
     * @param Address|null $address The customer address.
     * @return $this The store.
     */
    public function setAddress(?Address $address): Customer
    {
        $this->address = $address;

        return $this;
    }
}
