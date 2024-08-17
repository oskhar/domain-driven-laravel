<?php

namespace Domain\Shared\Data;

use App\Infrastructure\API\Enums\APIStatusEnum;
use App\Infrastructure\Exceptions\APIResponseException;
use Domain\Shared\Enums\SortTypeEnum;
use Illuminate\Pagination\LengthAwarePaginator;
use Spatie\LaravelData\Data;

class FilterData extends Data
{
    public function __construct(
        readonly int $length,
        readonly int $page,
        readonly ?string $search,
        readonly ?SortTypeEnum $sort,
    ) {
    }

    /**
     * Validate the pagination result
     * @param \Illuminate\Pagination\LengthAwarePaginator $model
     * @throws \App\Infrastructure\Exceptions\APIResponseException
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function validatedPagintion(LengthAwarePaginator $model): LengthAwarePaginator
    {
        if ($model->total() <= 0)
            throw new APIResponseException(["No results found for your search criteria. Please refine your search and try again."], APIStatusEnum::NOT_FOUND);

        if ($this->page > $model->lastPage())
            throw new APIResponseException(["You have exceeded the maximum page limit. Please check the available pages and try again."], APIStatusEnum::NOT_FOUND);

        if ($this->page < 1)
            throw new APIResponseException(["You have exceeded the minimum page limit. Please check the available pages and try again."], APIStatusEnum::NOT_FOUND);

        return $model;
    }
}
