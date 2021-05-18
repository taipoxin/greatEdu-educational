#!/bin/bash
echo "-- Run full dump"


SERVICE_NAME=great_edu_mysql
USER=test
PASS='test'
DATABASE=test
DUMP_FOLDER=dumps
DUMP_PATH=$DUMP_FOLDER/dump.sql

# make no-delimiter dump
mkdir $DUMP_FOLDER
docker exec -i $SERVICE_NAME mysqldump -u $USER --password=$PASS \
$DATABASE --add-drop-database --routines --verbose > $DUMP_PATH


echo "-- Full dump have been done successfully"
