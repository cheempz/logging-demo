#!/usr/bin/env bash

cleanup() {
    echo cleaning up
    docker-compose down -v --remove-orphans
    exit
}

trap cleanup SIGINT

if [ -z "$APPOPTICS_API_TOKEN" ]; then
    echo please set the APPOPTICS_API_TOKEN environment variable
    exit 1
fi
docker-compose down -v --remove-orphans
docker-compose up -d

sleep 2

while true; do
    curl -i http://localhost:8001/rpc/http://php-logdemo/logging.php
    sleep 1
done
