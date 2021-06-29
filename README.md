# TRM---Test
Repository for the TRM technical test

## Steps to configure on local system
* Open CLI
* Make sure Docker and Docker-compose is installed on the system
  * Check by typing $`docker` and $`docker-compose` in the CLI
* Create directory and change directory to it
  * $`mkdir TRM`
  * $`cd TRM`
* $`git clone git@github.com:xohail/TRM.git .`
* $`alias dcr='docker-compose run'` // for shorthand 
* $`dcr composer require --dev phpunit/phpunit`
* $`docker-compose up -d fpm nginx`
  * Website should be up on http://localhost:8080
  * If not please configure to the available port in **docker-compose.yml** for nginx
* $`dcr php-unit --debug` // for tests
* Update `index.php` to check specific case and output will be printed on http://localhost:8080
