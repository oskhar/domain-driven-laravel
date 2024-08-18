<?php

namespace Domain\User\Actions\Admin;

use App\Infrastructure\API\Data\APIResponseData;
use App\Infrastructure\Services\APIResponseService;
use App\Infrastructure\Services\SaveBase64ImageService;
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
    protected SaveBase64ImageService $saveImage;

    /**
     * Create a new service instance.
     * @param \App\Infrastructure\Services\APIResponseService $response
     * @param \App\Infrastructure\Services\SaveBase64ImageService $saveImage
     */
    public function __construct(APIResponseService $response, SaveBase64ImageService $saveImage)
    {
        $this->response = $response;
        $this->saveImage = $saveImage;
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
        $userData = $userData->availableEmailValidation()->toArray();

        if (!empty($userData['profile_picture']))
            $userData['profile_picture'] = ($this->saveImage)($userData['profile_picture']);

        $user = User::create([
            ...$userData,
            "role" => "admin"
        ]);

        Admin::create([
            "user_id" => $user->id,
            "job_title_id" => JobTitle::where("name", $adminData->job_title)->pluck("id")->firstOrFail(),
            "address" => $adminData->address
        ]);
    }
}
