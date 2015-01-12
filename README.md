# wordpress-heroku

WordPress on Heroku

## Setup

```
git clone https://github.com/shimoju/wordpress-heroku.git your-blog-name
cd your-blog-name
composer install --ignore-platform-reqs
cp wp-config-local-sample.php wp-config-local.php
touch public/.htaccess && chmod 666 public/.htaccess
```

### Edit wp-config-local.php

### Install WordPress

## Heroku Deploy

```
heroku create your-blog-name
heroku addons:add cleardb
bin/secret_key
git push heroku master
```

### Install WordPress

```
heroku open
```

## Settings

### Use Apache

Edit `Procfile`

```
web: vendor/bin/heroku-hhvm-apache2 -C config/apache.conf public/
```

## License

[GNU GPL v2.0](https://github.com/shimoju/wordpress-heroku/blob/master/LICENSE)

## Author

[Hiroshi Shimoju](https://github.com/shimoju)
