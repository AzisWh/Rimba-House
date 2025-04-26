<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Panduan untuk Clone

Sebelumnya pastikan Anda sudah menginstal:
- [PHP](https://www.php.net/downloads) (Minimal **versi 8.1**)
- [Composer](https://getcomposer.org/)
- [MySQL](https://www.mysql.com/) atau database lain yang didukung Laravel
- [Git](https://git-scm.com/)
- [Laravel](https://laravel.com/) (Opsional, bisa diinstal melalui `composer`)


Akses [github repo](https://github.com/AzisWh/Rimba-House)

open your terminal

```bash
git clone https://github.com/AzisWh/Rimba-House
#
cd Rimba-House
cd server
```

Install all the depedencies:

```bash
composer install
```
konfigurasi env:

```bash
cp .env.example .env
```

## Local Server

Edit env dan sesuaikan dengan konfigurasi database:
```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nama_database
DB_USERNAME=root
DB_PASSWORD=password_database
```

## Env Testing

Jika ingin digunakan tambahkan --env=testing pada terminal:
```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nama_database_test
DB_USERNAME=root
DB_PASSWORD=password_database
```

Migrate

```bash
php artisan migrate
```

Migrate Env Testing
```bash
php artisan migrate --env=testing
```

Key Generate

```bash
php artisan key:generate
```

Key Generate Env Testing

```bash
php artisan key:generate --env=testing
```

Seed Database

```bash
php artisan db:seed 
```

Seed Database Env Testing

```bash
php artisan db:seed --env=testing
```

Run Server :

```bash
php artisan serve
```

API ROUTES :

Cek All User
```bash
url/api/allUser
```
Cek User berdasarkan id
```bash
url/api/user/id
```
Menambah User
```bash
url/api/user/addUser
```
Edit User
```bash
url/api/user/editUser/id
```
Delete User
```bash
url/api/user/delUser/id
```

Untuk melihat Log melalui terminal
```bash
tail -f storage/logs/laravel.log
```

Integration Test
```bash
php artisan test
```
Integration Test env testing
```bash
php artisan test --env=testing
```
path folder test
test/Freature/UserTest.php

path swagger api documentation
```bash
url-artisan/api/documentation
```
url-artisan bisa di ubah sesuai port masing-masing
example = http://127.0.0.1:8000

