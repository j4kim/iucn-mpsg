# IUCN MPSG Top 50

Laravel web application for the IUCN's Top 50 Mediterranean island plants

## Development

Version of Laravel used is [5.4](https://laravel.com/docs/5.4).

MySQL database required.

* Copy `.env.example` to `.env`
* Update config in `.env`
* Generate API key: `php artisan key:generate`
* Require dependencies: `composer install`
* Import [this script](https://drive.google.com/file/d/1-a8agwG8LSgSnJXXKKm5bDbT6E7GqcNs/view?usp=sharing) in a new database "gegq_iucn". This contains all data from production except users, replaced by a admin/admin123 user.
* Extract [this archive](https://drive.google.com/file/d/1ilCBC0Zfe7mLtIbVt-igWmBX7YNeZyYf/view?usp=sharing) in public folder
* Run local server: `php artisan serve`
