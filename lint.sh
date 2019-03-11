cd src
vendor/bin/phpstan analyse public_routes --level 7
vendor/bin/phpstan analyse public_routes/Dashboard --level 7
vendor/bin/phpstan analyse utils --level 7
vendor/bin/phpstan analyse Include --level 7
cd ..
