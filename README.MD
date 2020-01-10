## NOTE

It is not recommended that anyone use this repo as is. This is old code put here in hopes for collaboration in its improvement.

## Reports

`git clone https://github.com/inmanturbo/reports.git`

`cd reports`

`mysql -h host -u username -p`

`CREATE DATABASE devwork;`

`quit`

`mysql -u username -p devwork < mysqldump/devwork.sql`

## Start server

`php -S localhost:3000`

## Edit includes/pdo_connect.php

`$c_username = "username";`
`$c_password = "password";`
`$c_host= "host";`
`$c_database = "devwork";`

## in a seperate terminal 

`cd reports/`

`composer install`

`cp -prv .env.example .env`

`cd public/`

`php -S localhost:8888`

##  Edit reports/.env


`DB_CONNECTION=mysql`
`DB_HOST=host`
`DB_PORT=3306`
`DB_DATABASE=devwork`
`DB_USERNAME=username`
`DB_PASSWORD=password`

## navigate to

`http:localhost:3000/reports.php`
