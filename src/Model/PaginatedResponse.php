<?php

namespace App\Model;

/**
 * Class holding paginated data.
 */
readonly class PaginatedResponse
{

    /**
     * Create the paginated response.
     *
     * @param array $results The paginated results.
     * @param int $total The total number of results.
     */
    public function __construct(
        public array $results,
        public int $total,
    )
    {
    }
}