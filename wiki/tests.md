# Tests

1. Enter to the PHP container console:
    ```shell
    make php-exec
    ```

* Run all tests:
    ```shell
    php artisan test
    ```

* Run current test suite:
    ```shell
    php artisan test --testsuite={Feature|Unit}
    ```

* To stop on failure use the `--stop-on-failure` flag:
    ```shell
    php artisan test --stop-on-failure
    ```

**NOTE**: run the `php artisan config:clear` command before running tests.

* Create a Feature test:
    ```shell
    php artisan make:test {ClassNameTest}
    ```

* Create a Unit test:
    ```shell
    php artisan make:test {ClassNameTest} --unit
    ```

**NOTE**: all tests should contain the "Test" suffix.
