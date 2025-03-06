<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\ActorRepository;
use DateTimeImmutable;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

/**
 * The actor entity
 */
#[ORM\Entity(repositoryClass: ActorRepository::class)]
class Actor
{
    /** @var int|null The actor internal identifier */
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: 'actor_id')]
    private ?int $id = null;

    /** @var string|null The actor first name */
    #[ORM\Column(name: 'first_name', length: 255)]
    private ?string $firstName = null;

    /** @var string|null The actor last name */
    #[ORM\Column(name: 'last_name', length: 255)]
    private ?string $lastName = null;

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
     * Get the actor first name.
     *
     * @return string|null The actor first name.
     */
    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    /**
     * Set the actor first name.
     *
     * @param string $firstName The actor first name.
     * @return $this The actor.
     */
    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Get the actor last name.
     *
     * @return string|null The actor last name.
     */
    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    /**
     * Set the actor last name.
     *
     * @param string $lastName The actor last name.
     * @return $this The actor.
     */
    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

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
    public function setLastUpdate(DateTimeImmutable $lastUpdate): self
    {
        $this->lastUpdate = $lastUpdate;

        return $this;
    }
}
