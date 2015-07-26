@echo off
php %~dp0\bin\phpDocumentor.phar -d "./" -t "./docs/api" --ignore="*tests*" --template="responsive-twig" -e "php" %*