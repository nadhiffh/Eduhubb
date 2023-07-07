# Learning Management System

## Requirements

- PHP >= 8.1.0
- BCMath PHP Extension
- Ctype PHP Extension
- JSON PHP Extension
- Mbstring PHP Extension
- OpenSSL PHP Extension
- PDO PHP Extension
- Tokenizer PHP Extension
- XML PHP Extension

## Installation

- Clone the repo and `cd` into it
- Run `composer install`
- Rename or copy `.env.example` file to `.env`
- Run `php artisan key:generate`
- Set your database credentials in your `.env` file
- Run migration `php artisan migrate`
- Make something awesome!

## Note

Recommend to install this preset on a project that you are starting from scratch, otherwise your project's design might break.
