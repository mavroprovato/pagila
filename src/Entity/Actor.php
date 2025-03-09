<?php

declare(strict_types=1);

namespace App\Entity;

use App\Entity\Traits\LastUpdate;
use App\Repository\ActorRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * The actor entity
 */
#[ORM\Entity(repositoryClass: ActorRepository::class)]
#[ORM\Index(name: 'idx_actor_last_name', columns: ['last_name'])]
class Actor
{
    use LastUpdate;

    /** @var int|null The actor internal identifier */
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: 'actor_id')]
    private ?int $id = null;

    /** @var string|null The actor first name */
    #[ORM\Column(name: 'first_name', length: 45)]
    private ?string $firstName = null;

    /** @var string|null The actor last name */
    #[ORM\Column(name: 'last_name', length: 45)]
    private ?string $lastName = null;

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
}
