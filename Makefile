destroy:
	docker compose down --rmi all --volumes --remove-orphans

up:
	docker compose up -d

down:
	docker compose down

key-generate:
	docker compose exec app php artisan key:generate

migrate:
	docker compose exec app php artisan migrate

seed:
	docker compose exec app php artisan db:seed

fresh:
	docker compose exec app php artisan migrate:fresh --seed

clear:
	docker compose exec app php artisan migrate:fresh --seed

test:
	docker compose exec app php artisan test

init:
	@make up
	@make key-generate
	@make jwt

logs:
	docker compose logs

watch:
	docker compose logs --follow

bash:
	docker compose exec app bash

db:
	docker compose exec db mysql -u root -p

jwt:
	docker compose exec app php artisan jwt:secret

recreate:
	@make destroy
	@make init
