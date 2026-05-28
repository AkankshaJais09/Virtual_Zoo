#!/bin/sh
set -e

# Clear any pre-existing cache to avoid configuration mismatches
php artisan config:clear
php artisan route:clear
php artisan view:clear

# Enable Laravel production optimizations
echo "Caching Laravel configuration..."
php artisan config:cache

echo "Caching Laravel routes..."
php artisan route:cache

echo "Caching Laravel views..."
php artisan view:cache

# Run database migrations automatically in production (optional, uncomment if needed)
# echo "Running migrations..."
# php artisan migrate --force

# Execute the main container command (Apache web server)
exec "$@"
