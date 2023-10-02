<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

# Laravel Playground

Small exercises to learn the basics of Laravel.

-   [ ] Create a new Laravel project with Sail (Docker)
-   [ ] Add Sass to the project
-   [ ] Add Bootstrap to the project

## Project overview

### Index

-   [Laravel Playground](#laravel-playground)
-   [Composer and NPM Packages](#composer-and-npm-packages)
    -   [Install Laravel](#install-laravel)
    -   [Install Sail (Docker)](#install-sail-docker)
        -   [Add Sail to the project](#add-sail-to-the-project)
        -   [Install Sail/Composer dependencies](#install-sailcomposer-dependencies)
        -   [Run Sails](#run-sails)
        -   [Sail problem solving](#sail-problem-solving)
            -   [Folder permission issues](#folder-permission-issues)
            -   [Docker not running error](#docker-not-running-error)
            -   [Docker not running](#docker-not-running)
            -   [Docker not running after restart](#docker-not-running-after-restart)
            -   [Port already in use error](#port-already-in-use-error)
            -   [Port 3306 already in use](#port-3306-already-in-use)
    -   [Add phpMyAdmin](#add-phpmyadmin)
    -   [Add Sass](#add-sass)
        -   [Install Sass:](#install-sass)
        -   [Setup Sass:](#setup-sass)
        -   [Test Sass](#test-sass)
-   [Sass exercises](#sass-exercises)
-   [Install Laravel Breeze](#install-breeze)

# Composer and NPM Packages

## Install Laravel

Make sure composer is installed on your system. Composer is a dependency manager for PHP. We can use the following command to install Laravel:

```bash
composer create-project laravel/laravel project-name
```

## Install Sail (Docker)

To have a local development environment we can use Laravel Sail. Sail is a light-weight command-line interface for interacting with Laravel's default Docker development environment. Sail provides a great starting point for building a Laravel application using PHP, MySQL, and Redis without requiring prior Docker experience.

Docs: https://laravel.com/docs/10.x/sail

### Add Sail to the project

We use composer again to add Sail to the project:

```bash
composer require laravel/sail --dev
```

### Install Sail/Composer dependencies

After adding Sail to the project we can install it:

```bash
php artisan sail:install
```

### Run Sails

After installing Sail we want to test and run it:

```bash
./vendor/bin/sail up
```

### Sail problem solving

Somtimes you run into problems when running Sail. Here are some solutions:

#### Folder permission issues

It can occur that you run into permission issues. To solve this you can run the following command in the project root:

```
sudo chmod 777 -R .
```

#### Docker not running error

It could be that Docker is not running. You can check this by running the following command:

```bash
sudo systemctl status docker
```

#### Docker not running

If Docker is not running you can start it with the following command:

```bash
sudo systemctl start docker
```

#### Docker not running after restart

If Docker is not running after a restart you can enable it with the following command:

```bash
sudo systemctl enable docker
```

If it is running and installed on your device, we can try try to add permissions to the docker.sock file for the current user to solve the problem:

```bash
sudo chmod 666 /var/run/docker.sock
```

#### Port already in use error

It could be that another service is using the port that Sail wants to use. For example port 3306.

#### Port 3306 already in use

Error starting userland proxy: listen tcp4 0.0.0.0:3306: bind: address already in use.

Check what is using port 3306:

```bash
sudo netstat -nlpt |grep 3306
```

Stop the service on port 3306, in this case mysql:

```bash
sudo systemctl stop mysql
```

## Add phpMyAdmin

Add the following to the docker-compose.yml file, below the mysql service. Make sure to indent it correctly.
It should be on the same level as the mysql service:

```
    phpmyadmin:
        image: "phpmyadmin:latest"
        ports:
            - 8080:80
        environment:
            PMA_HOST: mysql
            PMA_PORT: 3306
        depends_on:
            mysql:
                condition: service_healthy
        networks:
            - sail
```

You find the database credentials in the .env file in the project root.

## Add Sass

Docs: https://laravel.com/docs/10.x/vite#installing-node

Check Node version with sail:

```bash
./vendor/bin/sail node -v
```

### Install Sass:

```bash
./vendor/bin/sail npm add -D sass
```

### Setup Sass:

1. Go to resources/css/app.css and rename the file extension to .scss `resources/css/app.scss`.
2. Update the file name also in the vite.config.js file:

```js
import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";

export default defineConfig({
    plugins: [
        laravel({
            input: ["resources/css/app.scss", "resources/js/app.js"],
            refresh: true,
        }),
    ],
});
```

### Test Sass

Run vite to compile the Sass and JS files with hot reloading:

```bash
./vendor/bin/sail npm run dev
```

1. Go to the main view file "./resources/views/welcome.blade.php".
   Delete the styles and add the follwoing instead:

```html
@vite(['resources/css/app.scss', 'resources/js/app.js'])
```

2. Delete everything in the body tag and add the following:

```html
<body class="test">
    <h1>Hello World</h1>
</body>
```

3. Add the following to the app.scss file:

```scss
HTML,
body {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    overflow-x: hidden;
    height: 100vh;
}
.test {
    background-color: red;

    .inner {
        height: 200%;
        width: 100%;
        background-color: blue;
    }
}
```
# Sass exercises


# Install Breeze
1. At first we need to add the breeze package with composer.
```bash
sail composer require laravel/breeze --dev
```
2. Then we need to generate all files and routes
```bash
sail artisan breeze:install
```
3. After that we need to migrate, to create all the tables
```bash
sail artisan migrate
```
4. We also have to install the node packages
```bash
sail npm install
```
5. Node Server starten
```bash
sail npm run dev
```


