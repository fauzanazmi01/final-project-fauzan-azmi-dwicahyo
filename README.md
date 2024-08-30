# Final Project 1: Laravel Orders

Install packages based on `composer.json`
```
composer install
```

1. Migrate database
2. Generate app key to env (make sure your .env file exists and has APP_KEY key with empty value)
3. Generate jwt secret to env

```
php artisan migrate
php artisan key:generate
php artisan jwt:secret
```

(Optional) Seed the database with dummy data
```
php artisan db:seed
```

Run the app
```
php artisan serve
```