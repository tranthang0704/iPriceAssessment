# iPrice Assessment
This is a public repository for doing iPrice assessment

Example command running on Windows 10

### Please install `php7` and `composer` since it is required for running this app
```
https://www.php.net/manual/en/install.php
https://getcomposer.org/download/
``` 
### Example command (Windows 10)
Open `GitBash` or `CMD` at root directory and run command

Step 1 : Install `phpunit` via `composer`
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
Open `GitBash` or `CMD` at root directory and run command

```
#GitBash
./vendor/bin/phpunit --testdox ./test/HelperTest

#CMD
.\vendor\bin\phpunit --testdox .\test\HelperTest.php
```
