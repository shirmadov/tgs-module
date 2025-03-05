

### Установить модуль и необходимые зависимости

        composer require nwidart/laravel-modules

        composer require joshbrw/laravel-module-installer

        composer require tgs/tgs-module

### Активация и миграция модуля

        php artisan module:enable Tgs

        php artisan module:migrate Tgs

### Надо разместить ключ от сервис на .env 
TGS_API_KEY=xxxxxxxx

        php artisan key:generate

### Работа с роутами

1. Маршруты модуля находятся в: `modules/Tgs/routes/web.php`


2. Вы можете использовать маршрут списка статей в любом месте вашего приложения: `route('tgs.article.index')`


3. Для безопасности надо добавить `middleware` (например, для админов) в `modules/Tgs/routes/web.php`


### Сохранение статьи в другую таблицу. 

Для сохранения статьи в другую таблицу отредактируйте метод `accept()` в контроллере:
`modules/Tgs/app/Http/Controllers/ArticleController.php`

Чтобы понят поля ``extra_fields`` посмотрите на `modules/Tgs/resources/assets/field/field_settings.json`

### Дополнительная информация

Для получения дополнительных инструкций обратитесь к документации модуля или Laravel.

laravel module: https://laravelmodules.com/docs/v11/introduction

