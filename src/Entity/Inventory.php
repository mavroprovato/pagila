<?php

declare(strict_types=1);

namespace App\Entity;

use App\Entity\Traits\LastUpdate;
use App\Repository\InventoryRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * The inventory entity
 */
#[ORM\Entity(repositoryClass: InventoryRepository::class)]
class Inventory
{
    use LastUpdate;

    /** @var int|null The inventory internal identifier */
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: 'inventory_id')]
    private ?int $id = null;

    /** @var Film|null The film this item represents */
    #[ORM\ManyToOne(targetEntity: Film::class)]
    #[ORM\JoinColumn(referencedColumnName: 'film_id', nullable: false)]
    private ?Film $film = null;

    /** @var Store|null The store stocking this item */
    #[ORM\ManyToOne(targetEntity: Store::class)]
    #[ORM\JoinColumn(referencedColumnName: 'store_id', nullable: false)]
    private ?Store $store = null;

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
     * Return film this item represents.
     *
     * @return Film|null The film this item represents.
     */
    public function getFilm(): ?Film
    {
        return $this->film;
    }

    /**
     * Return the store stocking this item.
     *
     * @return Store|null The store stocking this item.
     */
    public function getStore(): ?Store
    {
        return $this->store;
    }
}
