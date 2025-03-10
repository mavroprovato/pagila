<?php

declare(strict_types=1);

namespace App\Entity\Types;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\Type;

/**
 * Full text database type.
 */
class FullTextType extends Type
{
    /** @var string The type name */
    const NAME = 'full_text';

    /**
     * {@inheritDoc}
     */
    public function getSQLDeclaration(array $column, AbstractPlatform $platform): string
    {
        return 'tsvector';
    }

    /**
     * {@inheritDoc}
     */
    public function getName(): string
    {
        return self::NAME;
    }
}