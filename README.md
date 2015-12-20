# wordpress-heroku

WordPress on Heroku

[![Deploy](https://www.herokucdn.com/deploy/button.png)](https://heroku.com/deploy)

## Setup

```
git clone https://github.com/shimoju/wordpress-heroku.git your-blog-name
cd your-blog-name
composer install --ignore-platform-reqs
cp config/local-sample.php config/local.php
touch public/.htaccess && chmod 666 public/.htaccess
```

### Edit config/local.php

- Edit Database settings
- Run this command and paste the output strings:

```
bin/secret-key --format array
```

### Install WordPress

## Heroku Deploy

```
heroku create your-blog-name
heroku addons:create cleardb
heroku addons:create mailgun
heroku addons:create papertrail
heroku config:set `bin/secret-key --format env`
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
web: vendor/bin/heroku-php-apache2 -C config/apache.conf public
```

## License

[GNU GPL v2.0](https://github.com/shimoju/wordpress-heroku/blob/master/LICENSE)

## Author

[Hiroshi Shimoju](https://github.com/shimoju)
