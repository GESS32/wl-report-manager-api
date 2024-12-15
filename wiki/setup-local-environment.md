## Setup local environment

1. Go to the docker folder:
    ```shell
    cd docker/
    ```

2. Create `.env` file:
    ```shell
    cp .env.example .env
    ```
   
3. Check your UID:
    ```shell
   id -u
    ```

4. If your UID is not `1000`, update the `UID` variable in the `.env` file with your UID:
    ```dotenv
    UID={YOUR_UID}
    ```

5. Return to the project root directory and  up docker compose:
   
    **Note**: to use `make` commands you should install the `make` package. For Ubuntu: `sudo apt install make`.

    ```shell
    cd ../
    make up
    ```

6. Create `.env` file:
    ```shell
    cp .env.example .env
    ```

7. Resolve permission issues:
    ```shell
    sudo chmod -R 0755 storage
    sudo chmod -R 0755 bootstrap/cache
    ```

8. Enter to the PHP container console:
    ```shell
    make php-exec
    ```

9. Install dependencies and generate app key:
    ```shell
    bash ./sh/php/setup.sh
    ```

10. Add the following line to the `hosts` file:
     ```text
     127.0.0.1 local.wrm-backend.com
     ```

11. Open the browser and go to the [local.wrm-backend.com](http://local.wrm-backend.com).
