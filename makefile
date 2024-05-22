up:
	- docker-compose up -d

down:
	- docker-compose down

bash:
	- docker exec -it exporter-app-1 bash

build-image-prod:
	docker build -t heseya/exporter:latest -f ./docker/Dockerfile-prod .
