<?php

namespace Domain\User\Actions\Admin;

use App\Infrastructure\API\Data\APIResponseData;
use App\Infrastructure\API\Enums\APIStatusEnum;
use App\Infrastructure\Exceptions\APIResponseException;
use App\Infrastructure\Services\APIResponseService;
use Domain\User\Data\AdminData;
use Domain\User\Models\Admin;
use Domain\Shared\Data\FilterData;
use Domain\Shared\Data\PaginationData;
use Illuminate\Http\JsonResponse;
use Lorisleiva\Actions\Concerns\AsAction;

class GetAllAdminAction
{
    use AsAction;

    protected APIResponseService $response;

    /**
     * Create a new service instance.
     * @param \App\Infrastructure\Services\APIResponseService $response
     */
    public function __construct(APIResponseService $response)
    {
        $this->response = $response;
    }

    /**
     * Run the business processes.
     * @return \Illuminate\Http\JsonResponse
     */
    public function asController(FilterData $filter): JsonResponse
    {
        $result = $this->execute($filter);

        return ($this->response)(
            APIResponseData::from([
                "data" => $result["data"],
                "pagination" => $result["pagination"]
            ])
        );
    }

    /**
     * Execute the business logic.
     * @return array
     */
    public function execute(FilterData $filter): array
    {
        $admin = Admin::getDetailedData();
        if ($filter->search)
            $admin->where("users.full_name", "LIKE", "%" . $filter->search . "%");

        if ($filter->sort)
            $admin->orderBy("users." . $filter->sort->column(), $filter->sort->direction());

        $admin = $filter->validatedPagintion($admin->paginate($filter->length));

        return [
            "data" => [
                "admin" => $admin->getCollection()
                    ->map(fn($item) => AdminData::from($item))
            ],
            "pagination" => PaginationData::fromPaginate($admin),
        ];
    }
}
