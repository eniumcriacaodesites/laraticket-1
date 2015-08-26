#LaraTicket

A simple Laravel ticket and client management system

## Installation and Setup

- Install required packages

```
composer install
```

- Copy .env.example to .env

- Generate private key

```
php artisan key:generate
```

- Update .env file with appropriate DB and system values

- Install database schema

```
php artisan migrate
```

- Seed database with default admin user

```
php artisan db:seed
```

- Visit url and login with email: **admin@admin.com** and password: **admin**

- **IMPORTANT**: Visit the "My Account" page (located under the user icon) and be sure to change your email address and password


## What's Next?

- Create routes for auth and setup views
- Team user management
- Client manager
- Status manager
- Ticket management
  - Assign ticket to client or null
  - Assign one or more users to ticket
- Dashboard to view tickets (View my / View all / Filter status)

## Future

- Client users to manage / create tickets