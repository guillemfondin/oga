#!/bin/sh

docker-compose exec php bin/console d:d:d --force
docker-compose exec php bin/console d:d:c
docker-compose exec php bin/console d:m:m --no-interaction
docker-compose exec php bin/console d:f:l --no-interaction
