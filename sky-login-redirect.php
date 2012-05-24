<?php
/*
Plugin Name: Sky Login Redirect
Plugin URI: http://www.skyminds.net/redirection-apres-login-sous-wordpress/
Description: Redirects users to the page they were reading just before logging in.
Version: 1.0
Author: Matt
Author URI: http://www.skyminds.net/
License: GPLv2 or later
*/
 
function sky_login_redirect() {
	$sky_referer  = $_SERVER['HTTP_REFERER'];
	$sky_site_url = home_url();

	/* add check */
	if( strpos($_SERVER['HTTP_REFERER'], $_SERVER['HTTP_HOST']) ){
		/* Smooth transparent redirects to the previous page */
		return $sky_referer;
	}
	else{
		/* else... redirect to homepage */
		return $sky_site_url;
	}
}
add_filter('login_redirect', 'sky_login_redirect');
?>
