#! /bin/bash

ROOT_PATH="$(pwd)"
HOST="0.0.0.0"
PORT="8001"

PHP=$(which php)

if [ $? != 0 ]; then
	echo "Unable to find PHP"
	exit 1
fi

$PHP -S $HOST:$PORT -t $ROOT_PATH
