build:
	docker-compose build --no-cache

push:
	docker-compose push


deploy: build push
