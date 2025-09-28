<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>


## Разработка простого API для управления задачами (тестовое задание)

### Как запустить

1. Поднятие контейнеров и установка зависимостей (первый запуск):
```
docker compose up -d --build
docker compose exec php bash -c "composer setup"
```

2. Для последующих запусков:
```
docker compose up -d
```

### Что реализовано
Простое REST API для управления задачами на Laravel 12.

API доступно по адресу: `http://localhost`

### API Endpoints

### 1. Получить список задач
**GET** `/api/tasks`

Пример ответа:
```json
[
    {
        "id": 1,
        "title": "Задача 1",
        "description": "Описание задачи 1",
        "status": "pending",
        "created_at": "2025-09-28T12:03:53+00:00",
        "updated_at": "2025-09-28T12:03:53+00:00"
    },
    {
        "id": 2,
        "title": "Задача 2",
        "description": "Описание задачи 2",
        "status": "pending",
        "created_at": "2025-09-28T12:04:10+00:00",
        "updated_at": "2025-09-28T12:04:10+00:00"
    }
]
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

Пример ответа:
```json
{
    "id": 1,
    "title": "Задача 1",
    "description": "Описание задачи 1",
    "status": "pending",
    "created_at": "2025-09-28T12:03:53+00:00",
    "updated_at": "2025-09-28T12:03:53+00:00"
}
```

### 4. Обновить задачу
**PUT** `/api/tasks/{id}`
Тело запроса:
```json
{
  "title": "Новый заголовок задачи 1",
  "description": "Новое описание задачи 1",
  "status": "completed"
}
```

Пример ответа:
```json
{
    "id": 1,
    "title": "Новый заголовок задачи 1",
    "description": "Новое описание задачи 1",
    "status": "completed",
    "created_at": "2025-09-28T12:03:53+00:00",
    "updated_at": "2025-09-28T12:03:53+00:00"
}
```

### 5. Удалить задачу
**DELETE** `/api/tasks/{id}`

Пример ответа:
Response code: 204 (No Content)

### Валидация

- `title` - обязательное поле, строка, 3-255 символов
- `description` - опциональное поле, строка, до 1000 символов
- `status` - опциональное поле, одно из: `pending`, `in_progress`, `completed`


### Коды ответов

- `200` - Успешный запрос
- `201` - Ресурс создан
- `204` - Ресурс удален
- `422` - Ошибки валидации
- `500` - Внутренняя ошибка сервера

### Дополнительная информация

Docker окружение честно взято [отсюда](https://github.com/refactorian/laravel-docker).
