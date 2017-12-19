#!/usr/bin/env bash

cp utils/.env.dist .env

cp utils/parameters.yml.dist symfony/app/config/parameters.yml.dist

read -r -p "It is the first time you init the project (e-g no docker container was build yet)  ???  [Y/n]" response

if [[ "$response" =~ ^([yY][eE][sS]|[yY])+$ ]]
then
    printf "\033[1;31mWe are going to build the docker containers now and run them after the build by using docker-compose up --build command!!!\033[0m\n"
    docker-compose up --build
else
    printf "\033[1;31mNo need to re-build the containers. We are going to run them by using docker-compose up command...\033[0m\n"
    docker-compose up
fi
