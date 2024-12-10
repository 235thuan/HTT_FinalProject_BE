#!/bin/bash

# Install PHP dependencies
composer install

# Install NPM dependencies
npm install

# Create .env file if not exists
if [ ! -f .env ]; then
    cp .env.example .env
    php artisan key:generate
fi

# Create storage link
php artisan storage:link

# Run migrations
php artisan migrate

# Build assets
npm run dev

echo "Setup completed! Don't forget to configure your .env file." 