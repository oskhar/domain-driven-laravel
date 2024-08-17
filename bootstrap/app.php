<?php

use App\Infrastructure\API\Data\APIResponseData;
use App\Infrastructure\API\Enums\APIStatusEnum;
use App\Infrastructure\Exceptions\APIResponseException;
use App\Infrastructure\Middleware\RoleMiddleware;
use Illuminate\Database\QueryException;
use Illuminate\Validation\ValidationException;
use App\Infrastructure\Middleware\RequestTrackingMiddleware;
use App\Infrastructure\Services\APIResponseService;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->append(RequestTrackingMiddleware::class);
        $middleware->alias([
            "role" => RoleMiddleware::class
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $response = app(APIResponseService::class);

        $exceptions->render(
            fn(ValidationException $exception, $request) => ($response)(
                APIResponseData::from([
                    "status" => false,
                    "errors" => $exception->validator->errors()->all()
                ]),
                APIStatusEnum::BAD_REQUEST
            )
        );

        $exceptions->render(
            fn(QueryException $exception, $request) => ($response)(
                APIResponseData::from([
                    "status" => false,
                    "errors" => [
                        "Bro wrote the wrong database query. Backend skills issue",
                        $exception->getMessage()
                    ]
                ]),
                APIStatusEnum::INTERNAL_SERVER_ERROR
            )
        );

        $exceptions->render(
            fn(OutOfBoundsException $exception, $request) => ($response)(
                APIResponseData::from([
                    "status" => false,
                    "errors" => [
                        "Ayyo, looks like your backend is designing the wrong array structure",
                        $exception->getMessage()
                    ]
                ]),
                APIStatusEnum::UNPROCESSABLE_ENTITY
            )
        );

        $exceptions->render(
            fn(BadMethodCallException $exception, $request) => ($response)(
                APIResponseData::from([
                    "status" => false,
                    "errors" => [
                        "Are you sure backend bro?",
                        $exception->getMessage()
                    ]
                ]),
                APIStatusEnum::NOT_FOUND
            )
        );

        $exceptions->render(
            fn(NotFoundHttpException $exception, $request) => ($response)(
                APIResponseData::from([
                    "status" => false,
                    "errors" => [$exception->getMessage()]
                ]),
                APIStatusEnum::NOT_FOUND
            )
        );

        $exceptions->render(
            fn(APIResponseException $exception, $request) => ($response)(
                APIResponseData::from([
                    "status" => false,
                    "errors" => $exception->getAllMessage()
                ]),
                $exception->getStatus()
            )
        );

        $exceptions->render(function (Exception $exception, $request) use ($response) {
            if ($request->is('*')) {

                if (
                    $exception->getMessage() == "Route [login] not defined." ||
                    $exception->getMessage() == "Unauthenticated."
                ) {
                    $errors = ["Unauthorization."];
                    $status = APIStatusEnum::UNAUTHORIZED;
                }

                return ($response)(
                    APIResponseData::from([
                        "status" => false,
                        "errors" => $errors ?? [
                            "Your backend is dumb bro",
                            $exception->getMessage()
                        ]
                    ]),
                    $status ?? APIStatusEnum::INTERNAL_SERVER_ERROR
                );
            }
        });
    })->create();
