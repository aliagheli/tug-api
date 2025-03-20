# Tug API

Tug API is a Laravel-based backend system designed for managing vehicles and drivers efficiently. This project follows
modern development best practices, including API resources, validation, Docker support, and API documentation using
Swagger.

## Features

- Vehicle and driver management
- Assign drivers to vehicles
- Standardized API responses with status codes
- Error handling using `ErrorResource`
- Full API documentation with Swagger
- Docker support for seamless deployment

---

## Installation

### 1. Clone the Repository

```bash
git clone https://github.com/aliagheli/tug-api
cd tug-api
```

### 2. Setup Environment

Copy the example environment file and configure it:

```bash
cp .env.example .env
```

Generate a unique application key:

```bash
php artisan key:generate
```

### 3. Install Dependencies

```bash
composer install
```

### 4. Run Database Migrations

```bash
php artisan migrate --seed
```

### 5. Start the Application

```bash
php artisan serve
```

The application should now be running at `http://127.0.0.1:8000`.

---

## Running with Docker

### 1. Start Docker Containers

```bash
docker-compose up -d --build
```

### 2. Run Migrations Inside the Container

```bash
docker exec -it tug-api-app php artisan migrate --seed
```

### 3. Access the API

The API will be accessible at `http://localhost:8000`.

---

## API Documentation (Swagger)

After running the application, you can access the API documentation at:

```
http://localhost:8000/api/documentation
```

Swagger provides detailed information about all available endpoints and their request/response formats.

---

## Testing API Endpoints

Use tools like **Postman** or `curl` to interact with the API.

Example: Retrieve all vehicles

```bash
curl -X GET http://localhost:8000/api/vehicles
```

---

## Contributing

Feel free to fork this repository and submit pull requests for improvements.

---

## License

This project is licensed under the MIT License.

