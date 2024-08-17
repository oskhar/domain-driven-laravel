<?php

namespace Domain\Shared\Data;

use Illuminate\Pagination\LengthAwarePaginator;
use Spatie\LaravelData\Data;

class PaginationData extends Data
{
    public function __construct(
        readonly int $total,
        readonly int $per_page,
        readonly int $current_page,
        readonly int $total_pages,
        readonly array $links
    ) {
    }

    public static function fromPaginate(LengthAwarePaginator $paginator): self
    {
        return new self(
            total: $paginator->total(),
            per_page: $paginator->perPage(),
            current_page: $paginator->currentPage(),
            total_pages: $paginator->lastPage(),
            links: PaginationLinkData::from([
                "next" => $paginator->nextPageUrl(),
                "prev" => $paginator->previousPageUrl(),
                "first" => $paginator->url(1),
                "last" => $paginator->url($paginator->lastPage())
            ])->toArray()
        );
    }
}
