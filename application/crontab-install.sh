#!/usr/bin/env bash
echo "Instaling crontab...";
echo "* * * * * . php /var/www/html/artisan schedule:run >> /dev/null 2>&1" > /tmp/crontab
crontab /tmp/crontab
echo "Running composer install...";
cd /var/www/html/ && composer install