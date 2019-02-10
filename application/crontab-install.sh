#!/usr/bin/env bash
echo "Instaling crontab...";
echo "* * * * * . php /var/www/html/artisan schedule:run >> /dev/null 2>&1" > /tmp/crontab
crontab /tmp/crontab
echo "Running composer install...";
cd /var/www/html/ && composer install;

file="/var/www/html/.env"
if [ -f "$file" ]
then
	echo "$file found not to do."
else
	echo "$file not found. generate key and cache"
    cp /var/www/html/.env.example /var/www/html/.env
    
fi


