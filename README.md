## My Ready Template Official Desription

**Created By :** Mahmoud Anwar
**Email :** Engsahaly@gmail.com
**Phone :** +2-01000166099

This is the main readme file for my ready dashboard template

This dashboard includes a lot of features already installed and created as below :

```
Admin Authentication using Laravel Breeze
Installed Spatie Media Library (you need to preparing models to use it)
Installed Spatie Permissions (with roles and links to admins in the systme - all you have to do is update PermissionArray.php file in config and seed)
Permission & Permission description helpers located in (app\http\helpers.php)
Included Admins module (with basic crud operations)
Included Roles module (with basic crud operations)
Included Users module (with basic crud operations)
Installed mcamara localization (with language switcher with ar & en)
```

## Installation

To get started, clone this repository.

```
git clone https://github.com/engsahaly/my_ready_admin_template.git 
```

Next, copy your `.env.example` file as `.env` and configure your Database connection.

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=YOUR-DATABASE-NAME
DB_USERNAME=YOUR-DATABASE-USERNAME
DB_PASSWORD=YOUR-DATABASE-PASSWROD
```

## Run Packages and helpers

You have to all used packages and load helpers as below.

```
composer install
```

## Generate new application key

You have to generate new application key as below.

```
php artisan key:generate
```

## Run Migrations and Seeders

You have to run all the migration files included with the project and also run seeders as below.

```
php artisan migrate
php artisan db:seed
```

## Accessing Admin Panel

You can access admin login page using this url.

```
http://localhost:8000/admin/login
Email: admin@admin.com
Password: 123456789 
```
