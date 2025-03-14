<?php

declare(strict_types=1);

namespace App\Entity;

use App\Entity\Traits\LastUpdate;
use App\Repository\StaffRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Ignore;

/**
 * The staff entity
 */
#[ORM\Entity(repositoryClass: StaffRepository::class)]
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

    /** @var resource|null A BLOB containing a photograph of the employee */
    #[ORM\Column(type: Types::BLOB, nullable: true)]
    #[Ignore]
    private $picture = null;

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
    #[Ignore]
    private ?string $password = null;

    /** @var Address|null The staff member address */
    #[ORM\ManyToOne(targetEntity: Address::class)]
    #[ORM\JoinColumn(referencedColumnName: 'address_id', nullable: false)]
    private ?Address $address = null;

    /** @var Store|null The staff member "home store" */
    #[ORM\ManyToOne(targetEntity: Store::class)]
    #[ORM\JoinColumn(referencedColumnName: 'store_id', nullable: false)]
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
     * Get the first name of the staff member.
     *
     * @return string|null The first name of the staff member.
     */
    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    /**
     * Set the first name of the staff member.
     *
     * @param string|null $firstName The first name of the staff member.
     * @return $this The staff.
     */
    public function setFirstName(?string $firstName): Staff
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Get the last name of the staff member.
     *
     * @return string|null The last name of the staff member.
     */
    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    /**
     * Set the last name of the staff member.
     *
     * @param string|null $lastName The last name of the staff member.
     * @return $this The staff.
     */
    public function setLastName(?string $lastName): Staff
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Return the staff member email address.
     *
     * @return string|null The staff member email address.
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * Set the staff member email address.
     *
     * @param string|null $email The staff member email address.
     * @return $this The staff.
     */
    public function setEmail(?string $email): Staff
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Whether this is an active employee.
     *
     * @return bool|null Whether this is an active employee.
     */
    public function getActive(): ?bool
    {
        return $this->active;
    }

    /**
     * Set whether this is an active employee.
     *
     * @param bool|null $active Whether this is an active employee.
     * @return $this The staff.
     */
    public function setActive(?bool $active): Staff
    {
        $this->active = $active;

        return $this;
    }

    /**
     * The username used by the staff member to access the rental system.
     *
     * @return string|null The username used by the staff member to access the rental system.
     */
    public function getUsername(): ?string
    {
        return $this->username;
    }

    /**
     * Set the username used by the staff member to access the rental system.
     *
     * @param string|null $username The username used by the staff member to access the rental system.
     * @return $this The staff.
     */
    public function setUsername(?string $username): Staff
    {
        $this->username = $username;

        return $this;
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

    /**
     * Return a BLOB containing a photograph of the employee.
     *
     * @return resource|null A BLOB containing a photograph of the employee.
     */
    public function getPicture(): null
    {
        return $this->picture;
    }

    /**
     * Return the password used by the staff member to access the rental system. The password should be stored
     * as a hash using the SHA2() function.
     *
     * @return string|null The password used by the staff member to access the rental system. The password should be
     * stored as a hash using the SHA2() function.
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    /**
     * Get the staff member "home store".
     *
     * @return Store|null The staff member "home store"
     */
    public function getStore(): ?Store
    {
        return $this->store;
    }
}
