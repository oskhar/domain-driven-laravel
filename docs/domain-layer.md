# 📦 Domain Layer

The `Domain` directory is the core of your Laravel application, encapsulating all the critical business logic and domain-specific rules. This layer is designed to be independent of the infrastructure, ensuring that your domain logic remains pure and focused on the business requirements.

## Structure

Each domain within your application should be organized into a dedicated subdirectory under the `Domain` directory. The structure of each domain should be intuitive and facilitate a clear understanding of the domain's responsibilities. Below is a breakdown of the key components within a domain:

### 🚀 Actions

Actions are the cornerstone of the domain logic. Each action class is responsible for executing a specific piece of business logic within the domain. Unlike traditional service classes, which might be used as helpers or utility classes, actions encapsulate the core logic that drives your application's functionality.

-   Purpose. Actions focus on specific tasks or workflows within the domain. They are designed to be highly cohesive, performing a single responsibility that can be easily understood by domain experts.
-   Naming. Action classes are named descriptively, reflecting the specific task they perform (e.g., `GetAllAdminAction`, `CreateUserAction`).
-   Implementation. Actions typically extend the `AsAction` trait, enabling them to be invoked in various contexts, such as controllers or directly within other domain logic.

**Example:**

```php
namespace Domain\User\Actions\Admin;

use App\Infrastructure\Services\APIResponseService;
use Domain\User\Data\AdminData;
use Domain\User\Models\Admin;
use Domain\Shared\Data\FilterData;
use Domain\Shared\Data\PaginationData;
use Illuminate\Http\JsonResponse;
use Lorisleiva\Actions\Concerns\AsAction;

class GetAllAdminAction
{
    use AsAction;

    protected APIResponseService $response;

    public function __construct(APIResponseService $response)
    {
        $this->response = $response;
    }

    public function asController(FilterData $filter). JsonResponse
    {
        $result = $this->execute($filter);

        return ($this->response)(
            APIResponseData::from([
                "data" => $result["data"],
                "pagination" => $result["pagination"]
            ])
        );
    }

    public function execute(FilterData $filter). array
    {
        $admin = Admin::getDetailedData();

        if ($filter->search)
            $admin->where("users.full_name", "LIKE", "%" . $filter->search . "%");

        if ($filter->sort)
            $admin->orderBy("users." . $filter->sort->column(), $filter->sort->direction());

        $admin = $filter->validatedPagintion($admin->paginate($filter->length));

        return [
            "data" => [
                "admin" => $admin->getCollection()
                    ->map(fn($item) => AdminData::from($item))
            ],
            "pagination" => PaginationData::fromPaginate($admin),
        ];
    }
}
```

### 🗃️ Data

The Data subdirectory houses Data Transfer Objects (DTOs) that encapsulate the data structures used within the domain. DTOs help ensure that data passed between different layers of the application remains consistent and well-defined.

### 🔢 Enums

Enums define a fixed set of constants that represent specific values within the domain. These are useful for maintaining consistency and avoiding magic numbers or strings throughout your codebase.

### ⚠️ Exceptions

Custom Exceptions are defined within each domain to handle domain-specific errors and exceptional cases. These exceptions provide clarity in error handling and can be used to signal specific issues that arise within the domain.

### 🛠️ Services

Services within the domain layer are utility classes that support the actions. These services encapsulate logic that might be shared across multiple actions but do not contain the core business logic themselves. They act as helpers, providing common functionality that actions can utilize without bloating their implementation.

### Other Components

Depending on the domain's complexity and requirements, you may also include the following:

-   Models. Eloquent models that represent entities within the domain.
-   Events & Listeners. For handling domain events and reacting to changes within the domain.
-   Policies. Define the authorization rules that apply to the domain.
-   Traits. Reusable methods shared across multiple classes in the domain.

## Philosophy

The domain layer is designed to be intuitive and immediately understandable by domain experts. By organizing logic into clearly defined actions, the structure allows developers to easily navigate the domain and understand the interactions without needing to dig into the infrastructure or other unrelated code. This approach promotes a clean, maintainable codebase that can evolve alongside the business needs.
