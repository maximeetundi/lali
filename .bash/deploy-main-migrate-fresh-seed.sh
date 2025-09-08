#!/bin/sh

composer self-update --2 --stable

php artisan down --refresh=5

composer clear-all

git pull origin main

composer i --no-interaction --prefer-dist --optimize-autoloader

php artisan horizon:terminate

php artisan migrate:fresh --seed --force

composer i --no-interaction --prefer-dist --optimize-autoloader --no-dev

composer reset

php artisan up
