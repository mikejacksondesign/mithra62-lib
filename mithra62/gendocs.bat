@echo off
php %~dp0\bin\phpDocumentor.phar -d "./,D:\ProjectFiles\mithra62\product-dev\backup-pro-lib\BackupPro" -t "./docs/api" --ignore="*tests*" --template="responsive-twig" -e "php" %*