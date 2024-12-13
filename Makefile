user?=developer
compose:=docker-compose -f ./docker/docker-compose.yml --env-file ./docker/.env
exec-php:=docker exec -it --user $(user) wrm-php bash
external-network:=promkod-shopify-external

help:
	@echo ---------------------------------------------
	@echo This is Makefile for local Docker environment
	@echo ---------------------------------------------
	@echo Available commands:
	@echo - make up ............... up the docker compose.
	@echo - make up-service ....... up the docker compose with a specific service.
	@echo - make build ............ build the docker compose.
	@echo - make develop .......... run php-pull and horizon-start.
	@echo - make php-exec ......... exec to the php container.
	@echo - make nginx-exec ....... exec to the nginx container.
	@echo - make redis-exec ....... exec to the redis container and run redis-cli.
	@echo - make mysql-exec ....... exec to the mysql container and run mysql.

up:
	@clear
	@$(compose) up

up-service:
	$(compose) up -d $(service)

build:
	$(compose) build

build-service:
	$(compose) build $(c)

php-exec:
	@clear
	@$(exec-php) || echo "Use 'make up' to up to the docker compose"

nginx-exec:
	@docker exec -it wrm-server bash || echo "Use 'make up' to up to the docker compose"

redis-exec:
	@clear
	@docker exec -it wrm-redis redis-cli || echo "Use 'make up' to up to the docker compose"

mysql-exec:
	@clear
	@docker exec -it wrm-mysql mysql -u root -p || echo "Use 'make up' to up to the docker compose"
