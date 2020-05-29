# iPrice Assessment
This is a public repository for doing iPrice assessment

Example command running in Windows 10

### Please install `php7` and `composer` since it is required for running this app
```
https://www.php.net/manual/en/install.php
https://getcomposer.org/download/
``` 
### Run main app
Open `CMD` at root directory

Step 1 : Run index file with command
```
php index.php
```

Step 2 : Type your input string and press `Enter`
```
This is a sample string !
```

Output expected
```
THIS IS A SAMPLE STRING !
tHiS Is a sAmPlE StRiNg !
CSV file created with name output.csv !
```
### Running Unit Test
Open `CMD` at root directory

Step 1 : Install `phpunit` via `composer`
```
composer install
```
Step 2 : Waiting the installation is done and run test command
```
./vendor/bin/phpunit --testdox ./test/HelperTest
 ```
