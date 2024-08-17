<?php

namespace Domain\User\Actions\Authentication;

use App\Infrastructure\API\Data\APIResponseData;
use App\Infrastructure\Exceptions\APIResponseException;
use App\Infrastructure\Services\APIResponseService;
use Domain\User\Data\ResetPasswordData;
use Domain\User\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Lorisleiva\Actions\Concerns\AsAction;

class ResetPasswordAction
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
    public function asController(ResetPasswordData $data): JsonResponse
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
    public function execute(ResetPasswordData $data): void
    {
        $user = User::findOrFail(Auth::user()->id);

        if (!Hash::check($data->old_password, $user->password))
            throw new APIResponseException(["Old password incorrect"]);

        $user->update([
            "password" => Hash::make($data->new_password)
        ]);
    }
}
