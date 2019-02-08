#!/usr/bin/env bash

composer install --optimize-autoloader --no-dev
yarn run prod
php artisan migrate

