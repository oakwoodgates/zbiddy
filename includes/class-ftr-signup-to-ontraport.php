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

		$op_id = $op = '';

		// will probably be using this when registering wp users,
		// so don't expect this to be true
		$op_id = get_user_meta( $uid, 'wontrapi_id', true );

		// should never be true, unless we are calling this function direct for a sync
		if ( $op_id ) {
			// the user has an account in OP and we have the ID, just give them the goods and leave

			// add tags for ftr user
			wontrapi_add_tags_to_contacts( array( $op_id ), array( '587' ) );

			// currently the way the FTR user's name at registration is not ideal
			if ( ! empty( $u->user_firstname ) ) {
				$c = wontrapi_get_contact( $op_id );
				// if they already have a firstname in OP, leave it
				if ( empty( $c->firstname ) ) {
					$c->firstname = $u->user_firstname;
					$op = wontrapi_update_contact( $c );
				}
			}
			// nothing left to see here captain

		} else {
			// Let's set this human up

			// data to send
			$dts = array(
				'email'	=> $u->user_email,
			);

			// Update/Create a contact if the email record does/not exist in Ontraport
			$op = wontrapi_update_or_create_contact( $u->user_email, $dts );

			// if the contact was created new in Ontraport we will be able to get the ID
			if ( ! empty( $op->data->id ) ) {

				$op_id = $op->data->id;

				if ( ! empty( $u->user_firstname ) ) {
					$dts = array(
						'id'	=> $op_id,
						'firstname' => $u->user_firstname
					);

					$op = wontrapi_update_contact( $dts );
				}
				// add tags for ftr user
				wontrapi_add_tags_to_contacts( array( $op_id ), array( '587' ) );
				// update the user meta in WP with the id from OP
				update_user_meta( $uid, 'wontrapi_id', $op_id );

			// if we updated existing contact, we do not have an ID from OP
			} else {
				// clear
				$op = '';
				// since we don't have an ID, lookup the user by email in OP
				$op = wontrapi_get_contacts_by( 'email', $u->user_email );
				// get the id of the user in OP
				if ( ! empty( $op->data[0]->id ) ) {
					$op_id = $op->data[0]->id;
					// currently the way the FTR user's name at registration is not ideal
					// if they already have a firstname in OP, leave it
					if ( ! empty( $u->user_firstname ) && empty( $op->data[0]->firstname ) ) {
						$dts = array(
							'id'	=> $op_id,
							'firstname' => $u->user_firstname
						);

						$op = wontrapi_update_contact( $dts );
					}
					// add tags for ftr user
					wontrapi_add_tags_to_contacts( array( $op_id ), array( '587' ) );
					// update the user meta in WP with the id from OP
					update_user_meta( $uid, 'wontrapi_id', $op_id );
				}
			}
		}
	}

}
