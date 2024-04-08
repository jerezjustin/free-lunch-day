# Free Lunch Day 🍚🍗😋

Tools used in the making of this project:

## Description

Technical assestment that emulates a restaurant with a free lunch day.

Tools used to make this project:

-   Laravel ^v11.0
    -   PHP v8.3.0
    -   Queues (database driver)
    -   Reverb @beta
    -   PHPUnit ^v11.0
    -   Local Scopes (filter orders)
    -   Supervisor (To run websockets and workers as deamon)
-   Vuejs (Frontend) ^v3.4
    -   Pinia ^v2.1
    -   Echo ^v1.16
    -   Pusher JS ^v8.4
    -   TailwindCSS ^v3.4
-   Mysql ^v8.0
-   Docker

You can visit the project clicking [here](http://justinjerez.com).

## Installation ⚙️

### 1. Clone repository using https running the following command:

To clone the repository run the following command:

```shell
git clone https://github.com/jerezjustin/free-lunch-day.git
```

or if you prefer using ssh:

```shell
git clone git@github.com:jerezjustin/free-lunch-day.git
```

### 2. Setup environment variables:

Each service has an `.env.example` file containing the environment variables needed to run that specific service.

To make it work it's required to copy those `.env.example` files to `.env` so we can setup values for the environment variables. Follow the next instructions to correctly setup the environment variables foor each service.

#### Laravel Application (Backend)

First create the `.env` file for the backend:

```shell
cp ./backend/.env.example ./backend/.env
```

Make sure that your database environment variables point to the database configuration points to the mysql service in docker. Here you can see how the database environment variables should look like:

```shell
DB_CONNECTION=mysql
DB_HOST=mysql # MySQL docker service name
DB_PORT=3306
DB_DATABASE=restaurant # Port MySQL is running on
DB_USERNAME=root # MySQL root
DB_PASSWORD=password # The MySQL root user password I set
```

Now you need to make sure the backend is broadcasting to `reverb`.

```shell
BROADCAST_CONNECTION=reverb
```

As it uses Laravel Reverb to run websockets, you need to setup the configuration for the service.

```shell
REVERB_APP_ID= # ex. 123456
REVERB_APP_KEY= # ex. xzivyv2eyzb1azhredxm
REVERB_APP_SECRET= # ex. qmqdwi6uefkhtfbojspf
REVERB_HOST="localhost"
REVERB_PORT=8080
REVERB_SCHEME=http
```

The backend dispatches a job every time an order is placed so you need to make sure you the `QUEUE_CONNECTION` is set to `database`.

```shell
QUEUE_CONNECTION=database
```

Finally there is a environment variable called `ALEGRA_MARKET_SERVICE_URL` to store the `Market` endpoint to purchase more ingredients when need, make sure to set it to:

```shell
ALEGRA_MARKET_SERVICE_URL=https://recruitment.alegra.com/api/farmers-market/buy
```

#### VueJs (Backend)

Create the `.env` file for the frontend using:

```shell
cp ./frontend/.env.example ./frontend/.env
```

Then setup the `VITE_API_URL` which points to the backend api.

```shell
VITE_API_URL=http://localhost/api
```

Finally setup the configuration to listen to the websockets events coming front the backend. You should set them according to the configuration on the backend.

```shell
VITE_REVERB_APP_KEY= # ex. xzivyv2eyzb1azhredxm
VITE_REVERB_HOST="localhost"
VITE_REVERB_PORT=8080
VITE_REVERB_SCHEME=http
```

### 3. Spin up container

To run the project you need to spin up docker containers, be sure to bet at the root of the project and execute

```shell
# -d flag means dettached, so it runs on the background.
docker compose up -d
```

If this doesn't build the images try using

```shell
# --build flag will try to build the images needed to run the project
docker compose up -d --build
```

At first those commands will take some time, the build process then gets cached and it faster to execute. When it's done executing you should see which containers started.

```shell
 ✔ Container free-lunch-day-mysql-1        Running          0.0s
 ✔ Container free-lunch-day-backend-1      Started         12.1s
 ✔ Container free-lunch-day-frontend-1     Started          1.9s
 ✔ Container free-lunch-day-nginx-1        Started          1.8s
```

### 4. Running migrations (Really Important)

Now the project should be up and running but there are a few things you must do so it works as it should. See what containers are running with the following command:

```shell
docker ps

# You should see a table with the following headers
CONTAINER ID    NAME    COMMAND     CREATED STATUS  PORTS   NAMES
# Here you will see the information about each process running
```

Copy the `CONTAINER ID` or `NAME` of the backend container en use it in the following command.

```shell
# Replace <backend-container> with the `CONTAINER ID` or `NAME` of the backend container
docker compose exec <backend-container> php artisan migrate --seed
```

This command will not only run the migrations on the database but also, it will seed the ingredients and recipes that are going to be use in the project.

### 5. Viewing and using the project

After you are done with all the configuration process you can visit the front-end at:

```bash
localhost:3000
```

And the backend will be at:

```bash
localhost:8000/api
```

# Disclaimer

### Orders, Ingredients and Purchases not updating

The first time you run the project you will encounter that the order are placed but their status do not change, nor does the ingredients count and purchase list. This is due of the missing migrations the first time. To fix it, stop the containers and spin them back up using:

```shell
# Stop containers
docker compose down

# Start containers back up
docker compose up -d
```
