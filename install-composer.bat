@echo off
echo Downloading Composer...
curl -sS https://getcomposer.org/installer -o composer-setup.php
php composer-setup.php
php -r "unlink('composer-setup.php');"
echo.
echo Composer downloaded as composer.phar
echo You can now use: php composer.phar install
