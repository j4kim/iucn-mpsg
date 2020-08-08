# IUCN MPSG Top 50

Laravel web application for the IUCN's Top 50 Mediterranean island plants

## Development

Version of Laravel used is [5.4](https://laravel.com/docs/5.4).

* Copy `.env.example` to `.env`
* Update config in `.env`
* Generate API key: `php artisan key:generate`
* Require dependencies: `composer install`
* Create symbolic link to storage folder: `php artisan storage:link`
* Migrate and seed: `php artisan migrate --seed`
* Run local server: `php artisan serve`
