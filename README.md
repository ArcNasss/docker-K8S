## Docker Development Setup

Project ini dapat dijalankan menggunakan Docker Compose untuk kebutuhan development local.

### Services

- `app`: container PHP-FPM untuk menjalankan Laravel
- `nginx`: web server untuk menerima HTTP request
- `mysql`: database MySQL
- `phpmyadmin`: database UI opsional

### Run Project

```bash
docker compose up -d --build

### Stop Project
docker compose down
Laravel Commands
docker compose exec app php artisan migrate
docker compose exec app php artisan route:list
docker compose exec app php artisan optimize:clear
Composer Commands
docker compose exec app composer install
docker compose exec app composer require vendor/package
Access

Laravel:

http://localhost:8080

phpMyAdmin:

http://localhost:8081
Database Config for Docker
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=cms_builder
DB_USERNAME=laravel
DB_PASSWORD=secret
