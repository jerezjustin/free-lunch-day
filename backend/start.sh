#!/bin/bash

# Start PHP-FPM
php-fpm &

# Start Supervisor
supervisord -n -c /etc/supervisor/supervisord.conf
