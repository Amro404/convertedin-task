set -e

echo "=== Copy .env  ==="
cp ./src/.env.example ./src/.env
echo "=== copy is done!  ==="

echo "=== Execute docker-compose build... ==="
docker-compose up --build -d
echo "=== docker-compose build is done!! ==="

echo "=== Installing composer... ==="
docker-compose run --rm composer install
echo "=== Composer build is done ==="

echo "==== Generating the app key ==="
docker-compose run --rm artisan key:generate
echo "==== App key generating is done ==="

echo "==== Installing npm==="
docker-compose run --rm npm install
docker-compose run --rm npm run dev
echo "==== npm installed ==="

echo "==== Migrating and seed database ==="
docker-compose run --rm artisan migrate:fresh --seed
docker-compose run --rm php vendor/bin/phpunit
echo "==== Migrating and seed database is done ==="