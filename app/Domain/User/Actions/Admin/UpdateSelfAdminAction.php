<?php

namespace Domain\User\Actions\Admin;

use App\Infrastructure\API\Data\APIResponseData;
use App\Infrastructure\Services\APIResponseService;
use App\Infrastructure\Services\SaveBase64ImageService;
use Domain\User\Data\AdminData;
use Domain\User\Data\UserData;
use Domain\User\Models\Admin;
use Domain\User\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Lorisleiva\Actions\Concerns\AsAction;

class UpdateSelfAdminAction
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
    public function asController(AdminData $data): JsonResponse
    {
        $this->execute($data);

        return ($this->response)(
            APIResponseData::from()
        );
    }

    /**
     * Execute the business logic.
     * @return void
     */
    public function execute(AdminData $data): void
    {
        $data = $data->toArrayUpdate();

        $user = User::findOrFail(Auth::user()->id);

        if (!empty($data['profile_picture']) && $data['profile_picture'] != $user['profile_picture'])
            $data['profile_picture'] = ($this->saveImage)($data['profile_picture']);

        $user->update(
            UserData::from($data)->toArray()
        );

        Admin::where("user_id", $user->id)
            ->update([
                "job_title_id" => $data['job_title_id'],
                "address" => $data['address']
            ]);
    }
}
