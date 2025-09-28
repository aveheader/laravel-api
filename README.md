<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>


## Разработка простого API для управления задачами (тестовое задание)

### Как запустить

1. Поднятие контейнеров и установка зависимостей (первый запуск):
```
git clone https://github.com/aveheader/laravel-api.git
cd laravel-docker
docker compose up -d --build
docker compose exec php bash
composer setup
```

2. Для последующих запусков:
```
docker compose up -d
```

3. Выполнение миграций (при необходимости):
```
docker compose exec php bash
php artisan migrate
```

4. Управление пакетом Laravel IDE Helper (barryvdh/laravel-ide-helper):
```
docker compose exec php bash
php artisan ide-helper:generate
php artisan ide-helper:models -W
```

### Что реализовано
Простое REST API для управления задачами на Laravel 12.

API доступно по адресу: `http://localhost:8000/api`

## 📚 API Endpoints

### 1. Получить список задач
**GET** `/api/tasks`

Пример ответа:
```json
{
  "success": true,
  "data": [
    {
      "id": 1,
      "title": "Изучить Laravel",
      "description": "Изучить основы фреймворка",
      "status": "pending",
      "created_at": "2025-09-27T10:00:00Z",
      "updated_at": "2025-09-27T10:00:00Z"
    }
  ]
}
```

### 2. Создать задачу
**POST** `/api/tasks`

Тело запроса:
```json
{
  "title": "Новая задача",
  "description": "Описание задачи",
  "status": "pending"
}
```

### 3. Получить задачу по ID
**GET** `/api/tasks/{id}`

### 4. Обновить задачу
**PUT** `/api/tasks/{id}`

### 5. Удалить задачу
**DELETE** `/api/tasks/{id}`

## 📝 Валидация

- `title` - обязательное поле, строка, 3-255 символов
- `description` - опциональное поле, строка, до 1000 символов
- `status` - опциональное поле, одно из: `pending`, `in_progress`, `completed`

## 🔒 Rate Limiting

API ограничен 60 запросами в минуту на IP адрес.

## 📊 Коды ответов

- `200` - Успешный запрос
- `201` - Ресурс создан
- `422` - Ошибки валидации
- `429` - Превышен лимит запросов
- `500` - Внутренняя ошибка сервера

### Дополнительная информация

Docker окружение честно взято [отсюда](https://github.com/refactorian/laravel-docker).

# Laravel Docker Starter Kit
- Laravel v12.x
- PHP v8.4.x
- MySQL v8.1.x (default)
- MariaDB v10.11.x
- PostgreSQL v16.x
- pgAdmin v4.x
- phpMyAdmin v5.x
- Mailpit v1.x
- Node.js v18.x
- NPM v10.x
- Yarn v1.x
- Vite v5.x
- Rector v1.x
- Redis v7.2.x

# Requirements
- Stable version of [Docker](https://docs.docker.com/engine/install/)
- Compatible version of [Docker Compose](https://docs.docker.com/compose/install/#install-compose)

# How To Deploy

### For first time only !
- `git clone https://github.com/refactorian/laravel-docker.git`
- `cd laravel-docker`
- `docker compose up -d --build`
- `docker compose exec php bash`
- `composer setup`

### From the second time onwards
- `docker compose up -d`

# Notes

### Laravel Versions
- [Laravel 12.x](https://github.com/refactorian/laravel-docker/tree/main)
- [Laravel 11.x](https://github.com/refactorian/laravel-docker/tree/laravel_11x)
- [Laravel 10.x](https://github.com/refactorian/laravel-docker/tree/laravel_10x)

### Laravel App
- URL: http://localhost

### Mailpit
- URL: http://localhost:8025

### phpMyAdmin
- URL: http://localhost:8080
- Server: `db`
- Username: `refactorian`
- Password: `refactorian`
- Database: `refactorian`

### Adminer
- URL: http://localhost:9090
- Server: `db`
- Username: `refactorian`
- Password: `refactorian`
- Database: `refactorian`

### Basic docker compose commands
- Build or rebuild services
    - `docker compose build`
- Create and start containers
    - `docker compose up -d`
- Stop and remove containers, networks
    - `docker compose down`
- Stop all services
    - `docker compose stop`
- Restart service containers
    - `docker compose restart`
- Run a command inside a container
    - `docker compose exec [container] [command]`

### Useful Laravel Commands
- Display basic information about your application
    - `php artisan about`
- Remove the configuration cache file
    - `php artisan config:clear`
- Flush the application cache
    - `php artisan cache:clear`
- Clear all cached events and listeners
    - `php artisan event:clear`
- Delete all of the jobs from the specified queue
    - `php artisan queue:clear`
- Remove the route cache file
    - `php artisan route:clear`
- Clear all compiled view files
    - `php artisan view:clear`
- Remove the compiled class file
    - `php artisan clear-compiled`
- Remove the cached bootstrap files
    - `php artisan optimize:clear`
- Delete the cached mutex files created by scheduler
    - `php artisan schedule:clear-cache`
- Flush expired password reset tokens
    - `php artisan auth:clear-resets`

### Laravel Pint (Code Style Fixer | PHP-CS-Fixer)
- Format all files
    - `vendor/bin/pint`
- Format specific files or directories
    - `vendor/bin/pint app/Models`
    - `vendor/bin/pint app/Models/User.php`
- Format all files with preview
    - `vendor/bin/pint -v`
- Format uncommitted changes according to Git
    - `vendor/bin/pint --dirty`
- Inspect all files
    - `vendor/bin/pint --test`

### Rector
- Dry Run
    - `vendor/bin/rector process --dry-run`
- Process
    - `vendor/bin/rector process`

# Alternatives
- [Laravel Sail](https://laravel.com/docs/master/sail)
- [Laravel Herd](https://herd.laravel.com/)
- [Laradock](https://laradock.io/)
