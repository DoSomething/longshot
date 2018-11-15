web: vendor/bin/heroku-php-nginx -C nginx.conf public/

release: php artisan migrate --force

queue: php artisan queue:work sqs --tries=3 --sleep=5 --queue=$SQS_DEFAULT_QUEUE
