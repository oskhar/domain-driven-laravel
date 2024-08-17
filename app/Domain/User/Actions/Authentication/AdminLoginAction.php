<?php

namespace Domain\User\Actions\Authentication;

use App\Infrastructure\API\Data\APIResponseData;
use Domain\User\Services\AccessTokenGenerateService;
use App\Infrastructure\Services\APIResponseService;
use Domain\User\Data\AdminData;
use Domain\User\Models\Admin;
use Domain\User\Data\LoginData;
use Illuminate\Http\JsonResponse;
use Lorisleiva\Actions\Concerns\AsAction;

class AdminLoginAction
{
    use AsAction;

    protected APIResponseService $response;
    protected AccessTokenGenerateService $accessTokenGenerate;

    /**
     * Create a new service instance.
     * @param \App\Infrastructure\Services\APIResponseService $response
     */
    public function __construct(APIResponseService $response, AccessTokenGenerateService $accessTokenGenerate)
    {
        $this->response = $response;
        $this->accessTokenGenerate = $accessTokenGenerate;
    }

    /**
     * Run the business processes.
     * @return \Illuminate\Http\JsonResponse
     */
    public function asController(LoginData $data): JsonResponse
    {
        $response = $this->execute($data);

        return ($this->response)(
            APIResponseData::from([
                "data" => $response
            ])
        );
    }

    /**
     * Execute the business logic.
     * @param \Domain\User\Data\LoginData $data
     * @return array
     */
    public function execute(LoginData $data): array
    {
        $user = $data->validateUser("admin");

        return [
            "admin" => AdminData::from(Admin::getDetailedData()->where("user_id", $user->id)->firstOrFail()),
            "token" => ($this->accessTokenGenerate)(
                $user,
                $data->remember_me
            ),
        ];
    }

}
