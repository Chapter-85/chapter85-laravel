#!/bin/bash
git pull origin staging

CONTAINER_NAME="Chapter85-FE-STG"
IMAGE_NAME_TAG="chapter85-fe-stg:latest"
HOST_PORT=9000
CONTAINER_PORT=9000

docker build -t $IMAGE_NAME_TAG .

docker stop $CONTAINER_NAME || true && docker rm $CONTAINER_NAME || true

docker run -d -p $HOST_PORT:$CONTAINER_PORT --restart unless-stopped --name $CONTAINER_NAME  $IMAGE_NAME_TAG

echo y | docker image prune --filter "dangling=true"
