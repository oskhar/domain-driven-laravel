# 🧱 Commands and Customization

### Overview of Command Components

In the domain-driven-laravel, command components play a crucial role in maintaining a consistent structure and automating the generation of essential classes. These commands are designed to streamline the development process by scaffolding specific elements in the Infrastructure and Domain layers according to Domain-Driven Design (DDD) principles.

### Available Commands

#### 1. **InfrastructureMiddlewareCommand.php**

-   **Purpose**: Generates middleware classes within the Infrastructure layer.
-   **Command**: `infrastructure:middleware`
-   **Usage**:

    ```bash
    php artisan infrastructure:middleware {name}
    ```

    -   **Parameters**:
        -   `{name}`: The name of the middleware class to be generated.

-   **Example**: To generate a middleware class named `AuthMiddleware`:
    ```bash
    php artisan infrastructure:middleware AuthMiddleware
    ```

#### 2. **InfrastructureServiceCommand.php**

-   **Purpose**: Creates service classes in the Infrastructure layer, ensuring they adhere to the project's architectural standards.
-   **Command**: `infrastructure:service`
-   **Usage**:

    ```bash
    php artisan infrastructure:service {name}
    ```

    -   **Parameters**:
        -   `{name}`: The name of the service class to be generated.

-   **Example**: To generate a service class named `UserService`:
    ```bash
    php artisan infrastructure:service UserService
    ```

#### 3. **DDDServiceCommand.php**

-   **Purpose**: Generates service classes within the Domain layer following DDD principles.
-   **Command**: `ddd:service`
-   **Usage**:

    ```bash
    php artisan ddd:service {name} --domain={domain}
    ```

    -   **Parameters**:
        -   `{name}`: The name of the service class.
        -   `{domain}`: The domain where the service class will be placed.

-   **Example**: To generate a service class named `PaymentService` in the `Billing` domain:
    ```bash
    php artisan ddd:service PaymentService Billing
    ```

#### 4. **DDDTransformerCommand.php**

-   **Purpose**: Creates transformer classes within the Domain layer, useful for data transformation tasks.
-   **Command**: `ddd:transformer`
-   **Usage**:

    ```bash
    php artisan ddd:transformer {name} --domain={domain}
    ```

    -   **Parameters**:
        -   `{name}`: The name of the transformer class.
        -   `{domain}`: The domain where the transformer class will be placed.

-   **Example**: To generate a transformer class named `UserTransformer` in the `User` domain:
    ```bash
    php artisan ddd:transformer UserTransformer User
    ```

### Customization

The commands provided can be customized using stubs located in the `resources/stubs` directory. This allows developers to tailor the scaffolding process to better fit the needs of their application.

-   **resources/stubs/ddd**: Customize stubs for Domain layer components.
-   **resources/stubs/infrastructure**: Customize stubs for Infrastructure layer components.

By modifying these stubs, you can ensure that the generated code adheres to your project’s specific conventions and best practices.

### Reference

The commands are inspired by and refer to the [laravel-ddd](https://github.com/lunarstorm/laravel-ddd) package, which provides additional resources and tools for implementing Domain-Driven Design in Laravel.
