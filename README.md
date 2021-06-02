<p align="center">
<a href=""><h2>Salesforce_PMC</h2></a>
</p>

![License: MIT](https://img.shields.io/badge/License-MIT-blue.svg)

### Introduction

Welcome to Salesforce Digital Marketing Services Campaign Builder.

**This website will help you build assets for your marketing campaign. Before you begin, please be sure to review the Partner Welcome Guide. It is essential that you gather all the listed assets and write answers to the questions related to your program before you sign in. Gathering all the required information in advance will help ensure you build the best campaign possible.**

### System Requirement

* **LARAVEL**: 8.
* **SERVER**: Apache 2 or NGINX.
* **RAM**: 3 GB or higher.
* **PHP**: 7.3 or higher.
* **For MySQL users**: 5.7.23 or higher.
* **For MariaDB users**: 10.2.7 or Higher.
* **Node**: 8.11.3 LTS or higher.
* **Composer**: 1.6.5 or higher.


### Installation and Configuration

##### Let's clone the application first.
~~~
$ git clone git@github.com:pierryincsoftware/SF-DMS-App.git
~~~

#### Update database settings in .env file.

```php
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=database_name
DB_USERNAME=username
DB_PASSWORD=secret
```

##### Execute these commands below, in order

~~~
1. $ composer install
~~~

~~~
2. $ php artisan config:cache
~~~

~~~
3. $ php artisan migrate
~~~

#### For setting up VueJs frontend

~~~
$ npm install
~~~

~~~
$ npm run watch
~~~

#### Running the application

~~~
$ php artisan serve
~~~

**Now go to browser and hit the address given:**

~~~
http(s)://127.0.0.1:8000
~~~

### Dependencies involved in the applications

- [inertia-laravel](https://github.com/inertiajs/inertia-laravel)
- [segmentio](https://github.com/segmentio/analytics-php)
- [cloudinary](https://github.com/cloudinary/cloudinary_php)
- [stripe](https://github.com/stripe/stripe-php)
- [sentry](https://packagist.org/packages/sentry/sentry-laravel)
- [tightenco-ziggy](https://packagist.org/packages/tightenco/ziggy)
- [league/flysystem-aws-s3-v3](https://packagist.org/packages/league/flysystem-aws-s3-v3)