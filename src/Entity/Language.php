<?php

declare(strict_types=1);

namespace App\Entity;

use App\Entity\Traits\LastUpdate;
use App\Repository\LanguageRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * The language entity
 */
#[ORM\Entity(repositoryClass: LanguageRepository::class)]
class Language
{
    use LastUpdate;

    /** @var int|null The language internal identifier */
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: 'language_id')]
    private ?int $id = null;

    /** @var string|null The English name of the language */
    #[ORM\Column(length: 255)]
    private ?string $name = null;

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
}
