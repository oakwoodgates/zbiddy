<?php
/**
 * ZBiddy FTR Signup To ONTRAPORT
 *
 * @since 1.0.2
 * @package ZBiddy
 */

/**
 * ZBiddy FTR Signup To ONTRAPORT.
 *
 * @since 1.0.2
 */
class ZB_FTR_Signup_to_ONTRAPORT {
	/**
	 * Parent plugin class
	 *
	 * @var   class
	 * @since 1.0.2
	 */
	protected $plugin = null;

	/**
	 * Constructor
	 *
	 * @since  1.0.2
	 * @param  object $plugin Main plugin object.
	 * @return void
	 */
	public function __construct( $plugin ) {
		$this->plugin = $plugin;
		$this->hooks();
	}

	/**
	 * Initiate our hooks
	 *
	 * @since  1.0.2
	 * @return void
	 */
	public function hooks() {
		add_action('user_register', array( $this, 'conditions' ), 10, 1);
	}

	/**
	 * Check conditions to see if we should setup our
	 * data and preform api_call()
	 * @since  1.0.2
	 * @param  [type] $user_id [description]
	 * @return [type]          [description]
	 */
	public function conditions( $user_id ) {

		if ( ! $user_id ) {
			return;
		}

		$user = get_user_by( 'id', $user_id );

		if ( ! in_array( 'ftr_user', $user->roles ) ){
			return;
		}

		self::setup_data( $user );
	}

	/**
	 * Original function from PilotPress->add_new_register_user_to_ONTRAPORT().
	 * Setup the user data to send to Ontraport
	 *
	 * @param  [type] $user [description]
	 * @since  1.0.2
	 * @return [type]       [description]
	 */
	function setup_data( $user ) {

		$userData = array(
			"firstname"=>$user->user_firstname,
			"lastname"=>$user->user_lastname,
			"email"=>$user->user_email,
			"tags"=>'FTR Customer',
			"sequences"=>'1'
		);

		self::add_newly_registered_contact_api_call( $userData );
	}

	/**
	 * Start PilotPress's api call
	 * @since  1.0.2
	 * @param [type] $userData [description]
	 */
	function add_newly_registered_contact_api_call( $userData ) {

		global $pilotpress;

		$api_result = $pilotpress->api_call( 'add_newly_registered_contact', $userData );
	}

}
