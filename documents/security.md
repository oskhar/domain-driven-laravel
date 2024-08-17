# 🔐 Security

Security is a critical aspect of any application, and in this project, we've implemented several layers of security measures to protect both user data and application integrity. This document outlines the security strategies and practices employed, with a focus on authentication, authorization, and handling common security vulnerabilities.

### Authentication

Authentication verifies the identity of users accessing the application. In this project, Laravel Sanctum is utilized to manage authentication, providing a simple and secure solution for Single Page Applications (SPAs) and API token authentication. Sanctum allows users to generate and manage API tokens, which can be used to authenticate requests and access resources.

[Laravel Sanctum Documentation](https://laravel.com/docs/11.x/sanctum).

### Authorization

Authorization controls what authenticated users can do within the application. We've implemented a hybrid model combining Role-Based Access Control (RBAC) and Attribute-Based Access Control (ABAC) to provide flexible and detailed permissions management.

#### Role-Based Access Control (RBAC)

RBAC assigns roles to users, such as `admin` and `member`, which define their access to different parts of the application. The roles are managed within the `users` table, and separate tables for `admin` and `member` store role-specific data relevant to each type of user. This separation ensures that the roles are well-organized and that each role's data is stored efficiently.

[Laravel Authorization Documentation](https://laravel.com/docs/11.x/authorization).

#### Attribute-Based Access Control (ABAC)

While RBAC provides a broad framework for managing user permissions, ABAC introduces additional granularity based on user attributes, such as `job_titles`. ABAC allows for more precise control over user actions, making it possible to define permissions based on specific attributes of the user or the resource being accessed. This combination of RBAC and ABAC ensures that the application can handle complex authorization scenarios while remaining flexible.

> [!IMPORTANT]
> The security model implemented in this project is designed to be adaptable. Depending on your project's needs, you can opt to use only RBAC, only ABAC, or a combination of both. It is also possible to avoid using them altogether if they are unnecessary for your project, as they could be overkill in some cases. This flexibility is essential for tailoring security to the specific requirements of different applications, avoiding an over-complicated setup when a simpler solution would suffice.

### Common Security Vulnerabilities

In addition to authentication and authorization, we've addressed common security vulnerabilities such as Cross-Site Scripting (XSS), Cross-Site Request Forgery (CSRF), and SQL injection. Laravel’s built-in security features, including automatic CSRF protection and input sanitization, provide a solid foundation for defending against these attacks.

[Laravel Security Documentation](https://laravel.com/docs/11.x/security).

By combining Sanctum for authentication, a hybrid RBAC/ABAC model for authorization, and Laravel’s robust security features, this application provides a secure environment that can be customized to meet the needs of various projects.
