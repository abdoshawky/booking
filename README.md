## Installation

Please follow these steps to install the projects:

- Clone the project.
- Navigate to the project directory.
- Run the following commands:
    - `cp .env.example .env` and update your database variables inside `.env` file.
    - `docker-compose build`.
    - `docker-composer exce booking.app composer install`
    - `docker-composer exce booking.app php artisan key:generate`.
    - `docker-composer exce booking.app php artisan migrate --seed`.
    - Use the token printed after seeding the database to test the apis that required api token.