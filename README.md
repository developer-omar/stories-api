<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

## About Project

This project is an API REST for stories and has made with Laravel 10 and PHP 8.2.

1. Make a copy of .env.example with name .env, and config data about your DB server.

2. In the terminal generate secret key  (I use library [jwt-auth](https://jwt-auth.readthedocs.io/en/develop/)).
```bash
php artisan jwt:secret
```

3. Run migrations.
```bash
php artisan migrate:fresh
```

4. Run seeders.
```bash
php artisan db:seed
```

5. Create symbolic link for uploading of images to locar server.
```bash
php artisan storage:link
```

6. Create the following folders to store user images and story images, and give them permissions for writing.  
```bash
cd stories-api/storage/app/public
```
```bash
mkdir -p images/stories
```
```bash
chmod -R 777 images/stories
```
```bash
mkdir -p images/users
```
```bash
chmod -R 777 images/users
```
7. (Optional) if there are problems with cache, sessions and views you should use the next commands:
```bash
cd /var/www/stories-api/storage/framework
```
```bash
chmod -R 777 cache
```
```bash
chmod -R 777 sessions
```
```bash
chmod -R 777 views
```
