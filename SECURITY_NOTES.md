# SECURITY NOTES
## AthleteGear — Sports Equipment Borrowing System

### 1. Project Overview

AthleteGear is a web-based application developed using Laravel and MariaDB/MySQL. The application helps manage sports equipment, categories, user profiles, and equipment borrowing transactions.

The system has two main user roles:
- **Admin:** Manages equipment and categories, views borrowing transactions, and processes equipment returns.
- **Athlete:** Views available equipment, manages their profile, creates borrowing requests, and views their own borrowing transactions.

These security notes describe the security mechanisms implemented in the application based on its routes, controllers, middleware, authentication logic, and form validation.

### 2. Authentication and Password Security

AthleteGear uses Laravel authentication to manage user access.

The following mechanisms are implemented:

- **Input validation during registration:** The name is required and limited to 100 characters, the email must be valid and unique, and the password must be at least eight characters long and match its confirmation.
- **Password hashing:** Passwords are stored using Laravel's `Hash::make()` instead of being stored as plain text.
- **Login verification:** The application uses `Auth::attempt()` to verify the submitted email and password.
- **Invalid login handling:** Failed login attempts return a validation error instead of granting access.
- **Session regeneration:** The session ID is regenerated after successful login and registration to help prevent session fixation.
- **Logout protection:** Logging out clears the authenticated session, invalidates the session, and regenerates the CSRF token.

These mechanisms help protect user accounts and manage authenticated sessions.

### 3. Authorization and Role-Based Access Control

AthleteGear separates access between administrators and athletes.

The application uses an `AdminMiddleware` to restrict administrator-only routes. If the current user is not authenticated or does not have administrator privileges, the request is rejected with an HTTP 403 Forbidden response.

Administrator-only routes include equipment management and category management, such as creating, updating, and deleting records.

Authenticated routes are grouped behind authentication middleware. These include the dashboard, profile, equipment pages, and borrowing pages.

Borrowing access is also checked in the controller:

- Athletes can view their own borrowing transactions.
- Athletes cannot access another athlete's borrowing details.
- Athletes can only submit a return request for their own borrowing transaction.
- Return processing is restricted to administrators.

These checks reduce the risk of unauthorized access to protected pages and other users' transaction data.

### 4. CSRF Protection

AthleteGear uses Cross-Site Request Forgery (CSRF) protection for its forms.

Blade forms include Laravel's `@csrf` directive, which generates a CSRF token for form submissions. The token helps Laravel verify that state-changing requests originate from a valid application session.

CSRF protection is applied to relevant forms, including authentication, profile updates, equipment management, category management, and borrowing actions.

This protection helps prevent unauthorized actions submitted through a user's authenticated browser session.

### 5. Input Validation and Data Integrity

The application validates incoming data before creating or updating records.

#### User Registration

- Name: required string with a maximum length of 100 characters.
- Email: required, valid email format, maximum 255 characters, and unique.
- Password: required, minimum eight characters, and confirmed.

#### Equipment Management

- Category ID: must exist in the categories table.
- Equipment name: required string with a maximum length of 150 characters.
- Description: optional string with a maximum length of 1,000 characters.
- Quantity and minimum stock: integers with a minimum value of zero.
- Equipment condition: restricted to `Good`, `Fair`, or `Damaged`.

#### Category Management

- Category name: required string with a maximum length of 100 characters and must be unique.
- Description: optional string with a maximum length of 1,000 characters.

#### Profile Management

- Name: required string with a maximum length of 255 characters.
- Email: required, valid email format, maximum 255 characters, and unique except for the current user's record.

#### Borrowing Transactions

- Equipment ID: must reference an existing equipment record.
- Quantity: must be an integer of at least one.
- Due date: optional and, when provided, must be today or a future date.

Validated data is used when creating or updating records. This helps prevent invalid input from being stored and maintains data consistency.

### 6. Equipment Stock and Borrowing Transaction Safety

The borrowing process uses a database transaction and row-level locking to protect equipment stock.

When an athlete borrows equipment, the application:

1. Starts a database transaction.
2. Locks the selected equipment record using `lockForUpdate()`.
3. Checks whether the requested quantity is available.
4. Reduces the equipment quantity.
5. Creates the borrowing transaction with the authenticated user's ID.

If the requested quantity exceeds the available stock, the borrowing operation is rejected.

The return process also uses a database transaction and locks the relevant borrowing and equipment records. The application verifies that the transaction is awaiting approval before processing the return, adds the borrowed quantity back to the stock, and records the return date.

These mechanisms help prevent stock inconsistencies and reduce the risk of processing the same return more than once.

### 7. Database Relationship and Deletion Protection

The application uses relationships between users, equipment, categories, and borrowing records.

The main relationships are:

- A user can have multiple borrowing transactions.
- Equipment belongs to a category.
- A borrowing transaction belongs to a user.
- A borrowing transaction belongs to an equipment record.

The application also prevents certain deletions:

- Equipment cannot be deleted if borrowing records reference it.
- Categories cannot be deleted while equipment records still reference them.
- Borrowing history cannot be deleted through the borrowing controller.

These restrictions help preserve transaction history and maintain referential consistency.

### 8. Mass Assignment Considerations

The `Borrowing` model defines fillable attributes for borrowing records, including `user_id`, `equipment_id`, `quantity`, dates, and `status`.

Because these fields are fillable, controllers must ensure that untrusted request data is not passed directly into model creation or update operations.

In the borrowing controller, the authenticated user's ID and the initial borrowing status are assigned by the application rather than taken directly from user-submitted values. Return status changes are also handled through controller logic.

This approach helps prevent users from manipulating sensitive transaction fields through submitted form data.

### 9. Session Management

AthleteGear uses Laravel's session functionality to maintain authentication state.

The authentication controller implements the following measures:

- Regenerating the session after successful login.
- Regenerating the session after registration.
- Invalidating the session during logout.
- Regenerating the CSRF token during logout.

These measures help manage session state safely during authentication and logout.

Session storage and cookie settings should also be configured appropriately for the deployment environment.

### 10. Environment Configuration and Deployment

Sensitive configuration values should be stored in the `.env` file rather than committed to the public repository.

The repository should include `.env.example` as a configuration template without real passwords, API keys, or production secrets.

Before deployment:

- Configure the production database credentials securely.
- Set `APP_ENV=production`.
- Set `APP_DEBUG=false`.
- Generate and configure a valid application key.
- Use HTTPS to protect data transmitted between the browser and server.
- Ensure the real `.env` file is excluded from version control.
- Use a database account with only the permissions required by the application.
- Avoid exposing database credentials and production error details.

These are deployment recommendations and should be checked against the actual production configuration.

### 11. Security Limitations and Further Improvements

The implemented authentication, validation, authorization, CSRF protection, and transaction controls provide a foundation for application security. However, additional checks are recommended before production use:

- Verify that all administrator routes consistently use the administrator middleware.
- Review all Blade forms and state-changing requests to ensure CSRF protection is present.
- Review model fillable attributes and controller usage to prevent unintended mass assignment.
- Configure secure session cookies and HTTPS in production.
- Test authorization with both administrator and athlete accounts.
- Review error handling and logs to ensure sensitive information is not exposed.
- Test input validation and borrowing edge cases.

### 12. Conclusion

AthleteGear implements several security measures, including Laravel authentication, password hashing, session regeneration, role-based access control, CSRF protection, input validation, database transactions, row-level locking, and deletion restrictions.

Together, these measures help protect user accounts, restrict access to sensitive operations, validate application data, and maintain the consistency of equipment borrowing transactions.

Security should continue to be reviewed and tested as the application develops and before it is deployed to a production environment.