<?php

declare(strict_types=1);

namespace App\Entity;

use App\Entity\Traits\LastUpdate;
use App\Repository\CategoryRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * The category entity
 */
#[ORM\Entity(repositoryClass: CategoryRepository::class)]
class Category
{
    use LastUpdate;

    /** @var int|null The category internal identifier */
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: 'category_id')]
    private ?int $id = null;

    /** @var string|null The category name */
    #[ORM\Column(length: 255)]
    private ?string $name = null;

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
     * Get the category name.
     *
     * @return string|null The category name.
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * Set the category name.
     *
     * @param string $name The category name.
     * @return $this The category.
     */
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }
}
