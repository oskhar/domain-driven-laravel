<?php

namespace Domain\User\Actions\Admin;

use App\Infrastructure\API\Data\APIResponseData;
use App\Infrastructure\Services\APIResponseService;
use Domain\User\Data\AdminData;
use Illuminate\Http\JsonResponse;
use Lorisleiva\Actions\Concerns\AsAction;

class GetSelfAdminAction
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
    public function asController(): JsonResponse
    {
        $admin = $this->execute();

        return ($this->response)(
            APIResponseData::from([
                "data" => [
                    "admin" => $admin
                ]
            ])
        );
    }

    /**
     * Execute the business logic.
     * @return mixed
     */
    public function execute(): AdminData
    {
        return AdminData::fromAuth();
    }
}
