#!/bin/bash
set -e

echo "Installing Laravel dependencies..."
composer install --prefer-dist --no-interaction --no-progress

echo "Generating application key..."
php artisan key:generate --force

echo "Running migrations..."
php artisan migrate --force

echo "Running seeders..."
php artisan db:seed

echo "Building assets..."
npm run dev

echo "Setup completed successfully!"
