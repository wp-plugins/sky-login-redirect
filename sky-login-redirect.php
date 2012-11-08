<?php
/*
Plugin Name: Sky Login Redirect
Plugin URI: http://www.skyminds.net/wordpress-plugins/sky-login-redirect/
Description: Redirects users to the page they were reading just before logging in.
Version: 1.2
Author: Matt
Author URI: http://www.skyminds.net/
License: GPLv2 or later
*/
function sky_login_redirect() {
	$sky_site_url = home_url();
	$sky_referer  = $_SERVER['HTTP_REFERER'];
	$redirect_to  = $_REQUEST['redirect_to'];

	/* check if $redirect_to is set, not empty and belongs to our home URL */
	if( isset( $redirect_to ) && !empty( $redirect_to ) && strpos( $redirect_to, $sky_site_url ) ) {
		/* yes it is, use $redirect_to */
		return $redirect_to;
	}

	/* else check if referer belongs to our home URL */
	elseif( strpos( $sky_referer, $sky_site_url ) ){
		/* Smooth transparent redirects to the referring page */
		return $sky_referer;
	}

	/* it doesn't, let's redirect users to our homepage */
	else{
		return $sky_site_url;
	}
}

function sky_login_url( $force_reauth, $redirect ) {
	
	/* define our login URL */	
	$login_url = home_url('/wp-login.php');
	
	/* if $redirect is set, append it as argument to the login URL */
	if ( !empty( $redirect ) ) {
		$login_url = add_query_arg( 'redirect_to', urlencode( $redirect ), $login_url );
	}
	
	/* if reauth is set, append it to the login URL as well */
	if ( $force_reauth ) {
		$login_url = add_query_arg( 'reauth', '1', $login_url ) ;
	}

	return $login_url ;
}

add_filter('login_redirect', 'sky_login_redirect');
add_filter('login_url', 'sky_login_url', 10, 2);
?>
