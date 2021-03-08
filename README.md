<h1>Сокращатель ссылок</h1>
Используемый стек: PHP 7.4, MySQL 5.7, Laravel 8.

Порядок развертывания:
1. Настроить подключение к базе данных и указать APP_URL в `.env`
2. `composer install`
3. `php artisan migrate`
4. `php artisan storage:link`
5. `nmp run dev`
6. Добавить изображения (jpg, png) в папку `storage/app/public/commercial/`. Изображение при переходе по коммерческой ссылке выбирается случайно из данной папки.
