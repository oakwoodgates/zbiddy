<?php
/**
 * ZBiddy Options
 *
 * @since 1.0.2
 * @package ZBiddy
 */

/**
 * ZBiddy Options class.
 *
 * @since 1.0.2
 */
class ZB_Options {
	/**
	 * Parent plugin class
	 *
	 * @var    class
	 * @since  1.0.2
	 */
	protected $plugin = null;

	/**
	 * Option key, and option page slug
	 *
	 * @var    string
	 * @since  1.0.2
	 */
	protected $key = 'zbiddy_options';

	/**
	 * Options page metabox id
	 *
	 * @var    string
	 * @since  1.0.2
	 */
	protected $metabox_id = 'zbiddy_options_metabox';

	/**
	 * Options Page title
	 *
	 * @var    string
	 * @since  1.0.2
	 */
	protected $title = '';

	/**
	 * Options Page hook
	 * @var string
	 */
	protected $options_page = '';

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

		$this->title = __( 'Biddy Settings', 'zbiddy' );
	}

	/**
	 * Initiate our hooks
	 *
	 * @since  1.0.2
	 * @return void
	 */
	public function hooks() {
		add_action( 'admin_init', array( $this, 'admin_init' ) );
		add_action( 'admin_menu', array( $this, 'add_options_page' ) );
		add_action( 'cmb2_admin_init', array( $this, 'add_options_page_metabox' ) );
	}

	/**
	 * Register our setting to WP
	 *
	 * @since  1.0.2
	 * @return void
	 */
	public function admin_init() {
		register_setting( $this->key, $this->key );
	}

	/**
	 * Add menu options page
	 *
	 * @since  1.0.2
	 * @return void
	 */
	public function add_options_page() {
		$this->options_page = add_menu_page(
			$this->title,
			$this->title,
			'manage_options',
			$this->key,
			array( $this, 'admin_page_display' )
		);

		// Include CMB CSS in the head to avoid FOUC.
		add_action( "admin_print_styles-{$this->options_page}", array( 'CMB2_hookup', 'enqueue_cmb_css' ) );
	}

	/**
	 * Admin page markup. Mostly handled by CMB2
	 *
	 * @since  1.0.2
	 * @return void
	 */
	public function admin_page_display() {
		?>
		<div class="wrap cmb2-options-page <?php echo esc_attr( $this->key ); ?>">
			<h2><?php echo esc_html( get_admin_page_title() ); ?></h2>
			<?php cmb2_metabox_form( $this->metabox_id, $this->key ); ?>
		</div>
		<?php
	}

	/**
	 * Add custom fields to the options page.
	 *
	 * @since  1.0.2
	 * @return void
	 */
	public function add_options_page_metabox() {

		$cmb = new_cmb2_box( array(
			'id'         => $this->metabox_id,
			'hookup'     => false,
			'cmb_styles' => false,
			'show_on'    => array(
				// These are important, don't remove.
				'key'   => 'options-page',
				'value' => array( $this->key ),
			),
		) );

		/*
		Add your fields here

		$cmb->add_field( array(
			'name'    => __( 'Test Text', 'myprefix' ),
			'desc'    => __( 'field description (optional)', 'myprefix' ),
			'id'      => 'test_text', // no prefix needed
			'type'    => 'text',
			'default' => __( 'Default Text', 'myprefix' ),
		) );
		*/

	}
}

/**
 * Wrapper to get zbiddy_options from database
 * @since  1.0.2
 * @param  string $key [description]
 * @return mixed      [description]
 */
function zbiddy_get_option( $key = '' ) {
	return cmb2_get_option( 'zbiddy_options', $key );
}
