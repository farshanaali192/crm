# CRM – Accounts, Leads and Contacts

A Laravel CRM application for managing accounts, leads and contacts. Contacts can be created from an Account or a Lead, and the source record is stored in the contact's contactable_type and contactable_id fields.

# Features

Dashboard displaying total accounts, leads and contacts.

Account and lead creation/listing pages.

Contact listing.

Contact creation shared through ContactService, with source-specific classes such as AccountContactSource and LeadContactSource.



# Requirements

Check composer.json for the exact PHP and extension requirements for this project. You will also need:

Composer

MySQL/MariaDB (for example, the database supplied with XAMPP)

Node.js and npm if the frontend assets are built with Vite

## Installation

1. Install PHP dependencies

From the project root:

composer install

2. Create the environment file

On Windows Command Prompt:

copy .env.example .env

On PowerShell:

Copy-Item .env.example .env

3. Create a database

Create a database in MySQL/phpMyAdmin, for example:

CREATE DATABASE crm;

Update the database settings in .env. Example for a typical local XAMPP setup:

APP_NAME="CRM"
APP_ENV=local
APP_DEBUG=true
APP_URL=http://127.0.0.1:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=crm
DB_USERNAME=root
DB_PASSWORD=

Use the credentials configured on your own machine. Do not commit real passwords or other secrets to version control.

4. Generate the application key

php artisan key:generate

5. Run migrations

php artisan migrate

This should create the tables defined by the project's migrations, including accounts, leads and contacts.

6. Build frontend assets

If the project includes a package.json and uses Vite:

npm install
npm run build

For frontend development with hot reload, use a separate terminal:

npm run dev

7. Start Laravel

php artisan serve

Open the local URL printed by Artisan, commonly http://127.0.0.1:8000.

# Application routes

    The routes discussed for this application are:

    php artisan route:list

# contact types

    The contacts table uses these fields to identify the originating record:

        contactable_type: currently account or lead.

        contactable_id: ID of the source account or lead.

        This is a manually stored source reference. Because contactable_type is an enum in the migration, adding a new source type requires updating the schema as well as adding its source class and service integration.


# Verification and testing

    Run the automated test suite with:
    php artisan test

    For individual testing of the functions:
    Account creation:
    php artisan test --filter=AccountCreationTest

    Lead Creation:
    php artisan test --filter=LeadCreationTest


    here used testing datatabse (crm_test) other than main database.Refer phpunit.xml.
    Both files contains positive testing, negative testing , Validation Testing , feature testing and Integration Testing.


    Useful commands

    php artisan route:list
    php artisan migrate:status
    php artisan test
    php artisan optimize:clear
