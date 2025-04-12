# Job Site Project

This is a basic job listing site.
Users can see job listings posted in the last 2 months.

## Libraries/frameworks used

-   Laravel v12 (Base framework)
-   Tailwind CSS (For easy styling, style sheets are smaller than using CDN/using another library)
-   php-flasher/flasher-laravel (For nice alerts)

## Features

### Global Features

-   Some responsive design
-   Separation of responsibilities: middleware, form requests, models.

### Listing Index

This is where user's can express interest into jobs. This is only available to users with the correct role.

### Listing Management

See [Role Management](#role-management) for who can see this page.

Users with the proper role can:

-   See their job listings.
-   Edit their job listings.
-   Delete their job listings.
-   See who is interested in their job listing.

### Role Management

Basic role management is included in the site. This is only available to admin users.

#### Guest (unauthenticated user)

A guest user is able to:

-   See the job listing index page

<small>Users who are guests will be asked to login if trying to access an authenticated feature. If they have the proper permission, they will be redirected to that page after login.</small>

#### Viewer

A viewer is able to:

-   See full job listings.
-   Express and remove interest from a job listing.

#### Poster

A poster is able to:

-   Add new job listings.
-   Modify or delete their own job listings.
-   See users who have expressed interest in their job listings.

#### Admin

Admin's inherit all roles, but can also:

-   Modify or delete ANY job listing
-   Delete users and manage permissions
