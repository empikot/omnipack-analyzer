# omnipack-analyzer

## installation

- to install required packages and check your local configuration run `composer install`
- to create .env file run `composer run-script post-root-package-install`
- to generate APP_KEY run `composer run-script post-create-project-cmd` 

## running tests

to run tests use `vendor/bin/phpunit` if on os x/linux or `vendor\bin\phpunit.bat` if on windows os

## running app

to run script analyzing input report and creating reports for each client mentioned in input report use following command:
`php artisan omnipack:analyze [path to input xlsx file]`

report files should be stored in storage/reports
