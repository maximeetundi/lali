#!/bin/sh

composer self-update --2 --stable

php artisan down --refresh=5

composer clear-all

git pull origin main

composer i --no-interaction --prefer-dist --optimize-autoloader --no-dev

php artisan horizon:terminate

composer reset

php artisan migrate --force

php artisan up
