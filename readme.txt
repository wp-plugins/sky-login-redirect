=== Sky Login Redirect ===
Contributors: skyminds
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=DNSC3NVBWR66L
Tags: login, redirect, redirection, sky login redirect
Requires at least: 3.0
Tested up to: 3.5
Stable tag: 1.2
License: GPLv2 or later

Redirects users to the page they were reading just before logging in.

== Description ==

Sky Login Redirect redirects users to the page they were reading just before logging in.
In case that page is not defined, users are redirected to the homepage.

No configuration necessary. Everything works under the hood. Simply activate the plugin.

More information can be found on [the plugin home page](http://www.skyminds.net/wordpress-plugins/sky-login-redirect/ "Sky Login Redirect Homepage").

== Installation ==

Install and activate the plugin. You're done. No configuration necessary.

== Screenshots ==

None. It works under the hood.

== Changelog ==

= 1.2 =
* Fix for the login loop that occured when using the password recovery and when logging straight from the login page. Thanks zkagen and salatfresser for reporting.
* Ditch the use of HTTP_HOST for home_url().

= 1.1 =
* Added code to check if $redirect_to is set and make it take precedence.
* Changed plugin URL to its [home page](http://www.skyminds.net/wordpress-plugins/sky-login-redirect/ "Sky Login Redirect Homepage").

= 1.0 =
* Initial release.

== Upgrade Notice ==

= 1.2 =
Fix for the login loop that occured when using the password recovery and when logging straight from the login page.

= 1.1 =
Add check for the $redirect_to to cover all redirection scenarios.
