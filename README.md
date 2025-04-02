Шаги для деплоя проекта
1. Склонировать проект
2. Убедитесь, что порты 80, 5432 не заняты на вашей машине
3. Выполните следующие команды
   cp .env.example .env \
   docker compose build \
   docker compose up -d \
   docker compose exec php composer install \
   docker compose exec php php artisan migrate --seed
7. Запросы отправлять по роуту http://localhost:80/api/calculate-bonus
