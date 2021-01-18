#!/bin/sh

# Test
docker-compose exec php bin/phpunit
# Static analysis
docker-compose exec php vendor/bin/phpstan analyse
# Linters
docker-compose exec php vendor/bin/phpcs
