# iPrice Assessment
This is a public repository for doing iPrice assessment

Example command running in Windows 10

### Please install `php7` and `composer` since it is required for running this app
```
https://www.php.net/manual/en/install.php
https://getcomposer.org/download/
``` 
### Example command (Windows 10)
Step 1 : Install `phpunit` via `composer`

Open `CMD` at root directory and run command
```
composer install
```
Step 2 : Run index file with command
```
php index.php
```

Step 3 : Type your input string and press `Enter`
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
Open `CMD` at root directory and run command
```
./vendor/bin/phpunit --testdox ./test/HelperTest
```
