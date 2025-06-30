## Анализ работы

### 1. Создать web-страницу

**Команды:**
```bash
# Проверка установки PHP, Composer, Npm
php -v
composer -V
npm -v

# Установка Laravel (если не установлен глобально)
composer global require laravel/installer

# Создание нового проекта
laravel new case-study-task-4

# Переход в директорию проекта
cd case-study-task-4

# Настройка подключения к базе данных в .env
# DB_CONNECTION=pgsql
# DB_HOST=localhost
# DB_PORT=5432
# DB_DATABASE=practike4
# DB_USERNAME=postgres
# DB_PASSWORD=postgres

# Добавление русского языка
composer require laravel-lang/lang --dev
php artisan lang:update

# Изменение локали в .env
# APP_LOCALE=ru

# Миграция базы данных
php artisan migrate

# Запуск локального сервера
php artisan serve
```

---

### 2. Создать 2 интерфейса: администратора и пользователя.

```bash
# Добавим пакет Spatie Laravel Permission для управления ролями и правами
composer require spatie/laravel-permission
php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider"
php artisan migrate

# Создаем пользователя на сайте
# Добавим роль "admin" нашему пользователю 
php artisan permission:create-role admin
php artisan user:assign-role 1 admin

# Создадим middleware для проверки роли в web.php

# Создадим интерфейс администратора добавив route
# Создадим интерфейс пользователя добавив route
```

---

### 3. Создать базу данных Ваших любимых книг.

```bash
# Создадим миграции и модели
php artisan make:model Category -m
php artisan make:model Author -m
php artisan make:model Book -m
php artisan make:migration Book

# Для наполнения данными создадим сидеры
php artisan make:seeder CategorySeeder
php artisan make:seeder AuthorSeeder

# Запустим что написали
php artisan migrate
php artisan db:seed
```

---

### 4. Для пользовательского интерфейса добавить возможность просмотра книги из библиотеки

```bash
# Создадим компонент для списка книг
php artisan make:livewire BookList

# Создадим компонент для просмотра книги
php artisan make:livewire BookShow

# Добавим маршруты
```

---

### 5. Добавить возможность сортировки на основе: Категории, Автора, Года написания

Обновим компонент BookList и представление book-list.blade.php

---

### 5. Добавить функцию покупки или аренды книги сроком на 2 недели / месяц / 3 месяца

```bash
# Добавим миграцию и модель
php artisan make:model BookOrder -m
# Запустим миграцию
php artisan migrate

# Создадим Livewire-компонент
php artisan make:livewire BookOrderForm

```

---

### 6. Для администратора добавить возможность изменения списка книг, управления ценой, статусы книг и их доступность, возможность напоминать пользователям об окончании срока аренды (автоматически)

```bash
# Создадим Livewire-компонент
php artisan make:livewire Admin/BookManager
# Добавим маршрут

# Создадим команду для рассылки напоминаний
php artisan make:command SendRentalReminders
# Создадим письмо-напоминание
php artisan make:mail RentalReminderMail

# Запуск команды
# Оформляем книгу в аренду и запускаем команду (14 - это дни остатка, можно заменить)
php artisan rental:reminders 14
# Проверяем письмо в логах, что оно было отправленно
# Добавьте команду в расписание (scheduler)
```
