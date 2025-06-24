# Laravel Prices API

Это Laravel приложение, предоставляющее RESTful API эндпоинт для получения списка продуктов с ценами, поддерживающее конверсию валют (RUB, USD, EUR). Приложение построено на Laravel 11 и следует лучшим практикам для написания чистого, поддерживаемого и тестируемого кода.

## Возможности
- **Эндпоинт**: `GET /api/v1/products` возвращает JSON-список продуктов с полями `id`, `title` и `price`.
- **Конверсия валют**: Поддерживает `RUB` (по умолчанию), `USD` и `EUR` через параметр запроса `currency`.
- **Форматирование цен**: Цены форматируются в зависимости от валюты (например, `1 200 ₽`, `$13.33`, `€12.00`).
- **Лучшие практики**: Используются FormRequest, Resource, паттерн Repository, слой сервисов и конфигурация для курсов валют.

## Требования
- PHP 8.0+
- Composer
- Laravel 11
- PostgreSQL
- Git

## Установка

1. **Клонирование репозитория**
   ```bash
   git clone https://github.com/yokithaiii/sputnik-test-assignment.git
   cd sputnik-test-assignment
   ```

2. **Установка зависимостей**
   ```bash
   composer install
   ```

3. **Настройка окружения**
    - Скопируйте `.env.example` в `.env`:
      ```bash
      cp .env.example .env
      ```
    - Обновите `.env`, указав параметры базы данных (например, `DB_CONNECTION`, `DB_HOST` и т.д.).
    - Сгенерируйте ключ приложения:
      ```bash
      php artisan key:generate
      ```

4. **Выполнение миграций и заполнение тестовыми данными**
   ```bash
   php artisan migrate --seed
   ```

5. **Запуск приложения**
   ```bash
   php artisan serve
   ```
   API будет доступен по адресу `http://localhost:8000`.

## Использование API

### Эндпоинт: `GET /api/products`

- **Описание**: Возвращает список продуктов с ценами в указанной валюте.
- **Параметр запроса**:
    - `currency` (необязательный): `RUB`, `USD` или `EUR`. По умолчанию `RUB`.
- **Ответ**: JSON-массив продуктов с полями `id` (UUID), `title` и `price` (отформатированная цена).

#### Примеры запросов
1. **По умолчанию (RUB)**:
   ```bash
   curl http://localhost:8000/api/prices
   ```
   **Ответ**:
   ```json
   [
       {
           "id": "9a2809ed-cdcb-45f8-a6ad-5ff9d7d5234d",
           "title": "Iphone 16 Pro Max",
           "price": "190 000₽"
       },
       ...
   ]
   ```

2. **USD**:
   ```bash
   curl http://localhost:8000/api/prices?currency=USD
   ```
   **Ответ**:
   ```json
   [
       {
            "id": "9a2809ed-cdcb-45f8-a6ad-5ff9d7d5234d",
            "title": "Iphone 16 Pro Max",
            "price": "$2,111.11"
       },
       ...
   ]
   ```

3. **Недопустимая валюта**:
   ```bash
   curl http://localhost:8000/api/prices?currency=INVALID
   ```
   **Ответ** (HTTP 422):
   ```json
   {
       "message": "The currency must be one of RUB, USD, or EUR.",
       "errors": {
           "currency": ["The currency must be one of RUB, USD, or EUR."]
       }
   }
   ```

## Структура проекта
- **Контроллеры**: `app/Http/Controllers/ProductsController.php` - Обработка HTTP-запросов.
- **Запросы**: `app/Http/Requests/Price/PriceIndexRequest.php` - Валидация параметра `currency`.
- **Ресурсы**:
    - `app/Http/Resources/Product/ProductResource.php` - Трансформация данных одного продукта.
    - `app/Http/Resources/Product/ProductCollection.php` - Обработка коллекции продуктов.
- **Модели**: `app/Models/Product.php` - Eloquent-модель с UUID и приведением типов для цены.
- **Репозитории**: `app/Repositories/ProductRepository.php` - Абстракция запросов к БД.
- **Сервисы**: `app/Services/CurrencyConverter.php` - Логика конверсии и форматирования цен.
- **Конфигурация**: `config/currencies.php` - Курсы и символы валют.
- **База данных**:
    - `database/migrations/2025_06_23_000001_create_products_table.php` - Создание таблицы `products`.
    - `database/factories/ProductFactory.php` - Генерация тестовых данных для продуктов.
- **Маршруты**: `routes/api.php` - Определение эндпоинта `/api/prices`.

## Конфигурация
Курсы валют и символы определены в `config/currencies.php`:
```php
return [
    'default' => 'RUB',
    'rates' => [
        'RUB' => 1,
        'USD' => 90,
        'EUR' => 100,
    ],
    'symbols' => [
        'RUB' => '₽',
        'USD' => '$',
        'EUR' => '€',
    ],
];
```
Для изменения курсов или добавления новых валют обновите этот файл.

## Лучшие практики
- **Принципы SOLID**: Разделение ответственности с использованием репозиториев и сервисов.
- **Безопасность типов**: Использование строгих типов и аннотаций.
- **Валидация**: Надежная проверка входных данных с помощью FormRequest.
- **Поддерживаемость**: Курсы валют в конфигурации и четкая документация.
- **Тестируемость**: Репозитории и сервисы легко поддаются мокингу.
- **Обработка ошибок**: Консистентные JSON-ответы для ошибок.

## Автор
Создано в качестве тестового задания для демонстрации навыков работы с Laravel. Приветствуется обратная связь!
