#!/bin/sh
# Run migrations
make setup
# Start the application
exec php-fpm
