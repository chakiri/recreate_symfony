Launch containers run : docker-compose up
if images defected run : docker-compose build
to use php => enter the container php7.3-apache2 : docker exec -it 25e8dc8bb692 sh
Execute phpunit tests : vendor/bin/phpunit tests --colors

To acces page : use url/index.php/name_of_page
