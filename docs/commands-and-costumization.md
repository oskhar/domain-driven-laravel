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

### Additional Commands for Domain-Driven Integration

For a comprehensive list of additional commands that support Domain-Driven Design integration, you can run:

```bash
php artisan list
```

This will display all available commands, including those that help in generating and managing domain-specific components, such as actions, models, events, services, and more. Here are a few key commands:

```bash
~$ php artisan list
 ddd
  ddd:action                 Generate an action
  ddd:base-model             Generate a base domain model
  ddd:base-view-model        Generate a base view model
  ddd:cache                  Cache auto-discovered domain objects used for autoloading.
  ddd:cast                   Create a new custom Eloquent cast class
  ddd:channel                Create a new channel class
  ddd:class                  Create a new class
  ddd:clear                  Clear cached domain autoloaded objects.
  ddd:command                Create a new Artisan command
  ddd:dto                    [ddd:data-transfer-object|ddd:datatransferobject|ddd:data] Generate a data transfer object
  ddd:enum                   Create a new enum
  ddd:event                  Create a new event class
  ddd:exception              Create a new custom exception class
  ddd:factory                Generate a domain model factory
  ddd:install                Install and initialize Laravel-DDD
  ddd:interface              Create a new interface
  ddd:job                    Create a new job class
  ddd:list                   List all current domains
  ddd:listener               Create a new event listener class
  ddd:mail                   Create a new email class
  ddd:model                  Generate a domain model
  ddd:notification           Create a new notification class
  ddd:observer               Create a new observer class
  ddd:policy                 Create a new policy class
  ddd:provider               Create a new service provider class
  ddd:resource               Create a new resource
  ddd:rule                   Create a new validation rule
  ddd:scope                  Create a new scope class
  ddd:service                Create a new service class within a domain
  ddd:trait                  Create a new trait
  ddd:transformer            Create a new transformer transformer class
  ddd:upgrade                Upgrade published config files for compatibility with 1.x.
  ddd:value                  [ddd:value-object|ddd:valueobject] Generate a value object
  ddd:view-model             [ddd:viewmodel] Generate a view model
 infrastructure
  infrastructure:middleware  Generate a new middleware class in the Infrastructure layer
  infrastructure:service     Generate a new service class in the Infrastructure layer
```

These commands ensure that your development process is efficient and aligned with DDD principles.

### Reference

The commands are inspired by and refer to the [laravel-ddd](https://github.com/lunarstorm/laravel-ddd) package, which provides additional resources and tools for implementing Domain-Driven Design in Laravel.
