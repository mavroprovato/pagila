<?php

declare(strict_types=1);

namespace App\Entity;

use DateTimeImmutable;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

/**
 * The payment entity
 */
#[ORM\Entity]
class Payment
{
    /** @var int|null The payment internal identifier */
    #[ORM\Id]
    #[ORM\Column(name: 'payment_id')]
    private ?int $id = null;

    /** @var Customer|null The customer whose balance the payment is being applied to */
    #[ORM\ManyToOne(targetEntity: Customer::class)]
    #[ORM\JoinColumn(referencedColumnName: 'customer_id', nullable: false)]
    private ?Customer $customer = null;

    /** @var Staff|null The staff member who processed the payment */
    #[ORM\ManyToOne(targetEntity: Staff::class)]
    #[ORM\JoinColumn(referencedColumnName: 'staff_id', nullable: false)]
    private ?Staff $staff = null;

    /**
     * @var Rental|null The rental that the payment is being applied to. This is optional because some payments are for
     * outstanding fees and may not be directly related to a rental
     */
    #[ORM\ManyToOne(targetEntity: Rental::class)]
    #[ORM\JoinColumn(referencedColumnName: 'rental_id', nullable: false)]
    private ?Rental $rental = null;

    /** @var string|null The amount of the payment */
    #[ORM\Column(name: 'amount', type: Types::DECIMAL, precision: 5, scale: 2)]
    private ?string $amount = null;

    /** @var DateTimeImmutable|null The date the payment was processed */
    #[ORM\Id]
    #[ORM\Column(name: 'payment_date', type: Types::DATETIMETZ_IMMUTABLE)]
    private ?DateTimeImmutable $paymentDate = null;

    /**
     * Return the payment internal identifier.
     *
     * @return int|null The payment internal identifier.
     */
    public function getId(): ?int
    {
        return $this->id;
    }
}