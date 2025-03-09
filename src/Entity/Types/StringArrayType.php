<?php

namespace App\Entity\Types;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\Type;

/**
 * String array database type.
 */
class StringArrayType extends Type
{
    /** @var string The type name */
    const NAME = 'string_array';

    /**
     * {@inheritDoc}
     */
    public function getSQLDeclaration(array $column, AbstractPlatform $platform): string
    {
        return 'text[]';
    }

    /**
     * {@inheritDoc}
     */
    public function convertToPHPValue($value, AbstractPlatform $platform): ?array
    {
        if ($value) {
            return array_map(
                function (string $value): string {
                    if ($value[0] === '"' && $value[strlen($value) - 1] === '"') {
                        $value = substr($value, 1, -1);
                    }
                    return $value;
                }, explode(',', substr($value, 1, -1))
            );
        }

        return null;
    }

    /**
     * {@inheritDoc}
     */
    public function getName(): string
    {
        return self::NAME;
    }
}