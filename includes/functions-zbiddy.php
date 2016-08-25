<?php
/**
 * ZBiddy Helper Functions
 * @since  1.0.2 zbiddy_login_redirect
 */

/**
 * Redirect user after successful login.
 *
 * @param string $redirect_to URL to redirect to.
 * @param string $request URL the user is coming from.
 * @param object $user Logged user's data.
 * @return string
 * @since  1.0.2 Redirect ftr_user to readers hub readings request page
 * @since  1.0.3 Redirect ftr_reader to readers hub dashboard
 * @since  1.0.5 Don't redirect if login from free reading page
 */
function zbiddy_login_redirect( $redirect_to, $request, $user ) {
	global $post;
	if ( is_object( $post ) && '3718' == $post->ID ) {
		return $redirect_to;
	}
	// is there a user to check?
	if ( isset( $user->roles ) && is_array( $user->roles ) ) {

		// check for ftr_users (FTR Customer)
		if ( in_array( 'ftr_user', $user->roles ) ) {
			// redirect them to the request page
			return home_url( '/readers-hub/readings/request/' );
		}
		// check for ftr_reader (FTR Reader)
		if ( in_array( 'ftr_reader', $user->roles ) ) {
			// redirect them to the dashboard
			return home_url( '/readers-hub/dashboard/' );
		}
	//	else {
	//		return home_url( '/readers-hub/dashboard/' );
	//	}
	}

	return $redirect_to;
}
add_filter( 'login_redirect', 'zbiddy_login_redirect', 20, 3 );

/**
 * zbiddy_wplogin_styles
 * Styles for wp-login.php
 * @return string css
 * @since  1.0.5 similar to /login-page
 */
function zbiddy_wplogin_styles() { ?>
<?php
// $img = content_url() . '/uploads/2016/04/logo_btc.png';
$img = ZBiddy::url( 'assets/images/admin-logo-white.png' );
$bkg = content_url() . '/uploads/2016/04/aurora-borealis-wallpaper-hd-wallpaper-3.jpg'; ?>
<style type="text/css">
.login h1 a {
    background-image: url(<?php echo $img ?>) !important;
    width: 320px !important;
    background-size: 100%!important;
    height: 200px !important;
    margin-top:-30px!important;
}
body {
	background-image: url(<?php echo $bkg ?>) !important;
	background-position: left center !important;
	background-repeat: no-repeat !important;
	background-size:cover!important;
	background-attachment:fixed!important;
	display: table;
	width: 100%;
}
body.login form {
    background: transparent;
    /* color: #fff; */
    box-shadow: none;
    -webkit-box-shadow: none;
}
.login form .input, .login input[type=text] {
    padding: 4px 8px;
    background: transparent!important;
    color: #fff;
    border-radius: 2px;
}
.login label,
.login #backtoblog a,
.login #nav a {
 /*   font-weight: 400;
    font-family: MontserratLight;
    font-size: 14px !important; */
    color:#fff!important;
}
body.login .message {
	border-left-color: #66c3c9;
}
.wp-core-ui .button-primary {
	background:#66c3c9!important;
	border: 0!important;
    box-shadow: none!important;
    text-shadow: none!important;
    text-transform: uppercase;
}
</style>
<?php }
add_action( 'login_head', 'zbiddy_wplogin_styles' );

/**
 * [zbiddy_logout_redirect description]
 * @return [type] [description]
 * @since  1.0.5 [<description>]
 */
function zbiddy_logout_redirect(){
  wp_redirect( home_url( 'readers-hub/' ) );
  exit();
}
add_action( 'wp_logout', 'zbiddy_logout_redirect', 9 );

/**
 * Filter the wp-login.php logo link
 * @return [type] [description]
 * @since  1.0.5 [<description>]
 */
function zbiddy_login_logo_url() {
	return home_url();
}
add_filter( 'login_headerurl', 'zbiddy_login_logo_url' );
