<?php

declare(strict_types=1);

namespace App\Entity;

use App\Entity\Traits\LastUpdate;
use App\Repository\StoreRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * The store entity
 */
#[ORM\Entity(repositoryClass: StoreRepository::class)]
class Store
{
    use LastUpdate;

    /** @var int|null The store internal identifier */
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: 'store_id')]
    private ?int $id = null;

    /** @var Staff|null The manager of this store */
    #[ORM\ManyToOne(targetEntity: Staff::class)]
    #[ORM\JoinColumn(referencedColumnName: 'staff_id')]
    private ?Staff $managerStaff = null;

    /** @var Address|null The address of this store */
    #[ORM\ManyToOne(targetEntity: Address::class)]
    #[ORM\JoinColumn(referencedColumnName: 'address_id', nullable: false)]
    private ?Address $address = null;

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
     * Return the address of this store.
     *
     * @return Address|null The address of this store.
     */
    public function getAddress(): ?Address
    {
        return $this->address;
    }

    /**
     * Return the manager of this store.
     *
     * @return Staff|null The manager of this store.
     */
    public function getManagerStaff(): ?Staff
    {
        return $this->managerStaff;
    }

    /**
     * Set the address of this store.
     *
     * @param Address|null $address The address of this store.
     * @return $this The store.
     */
    public function setAddress(?Address $address): Store
    {
        $this->address = $address;

        return $this;
    }
}
