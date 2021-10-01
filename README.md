# cron-parser
<p>This small library parses the cron string and display next run times for each field.<br>
Timing of each cron field (i.e. minute, hour) is isoladed and is based on its own unit of time. </p>

### Example
Following command:
```
 php main.php "*/30 1 1,2 * 1-2 /test"  
```
Will output:
```
minute         0 30
hour           1
day of month   1 2
month          1 2 3 4 5 6 7 8 9 10 11 12
day of week    1 2
command        /test
```

## Dependencies
- docker image ```php:8.0-cli```
- php > ```8.0```
- composer ```2.1.8``` (already added to repository)
- phpunit ```9.5``` (already added to repository)

## Steps to Execute
without Docker:
```
composer.phar install
php main.php "{CRON_STRING} {COMMAND}"  
```

with Docker:
```
docker run -it --rm -v "$PWD":/opt/project php:8.0-cli php /opt/project/main.php "{CRON_STRING} {COMMAND}"
```


## Steps to Run Tests
without Docker:<br>
(execute in repository main directory)
```
php phpunit-9.5.phar --configuration phpunit.xml.dist tests
```

with docker:<br>
```
docker run -it --rm -v "$PWD":/opt/project php:8.0-cli /opt/project/phpunit-9.5.phar --configuration /opt/project/phpunit.xml.dist /opt/project/tests
```
## Code structure

TBD...

## Test Cover Report (from last run)
Check [Report](https://htmlpreview.github.io/?https://github.com/khalidumarr/cron-parser/blob/master/test-results.html) for detailed coverage information.
## Actual Demo Output
<img src="./output.png" alt="Ouput"/>
