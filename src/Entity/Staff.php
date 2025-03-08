<?php

declare(strict_types=1);

namespace App\Entity;

use App\Entity\Traits\LastUpdate;
use App\Repository\CategoryRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

/**
 * The staff entity
 */
#[ORM\Entity]
class Staff
{
    use LastUpdate;

    /** @var int|null The staff internal identifier */
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: 'staff_id')]
    private ?int $id = null;

    /** @var string|null The first name of the staff member */
    #[ORM\Column(name: 'first_name', length: 45)]
    private ?string $firstName = null;

    /** @var string|null The last name of the staff member */
    #[ORM\Column(name: 'last_name', length: 45)]
    private ?string $lastName = null;

    /** @var string|null A BLOB containing a photograph of the employee */
    #[ORM\Column(length: 255, nullable: true)]
    private ?string $picture = null;

    /** @var string|null The staff member email address */
    #[ORM\Column(length: 50)]
    private ?string $email = null;

    /** @var bool|null Whether this is an active employee */
    #[ORM\Column(type: Types::BOOLEAN)]
    private ?bool $active = null;

    /** @var string|null The username used by the staff member to access the rental system */
    #[ORM\Column(length: 32)]
    private ?string $username = null;

    /**
     * @var string|null The password used by the staff member to access the rental system. The password should be stored
     * as a hash using the SHA2() function
     */
    #[ORM\Column(length: 40)]
    private ?string $password = null;

    /** @var Address|null The staff member address */
    #[ORM\ManyToOne(targetEntity: Address::class)]
    #[ORM\JoinColumn(referencedColumnName: 'address_id')]
    private ?Address $address = null;

    /** @var Store|null The staff member "home store" */
    #[ORM\ManyToOne(targetEntity: Store::class)]
    #[ORM\JoinColumn(referencedColumnName: 'store_id')]
    private ?Store $store = null;

    /**
     * Return the store internal identifier.
     *
     * @return int|null The store internal identifier.
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Return the staff member address.
     *
     * @return Address|null The staff member address.
     */
    public function getAddress(): ?Address
    {
        return $this->address;
    }

    /**
     * Set the staff member address.
     *
     * @param Address|null $address The staff member address.
     * @return $this The store.
     */
    public function setAddress(?Address $address): Staff
    {
        $this->address = $address;

        return $this;
    }
}
