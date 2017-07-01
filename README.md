# wordpress-heroku

WordPress on Heroku

[![Deploy](https://www.herokucdn.com/deploy/button.png)](https://heroku.com/deploy)

## Setup

### Requirements

- Install [Docker](https://www.docker.com/)
- Install git

### Build Docker image

```sh
git clone https://github.com/shimoju/wordpress-heroku.git your-blog-name
cd your-blog-name
docker-compose build && docker-compose run --rm app composer install
```

### Run Docker container

```sh
docker-compose up -d
```

Access [http://localhost:8080/](http://localhost:8080/)


## Heroku Deploy

```sh
heroku create your-blog-name
heroku addons:create cleardb
heroku addons:create newrelic
heroku addons:create papertrail
heroku config:set `bin/secret-key --format env`
git push heroku master
heroku open
```

### Use Apache

Edit `Procfile`

```
web: vendor/bin/heroku-php-apache2 -C config/apache.conf public
```

## License

[GNU GPL v2.0](https://github.com/shimoju/wordpress-heroku/blob/master/LICENSE)

## Author

[Hiroshi Shimoju](https://github.com/shimoju)
