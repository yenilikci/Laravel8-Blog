<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Artisan CLI

Başlatmak için:

`php artisan serve`

Migration oluşturmak için:

`php artisan make:migration migrationadi --create=migrationadi` 

Migration uygulama:

`php artisan migrate`

Seeder oluşturmak için:

`php artisan make:seeder AdSeeder`

Seeder uygulama:

`php artisan db:seed`

Tabloları seed veriler ile yeniden oluşturmak için:

`php artisan migrate:refresh --seed`

Controller oluşturmak için:

`php artisan make:controller Dizin\ControllerAdi`

Model oluşturmak için:

`php artisan make:model Ad`
