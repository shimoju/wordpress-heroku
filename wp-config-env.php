<?php

/* Settings for each environment */

if ( $wp_config['wp_env'] === 'production' ) {

} elseif ( $wp_config['wp_env'] === 'staging' ) {
	$wp_config['wp_debug'] = true;
	$wp_config['disallow_file_mods'] = false;
}

/* Heroku settings */

/* Database */
if ( $wp_config['db_host'] === false ) {
	$wp_config['heroku_db_list'] = [
		'CLEARDB_DATABASE_URL',
		'DATABASE_URL',
	];
	foreach ( $wp_config['heroku_db_list'] as $heroku_db ) {
		if ( getenv($heroku_db) ) {
			$wp_config['db_url'] = parse_url(getenv($heroku_db));
			$wp_config['db_name'] = trim($wp_config['db_url']['path'], '/');
			$wp_config['db_user'] = $wp_config['db_url']['user'];
			$wp_config['db_password'] = $wp_config['db_url']['pass'];
			$wp_config['db_host'] = $wp_config['db_url']['host'];
			break;
		}
	}
	unset($heroku_db);
}

/* Mailgun */
if ( getenv('MAILGUN_AUTO_CONFIG') !== 'false' && getenv('MAILGUN_SMTP_LOGIN') ) {
	define('MAILGUN_USEAPI', true);
	define('MAILGUN_DOMAIN', explode('@', getenv('MAILGUN_SMTP_LOGIN'))[1]);
	define('MAILGUN_APIKEY', getenv('MAILGUN_API_KEY'));
}
