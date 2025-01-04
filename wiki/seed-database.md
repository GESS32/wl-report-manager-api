# Seed database

1. Enter to the PHP container console:
    ```bash
    make php-exec
    ```

* To seed the database with test data:
    ```bash
    php artisan db:seed
    ```
    * All users will be created with the `12345678` password.


* To create a user with PHP developer specialization:
    ```bash
    php artisan db:seed --class=PhpDeveloperSeeder
    ```
    * User credentials
        * Login: `developer`
        * Password: `12345678`
