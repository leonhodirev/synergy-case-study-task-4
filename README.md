## Запуск приложения

**Технологии:** PHP 8.3.2, Laravel 12, PostgreSQL

**Команды:**
```bash

# Установка зависимостей
composer install

# Создание файла переменных окружения
cp .env.example .env
# Настройка подключения к базе данных в .env

# Миграция базы данных
php artisan migrate

# Можно наполнить тестовыми данными
php artisan db:seed

# Сгенерировать ключ приложения
php artisan key:generate

# Сборка фронта
npm install && npm run build

# Запуск локального сервера
php artisan serve

# Создаем пользователя на сайте
# Добавим роль "admin" нашему пользователю 
php artisan permission:create-role admin
php artisan user:assign-role 1 admin
```

---

Роуты
-------------------

      /             Главная страница -> Переход в авторизацию
      /login        Авторизация
      /register     Регистрация пользователя
      /books        Книги
      /admin/books  Редактирование книг
