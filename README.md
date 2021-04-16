# pure-auth-application
a pure Auth Application Project with PHP

## Requirements

* [compose.exe](https://getcomposer.org/download/)
* [PostgreSQL](https://www.postgresql.org/)

## Installation
Run the following command on your project directory:

    $ composer install

after it change the `Config.php` file to your database connection info, and run this command on your database:

    CREATE TABLE users(
        id SERIAL NOT NULL,
        first_name VARCHAR(255) NOT NULL,
        last_name VARCHAR(255) NOT NULL,
        email VARCHAR(255) NOT NULL UNIQUE,
        password VARCHAR(255) NOT NULL,
        created_at TIMESTAMP NOT NULL DEFAULT NOW(),
        updated_at TIMESTAMP NOT NULL DEFAULT NOW()
    )