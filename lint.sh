cd src
echo "lint public_routes/*"
vendor/bin/phpstan analyse public_routes --level 7
echo "lint utils/*"
vendor/bin/phpstan analyse utils --level 7
echo "lint Include/*"
vendor/bin/phpstan analyse Include --level 7
cd ..
