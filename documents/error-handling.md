# ⚠️ Error Handling

Effective error handling is crucial for creating a robust and user-friendly application. In this project, error handling is designed to catch and manage exceptions both in development and production environments. By structuring the errors and responses systematically, we ensure that the API communicates issues clearly, enabling quick identification and resolution.

### API Errors

We implement a custom interceptor to handle API errors efficiently. This interceptor is responsible for converting exceptions into structured JSON responses, making it easier for clients to understand and handle errors. It also triggers appropriate actions, such as logging out unauthorized users or notifying them of issues.

Laravel provides a flexible way to handle exceptions through custom exception handlers. You can refer to the official [Laravel 11 Exception Handling Documentation](https://laravel.com/docs/11.x/errors#handling-exceptions) to understand the traditional approach to managing exceptions.

### In-App Errors

Within the application, error boundaries are used to manage errors that occur during the rendering process. Instead of relying on a single global error boundary, multiple boundaries are strategically placed throughout the application. This approach ensures that errors are localized, preventing a single error from crashing the entire application.

In Laravel, you can manage specific exceptions by customizing the exception handler and rendering different responses based on the type of exception. For more details, refer to the [Laravel 11 Error Handling Documentation](https://laravel.com/docs/11.x/errors#custom-http-exceptions).

### Custom Exception Handling

To enhance the development experience, a custom error handling configuration is added to the `bootstrap/app` file. This setup catches common exceptions like `ValidationException`, `QueryException`, `OutOfBoundsException`, and others, and renders them into predefined API responses with relevant status codes and error messages. This approach allows developers to quickly identify and address issues by providing meaningful error messages and maintaining a consistent error response structure.

Here’s an example configuration:

```php
withExceptions(function (Exceptions $exceptions) {
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
});
```

### Error Tracking

Tracking errors in production is essential to identify and fix issues that users might face. It’s recommended to integrate a tool like [Sentry](https://sentry.io/) to monitor and report errors in real-time. Sentry helps by providing detailed insights into where and why an error occurred, along with context like the platform and browser details. This makes debugging more efficient and helps maintain a smooth user experience.

To ensure all source maps and relevant information are available for accurate error tracking, make sure to configure Sentry properly and upload source maps as part of your deployment process.
