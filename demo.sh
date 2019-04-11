#!/usr/bin/env bash

cleanup() {
    echo cleaning up
    docker-compose down -v --remove-orphans
    exit
}

trap cleanup SIGINT

docker-compose down -v --remove-orphans
docker-compose up -d

sleep 2

while true; do
    curl -i http://localhost:8001/chain?target=http://php/logging.php
    sleep 1
done

