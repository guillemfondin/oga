#!/bin/sh

docker-compose exec php bin/console d:d:d --force --env=test
docker-compose exec php bin/console d:d:c --env=test
docker-compose exec php bin/console d:m:m --no-interaction --env=test
docker-compose exec php bin/console d:f:l --no-interaction --env=test
