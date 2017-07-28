#!/bin/bash
echo 
redraw() {
    clear && printf '\e[3J'
    WIDTH="$(tput lines)"
    HEIGHT="$(tput width)"
}

trap redraw WINCH

while true; do

	php contactsManager.php
    :
done