<?php
/**
 * ZBiddy Redirect On Date
 *
 * @since 1.0.0
 * @package ZBiddy
 */

/**
 * ZBiddy Redirect On Date.
 *
 * @since 1.0.0
 */
class ZB_Redirect_On_Date {
	/**
	 * Parent plugin class
	 *
	 * @var   class
	 * @since 1.0.0
	 */
	protected $plugin = null;

	/**
	 * Constructor
	 *
	 * @since  1.0.0
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
	 * @since  1.0.0
	 * @return void
	 */
	public function hooks() {
		add_action( 'cmb2_admin_init', array( $this, 'redirect_on_date_metaboxes' ) );
		add_action( 'template_redirect', array( $this, 'redirect' ) );
	}

	public function redirect_on_date_metaboxes() {
		// Start with an underscore to hide fields from custom fields list
		$prefix = '_zbiddy_';

		/**
		* Initiate the metabox
		*/
		$cmb = new_cmb2_box( array(
			'id'            => 'zbiddy_redirect_on_date_metabox',
			'title'         => __( 'Redirect on date', 'cmb2' ),
			'object_types'  => array( 'page', ), // Post type
			'context'       => 'normal',
			'priority'      => 'high',
			'show_names'    => true, // Show field names on the left
			// 'cmb_styles' => false, // false to disable the CMB stylesheet
			// 'closed'     => true, // Keep the metabox closed by default
		) );

		// Regular text field
		$cmb->add_field( array(
			'name'       => __( 'Enable redirect on date', 'cmb2' ),
			'id'         => $prefix . 'enable_redirect_on_date',
			'type'       => 'checkbox',
		) );

	//	$time = time();
		$ts = date('m-d-y, H:i');
		$cmb->add_field( array(
			'name'       => __( 'Time and date to start redirecting', 'cmb2' ),
			'desc'       => 'Will redirect any time after this. Compares to UTC, currently: ' . $ts . ' (mm-dd-yy, hh:mm)',
			'id'         => $prefix . 'time_to_redirect',
			'type'       => 'text_datetime_timestamp',
		) );

		$cmb->add_field( array(
			'name'       => __( 'Redirect to page', 'cmb2' ),
			'id'         => $prefix . 'redirect_to',
			'type'        => 'post_search_text', // This field type
			// post type also as array
			'post_type'   => 'page',
			// Default is 'checkbox', used in the modal view to select the post type
			'select_type' => 'radio',
			// Will replace any selection with selection from modal. Default is 'add'
			'select_behavior' => 'replace',
		) );

	}

	public function redirect() {
		global $post;
		$enable = get_post_meta( $post->ID, '_zbiddy_enable_redirect_on_date', true );
		if ( ! $enable ) {
			return;
		}
		$now = time();
		$then = get_post_meta( $post->ID, '_zbiddy_time_to_redirect', true );
		$where = get_post_meta( $post->ID, '_zbiddy_redirect_to', true );
		if ( $now > $then && $where ) {
			wp_safe_redirect( esc_url( get_permalink( $where ) ) );
		}
	}
}
