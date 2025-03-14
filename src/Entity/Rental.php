<?php

declare(strict_types=1);

namespace App\Entity;

use App\Entity\Traits\LastUpdate;
use App\Repository\RentalRepository;
use DateTimeImmutable;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

/**
 * The rental entity
 */
#[ORM\Entity(repositoryClass: RentalRepository::class)]
#[ORM\UniqueConstraint(
    name: 'idx_unq_rental_rental_date_inventory_id_customer_id', columns: ['rental_date', 'inventory_id', 'customer_id']
)]
class Rental
{
    use LastUpdate;

    /** @var int|null The rental internal identifier */
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: 'rental_id')]
    private ?int $id = null;

    /** @var Inventory|null The item being rented */
    #[ORM\ManyToOne(targetEntity: Inventory::class)]
    #[ORM\JoinColumn(referencedColumnName: 'inventory_id', nullable: false)]
    private ?Inventory $inventory = null;

    /** @var Customer|null The customer renting the item */
    #[ORM\ManyToOne(targetEntity: Customer::class)]
    #[ORM\JoinColumn(referencedColumnName: 'customer_id', nullable: false)]
    private ?Customer $customer = null;

    /** @var Staff|null The staff member who processed the rental */
    #[ORM\ManyToOne(targetEntity: Staff::class)]
    #[ORM\JoinColumn(referencedColumnName: 'staff_id', nullable: false)]
    private ?Staff $staff = null;

    /** @var DateTimeImmutable|null The date and time that the item was rented */
    #[ORM\Column(name: 'rental_date', type: Types::DATETIMETZ_IMMUTABLE)]
    private ?DateTimeImmutable $rentalDate = null;

    /** @var DateTimeImmutable|null The date and time the item was returned */
    #[ORM\Column(name: 'return_date', type: Types::DATETIMETZ_IMMUTABLE, nullable: true)]
    private ?DateTimeImmutable $returnDate = null;

    /**
     * Return the rental internal identifier.
     *
     * @return int|null The rental internal identifier.
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Return the item being rented.
     *
     * @return Inventory|null The item being rented
     */
    public function getInventory(): ?Inventory
    {
        return $this->inventory;
    }

    /**
     * Return the customer renting the item.
     *
     * @return Customer|null The customer renting the item
     */
    public function getCustomer(): ?Customer
    {
        return $this->customer;
    }

    /**
     * Return the staff member who processed the rental.
     *
     * @return Staff|null The staff member who processed the rental.
     */
    public function getStaff(): ?Staff
    {
        return $this->staff;
    }

    /**
     * Return the date and time that the item was rented.
     *
     * @return DateTimeImmutable|null The date and time that the item was rented.
     */
    public function getRentalDate(): ?DateTimeImmutable
    {
        return $this->rentalDate;
    }

    /**
     * Return The date and time the item was returned.
     *
     * @return DateTimeImmutable|null The date and time the item was returned.
     */
    public function getReturnDate(): ?DateTimeImmutable
    {
        return $this->returnDate;
    }
}
