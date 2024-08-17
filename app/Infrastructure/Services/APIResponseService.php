<?php

namespace App\Infrastructure\Services;

use App\Infrastructure\API\Data\APIMetaData;
use App\Infrastructure\API\Data\APIResponseData;
use App\Infrastructure\API\Enums\APIStatusEnum;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class APIResponseService
{
    protected Request $request;

    /**
     * Create a new service instance.
     * @param \Illuminate\Http\Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }
    /**
     * Generate a JSON response.
     *
     * @param APIResponseData $response
     * @param APIStatusEnum $status
     * @return JsonResponse
     */
    public function __invoke(APIResponseData $response, ?APIStatusEnum $status = APIStatusEnum::SUCCESS): JsonResponse
    {
        $result = [
            "status" => $response->status ?? true,
            "message" => $response->message ?? $status->getMessage(),
        ];

        if (!empty($response->data)) {
            $result['data'] = $response->data;
        }

        if (!empty($response->errors)) {
            $result['errors'] = $response->errors;
        }

        if (!empty($response->pagination)) {
            $result['pagination'] = $response->pagination;
        }

        return response()->json([
            ...$result,
            "meta" => $response->meta ?? APIMetaData::from([
                "request_id" => $this->request->header('X-Request-ID', uniqid()),
                "response_size" => strlen(json_encode($result)) . " byte"
            ])
        ])->setStatusCode($status->value);
    }
}
