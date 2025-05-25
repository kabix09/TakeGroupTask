# Take Group TMDB Task

A Laravel-based application that imports movies, TV series, and genre data from The Movie Database (TMDB) API, stores them in a local database, and exposes this data via a RESTful API with Swagger documentation.

---

## Table of Contents

1. [Technologies](#technologies)
2. [Installation & Setup](#installation--setup)
3. [Data Importing](#data-importing)
4. [API Documentation](#api-documentation)

---

## Technologies

- **PHP 8** – Core language
- **Laravel 12** – PHP framework
- **Docker** – Containerized development environment
- **Swagger (L5-Swagger)** – API documentation
- **Adminer** – Database management tool
---

## Installation & Setup

Follow these steps to get the project running locally:

1. **Clone the repository**  
   *(if not already cloned)*
   ```bash
   git clone <repository-url>
   cd <project-directory>
    ```
2. **Copy the environment file**

   Remember to set `TMDB_API_TOKEN` value

   ```bash
   cp .env.example .env
   ```

3. **Install PHP dependencies inside the container**
   ```bash
   composer install
   ```

4. **Build and start the Docker containers**
    ```bash
    docker-compose up -d --build
    ```

5. **Run database migrations**
    ```bash
    php artisan migrate
    ```
   
6. **Generate the Swagger API documentation**
   ```bash
   php artisan l5-swagger:generate
   ```

7. **Start the Laravel development server**
   ```bash
    php artisan serve
    ```
   
## Data Importing
To fetch and store data from the [TMDB API](https://developer.themoviedb.org/reference/intro/getting-started) (genres, movies, and series), run:
```bash
php artisan import:tmdb:models
```

This command:
- Imports TV and Movie genres
- Imports the latest movie and TV series data
- Creates local records with proper relationships between genres and models

**Be careful**

Make sure your `.env` file contains a valid `TMDB key` under a variable like `TMDB_API_KEY`.

## API Documentation

Once the application is running, you can access the interactive API documentation generated with Swagger:

🔗 http://localhost:8000/api/documentation

This documentation provides:
- Endpoint descriptions
- Parameters
- Request/response schemas
- Try-it-out functionality

## Notes

Genre records are first created to assign custom internal IDs.

Movies and series are then imported with references to these genres via many-to-many relationships.

The `/api/movies/{id}` and `/api/series/{id}` endpoints support an optional `language` query parameter (e.g., `?language=pl`) to return translated data.

## License

This project is provided as part of a technical task and is open for modification and educational purposes.
