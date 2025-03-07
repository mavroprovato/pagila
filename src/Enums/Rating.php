<?php

declare(strict_types=1);

namespace App\Enums;

/**
 * The film rating enumeration.
 */
enum Rating: string
{
    case G = 'G';
    case PG = 'PG';
    case PG_13 = 'PG-13';
    case R = 'R';
    case NC_17 = 'NC-17';
}
