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
		add_action('user_register', array( $this, 'create_ftr_user_entry' ), 99, 1);
	//	add_action('op_test', array( $this, 'create_ftr_user_entry' ), 10, 1);
	}

	/**
	 * Adds FTR User to Ontraport with FTR Customer tag and Newsletter sequence
	 * @param  [type] $uid User ID
	 * @return [type]      [description]
	 * @since  1.0.4
	 */
	function create_ftr_user_entry( $uid ) {
		if ( empty( $uid ) ) {
			return;
		}

		$u = get_user_by( 'id', $uid );

		if ( ! is_object( $u ) ) {
			return;
		}

		// check for ftr user. should probably filter conditions longterm
		if ( ! in_array( 'ftr_user', $u->roles ) ){
			return;
		}

		// will probably be using this when registering wp users,
		// so don't expect this to be true
		$op_id = ( ! empty( get_user_meta( $uid, 'wontrapi_id', true ) ) ) ? get_user_meta( $uid, 'wontrapi_id', true ) : '';

		if ( ! $op_id ) {
			$data = array(
				'email'	=> $u->user_email,
			);

			// Update/Create a contact if the email record
			// does/not exist in Ontraport
			$op = wontrapi_update_or_create_contact( $u->user_email, $data );

			// if the contact was created new in Ontraport,
			// get the id of the new user from OP
			$op_id = ( ! empty( $op->data->id ) ) ? $op->data->id : $op_id;
		}

		// if contact was updated (or failed?) it
		// does not return the id from Ontraport
		if ( ! $op_id ){
			$op = '';
			// get the contact from OP by email
			$op = wontrapi_get_contacts_by( 'email', $u->user_email );
			// get the id of the user in OP
			if ( ! empty( $op->data[0]->id ) ){
				$op_id = $op->data[0]->id;
			} else {
				// something messed up
				return;
			}
		}

		if ( ! empty( $u->user_firstname ) ) {
			$abc = wontrapi_get_contact( $op_id );
			if ( empty( $abc->firstname ) ) {
				$abc->firstname = $u->user_firstname;
				wontrapi_update_contact( $abc );
			}
		}

		// update the user meta in WP with the id from OP
		update_user_meta( $uid, 'wontrapi_id', $op_id );
		// add tags for ftr user
		wontrapi_add_tags_to_contacts( array( $op_id ), array( '587' ) );
		// add newsletter sequence
		wontrapi_add_sequence_to_contact( $op_id, '1' );
	}

}
