<?php

declare(strict_types=1);

namespace App\Entity;

use App\Entity\Traits\LastUpdate;
use App\Entity\Types\FullTextType;
use App\Entity\Types\MpaaRatingType;
use App\Entity\Types\StringArrayType;
use App\Entity\Types\YearType;
use App\Enums\Rating;
use App\Repository\FilmRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

/**
 * The film entity
 */
#[ORM\Entity(repositoryClass: FilmRepository::class)]
class Film
{
    use LastUpdate;

    /** @var int|null The film internal identifier */
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: 'film_id')]
    private ?int $id = null;

    /** @var string|null The title of the film */
    #[ORM\Column(length: 128)]
    private ?string $title = null;

    /** @var string|null The short description or plot summary of the film */
    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    /** @var int|null The year in which the movie was released */
    #[ORM\Column(name: 'release_year', type: YearType::NAME)]
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

    /** @var Rating The rating assigned to the film */
    #[ORM\Column(type: MpaaRatingType::NAME)]
    private Rating $rating;

    /** @var array|null The special features are included on the DVD */
    #[ORM\Column(name: 'special_features', type: StringArrayType::NAME)]
    private ?array $specialFeatures = null;

    /** @var string|null The film full text */
    #[ORM\Column(name: 'fulltext', type: FullTextType::NAME)]
    private ?string $fulltext = null;

    /** @var Language|null The language of the film */
    #[ORM\ManyToOne(targetEntity: Language::class)]
    #[ORM\JoinColumn(referencedColumnName: 'language_id')]
    private ?Language $language = null;

    /** @var Language|null The original language of the film. Used when a film has been dubbed into a new language */
    #[ORM\ManyToOne(targetEntity: Language::class)]
    #[ORM\JoinColumn(referencedColumnName: 'language_id', nullable: true)]
    private ?Language $originalLanguage = null;

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
     * @return string|null The cost to rent the film for the period specified in rental duration.
     */
    public function getRentalRate(): ?string
    {
        return $this->rentalRate;
    }

    /**
     * Set the cost to rent the film for the period specified in rental duration.
     *
     * @param string|null $rentalRate The cost to rent the film for the period specified in rental duration.
     * @return $this The film.
     */
    public function setRentalRate(?string $rentalRate): Film
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
     * @return string|null The amount charged to the customer if the film is not returned or is returned in a damaged
     * state.
     */
    public function getReplacementCost(): ?string
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
     * Get the rating assigned to the film.
     *
     * @return Rating|null rating assigned to the film.
     */
    public function getRating(): ?Rating
    {
        return $this->rating;
    }

    /**
     * Set the rating assigned to the film.
     *
     * @param Rating|null $rating The rating assigned to the film.
     * @return $this The film.
     */
    public function setRating(?Rating $rating): Film
    {
        $this->rating = $rating;

        return $this;
    }

    /**
     * The special features are included on the DVD.
     *
     * @return array|null The special features are included on the DVD.
     */
    public function getSpecialFeatures(): ?array
    {
        return $this->specialFeatures;
    }

    /**
     * Get The language of the film.
     *
     * @return Language|null The language of the film.
     */
    public function getLanguage(): ?Language
    {
        return $this->language;
    }

    /**
     * Set the language of the film.
     *
     * @param Language|null $language The language of the film.
     * @return $this The film.
     */
    public function setLanguage(?Language $language): Film
    {
        $this->language = $language;

        return $this;
    }

    /**
     * Get The original language of the film. Used when a film has been dubbed into a new language.
     *
     * @return Language|null The original language of the film. Used when a film has been dubbed into a new language.
     */
    public function getOriginalLanguage(): ?Language
    {
        return $this->originalLanguage;
    }

    /**
     * Set the original language of the film. Used when a film has been dubbed into a new language.
     *
     * @param Language|null $originalLanguage The original language of the film. Used when a film has been dubbed into
     * a new language.
     * @return $this The city.
     */
    public function setOriginalLanguage(?Language $originalLanguage): Film
    {
        $this->originalLanguage = $originalLanguage;

        return $this;
    }
}
