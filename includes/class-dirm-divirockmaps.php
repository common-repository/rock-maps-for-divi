<?php

/**
 * Divi Rock Maps Main Class
 */
class DIRM_DiviRockMaps extends DiviExtension {

	/**
	 * The gettext domain for the extension's translations.
	 *
	 * @since 1.0.0
	 *
	 * @var string
	 */
	public $gettext_domain = 'dirm-divi-rock-maps';

	/**
	 * The extension's WP Plugin name.
	 *
	 * @since 1.0.0
	 *
	 * @var string
	 */
	public $name = 'divi-rock-maps';

	/**
	 * The extension's version
	 *
	 * @since 1.0.0
	 *
	 * @var string
	 */
	public $version = '1.0.1';

	/**
	 * The extension's prefix
	 *
	 * @var string The prefix for the extension.
	 */
	public string $prefix = 'dirm';

	/**
	 * DIRM_DiviRockMaps constructor.
	 *
	 * @param string $name The Divi Extension name.
	 * @param array  $args The Divi Extension args.
	 */
	public function __construct( $name = 'divi-rock-maps', $args = array() ) {
		$this->plugin_dir     = plugin_dir_path( __FILE__ );
		$this->plugin_dir_url = plugin_dir_url( $this->plugin_dir );

		parent::__construct( $name, $args );
		add_filter( 'script_loader_tag', array( $this, 'dirm_add_type_attribute' ), 10, 3 );
		add_filter( 'plugin_row_meta', array( $this, 'dirm_add_changelog_to_plugin_details' ), 10, 2 );
		wp_enqueue_style( $this->prefix . '-vue-app', $this->plugin_dir_url . 'dist/index.css', array(), $this->version );
		wp_enqueue_script( $this->prefix . '-vue-app', $this->plugin_dir_url . 'dist/main.js', array( 'jquery' ), $this->version, true );
		add_action( 'epanel_render_maintabs', array( $this, 'dirm_divi_panel_tab' ) );
		add_action( 'et_epanel_changing_options', array( $this, 'dirm_divi_panel_fields' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'dirm_admin_enqueue_scripts' ) );

	}

	/**
	 * Enqueue scripts and styles for the admin area.
	 *
	 * @param mixed $tag The script tag.
	 * @param mixed $handle The script handle.
	 * @param mixed $src The script source.
	 *
	 * @return string
	 */
	public function dirm_add_type_attribute( $tag, $handle, $src ): string {
		// if not your script, do nothing and return original $tag.
		if ( $this->prefix . '-vue-app' !== $handle ) {
			return $tag;
		}

		// Change the script tag by adding type="module" and return it.
		return '<script type="module" src="' . esc_url( $src ) . '" id="' . $handle . '-js"></script>';
	}

	/**
	 * Add the Divi Panel tab.
	 *
	 * @return void
	 */
	public function dirm_divi_panel_tab() {
		$this->dirm_divi_panel_fields();
		?>
		<li><a href="#wrap-dividynam"><?php esc_attr_e( 'Divi Rock Maps', 'dirm-divi-rock-maps' ); ?></a></li>
		<?php
	}

	/**
	 * Add the Divi Panel fields.
	 *
	 * @return void
	 */
	public function dirm_divi_panel_fields() {
		global $options;
		$options[] = array(
			'name' => 'wrap-dividynam',
			'type' => 'contenttab-wrapstart',
		);

		$options[] = array(
			'type' => 'subnavtab-start',
		);

		$options[] = array(
			'name' => 'dppre-1',
			'type' => 'subnav-tab',
			'desc' => esc_html__( 'Map Settings', 'dirm-divi-rock-maps' ),
		);

		$options[] = array(
			'name' => 'dppre-2',
			'type' => 'subnav-tab',
			'desc' => esc_html__( 'Map GDPR', 'dirm-divi-rock-maps' ),
		);

		$options[] = array(
			'type' => 'subnavtab-end',
		);

		$options[] = array(
			'name' => 'dppre-1',
			'type' => 'subcontent-start',
		);

		$options[] = array(
			'id'             => DIRM_OPTIONS_PREFIX . '_map_provider',
			'name'           => esc_html__( 'Map Provider', 'dirm-divi-rock-maps' ),
			'type'           => 'select',
			'std'            => 'leaftlet',
			'desc'           => esc_html__( 'Select your default provider map provider', 'dirm-divi-rock-maps' ),
			'options'        => array(
				'leaflet' => esc_html__( 'Leaflet (OpenStreetMap) ', 'dirm-divi-rock-maps' ),
				'google'  => esc_html__( 'Google Maps', 'dirm-divi-rock-maps' ),
			),
			'et_save_values' => true,
		);

		/*
		 * Code to test if the map provider is Google
		 * et_add_show_if_field($options_prefix."map_provider", $options_prefix."map_provider", 'google', '==');
		 *
		 */

		$options[] = array(
			'id'   => DIRM_OPTIONS_PREFIX . '_google_api_key',
			'name' => esc_html__( 'Google Maps API Key', 'dirm-divi-rock-maps' ),
			'type' => 'password',
			'std'  => '',
			'desc' => esc_html__( 'Put your Google maps API KEY', 'dirm-divi-rock-maps' ),
		);

		$options[] = array(
			'id'   => DIRM_OPTIONS_PREFIX . '_expose_all_acf_group_fields_to_rest_api',
			'name' => esc_html__( 'Expose All ACF Group Fields to REST API', 'dirm-divi-rock-maps' ),
			'type' => 'checkbox',
			'std'  => 'on',
			'desc' => esc_html__(
				'If you want to expose all ACF group fields to REST API, turn this on. Otherwise, if you turn it off
				the Rest Api exposure will also be turned off for each ACF group field. You can always adjust this setting
				manually through ACF Field Groups page and leverage only the ACF Group Fileds you are using at
				your Dynamic Map Modules',
				'dirm-divi-rock-maps'
			),
		);

		$options[] = array(
			'name' => 'dppre-1',
			'type' => 'subcontent-end',
		);

		$options[] = array(
			'name' => 'dppre-2',
			'type' => 'subcontent-start',
		);

		$options[] = array(
			'id'   => DIRM_OPTIONS_PREFIX . '_enable_gdpr',
			'name' => esc_html__( 'Enable GDPR', 'dirm-divi-rock-maps' ),
			'type' => 'checkbox',
			'std'  => 'off',
			'desc' => esc_html__( 'If you want to enable GDPR, turn this on. Otherwise, if you turn it off', 'dirm-divi-rock-maps' ),
		);

		$default_title_gdpr = "By loading the map, you agree to Google's privacy policy.<br><a href='https://policies.google.com/privacy' target='_blank'>Learn more</a>";

		$options[] = array(
			'id'   => DIRM_OPTIONS_PREFIX . '_title_gdpr',
			'name' => esc_html__( 'Title', 'dirm-divi-rock-maps' ),
			'type' => 'textarea',
			'std'  => $default_title_gdpr,
			'desc' => esc_html__(
				'Title GDPR',
				'dirm-divi-rock-maps',
			),
		);

		$options[] = array(
			'id'   => DIRM_OPTIONS_PREFIX . '_button_label_gdpr',
			'name' => esc_html__( 'Button Label', 'dirm-divi-rock-maps' ),
			'type' => 'text',
			'std'  => 'Load Map',
			'desc' => esc_html__(
				'Button Label GDPR',
				'dirm-divi-rock-maps',
			),
		);

		$options[] = array(
			'id'   => DIRM_OPTIONS_PREFIX . '_enable_always_unblock_gdpr',
			'name' => esc_html__( 'Enable Always Unblock', 'dirm-divi-rock-maps' ),
			'type' => 'checkbox',
			'std'  => 'off',
			'desc' => esc_html__(
				'Enable Always Unblock GDPR',
				'dirm-divi-rock-maps',
			),
		);

		$options[] = array(
			'id'   => DIRM_OPTIONS_PREFIX . '_always_unblock_label_gdpr',
			'name' => esc_html__( 'Always Unblock Label', 'dirm-divi-rock-maps' ),
			'type' => 'text',
			'std'  => 'Always load this map',
			'desc' => esc_html__(
				'Always unblock GDPR Label',
				'dirm-divi-rock-maps',
			),
		);

		$options[] = array(
			'name' => 'dppre-2',
			'type' => 'subcontent-end',
		);

		$options[] = array(
			'name' => 'wrap-dppre',
			'type' => 'contenttab-wrapend',
		);
	}

	/**
	 * Add Changelog to Plugin Details
	 *
	 * @param mixed $plugin_meta The plugin meta data.
	 * @param mixed $plugin_file The plugin file path.
	 *
	 * @return mixed
	 * @since 1.0.0
	 */
	public function dirm_add_changelog_to_plugin_details( $plugin_meta, $plugin_file ) {
		if ( 'divi-rock-maps/divi-rock-maps.php' === $plugin_file ) {
			$changelog_url    = $this->plugin_dir_url . 'changelog.txt';
			$changelog_button = '<a href="' . $changelog_url . '" class="dirm-view-changelog">View Changelog</a>';
			$plugin_meta[]    = $changelog_button;
		}

		return $plugin_meta;
	}

	/**
	 * Add Changelog Popup
	 *
	 * @since 1.0.0
	 * @return void
	 */
	public function dirm_admin_enqueue_scripts() {
		wp_enqueue_script( $this->prefix . 'changelog-popup', $this->plugin_dir_url . 'scripts/changelog-popup.js', array( 'jquery' ), $this->version, true );
	}

}

new DIRM_DiviRockMaps();
