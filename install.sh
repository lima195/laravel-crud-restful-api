
#!/bin/sh
echo "Install"

composer install;
find /var/www/laravel-crud-restful-api/public/api-front/ -type f -exec sudo chmod 664 {} \;
find /var/www/laravel-crud-restful-api/public/api-front/ -type d -exec sudo chmod 775 {} \;
cp .env.demo .env;
echo "CREATE DATABASE lima" | mysql -u root -proot;
php artisan key:generate;
php artisan module:migrate;
php artisan module:seed;