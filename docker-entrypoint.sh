#!/bin/bash

# Optimize Laravel
php artisan optimize

# Run database migrations
php artisan migrate --force

# Continue to main command (CMD in Dockerfile)
exec "$@"
