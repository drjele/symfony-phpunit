#!/bin/bash

if [[ -f /var/www/html/dev/utility.sh ]]; then
    . /var/www/html/dev/utility.sh
fi

if [[ -f ~/.bashrc ]]; then
    . ~/.bashrc
fi

if [[ -x "$(command -v git)" ]]; then
    git config --global alias.st status
    git config --global alias.ci commit
    git config --global alias.co checkout
    git config --global alias.br branch
    git config --global color.branch auto
    git config --global color.diff auto
    git config --global color.interactive auto
    git config --global color.status auto
    git config --global push.default current
    git config --global --add safe.directory /var/www/html
    git config --global init.defaultBranch master
    git config --global core.autocrlf input
    git config --global pull.rebase false
fi

# generic
alias ll="ls -al"

alias app="cd /var/www/html"

alias full="clear && scomposer install && pfix && punit && pstan"

gpci() {
    clear && sgit pull && ci "$@" && sgit st
}

gpcu() {
    clear && sgit pull && cu "$@" && sgit st
}

print_command() {
    println "\e[33m[\e[32m $1 \e[33m]\e[0m"
}

print_error() {
    println "\e[31m( $1 )\e[0m"
}

println() {
    printf %b "$1\n"
}
# end generic

# composer
scomposer() {
    if [[ -e 'composer.json' ]]; then
        print_command "composer $@"
        composer "$@"
    else
        print_error 'composer json not found'
        return 0
    fi
}

alias ci="clear && scomposer install"
alias cu="clear && scomposer update"
# end composer

pfix() {
    if [[ -e "${PWD}/vendor/bin/php-cs-fixer" ]]; then
        EXEC_PATH="${PWD}/vendor/bin/php-cs-fixer"
    else
        print_error 'php cs fixer not found'
        return 0
    fi

    print_command "PHP_CS_FIXER_IGNORE_ENV=1 php -d memory_limit=-1 ${EXEC_PATH} fix $@"
    PHP_CS_FIXER_IGNORE_ENV=1 php -d memory_limit=-1 "${EXEC_PATH}" fix "$@"

    return 0
}

punit() {
    if [[ -e "${PWD}/vendor/bin/simple-phpunit" ]]; then
        EXEC_PATH="${PWD}/vendor/bin/simple-phpunit"
    else
        print_error 'phpunit not found'
        return 0
    fi

    print_command "php -d memory_limit=-1 ${EXEC_PATH} $@"
    php -d memory_limit=-1 "${EXEC_PATH}" "$@"

    return 0
}

pstan() {
    if [[ -e "${PWD}/vendor/bin/phpstan" ]]; then
        EXEC_PATH="${PWD}/vendor/bin/phpstan"
    else
        print_error 'phpstan not found'
        return 0
    fi

    print_command "php -d memory_limit=-1 ${EXEC_PATH} $@"
    php -d memory_limit=-1 "${EXEC_PATH}" "$@"

    return 0
}

if [[ -f ~/.profile_local ]]; then
    . ~/.profile_local
fi
