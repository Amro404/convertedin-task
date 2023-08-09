set -e

cp .env.example .env

docker-compose run --rm artisan key:generate

docker-compose up -d --build

docker-compose run --rm composer install

docker-compose run --rm npm install

docker-compose run --rm npm run dev

docker-compose run --rm artisan migrate:fresh --seed

docker-compose run --rm php vendor/bin/phpunit