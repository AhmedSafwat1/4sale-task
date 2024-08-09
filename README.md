# Ahmed Safwat baker
## Assessment For Backend Application (Senior Backend Application)


## Features

- Api to list users from any provider available 
- Easy to handle new filter 
- Easy add new provider 
- Create some unit tests 
- Use package to read json with high performance 
- use sail package to run app in docker



## Unit test

To run unit test  

```bash
./vendor/bin/phpunit
```

## run application

to  run app without docker 

```sh
composer i
```

```sh
php  artisan serve --port=8070
```

For docker

```sh
 docker compose -f "docker-compose.yml" up -d --build 
```
and use this api 
`http://localhost:8070/api/v1/users`

