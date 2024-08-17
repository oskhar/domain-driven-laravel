<?php

namespace Domain\User\Actions\Member;

use App\Infrastructure\API\Data\APIResponseData;
use App\Infrastructure\Services\APIResponseService;
use Domain\User\Data\MemberData;
use Illuminate\Http\JsonResponse;
use Lorisleiva\Actions\Concerns\AsAction;

class GetSelfMemberAction
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
        $member = $this->execute();

        return ($this->response)(
            APIResponseData::from([
                "data" => [
                    "member" => $member
                ]
            ])
        );
    }

    /**
     * Execute the business logic.
     * @return MemberData
     */
    public function execute(): MemberData
    {
        return MemberData::fromAuth();
    }
}
