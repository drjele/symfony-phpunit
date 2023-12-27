#!/bin/bash

if [[ $TERM == *color* ]]; then
    COLOR_RESET='\e[0;0m'
    COLOR_GREEN='\e[0;32m'
    COLOR_YELLOW='\e[0;33m'
else
    COLOR_RESET=''
    COLOR_GREEN=''
    COLOR_YELLOW=''
fi

DOCKER_PATH="dev/docker/"

print_command() {
    println "${COLOR_YELLOW}[${COLOR_GREEN} $1 ${COLOR_YELLOW}]${COLOR_RESET}"
}

println() {
    printf %b "$1\n"
}
