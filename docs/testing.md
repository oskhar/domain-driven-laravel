# 🧪 Testing

In any software project, robust testing is crucial to ensure the application functions as expected and is resilient to changes. This document outlines the testing strategies used in this project, which combines traditional Laravel testing approaches with modern practices like Swagger OpenAPI for comprehensive and practical testing workflows.

## Types of Tests:

### Unit Tests

Unit tests focus on testing individual components or classes in isolation. These tests are fast to run and are essential for verifying the correctness of your application's fundamental units, such as utility functions, custom services, or domain logic encapsulated in Actions.

[Laravel 11 Unit Testing Documentation](https://laravel.com/docs/11.x/testing#unit-tests)

### Integration Tests

Integration tests verify how different parts of the application work together. These tests are essential in a Laravel project to ensure that different components, such as controllers, services, and database layers, interact correctly. Integration tests often involve making HTTP requests to test the complete flow of a feature.

[Laravel 11 Integration Testing Documentation](https://laravel.com/docs/11.x/testing#http-tests)

### End-to-End (E2E) Tests

End-to-End testing is a method that validates the entire application, including the frontend and backend, by simulating real user interactions. These tests are critical for ensuring that the system works as a whole, covering scenarios from start to finish.

[Laravel 11 Browser Testing (Dusk) Documentation](https://laravel.com/docs/11.x/dusk)

## Advanced Testing with Swagger OpenAPI

### Swagger OpenAPI for Dual-Sided Testing

In this project, we've integrated Swagger OpenAPI as an advanced tool for both backend and frontend testing. Swagger allows you to define and visualize the API structure, providing a practical interface for testers to interact with the API.

-   Two-Way Testing. Testers can see the predefined schema and use the "Try Out" feature to test API endpoints directly. This setup enables frontend and backend teams to have a clear understanding of how the API is supposed to behave, facilitating easier collaboration and validation.

-   Example and Rule Data. For every API endpoint, we've defined two sets of data:
    -   Example Data. Predefined dummy data used for testing in the Swagger UI.
    -   Rule Data. A strict set of validation rules that can be directly integrated into Laravel's validation system or used by frontend developers (e.g., in React with TypeScript) to ensure consistency across the stack.

Swagger Benefits:

-   Enhanced Collaboration. Both frontend and backend teams can work from a shared, live documentation of the API.
-   Immediate Feedback. Testers can use the "Try Out" feature to instantly see how an endpoint behaves, without needing to write separate scripts or tests.
-   Consistency. The Rule Data ensures that all parties adhere to the same validation standards, reducing the likelihood of discrepancies between the frontend and backend.

## Recommended Tooling:

[Pest](https://pestphp.com)

Pest is a modern PHP testing framework that offers a simpler, more expressive syntax than traditional PHPUnit tests. It integrates seamlessly with Laravel and provides powerful tools for writing clear and concise tests.

[Laravel Dusk](https://laravel.com/docs/11.x/dusk)

Laravel Dusk provides an expressive, easy-to-use browser automation and testing API. It is perfect for writing end-to-end tests in a Laravel environment, allowing you to automate user interactions and verify that your application behaves as expected.

[Laravel Test Factories](https://laravel.com/docs/11.x/database-testing#defining-model-factories)

Laravel's Model Factories are an excellent tool for creating fake data for your tests. They ensure that your tests remain isolated and predictable by providing a consistent way to generate test data.

[Swagger UI](https://swagger.io/tools/swagger-ui/)

Swagger UI is used to visualize the design and functionality of the API. It offers an interactive environment where testers and developers can test API endpoints directly within the browser, using the example and rule data defined in the OpenAPI specification.

[Example Swagger UI](../public/openapi.yml)
