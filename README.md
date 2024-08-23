# Domain-Driven Laravel 🛸 🔃

[![MIT License](https://img.shields.io/github/license/oskhar/domain-driven-laravel)](https://github.com/oskhar/domain-driven-laravel/blob/main/LICENSE)

A robust, scalable, and flexible architecture for developing RESTful APIs with Laravel using Domain-Driven Design (DDD) principles.

[📘 Article](https://dev.to/oskhar/domain-driven-laravel-build-great-systems-that-are-scalable-and-powerful-4458)

## Introduction

Laravel is an excellent framework for building Powerfull Apps, offering a rich set of features and a clean syntax. However, as projects grow in complexity, it's easy for the codebase to become unmanageable. The absence of a clear architectural pattern can lead to a mix of responsibilities, making the code harder to maintain and scale.

This repository presents a way to structure Laravel projects using Domain-Driven Design (DDD) principles, allowing for better organization, scalability, and separation of concerns. The approach showcased here is inspired by best practices and aims to solve real-world challenges in a practical and maintainable way.

The goal is to provide a solid foundation for building Laravel applications that are.

-   🧩 Easy to Understand. A well-organized codebase with clear boundaries.
-   🛠️ Maintainable. Follow DDD principles to keep concerns separated.
-   📈 Scalable. Designed to grow with your application's needs.
-   🔒 Secure. Focused on applying security best practices.
-   🔥 Performant. Built with performance considerations from the ground up.

> [!IMPORTANT]
> This template is designed with flexibility and scalability in mind, but it's essential to understand that every project is unique. Before adopting this template, consider the specific requirements of your project. You may need to modify certain aspects to fit your needs. This template serves as a solid starting point, but it's not a one-size-fits-all solution.

## Key Features

-   Domain-Driven Design (DDD) Principles. Ensures maintainable and scalable code.
-   Clean Architecture. Clear separation of concerns with distinct layers for infrastructure, domain, and application logic.
-   Pre-configured Commands. Includes commands for generating middleware and service classes in the Infrastructure layer.
-   Customizable Stubs Predefined stubs to easily generate custom classes.
-   Extensible Structure. Supports the growth and complexity of your application.

Feel free to explore the repository and the provided documentation to get the most out of this template.

## Table Of Contents

-   [💻 Application Overview](docs/application-overview.md)
-   [⚙️ Project Standards](docs/project-standards.md)
-   [🗄️ Project Structure](docs/project-structure.md)
-   [🧱 Commands and Customization](docs/commands-and-costumization.md)
-   [📡 API Layer](docs/api-layer.md)
-   [📦 Domain Layer](docs/domain-layer.md)
-   [🧪 Testing](docs/testing.md)
-   [⚠️ Error Handling](docs/error-handling.md)
-   [🔐 Security](docs/security.md)

## Who is This Template For?

This template is ideal for Laravel developers who.

-   Want to adopt Domain-Driven Design (DDD) principles.
-   Are building complex applications requiring clean architecture and maintainability.
-   Need a scalable solution for managing domain logic, services, and middleware.

## Managing API Documentation

When using this project, you have flexibility in how you manage your API documentation. If you prefer, you can delete the docs folder entirely. Although API documentation files exist there, you’ll find that the `public` folder also contains API documentation, which is automatically served at http://localhost:8000 when you run your Laravel application.

This means you can focus solely on updating the `public/openapi.yml` file for your API documentation. Alternatively, if you prefer working within the docs folder, you can maintain your OpenAPI documentation in `docs/openapi-view/public/openapi.yml`. The choice is yours, allowing you to manage your API documentation in the way that best suits your workflow.

## Contributing

Contributions are welcome! Please submit a pull request or open an issue to discuss any changes.For further questions, issues, or discussions, please open an issue on GitHub or contact the project maintainers.

We appreciate your contributions and look forward to seeing how you can help enhance Domain-Driven Laravel!
email: [muhamadoskhar@gmail.com](mailto:muhamadoskhar@gmail.com)

## License

This project is licensed under the [MIT License](LICENSE).
