## Requirements

PHP 7.2.*

## Install

git clone project

```shell
git clone https://github.com/dmforaname/hik.git
```

Create and edit `.env`

```shell
cp .env.example .env
vim .env
```

Edit the following env variables

```env
APP_NAME=
APP_KEY=
APP_URL=
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=
```


## Install dependencies:

```shell
composer install
php artisan config:cache
php artisan key:generate
php artisan migrate
php artisan db:seed
php artisan passport:install
npm install && npm run dev 
```

## Admin login

```shell
user : kasir@example.com
pass : password

user : pelayan@example.com
pass : password
```