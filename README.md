env db setup

create database book_store;

php artisan migrate;

php artisan admin:create-base;

php artisan storage:link
