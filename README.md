Product Management Module
======

This module allows to manage products such as create,edit product.

## Screenshot
![Custom Menu](https://raw.githubusercontent.com/hieunx1990/laravel-product-management/master/public/screenshot/product_list.png)

![Custom Menu](https://raw.githubusercontent.com/hieunx1990/laravel-product-management/master/public/screenshot/product_edit.png)


## Installation

Add the following configuration in composer.json in the laravel root folder
```php
    "repositories": [
        {
            "type": "vcs",
            "url": "https://github.com/hieunx1990/laravel-product-management"
        }
    ]
```
Execute the following command to install the package:
```bash
composer require hieu/product-management
```

Open config/app.php file and add service provider in providers array:
```php
\Hieu\ProductManagement\ServiceProvider::class
```
This module require encore/laravel-admin package for UI then you have to run commands bellow:
```bash
php artisan vendor:publish --provider="Encore\Admin\AdminServiceProvider"
php artisan vendor:publish --tag=laravel-admin-ckeditor
```
Finally
```bash
php artisan vendor:publish --tag=public --force
```

## Configuration

## Usage

After done the installation, you can sign in to admin panel by the following url:

[http://your_domain/admin/](http://your_domain/admin/)

This is admin information which is automatic generated:

username: admin, password: admin

This is the product listing page url:

[http://your_domain/admin/products/](http://your_domain/admin/products/)

You can add this link to the left menu bar by add custom menu here:

![Custom Menu](https://raw.githubusercontent.com/hieunx1990/laravel-product-management/master/public/screenshot/custommenu.png)
