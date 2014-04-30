<?php
/*
Plugin Name: Sky Login Redirect
Plugin URI: http://www.skyminds.net/wordpress-plugins/sky-login-redirect/
Description: Redirects users to the page they were reading just before logging in. Also redirects to homepage when logging out.
Version: 1.5
Author: Matt
Author URI: http://www.skyminds.net/
License: GPLv2 or later
*/

/* Check if the login is made through login-related pages */
function sky_is_login_page() {
	return in_array( $GLOBALS['pagenow'], array('wp-login.php', 'wp-signup.php' ));
}

/* Login redirect to the page we were reading prior to log in. */
function sky_login_redirect() {

	$redirect_to  = $_REQUEST['redirect_to'];

	/* if this is a login page... */
	if( sky_is_login_page() ){

		/* If the login page calls itself in $redirect_to, avoid the loop and redirect to the homepage.
		This would happen when using password recovery and registration links. */
		if ( preg_match( "/wp-login.php/", $redirect_to ) ){
			$redirect_to = home_url('/');
			return $redirect_to;
		}
		/* Variable $redirect_to is empty i.e. the login page was called directly. */
		elseif ( !isset( $redirect_to ) || empty( $redirect_to ) ){
			$referrer = wp_get_referer();

			/* If the referrer is empty, go back to homepage. */
			if( empty($referrer)) {
				$redirect_to = home_url('/');
				return $redirect_to;
			}
			else {
			/* Otherwise, go back to referring page. */
				return $referrer;
			}
		}
		/* For every other case, redirect to whatever $redirect_to was set to. */
		else {
			return $redirect_to;
		}
	}
}

/* Create the login URL with redirection built-in. */
function sky_login_url( $login_url ) {

	/* Define our login URL, using standard login URL. */	
	$login_url = site_url('wp-login.php');
	
	/* If we are attempting to access any page on /wp-admin/, explicitly set the redirection. */
	if (preg_match("/wp-admin/", $_SERVER['REQUEST_URI']) ) {
		$login_url = add_query_arg( 'redirect_to', urlencode( (is_ssl() ? 'https://' : 'http://') . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] ), $login_url );
		return $login_url;
	}
	/* Otherwise, just go through with clean URI. */
	else {
		return $login_url;
	}
}

/* Create the logout URL with redirection built-in. */
function sky_logout_url( $logout_url ) {
	if( preg_match("/redirect_to=/", $logout_url) ) {
		return $logout_url;
	} 
	else {
		return $logout_url . '&amp;redirect_to=' . urlencode( home_url() );
	}
}

/* Logout redirect : redirect to homepage when logging out. */
function sky_logout_redirect() {
	if( isset($_GET['loggedout']) && $_GET['loggedout'] == 'true' ) {
		wp_safe_redirect( home_url('/') );
		exit;
	}
}

/* Bonus : change the logo link from wordpress.org to your site */
function sky_login_logo_url() { return home_url(); }

add_filter( 'login_url', 'sky_login_url', 10, 2 );
add_filter( 'login_redirect', 'sky_login_redirect' );
add_filter( 'logout_url', 'sky_logout_url', 10, 2 );
add_action( 'init', 'sky_logout_redirect' );
add_filter( 'login_headerurl', 'sky_login_logo_url' );
?>
