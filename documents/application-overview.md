# 💻 Application Overview

The domain-driven-laravel is a powerful template bootstrapped using Laravel, specifically designed for developers who want to build scalable and maintainable RESTful APIs using Domain-Driven Design (DDD) principles.

### Key Components

The application is structured with a clear separation of concerns, making it easy to maintain and extend:

-   📦 **Domain Layer.** Encapsulates core business logic and domain rules. This layer ensures that your business logic is decoupled from infrastructure and application concerns.
-   🏗️ **Infrastructure Layer.** Handles all the technical aspects such as middleware, service integration, and API management, ensuring that the application is well-structured and adheres to best practices.
-   🛠️ **Application Layer.** Manages the interaction between the domain and infrastructure layers, acting as a mediator.

### Models Overview

The template includes the following core models:

-   👤 **User.** Manages user data and roles. Users can have different roles such as `Admin`, `Operator`, or `Member`, each with specific permissions.
-   🛡️ **Admin.** Admins are users with elevated permissions who manage and oversee other users within the application. This role is distinct, necessitating a separate table to handle specific admin data.
-   👥 **Member.** Members are standard users with specific roles, interacting with the application based on their assigned permissions. A separate table for members accounts for unique data relevant to this role.

This updated version now accurately reflects the minimalistic design of your template with just the User model and its associated child tables, Admin and Member.

The addition of the Admin and Member tables is based on the need to differentiate data between these two roles, while ensuring each user account has, at a minimum, an email and password for login as a user.

### Getting Started

To set up the application, ensure that you have the following prerequisites:

-   PHP 8.1^
-   Composer

Follow these steps to set up the application:

#### Clone from github ☄️

```bash
git clone https://github.com/your-repo/domain-driven-laravel.git
cd domain-driven-laravel
```

#### Configure your environment 🏡

```bash
cp .env.example .env
```

#### Install and run 🏃🏻‍➡️

```bash
composer install
php artisan key:generate
php artisan migrate
php artisan db:seed
php artisan serve
```

This will set up the application in development mode. Access it via `http://localhost:8000`.
