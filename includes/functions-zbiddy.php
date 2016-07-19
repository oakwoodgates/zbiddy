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
 */
function zbiddy_login_redirect( $redirect_to, $request, $user ) {
	// is there a user to check?
	if ( isset( $user->roles ) && is_array( $user->roles ) ) {
		// check for ftr_users
		if ( in_array( 'ftr_user', $user->roles ) ) {
			// redirect them to the dashboard
			return home_url( '/readers-hub/readings/request/' );
		} else {
			return $redirect_to;
		}
	} else {
		return $redirect_to;
	}
}

add_filter( 'login_redirect', 'zbiddy_login_redirect', 20, 3 );
