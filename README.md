# Инструкция по запуску проекта

```bash
cd docker/
docker-compose up -d --build
docker-compose exec -it app composer install
docker-compose exec -it app php artisan migrate
docker-compose exec -it app php artisan key:generate
docker-compose exec -it app npm install
docker-compose exec -it app npm run build
docker-compose exec -it app php artisan db:seed
```
в браузере зайти http://localhost:8000/


