#!/bin/sh
# Migrate and seed the database,
# Output the current user and group IDs.
cd /var/www

php artisan migrate --force 
php artisan db:seed --force 

# Create .env file
echo "APP_KEY=" > /var/www/.env
chown www-data:www-data /var/www/.env

# Clear and cache the configuration
php artisan optimize:clear

# Generate the application key
php artisan key:generate --force

# Clear and cache the configuration
php artisan optimize

exec /usr/local/sbin/php-fpm