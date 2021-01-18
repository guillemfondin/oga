#!/bin/sh

# clear db before
sh scripts/reset-db-test.sh

# Test
sh scripts/ci-tests.sh
