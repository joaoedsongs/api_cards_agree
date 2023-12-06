git clone https://github.com/joaoedsongs/api_cards_agree.git

cd api_cards_agree

composer install

php artisan storage:link

cp .env.example .env

CONFIGURAR .env
base de datos

php artisan key:generate

php artisan migrate --seed

php artisan serve
