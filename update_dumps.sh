#!/bin/sh
rm dumps/great_edu_dump.sql
mysqldump -u tiranid -p great_edu > dumps/great_edu_dump.sql

