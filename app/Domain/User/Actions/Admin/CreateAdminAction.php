<?php

namespace Domain\User\Actions\Admin;

use App\Infrastructure\API\Data\APIResponseData;
use App\Infrastructure\Services\APIResponseService;
use Domain\User\Data\AdminData;
use Domain\User\Data\UserData;
use Domain\User\Models\Admin;
use Domain\User\Models\JobTitle;
use Domain\User\Models\User;
use Illuminate\Http\JsonResponse;
use Lorisleiva\Actions\Concerns\AsAction;

class CreateAdminAction
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
    public function asController(UserData $userData, AdminData $adminData): JsonResponse
    {
        $this->execute($userData, $adminData);

        return ($this->response)(
            APIResponseData::from()
        );
    }

    /**
     * Execute the business logic.
     * @return void
     */
    public function execute(UserData $userData, AdminData $adminData): void
    {
        $userData = $userData->availableEmailValidation();

        $user = User::create([
            ...$userData->toArray(),
            "role" => "admin"
        ]);

        Admin::create([
            "user_id" => $user->id,
            "job_title_id" => JobTitle::where("name", $adminData->job_title)->pluck("id")->firstOrFail(),
            "address" => $adminData->address
        ]);
    }
}
