#!/bin/sh
mysqldump -u tiranid -p cms_blog > cms_blog_dump.sql
mysqldump -u tiranid -p great_edu > great_edu_dump.sql

