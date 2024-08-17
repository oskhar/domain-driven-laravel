<?php

namespace Domain\User\Actions\Authentication;

use App\Infrastructure\API\Data\APIResponseData;
use Domain\User\Services\AccessTokenGenerateService;
use App\Infrastructure\Services\APIResponseService;
use Carbon\Carbon;
use Domain\User\Data\AccessTokenData;
use Domain\User\Data\AdminData;
use Domain\User\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Lorisleiva\Actions\Concerns\AsAction;

class RefreshAction
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
    public function asController(): JsonResponse
    {
        $token = $this->execute();

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
     * @return AccessTokenData
     */
    public function execute(): AccessTokenData
    {
        $user = User::findOrFail(Auth::user()->id);

        Auth::user()->currentAccessToken()->delete();

        return ($this->accessTokenGenerate)(
            $user
        );
    }
}
