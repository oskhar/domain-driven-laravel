<?php

namespace Domain\User\Actions\Admin;

use App\Infrastructure\API\Data\APIResponseData;
use App\Infrastructure\Services\APIResponseService;
use Domain\User\Models\Admin;
use Domain\User\Models\User;
use Illuminate\Http\JsonResponse;
use Lorisleiva\Actions\Concerns\AsAction;

class RecoverAdminAction
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
    public function asController($id): JsonResponse
    {
        $this->execute($id);

        return ($this->response)(
            APIResponseData::from()
        );
    }

    /**
     * Execute the business logic.
     * @return void
     */
    public function execute($id): void
    {
        $admin = Admin::withTrashed()
            ->findOrFail($id);

        User::withTrashed()
            ->where('id', $admin->user_id)
            ->where('role', 'admin')
            ->firstOrFail()
            ->restore();

        $admin->restore();
    }
}
