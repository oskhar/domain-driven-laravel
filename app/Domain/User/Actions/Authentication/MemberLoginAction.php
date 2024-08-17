<?php

namespace Domain\User\Actions\Authentication;

use App\Infrastructure\API\Data\APIResponseData;
use App\Infrastructure\API\Enums\APIStatusEnum;
use App\Infrastructure\Exceptions\APIResponseException;
use Domain\User\Services\AccessTokenGenerateService;
use App\Infrastructure\Services\APIResponseService;
use Domain\User\Data\AccessTokenData;
use Domain\User\Data\LoginData;
use Illuminate\Http\JsonResponse;
use Lorisleiva\Actions\Concerns\AsAction;

class MemberLoginAction
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
        $token = $this->execute($data);

        return ($this->response)(
            APIResponseData::from([
                "data" => [
                    "token" => $token
                ]
            ])
        );
    }

    /**
     * Execute the business logic.
     * @param \Domain\User\Data\LoginData $data
     * @return AccessTokenData
     */
    public function execute(LoginData $data): AccessTokenData
    {
        $user = $data->validateUser("member");

        return ($this->accessTokenGenerate)(
            $user,
            $data->remember_me
        );
    }

}
