<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

# Start a new Laravel project

Small exercises to learn the basics of Laravel.

-   [ ] Create a new Laravel project
-   [ ] Add Sass to the project
-   [ ] Add Bootstrap to the project

# How to run this project

## Install Laravel

```bash
composer create-project laravel/laravel project-name
```

### Install Sail (Docker)

Docs: https://laravel.com/docs/10.x/sail

#### Add Sail to the project

```bash
composer require laravel/sail --dev
```

#### Install Sails

```bash
php artisan sail:install
```

#### Run Sails

```bash
./vendor/bin/sail up
```

### Problem solving

Folder permission issues:

```
sudo chmod 777 -R .
```

Docker not running permission issues:

```bash
sudo chmod 666 /var/run/docker.sock
```

Docker not running:

```bash
sudo systemctl start docker
```

Docker not running after restart:

```bash
sudo systemctl enable docker
```

#### Port 3306 already in use

Error starting userland proxy: listen tcp4 0.0.0.0:3306: bind: address already in use.

Check what is using port 3306:

```bash
sudo netstat -nlpt |grep 3306
```

Stop the service using port 3306:

```bash
sudo systemctl stop mysql
```

### Add phpMyAdmin

Add the following to the docker-compose.yml file, below the mysql service. Make sure to indent correctly.
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

### Add Sass

Docs: https://laravel.com/docs/10.x/vite#installing-node

Check Node version with sail:

```bash
./vendor/bin/sail node -v
```

#### Install Sass:

```bash
./vendor/bin/sail npm add -D sass
```

#### Setup Sass:

1. Go to resources/css/app.css and change the file extension to .scss `resources/css/app.scss`.
2. Update the file name in the vite.config.js file:

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

Start vite:

```bash
./vendor/bin/sail npm run dev
```

#### Test Sass

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
