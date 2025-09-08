# Laravel Filament Ecommerce


## Requirements

- PHP 8.2.6 or later
- Composer v2
- MySQL/Postgres

## Installation

1. Download the project zip file from the repository.
2. Extract the zip file to a directory on your local machine.
3. Copy the .env.example file to .env and update the necessary variables such as database credentials and application URL.

```bash
cp .env.example .env
```

4. Install the project dependencies by running the following command in the project directory:

```bash
composer install
```

5. Generate the application key by running the following command:

```bash
php artisan key:generate
```

6. Create a database for the project and update the database credentials in the .env file.
7. Run the database migrations to create the necessary tables by running the following command:

```bash
php artisan migrate:fresh --seed
```

8. Create a symbolic link from the public directory to the storage directory by running the following command:

```bash
php artisan storage:link
```

9. Start the development server by running the following command:

```bash
php artisan serve
```

The project is now installed and ready to use. You can access it by navigating to http://localhost:8000/admin in your web browser.

10. Login in admin panel by using credencials
```
username: eemf4865@gmail.com
password: secret
```
