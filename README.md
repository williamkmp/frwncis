# **Taskly**

## Project Prerequisite

Below are the requirement for running the project

- [Node](https://nodejs.org/en), LTS version 18.4.0 or above
- [Composer](https://getcomposer.org/download/), version 2.5.4
- [XAMPP](https://www.apachefriends.org/download.html), for PHP 8.1.6 and MySQL

## Project Setup

1. Clone Repository and download all dependency

    ```bash
    git clone https://github.com/williamkmp/frwncis.git
    cd frwncis
    composer install
    npm install
    php artisan key:generate
    code .
    ```

2. Run xampp and turn on the MySQL server
3. Configure the project `.env` by copying the availabel `.env.example` and change below parameter:

    ```env
    APP_NAME = Taskly

    APP_URL = http://localhost

    DB_CONNECTION = mysql
    DB_HOST = 127.0.0.1
    DB_PORT = 3306
    DB_DATABASE = taskly
    DB_USERNAME = root
    ```

4. Run database migartions

    ```bash
    php artisan migrate:fresh --seed
    ```

5. In a seperate terminal run the vite server (for building tailwind css stlye)

    ```bash
    npm run dev
    ```

6. In a seperate terminal run the artisan serve command

    ```bash
    php artisan serve 
    ```

## Project Dependecies

Below are libraries and devtools included inside the project:

- [Bootstrap 5](https://getbootstrap.com/), for styling.
