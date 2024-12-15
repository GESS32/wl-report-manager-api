# Domain-Driven Design (DDD) в Laravel

---

1. [Domains](./Domains/readme.md)
2. [Application](./Application/readme.md)
3. [Infrastructure](./Infrastructure/readme.md)

---

## 1. Основные принципы DDD

DDD основывается на следующих ключевых концепциях:

- **Domain (Домен)**: Сердце бизнес-логики. Этот слой содержит сущности, их атрибуты и поведение.
- **Application (Приложение)**: Координирующий слой, который управляет процессами и содержит команды и обработчики.
- **Infrastructure (Инфраструктура)**: Реализация работы с внешними системами (например, базой данных, API) и реализация интерфейсов репозиториев.

**DDD стремится сделать слой домена независимым от фреймворка**, что позволяет переиспользовать бизнес-логику в других проектах или переносить её на другие платформы.

---

## 2. Структура проекта

### Общая структура

```
architecture/
├── Domains/                 # Доменные модели, репозитории и сервисы
│   └── Product/             # Пример домена "Product"\│       ├── Entities/         # Сущности
│       ├── Repositories/    # Интерфейсы репозиториев
│       └── Services/        # Бизнес-логика, специфичная для домена
├── Application/             # Координация действий (команды, обработчики)
│   └── Product/             # Пример для "Product"
│       ├── Commands/        # Команды для работы с доменом
│       └── Handlers/        # Обработчики команд
├── Infrastructure/          # Инфраструктурный слой
│   └── Persistence/         # Репозитории для работы с БД
├── Http/Controllers/        # Контроллеры для обработки HTTP-запросов
├── Providers/               # Сервис-провайдеры
└── ...                      # Другие стандартные каталоги Laravel
```

### Пример структуры домена "Product"

```
architecture/
├── Domains/
│   └── Product/
│       ├── Entities/
│       │   └── Product.php
│       ├── Repositories/
│       │   └── ProductRepositoryInterface.php
│       └── Services/
│           └── ProductService.php
├── Application/
│   └── Product/
│       ├── Commands/
│       │   └── CreateProductCommand.php
│       └── Handlers/
│           └── CreateProductHandler.php
└── Infrastructure/
    └── Persistence/
        └── MySQLProductRepository.php
```

---

## 3. Подробности реализации

### 3.1. Домены (Domains)

Слой домена содержит:
- **Entities (Сущности)**: Основные объекты с бизнес-логикой и поведением.
- **Repositories (Репозитории)**: Интерфейсы для взаимодействия с хранилищами данных.
- **Services (Сервисы)**: Бизнес-логика, которая не относится к конкретной сущности.

Пример сущности:
```php
namespace Architecture\Domains\Product\Entities;

class Product
{
    private string $id;
    private string $name;
    private float $price;

    public function __construct(string $id, string $name, float $price)
    {
        $this->id = $id;
        $this->name = $name;
        $this->price = $price;
    }

    public function changePrice(float $newPrice): void
    {
        if ($newPrice <= 0) {
            throw new \InvalidArgumentException('Price must be positive.');
        }
        $this->price = $newPrice;
    }

    // Any behavior...
}
```

### 3.2. Приложение (Application)

Слой приложения отвечает за координацию действий. Основные компоненты:
- **Commands (Команды)**: Объекты, инкапсулирующие запросы от пользователей.
- **Handlers (Обработчики команд)**: Логика выполнения команд.

Пример команды:
```php
namespace Architecture\Application\Product\Commands;

class CreateProductCommand
{
    public string $name;
    public float $price;

    public function __construct(string $name, float $price)
    {
        $this->name = $name;
        $this->price = $price;
    }
}
```

Пример обработчика команды:
```php
namespace Architecture\Application\Product\Handlers;

use Architecture\Application\Product\Commands\CreateProductCommand;
use Architecture\Domains\Product\Repositories\ProductRepositoryInterface;
use Architecture\Domains\Product\Entities\Product;

class CreateProductHandler
{
    private ProductRepositoryInterface $repository;

    public function __construct(ProductRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function handle(CreateProductCommand $command): void
    {
        $product = new Product(uniqid(), $command->name, $command->price);
        $this->repository->save($product);
    }
}
```

### 3.3. Инфраструктура (Infrastructure)

Слой инфраструктуры отвечает за связь с внешними системами (например, БД).
Пример репозитория:
```php
namespace Architecture\Infrastructure\Persistence;

use Architecture\Domains\Product\Repositories\ProductRepositoryInterface;
use Architecture\Domains\Product\Entities\Product;
use Illuminate\Support\Facades\DB;

class MySQLProductRepository implements ProductRepositoryInterface
{
    public function save(Product $product): void
    {
        DB::table('products')->updateOrInsert(
            ['id' => $product->getId()],
            ['name' => $product->getName(), 'price' => $product->getPrice()]
        );
    }

    public function findById(string $id): ?Product
    {
        $data = DB::table('products')->find($id);

        if (!$data) {
            return null;
        }

        return new Product($data->id, $data->name, $data->price);
    }
}
```

---

## 6. Преимущества подхода DDD
- Четкое разделение ответственности.
- Удобство тестирования (бизнес-логика не зависит от инфраструктуры).
- Лучшая читаемость и поддерживаемость кода.
- Возможность переиспользования домена в других проектах.

