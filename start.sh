#!/bin/bash

# Run migrations
php artisan migrate --force

# Start the server
php -S 0.0.0.0:$PORT -t public
