web: vendor/bin/heroku-php-nginx -C nginx.conf public/

release: php artisan migrate --force

queue: php -c public/.user.ini artisan queue:listen sqs --tries=3 --sleep=5  --timeout=240
