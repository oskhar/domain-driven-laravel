# 📡 API Layer

### Centralized API Response Handling

In the API layer, centralized handling of responses ensures consistent formatting across the entire application. This is achieved by using the `APIResponseService`, which generates structured JSON responses, leveraging `APIResponseData` and `APIStatusEnum`.

-   **Success Response Example**:

    ```php
    return ($this->response)(
        APIResponseData::from([
            "data" => $result["data"],
            "pagination" => $result["pagination"]
        ])
    );
    ```

-   **Error Response Example**:
    ```php
    $response = app(APIResponseService::class);
    ($response)(
        APIResponseData::from([
            "status" => false,
            "errors" => [
                "Bro wrote the wrong database query. Backend skills issue",
                $exception->getMessage()
            ]
        ]),
        APIStatusEnum::INTERNAL_SERVER_ERROR
    );
    ```

> [!NOTE]
> You can see `app/Infrastructure/Services/APIResponseService.php` for more detailed usage

### Use a Single Instance of the API Client

It is advisable to maintain a single, reusable instance of the API client. In this application, the API responses are standardized using the `APIResponseService`, ensuring that all endpoints return a consistent structure.

### Structured API Response Data

API responses are structured using the `APIResponseData` class. This class allows for defining various components of a response, such as the actual data, pagination information, errors, metadata, and the status of the response.

```php
class APIResponseData extends Data
{
    public function __construct(
        readonly mixed $data = null,
        readonly ?string $message,
        readonly ?array $errors,
        readonly ?PaginationData $pagination,
        readonly ?APIMetaData $meta,
        readonly ?bool $status = true,
    ) {
    }
}
```

Default message if you forget to set it 🛰

-   `200 SUCCESS` => "Success! Your request has safely landed back to Earth."
-   `201 CREATED` => "New entity launched into the cosmos."
-   `400 BAD_REQUEST` => "Your request veered off course and couldn't escape Earth's gravity!"
-   `401 UNAUTHORIZED` => "Your credentials don't pass the cosmic gatekeeper!"
-   `403 FORBIDDEN` => "Your request violates the Sacred Timeline and cannot be fulfilled!"
-   `404 NOT_FOUND` => "The data you're seeking is beyond the bounds of space!"
-   `409 CONFLICT` => "Collision in the cosmic pathways! Your request encountered a space-time conflict."
-   `422 UNPROCESSABLE_ENTITY` => "Data anomaly detected. Unable to process your request in this dimension!"
-   `500 INTERNAL_SERVER_ERROR` => "Galactic disruption. An unexpected cosmic event occurred!"

### Enum-Based Status Codes

The `APIStatusEnum` enum provides a set of predefined status codes and their corresponding messages, ensuring consistent use of HTTP status codes across the application.

```php
enum APIStatusEnum: int
{
    case SUCCESS = 200;
    case CREATED = 201;
    case BAD_REQUEST = 400;
    case UNAUTHORIZED = 401;
    case FORBIDDEN = 403;
    case NOT_FOUND = 404;
    case CONFLICT = 409;
    case UNPROCESSABLE_ENTITY = 422;
    case INTERNAL_SERVER_ERROR = 500;
}
```

### Request Tracking Middleware

To enhance request tracing and debugging, the `RequestTrackingMiddleware` assigns a unique `X-Request-ID` to each incoming request, which is included in the API response metadata.

```php
class RequestTrackingMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $requestId = (string) Str::uuid();
        $request->headers->set('X-Request-ID', $requestId);
        return $next($request);
    }
}
```
