#https://webdock.io/en/docs/how-guides/docker-guides/how-to-install-and-run-docker-containers-using-docker-compose#:~:text=Running%20docker%2Dcompose,-Now%20save%20the&text=It%20will%20run%20the%20docker,d%20option%20with%20the%20command.&text=If%20the%20docker%2Dcompose.,is%20other%20than%20docker%2Dcompose.

DOCKER_CONTAINER = php
DOCKER_DB_CONTAINER = mysql
DB_NAME = gomoon

build_docker_image:
	docker build -t $(DOCKER_IMAGE) .

# Path: makefile
run_docker_container:
	docker run -it --rm --name $(DOCKER_CONTAINER)
	docker run -it --rm --name $(DOCKER_DB_CONTAINER)

run_docker:
	@docker-compose up -d

restart_docker:
	@docker-compose restart

stop_docker:
	@docker-compose down

build-docker:
	@docker-compose build

make-env:
	cp .env.dist .env

composer-install:
	@docker exec -it $(DOCKER_CONTAINER) composer install

key-gen:
	@docker exec -it $(DOCKER_CONTAINER) php artisan key:generate --force

passport-install:
	@docker exec -it $(DOCKER_CONTAINER) php artisan passport:install --force


migrate:
	@docker exec -it $(DOCKER_CONTAINER) php artisan migrate

serve:
	@docker exec $(DOCKER_CONTAINER) php artisan serve --host=0.0.0.0 --port=8000 > /dev/null 2>&1 &

only-install: make-env build-docker composer-install migrate

run: run_docker serve

install: make-env build-docker run_docker composer-install key-gen migrate serve

stop: stop_docker

restart: restart_docker
