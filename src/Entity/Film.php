<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\FilmRepository;
use DateTimeImmutable;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

/**
 * The film entity
 */
#[ORM\Entity(repositoryClass: FilmRepository::class)]
class Film
{
    /** @var int|null The film internal identifier */
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: 'film_id')]
    private ?int $id = null;

    /** @var string|null The title of the film */
    #[ORM\Column(length: 255)]
    private ?string $title = null;

    /** @var string|null The short description or plot summary of the film */
    #[ORM\Column(length: 255)]
    private ?string $description = null;

    /** @var int|null The year in which the movie was released */
    #[ORM\Column(name: 'release_year', type: Types::SMALLINT)]
    private ?int $releaseYear = null;

    /** @var int|null The length of the rental period in days */
    #[ORM\Column(name: 'rental_duration', type: Types::SMALLINT)]
    private ?int $rentalDuration = null;

    /** @var string|null The cost to rent the film for the period specified in rental duration */
    #[ORM\Column(name: 'rental_rate', type: Types::DECIMAL, precision: 4, scale: 2)]
    private ?string $rentalRate = null;

    /** @var int|null The duration of the film in minutes */
    #[ORM\Column(type: Types::SMALLINT, nullable: true)]
    private ?int $length = null;

    /**
     * @var string|null The amount charged to the customer if the film is not returned or is returned in a damaged state
     */
    #[ORM\Column(name: 'replacement_cost',type: Types::DECIMAL, precision: 5, scale: 2)]
    private ?string $replacementCost = null;

    /** @var DateTimeImmutable|null The last update date for the film */
    #[ORM\Column(name: 'last_update', type: Types::DATETIMETZ_IMMUTABLE)]
    private ?DateTimeImmutable $lastUpdate = null;

    /**
     * Return the film internal identifier.
     *
     * @return int|null The country internal identifier.
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Get the title of the film.
     *
     * @return string|null The title of the film.
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * Set the title of the film.
     *
     * @param string $title The title of the film.
     * @return $this The film.
     */
    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get the short description or plot summary of the film.
     *
     * @return string|null The short description or plot summary of the film.
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * Set the short description or plot summary of the film.
     *
     * @param string $description The short description or plot summary of the film.
     * @return $this The film.
     */
    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get the year in which the movie was released.
     *
     * @return int|null The year in which the movie was released.
     */
    public function getReleaseYear(): ?int
    {
        return $this->releaseYear;
    }

    /**
     * Set the year in which the movie was released.
     *
     * @param int|null $releaseYear The year in which the movie was released.
     * @return $this The film.
     */
    public function setReleaseYear(?int $releaseYear): Film
    {
        $this->releaseYear = $releaseYear;

        return $this;
    }

    /**
     * Get the length of the rental period in days.
     *
     * @return int|null The length of the rental period in days.
     */
    public function getRentalDuration(): ?int
    {
        return $this->rentalDuration;
    }

    /**
     * Set the length of the rental period in days.
     *
     * @param int|null $rentalDuration The length of the rental period in days.
     * @return $this The film.
     */
    public function setRentalDuration(?int $rentalDuration): Film
    {
        $this->rentalDuration = $rentalDuration;

        return $this;
    }

    /**
     * Get the cost to rent the film for the period specified in rental duration.
     *
     * @return int|null The cost to rent the film for the period specified in rental duration.
     */
    public function getRentalRate(): ?int
    {
        return $this->rentalRate;
    }

    /**
     * Set the cost to rent the film for the period specified in rental duration.
     *
     * @param int|null $rentalRate The cost to rent the film for the period specified in rental duration.
     * @return $this The film.
     */
    public function setRentalRate(?int $rentalRate): Film
    {
        $this->rentalRate = $rentalRate;

        return $this;
    }

    /**
     * Get the duration of the film in minutes.
     *
     * @return int|null The duration of the film in minutes.
     */
    public function getLength(): ?int
    {
        return $this->length;
    }

    /**
     * Set the duration of the film in minutes.
     *
     * @param int|null $length The duration of the film in minutes.
     * @return $this The film.
     */
    public function setLength(?int $length): Film
    {
        $this->length = $length;

        return $this;
    }

    /**
     * Get the amount charged to the customer if the film is not returned or is returned in a damaged state.
     *
     * @return int|null The amount charged to the customer if the film is not returned or is returned in a damaged
     * state.
     */
    public function getReplacementCost(): ?int
    {
        return $this->replacementCost;
    }

    /**
     * Set the amount charged to the customer if the film is not returned or is returned in a damaged state.
     *
     * @param string|null $replacementCost The amount charged to the customer if the film is not returned or is returned
     * in a damaged state.
     * @return $this The film.
     */
    public function setReplacementCost(?string $replacementCost): Film
    {
        $this->replacementCost = $replacementCost;

        return $this;
    }

    /**
     * Return the film last update.
     *
     * @return DateTimeImmutable|null The film last update.
     */
    public function getLastUpdate(): ?DateTimeImmutable
    {
        return $this->lastUpdate;
    }

    /**
     * Set the film last update.
     *
     * @param DateTimeImmutable $lastUpdate The film last update.
     * @return $this The film.
     */
    public function setLastUpdate(DateTimeImmutable $lastUpdate): self
    {
        $this->lastUpdate = $lastUpdate;

        return $this;
    }
}
