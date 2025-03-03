# Agencies API Documentation

## Overview

This is a simple API project built using Laravel. The API is designed to manage **Agencies**. The application supports the **Create** and **Read** CRUD operations.

## Installation

Follow these steps to get the project up and running locally:

### 1. Clone the repository

```bash
git clone https://github.com/pcerbino/agencies.git
cd agencies
```

### 2. Install dependencies

Run the following command to install Laravel dependencies via Composer:

```bash
composer install
```

### 3. Create environment

Create the environment file from the example

```bash
cp .env.example .env
```


### 4. Run the migrations

Run the migrations to set up the database tables:

```bash
php artisan migrate
```

### 5. Start the development server

Finally, start the Laravel development server:

```bash
php artisan serve
```

Your API will now be running at `http://localhost:8000`.

----

## API Routes

This API includes the following routes:

### Agencies endpoints

- **POST** `api/agencies`

  - Creates a new agency.
  - Request Body:
  ```json
  {
    "name": "New Agency",
    "email": "new@example.com",
    "secret": "my-super-secret"
  }
  ```
  - **Response**

  ```json
  {
    "id": "05610306-c98b-4cc6-b1f9-38882aecf9e2"
  }
  ```

- **GET** `/api/agencies?email=new@example.com`

  - Retrieves a single Agency by email
  - Query Parameters: `email` (string) - The email address of the agency to retrieve.
  - **Response**
```json
{
    "id": "024381f7-ad83-417a-85af-8223adb76516",
    "name": "The Super Agency Inc",
    "email": "super@agency.com",
    "secret": "salaka"
}
```

---

## Running Tests

To run the tests, you can use the following command:

```bash
php artisan test
```

Ensure that your `.env.testing` file is correctly configured if you're using a testing database. If you're using SQLite, you can configure it like this:

```bash
DB_CONNECTION=sqlite
DB_DATABASE=:memory:
```
