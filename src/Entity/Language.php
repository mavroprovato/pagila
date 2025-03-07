<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\LanguageRepository;
use DateTimeImmutable;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

/**
 * The language entity
 */
#[ORM\Entity(repositoryClass: LanguageRepository::class)]
class Language
{
    /** @var int|null The language internal identifier */
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: 'language_id')]
    private ?int $id = null;

    /** @var string|null The English name of the language */
    #[ORM\Column(length: 255)]
    private ?string $name = null;

    /** @var DateTimeImmutable|null The last update date for the country */
    #[ORM\Column(name: 'last_update', type: Types::DATETIMETZ_IMMUTABLE)]
    private ?DateTimeImmutable $lastUpdate = null;

    /**
     * Return the language internal identifier.
     *
     * @return int|null The language internal identifier.
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Get the English name of the language.
     *
     * @return string|null The language name.
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * Set the English name of the language.
     *
     * @param string $name The English name of the language.
     * @return $this The language.
     */
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Return the language last update.
     *
     * @return DateTimeImmutable|null The language last update.
     */
    public function getLastUpdate(): ?DateTimeImmutable
    {
        return $this->lastUpdate;
    }

    /**
     * Set the language last update.
     *
     * @param DateTimeImmutable $lastUpdate The language last update.
     * @return $this The language.
     */
    public function setLastUpdate(DateTimeImmutable $lastUpdate): self
    {
        $this->lastUpdate = $lastUpdate;

        return $this;
    }
}
