composer install &&
composer update &&
php8.1 artisan key:generate &&
npm install && npm run dev &&
php8.1 artisan migrate &&
php8.1 artisan db:seed &&
php8.1 artisan storage:link &&
mkdir -p storage/framework/cache/data &&
php8.1 artisan route:clear &&
php8.1 artisan cache:clear &&
php8.1 artisan config:clear &&
php8.1 artisan view:clear
