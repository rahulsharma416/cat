# cat
Test for Cat Technologies

# Setup Instructions
* Clone the code
* Create a DB named `cat`
* Open terminal and navigate to the code folder
* Run the following commands

```
composer install
composer dump-autoload
composer migrate
or
composer migrate:refresh
composer db:seed
```
* Now open Postman and just navigate to http//localhost:82/cat/public/index.php/api/bills

Well this is a get request and not secured one so that can be opened with in the browser also.