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
 */
function zbiddy_login_redirect( $redirect_to, $request, $user ) {
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

	}

	return $redirect_to;
}

add_filter( 'login_redirect', 'zbiddy_login_redirect', 20, 3 );
