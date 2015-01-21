<?php

/* Settings for each environment */

if ( $wp_config['wp_env'] === 'production' ) {

} elseif ( $wp_config['wp_env'] === 'staging' ) {
	$wp_config['wp_debug'] = true;
	$wp_config['disallow_file_mods'] = false;
}
