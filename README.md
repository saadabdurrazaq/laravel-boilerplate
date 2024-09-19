1. cd <your_path>
2. git clone https://github.com/saadabdurrazaq/laravel-boilerplate.git
3. cd <cloned_repo>
4. Run `composer install` (if you are not lucky, maybe it will takes 15 minutes when generate optimized autoload files)
5. Create database with name laravel_boilerplate
6. Run this command: `cp .env.example .env`
7. Run this command: `php artisan key:generate`
8. Run this command: `php artisan migrate:refresh --seed`
9. Run this command: `php artisan optimize`
10. Run this command: `php artisan serve --host=0.0.0.0 --port=8081`
11. Run postman files
12. Run `php artisan queue:work` to implement a queued job for sending a welcome email when a new user registers.
