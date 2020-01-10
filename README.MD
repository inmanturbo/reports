## Reports

`git clone https://github.com/inmanturbo/reports.git`

`cd reports`

`mysql -h host -u user -p`

`CREATE DATABASE devwork;`

`quit`

`mysql -u username -p devwork < mysqldump/devwork.sql`

## Edit includes/pdo_connect.php

`$c_username = "devwork";`
`$c_password = "password";`
`$c_host= "host";`
`$c_database = "devwork";`

##  Edit reports/.env


`DB_CONNECTION=mysql`
`DB_HOST=host`
`DB_PORT=3306`
`DB_DATABASE=devwork`
`DB_USERNAME=user`
`DB_PASSWORD=password`

## Start server

`php -S localhost:3000`

## in a seperate terminal 

`cd reports/`

`composer install`

`cd public/`

`php -S localhost:8888`

## navigate to

`http:localhost:3000/reports.php`
