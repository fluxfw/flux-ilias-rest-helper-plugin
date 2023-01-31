#!/usr/bin/env sh

set -e

root="`dirname "$0"`/.."
libs="$root/.."

checkAlreadyInstalled() {
    if [ `ls "$libs" | wc -l` != "1" ]; then
        echo "Already installed"
        exit 1
    fi
}

installLibrary() {
    (mkdir -p "$libs/$1" && cd "$libs/$1" && wget -O - "$2" | tar -xz --strip-components=1)
}

checkAlreadyInstalled

installLibrary flux-php-backport https://github.com/fluxfw/flux-php-backport/archive/refs/tags/v2023-01-31-1.tar.gz
