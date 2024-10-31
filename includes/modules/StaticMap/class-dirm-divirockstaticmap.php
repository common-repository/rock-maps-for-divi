<?php
/**
 * Divi Rock Static Map Module
 * Author: renzo.castillo@quaira.com
 *
 * @package   DiviRockStaticMap
 */

if ( ! class_exists( 'DIRM_DiviRockStaticMap' ) ) {
	/**
	 * Class DIRM_DiviRockStaticMap
	 *
	 * @since 1.0.0
	 */
	class DIRM_DiviRockStaticMap extends ET_Builder_Module {

		/**
		 * Module string
		 *
		 * @var string
		 */
		public $slug = 'dirm_divi_rock_static_map';
		/**
		 * Module string
		 *
		 * @var string
		 */
		public $child_slug = 'dirm_divi_rock_static_map_marker';
		/**
		 * Module string
		 *
		 * @var string
		 */
		public string $child_item_text = 'Marker';
		/**
		 * Module marker
		 *
		 * @var string
		 */
		public $vb_support = 'off';
		/**
		 * Module icon path
		 *
		 * @var string
		 */
		public string $icon_path;

		/**
		 * Init function.
		 *
		 * @return void
		 */
		public function init() {
			$this->name             = 'Divi Rock Static Map';
			$this->main_css_element = '%%order_class%%';
			$this->icon_path        = DIRM_PLUGIN_PATH . 'assets/icons/divi-rock-static-map.svg';
		}

		/**
		 * Get Fields function.
		 *
		 * @return array|array[]
		 */
		public function get_fields(): array {
			return array(
				'dirm_sm_map_center_type'                  => array(
					'label'       => __( 'Map Center Type', 'dirm-divi-rock-maps' ),
					'type'        => 'select',
					'options'     => array(
						'first value' => 'First value',
						'manual'      => 'Manual',
					),
					'default'     => 'first value',
					'tab_slug'    => 'general',
					'toggle_slug' => 'content',
					'description' => __( 'Map center type', 'dirm-divi-rock-maps' ),
				),
				'dirm_sm_center_latitude'                  => array(
					'label'           => __( 'Map Center Latitude', 'dirm-divi-rock-maps' ),
					'type'            => 'text',
					'mobile_options'  => false,
					'default'         => '',
					'tab_slug'        => 'general',
					'toggle_slug'     => 'content',
					'description'     => __( 'Map Center Latitude', 'dirm-divi-rock-maps' ),
					'depends_show_if' => 'manual',
					'depends_on'      => array( 'dirm_sm_map_center_type' ),
				),
				'dirm_sm_center_longitude'                 => array(
					'label'           => __( 'Map Center Longitude', 'dirm-divi-rock-maps' ),
					'type'            => 'text',
					'mobile_options'  => false,
					'default'         => '',
					'tab_slug'        => 'general',
					'toggle_slug'     => 'content',
					'description'     => __( 'Map center longitude', 'dirm-divi-rock-maps' ),
					'depends_show_if' => 'manual',
					'depends_on'      => array( 'dirm_sm_map_center_type' ),
				),
				'dirm_sm_map_zoom'                         => array(
					'label'           => __( 'Map Zoom', 'dirm-divi-rock-maps' ),
					'type'            => 'range',
					'option_category' => 'font_option',
					'range_settings'  => array(
						'min'  => '1',
						'max'  => '22',
						'step' => '1',
					),
					'mobile_options'  => false,
					'default'         => __( '5', 'dirm-divi-rock-maps' ),
					'tab_slug'        => 'general',
					'toggle_slug'     => 'content',
					'description'     => __( 'Map zoom', 'dirm-divi-rock-maps' ),
				),
				'dirm_sm_preloader_icon'                   => array(
					'label'       => __( 'Preloader Icon', 'dirm-divi-rock-maps' ),
					'type'        => 'select_icon',
					'class'       => array( 'et-pb-font-icon' ),
					'default'     => '%%297%%',
					'tab_slug'    => 'general',
					'toggle_slug' => 'group_1',
					'description' => '',
				),
				'dirm_sm_preloader_icon_icon_color'        => array(
					'label'        => __( 'Preloader Icon Color', 'dirm-divi-rock-maps' ),
					'type'         => 'color-alpha',
					'custom_color' => true,
					'tab_slug'     => 'advanced',
					'toggle_slug'  => 'icon',
					'description'  => __( 'Here you can define a custom color for your icon.', 'dirm-divi-rock-maps' ),
				),
				'dirm_sm_preloader_icon_use_circle'        => array(
					'label'       => __( 'Preloader Icon Circle', 'dirm-divi-rock-maps' ),
					'type'        => 'yes_no_button',
					'options'     => array(
						'off' => __( 'No', 'dirm-divi-rock-maps' ),
						'on'  => __( 'Yes', 'dirm-divi-rock-maps' ),
					),
					'default'     => 'off',
					'affects'     => array(
						'dirm_sm_preloader_icon_use_circle_border',
						'dirm_sm_preloader_icon_circle_color',
					),
					'tab_slug'    => 'advanced',
					'toggle_slug' => 'icon',
					'description' => __( 'Here you can choose whether icon should display within a circle.', 'dirm-divi-rock-maps' ),
				),
				'dirm_sm_preloader_icon_circle_color'      => array(
					'label'        => __( 'Preloader Icon Circle Color', 'dirm-divi-rock-maps' ),
					'type'         => 'color-alpha',
					'custom_color' => true,
					'tab_slug'     => 'advanced',
					'toggle_slug'  => 'icon',
					'description'  => __( 'Here you can define a custom color for the icon circle.', 'dirm-divi-rock-maps' ),
				),
				'dirm_sm_preloader_icon_use_circle_border' => array(
					'label'       => __( 'Preloader Icon Show Circle Border', 'dirm-divi-rock-maps' ),
					'type'        => 'yes_no_button',
					'options'     => array(
						'off' => __( 'No', 'dirm-divi-rock-maps' ),
						'on'  => __( 'Yes', 'dirm-divi-rock-maps' ),
					),
					'default'     => 'off',
					'affects'     => array(
						'dirm_sm_preloader_icon_circle_border_color',
					),
					'tab_slug'    => 'advanced',
					'toggle_slug' => 'icon',
					'description' => __( 'Here you can choose whether the icon circle border should display.', 'dirm-divi-rock-maps' ),
				),
				'dirm_sm_preloader_icon_circle_border_color' => array(
					'label'        => __( 'Preloader Icon Border Color', 'dirm-divi-rock-maps' ),
					'type'         => 'color-alpha',
					'custom_color' => true,
					'tab_slug'     => 'advanced',
					'toggle_slug'  => 'icon',
					'description'  => __( 'Here you can define a custom color for the icon circle border.', 'dirm-divi-rock-maps' ),
				),
				'dirm_sm_preloader_icon_use_icon_font_size' => array(
					'label'       => __( 'Preloader Icon Use Font Size', 'dirm-divi-rock-maps' ),
					'type'        => 'yes_no_button',
					'options'     => array(
						'off' => __( 'No', 'dirm-divi-rock-maps' ),
						'on'  => __( 'Yes', 'dirm-divi-rock-maps' ),
					),
					'default'     => 'off',
					'affects'     => array(
						'dirm_sm_preloader_icon_icon_font_size',
					),
					'tab_slug'    => 'advanced',
					'toggle_slug' => 'icon',
				),
				'dirm_sm_preloader_icon_icon_font_size'    => array(
					'label'           => __( 'Preloader Icon Font Size', 'dirm-divi-rock-maps' ),
					'type'            => 'range',
					'option_category' => 'font_option',
					'default'         => '96px',
					'range_settings'  => array(
						'min'  => '1',
						'max'  => '120',
						'step' => '1',
					),
					'mobile_options'  => true,
					'tab_slug'        => 'advanced',
					'toggle_slug'     => 'icon',
				),
				'dirm_sm_preloader_icon_icon_font_size_last_edited' => array(
					'type'        => 'skip',
					'tab_slug'    => 'advanced',
					'toggle_slug' => 'icon',
				),
				'dirm_sm_preloader_icon_icon_font_size_tablet' => array(
					'type'        => 'skip',
					'tab_slug'    => 'advanced',
					'toggle_slug' => 'icon',
				),
				'dirm_sm_preloader_icon_icon_font_size_phone' => array(
					'type'        => 'skip',
					'tab_slug'    => 'advanced',
					'toggle_slug' => 'icon',
				),
				'dirm_sm_preloader_label'                  => array(
					'label'          => __( 'Preloader Label', 'dirm-divi-rock-maps' ),
					'type'           => 'text',
					'mobile_options' => true,
					'default'        => __( 'Loading ...', 'dirm-divi-rock-maps' ),
					'tab_slug'       => 'general',
					'toggle_slug'    => 'group_1',
					'description'    => '',
				),
				'dirm_sm_no_results_found_icon'            => array(
					'label'       => __( 'No Results Found Icon', 'dirm-divi-rock-maps' ),
					'type'        => 'select_icon',
					'class'       => array( 'et-pb-font-icon' ),
					'default'     => '%%297%%',
					'tab_slug'    => 'general',
					'toggle_slug' => 'group_2',
					'description' => '',
				),
				'dirm_sm_no_results_found_icon_icon_color' => array(
					'label'        => __( 'No Results Found Icon Color', 'dirm-divi-rock-maps' ),
					'type'         => 'color-alpha',
					'custom_color' => true,
					'tab_slug'     => 'advanced',
					'toggle_slug'  => 'icon',
					'description'  => __( 'Here you can define a custom color for your icon.', 'dirm-divi-rock-maps' ),
				),
				'dirm_sm_no_results_found_icon_use_circle' => array(
					'label'       => __( 'No Results Found Icon Circle', 'dirm-divi-rock-maps' ),
					'type'        => 'yes_no_button',
					'options'     => array(
						'off' => __( 'No', 'dirm-divi-rock-maps' ),
						'on'  => __( 'Yes', 'dirm-divi-rock-maps' ),
					),
					'default'     => 'off',
					'affects'     => array(
						'dirm_sm_no_results_found_icon_use_circle_border',
						'dirm_sm_no_results_found_icon_circle_color',
					),
					'tab_slug'    => 'advanced',
					'toggle_slug' => 'icon',
					'description' => __( 'Here you can choose whether icon should display within a circle.', 'dirm-divi-rock-maps' ),
				),
				'dirm_sm_no_results_found_icon_circle_color' => array(
					'label'        => __( 'No Results Found Icon Circle Color', 'dirm-divi-rock-maps' ),
					'type'         => 'color-alpha',
					'custom_color' => true,
					'tab_slug'     => 'advanced',
					'toggle_slug'  => 'icon',
					'description'  => __( 'Here you can define a custom color for the icon circle.', 'dirm-divi-rock-maps' ),
				),
				'dirm_sm_no_results_found_icon_use_circle_border' => array(
					'label'       => __( 'No Results Found Icon Show Circle Border', 'dirm-divi-rock-maps' ),
					'type'        => 'yes_no_button',
					'options'     => array(
						'off' => __( 'No', 'dirm-divi-rock-maps' ),
						'on'  => __( 'Yes', 'dirm-divi-rock-maps' ),
					),
					'default'     => 'off',
					'affects'     => array(
						'dirm_sm_no_results_found_icon_circle_border_color',
					),
					'tab_slug'    => 'advanced',
					'toggle_slug' => 'icon',
					'description' => __( 'Here you can choose whether the icon circle border should display.', 'dirm-divi-rock-maps' ),
				),
				'dirm_sm_no_results_found_icon_circle_border_color' => array(
					'label'        => __( 'No Results Found Icon Border Color', 'dirm-divi-rock-maps' ),
					'type'         => 'color-alpha',
					'custom_color' => true,
					'tab_slug'     => 'advanced',
					'toggle_slug'  => 'icon',
					'description'  => __( 'Here you can define a custom color for the icon circle border.', 'dirm-divi-rock-maps' ),
				),
				'dirm_sm_no_results_found_icon_use_icon_font_size' => array(
					'label'       => __( 'No Results Found Icon Use Font Size', 'dirm-divi-rock-maps' ),
					'type'        => 'yes_no_button',
					'options'     => array(
						'off' => __( 'No', 'dirm-divi-rock-maps' ),
						'on'  => __( 'Yes', 'dirm-divi-rock-maps' ),
					),
					'default'     => 'off',
					'affects'     => array(
						'dirm_sm_no_results_found_icon_icon_font_size',
					),
					'tab_slug'    => 'advanced',
					'toggle_slug' => 'icon',
				),
				'dirm_sm_no_results_found_icon_icon_font_size' => array(
					'label'           => __( 'No Results Found Icon Font Size', 'dirm-divi-rock-maps' ),
					'type'            => 'range',
					'option_category' => 'font_option',
					'default'         => '96px',
					'range_settings'  => array(
						'min'  => '1',
						'max'  => '120',
						'step' => '1',
					),
					'mobile_options'  => true,
					'tab_slug'        => 'advanced',
					'toggle_slug'     => 'icon',
				),
				'dirm_sm_no_results_found_icon_icon_font_size_last_edited' => array(
					'type'        => 'skip',
					'tab_slug'    => 'advanced',
					'toggle_slug' => 'icon',
				),
				'dirm_sm_no_results_found_icon_icon_font_size_tablet' => array(
					'type'        => 'skip',
					'tab_slug'    => 'advanced',
					'toggle_slug' => 'icon',
				),
				'dirm_sm_no_results_found_icon_icon_font_size_phone' => array(
					'type'        => 'skip',
					'tab_slug'    => 'advanced',
					'toggle_slug' => 'icon',
				),
				'dirm_sm_no_result_found_label'            => array(
					'label'          => __( 'No Results Found Label', 'dirm-divi-rock-maps' ),
					'type'           => 'text',
					'mobile_options' => true,
					'default'        => __( 'no results', 'dirm-divi-rock-maps' ),
					'tab_slug'       => 'general',
					'toggle_slug'    => 'group_2',
					'description'    => '',
				),
			);
		}

		/**
		 * Get settings modal tabs array.
		 *
		 * @return array[]
		 */
		public function get_settings_modal_toggles(): array {

			return array(
				'general'  => array(
					'toggles' => array(
						'group_1'     => esc_html__( 'Preloader', 'dirm-divi-rock-maps' ),
						'group_2'     => esc_html__( 'No Results Found', 'dirm-divi-rock-maps' ),
						'content'     => esc_html__( 'Content', 'dirm-divi-rock-maps' ),
						'background'  => esc_html__( 'Background', 'dirm-divi-rock-maps' ),
						'admin_label' => esc_html__( 'Admin Label', 'dirm-divi-rock-maps' ),
					),
				),
				'advanced' => array(
					'toggles' => array(
						'icon' => esc_html__( 'Icons', 'dirm-divi-rock-maps' ),
					),
				),
			);
		}

		/**
		 * Get the fields configuration array.
		 *
		 * @return array|array[]
		 */
		public function get_advanced_fields_config(): array {
			return array(
				'background'     => array(
					'use_background_image' => true,
					'use_background_video' => true,
				),
				'text'           => array(
					'use_background_layout' => true,
					'options'               => array(
						'background_layout' => array(
							'default' => 'light',
						),
					),
					'css'                   => array(
						'text_orientation'  => '%%order_class%%',
						'background_layout' => '%%order_class%%',
					),
				),
				'borders'        => array(
					'default' => array(
						'css' => array(
							'main' => '%%order_class%%',
						),
					),
				),
				'box_shadow'     => array(
					'default' => array(
						'css' => array(
							'main' => '%%order_class%%',
						),
					),
				),
				'button'         => array(),
				'filters'        => array(),
				'fonts'          => array(
					'dirm_sm_preloader_label'       => array(
						'label'       => __( 'Preloader label', 'dirm-divi-rock-maps' ),
						'css'         => array(
							'main'      => sprintf( '%s .dirm_sm_preloader_label', $this->main_css_element ),
							'important' => 'all',
						),
						'line_height' => array(
							'default' => floatval( et_get_option( 'body_font_height', '1.7' ) ) . 'em',
						),
						'font_size'   => array(
							'default' => absint( et_get_option( 'body_font_size', '14' ) ) . 'px',
						),
					),
					'dirm_sm_no_result_found_label' => array(
						'label'       => __( 'No Results Found Label', 'dirm-divi-rock-maps' ),
						'css'         => array(
							'main'      => sprintf( '%s .dirm_sm_no_result_found_label', $this->main_css_element ),
							'important' => 'all',
						),
						'line_height' => array(
							'default' => floatval( et_get_option( 'body_font_height', '1.7' ) ) . 'em',
						),
						'font_size'   => array(
							'default' => absint( et_get_option( 'body_font_size', '14' ) ) . 'px',
						),
					),
				),
				'margin_padding' => array(),
				'max_width'      => array(),
				'animation'      => array(),
				'height'         => array(
					'label'          => esc_html__( 'Height', 'my-custom-module' ),
					'type'           => 'range',
					'default'        => '500px',
					'range_settings' => array(
						'min'  => '1',
						'max'  => '1000',
						'step' => '1',
					),
					'mobile_options' => true,
				),
			);
		}

		/**
		 * Get the custom css fields config.
		 *
		 * @return array[]
		 */
		public function get_custom_css_fields_config(): array {
			return array(
				'dirm_sm_preloader_icon'        => array(
					'label'    => __( 'Preloader Icon', 'dirm-divi-rock-maps' ),
					'selector' => '.dirm_sm_preloader_icon',
				),
				'dirm_sm_preloader_label'       => array(
					'label'    => __( 'Preloader Label', 'dirm-divi-rock-maps' ),
					'selector' => '.dirm_sm_preloader_label',
				),
				'dirm_sm_no_results_found_icon' => array(
					'label'    => __( 'No Results Found icon', 'dirm-divi-rock-maps' ),
					'selector' => '.dirm_sm_no_results_found_icon',
				),
				'dirm_sm_no_result_found_label' => array(
					'label'    => __( 'No Results Found Label', 'dirm-divi-rock-maps' ),
					'selector' => '.dirm_sm_no_result_found_label',
				),
			);
		}

		/**
		 * Before render
		 *
		 * @return void
		 */
		public function before_render() {
			add_filter( 'et_late_global_assets_list', array( $this, 'require_divi_global_assets' ) );
		}

		/**
		 * This function is used to add the required Divi global assets to the Divi Builder.
		 *
		 * @param mixed $attrs Attributes.
		 * @param mixed $content Content.
		 * @param mixed $render_slug Render slug.
		 *
		 * @return string
		 */
		public function render( $attrs, $content, $render_slug ): string {
			$background_layout                                   = $this->props['background_layout'];
			$dirm_sm_map_center_type                             = $this->props['dirm_sm_map_center_type'];
			$dirm_sm_center_latitude                             = $this->props['dirm_sm_center_latitude'];
			$dirm_sm_center_longitude                            = $this->props['dirm_sm_center_longitude'];
			$dirm_sm_map_zoom                                    = $this->props['dirm_sm_map_zoom'];
			$dirm_sm_preloader_icon                              = $this->props['dirm_sm_preloader_icon'];
			$dirm_sm_preloader_icon_icon_color                   = $this->props['dirm_sm_preloader_icon_icon_color'];
			$dirm_sm_preloader_icon_use_circle                   = $this->props['dirm_sm_preloader_icon_use_circle'];
			$dirm_sm_preloader_icon_circle_color                 = $this->props['dirm_sm_preloader_icon_circle_color'];
			$dirm_sm_preloader_icon_use_circle_border            = $this->props['dirm_sm_preloader_icon_use_circle_border'];
			$dirm_sm_preloader_icon_circle_border_color          = $this->props['dirm_sm_preloader_icon_circle_border_color'];
			$dirm_sm_preloader_icon_use_icon_font_size           = $this->props['dirm_sm_preloader_icon_use_icon_font_size'];
			$dirm_sm_preloader_icon_icon_font_size               = $this->props['dirm_sm_preloader_icon_icon_font_size'];
			$dirm_sm_preloader_icon_icon_font_size_tablet        = $this->props['dirm_sm_preloader_icon_icon_font_size_tablet'];
			$dirm_sm_preloader_icon_icon_font_size_phone         = $this->props['dirm_sm_preloader_icon_icon_font_size_phone'];
			$dirm_sm_preloader_icon_icon_font_size_last_edited   = $this->props['dirm_sm_preloader_icon_icon_font_size_last_edited'];
			$dirm_sm_preloader_label                             = $this->props['dirm_sm_preloader_label'];
			$dirm_sm_preloader_label_tablet                      = $this->props['dirm_sm_preloader_label_tablet'];
			$dirm_sm_preloader_label_phone                       = $this->props['dirm_sm_preloader_label_phone'];
			$dirm_sm_no_results_found_icon                       = $this->props['dirm_sm_no_results_found_icon'];
			$dirm_sm_no_results_found_icon_icon_color            = $this->props['dirm_sm_no_results_found_icon_icon_color'];
			$dirm_sm_no_results_found_icon_use_circle            = $this->props['dirm_sm_no_results_found_icon_use_circle'];
			$dirm_sm_no_results_found_icon_circle_color          = $this->props['dirm_sm_no_results_found_icon_circle_color'];
			$dirm_sm_no_results_found_icon_use_circle_border     = $this->props['dirm_sm_no_results_found_icon_use_circle_border'];
			$dirm_sm_no_results_found_icon_circle_border_color   = $this->props['dirm_sm_no_results_found_icon_circle_border_color'];
			$dirm_sm_no_results_found_icon_use_icon_font_size    = $this->props['dirm_sm_no_results_found_icon_use_icon_font_size'];
			$dirm_sm_no_results_found_icon_icon_font_size        = $this->props['dirm_sm_no_results_found_icon_icon_font_size'];
			$dirm_sm_no_results_found_icon_icon_font_size_tablet = $this->props['dirm_sm_no_results_found_icon_icon_font_size_tablet'];
			$dirm_sm_no_results_found_icon_icon_font_size_phone  = $this->props['dirm_sm_no_results_found_icon_icon_font_size_phone'];
			$dirm_sm_no_results_found_icon_icon_font_size_last_edited = $this->props['dirm_sm_no_results_found_icon_icon_font_size_last_edited'];
			$dirm_sm_no_result_found_label                            = $this->props['dirm_sm_no_result_found_label'];
			$dirm_sm_no_result_found_label_tablet                     = $this->props['dirm_sm_no_result_found_label_tablet'];
			$dirm_sm_no_result_found_label_phone                      = $this->props['dirm_sm_no_result_found_label_phone'];

			$this->add_classname(
				array(
					sprintf( 'et_pb_bg_layout_%s', $background_layout ),
					$this->get_text_orientation_classname(),
				)
			);

			// Processing Icon: dirm_sm_preloader_icon.
			if ( 'off' !== $dirm_sm_preloader_icon_use_icon_font_size ) {
				$dirm_sm_preloader_icon_font_size_responsive_active = et_pb_get_responsive_status( $dirm_sm_preloader_icon_icon_font_size_last_edited );
				$dirm_sm_preloader_icon_font_size_values            = array(
					'desktop' => $dirm_sm_preloader_icon_icon_font_size,
					'tablet'  => $dirm_sm_preloader_icon_font_size_responsive_active ? $dirm_sm_preloader_icon_icon_font_size_tablet : '',
					'phone'   => $dirm_sm_preloader_icon_font_size_responsive_active ? $dirm_sm_preloader_icon_icon_font_size_phone : '',
				);
				et_pb_responsive_options()->generate_responsive_css( $dirm_sm_preloader_icon_font_size_values, '%%order_class%% .et-pb-icon.dp-icon-dirm_sm_preloader_icon', 'font-size', $render_slug );
			}
			$dirm_sm_preloader_icon_icon_style = sprintf( 'color: %1$s;', esc_attr( $dirm_sm_preloader_icon_icon_color ) );
			if ( 'on' === $dirm_sm_preloader_icon_use_circle ) {
				$dirm_sm_preloader_icon_icon_style .= sprintf( ' background-color: %1$s;', esc_attr( $dirm_sm_preloader_icon_circle_color ) );
				if ( 'on' === $dirm_sm_preloader_icon_use_circle_border ) {
					$dirm_sm_preloader_icon_icon_style .= sprintf( ' border-color: %1$s;', esc_attr( $dirm_sm_preloader_icon_circle_border_color ) );
				}
			}
			$dirm_sm_preloader_icon = sprintf( ' <span class="dirm_sm_preloader_icon et-pb-icon dp-icon-dirm_sm_preloader_icon %2$s%3$s" style="%4$s">%1$s</span>', esc_attr( et_pb_process_font_icon( $dirm_sm_preloader_icon ) ), ( 'on' === $dirm_sm_preloader_icon_use_circle ? ' et-pb-icon-circle' : '' ), ( 'on' === $dirm_sm_preloader_icon_use_circle && 'on' === $dirm_sm_preloader_icon_use_circle_border ? ' et-pb-icon-circle-border' : '' ), $dirm_sm_preloader_icon_icon_style );
			if ( version_compare( ET_BUILDER_PRODUCT_VERSION, '4.12.1', '>' ) ) {
				$this->generate_styles(
					array(
						'utility_arg'    => 'icon_font_family',
						'render_slug'    => $render_slug,
						'base_attr_name' => 'dirm_sm_preloader_icon',
						'important'      => true,
						'selector'       => '%%order_class%% .dp-icon-dirm_sm_preloader_icon',
						'processor'      => array(
							'ET_Builder_Module_Helper_Style_Processor',
							'process_extended_icon',
						),
					)
				);
			}
			// End Processing Icon: dirm_sm_preloader_icon.

			// Processing Icon: dirm_sm_no_results_found_icon.
			if ( 'off' !== $dirm_sm_no_results_found_icon_use_icon_font_size ) {
				$dirm_sm_no_results_found_icon_font_size_responsive_active = et_pb_get_responsive_status( $dirm_sm_no_results_found_icon_icon_font_size_last_edited );
				$dirm_sm_no_results_found_icon_font_size_values            = array(
					'desktop' => $dirm_sm_no_results_found_icon_icon_font_size,
					'tablet'  => $dirm_sm_no_results_found_icon_font_size_responsive_active ? $dirm_sm_no_results_found_icon_icon_font_size_tablet : '',
					'phone'   => $dirm_sm_no_results_found_icon_font_size_responsive_active ? $dirm_sm_no_results_found_icon_icon_font_size_phone : '',
				);
				et_pb_responsive_options()->generate_responsive_css( $dirm_sm_no_results_found_icon_font_size_values, '%%order_class%% .et-pb-icon.dp-icon-dirm_sm_no_results_found_icon', 'font-size', $render_slug );
			}
			$dirm_sm_no_results_found_icon_icon_style = sprintf( 'color: %1$s;', esc_attr( $dirm_sm_no_results_found_icon_icon_color ) );
			if ( 'on' === $dirm_sm_no_results_found_icon_use_circle ) {
				$dirm_sm_no_results_found_icon_icon_style .= sprintf( ' background-color: %1$s;', esc_attr( $dirm_sm_no_results_found_icon_circle_color ) );
				if ( 'on' === $dirm_sm_no_results_found_icon_use_circle_border ) {
					$dirm_sm_no_results_found_icon_icon_style .= sprintf( ' border-color: %1$s;', esc_attr( $dirm_sm_no_results_found_icon_circle_border_color ) );
				}
			}
			$dirm_sm_no_results_found_icon = sprintf( ' <span class="dirm_sm_no_results_found_icon et-pb-icon dp-icon-dirm_sm_no_results_found_icon %2$s%3$s" style="%4$s">%1$s</span>', esc_attr( et_pb_process_font_icon( $dirm_sm_no_results_found_icon ) ), ( 'on' === $dirm_sm_no_results_found_icon_use_circle ? ' et-pb-icon-circle' : '' ), ( 'on' === $dirm_sm_no_results_found_icon_use_circle && 'on' === $dirm_sm_no_results_found_icon_use_circle_border ? ' et-pb-icon-circle-border' : '' ), $dirm_sm_no_results_found_icon_icon_style );
			if ( version_compare( ET_BUILDER_PRODUCT_VERSION, '4.12.1', '>' ) ) {
				$this->generate_styles(
					array(
						'utility_arg'    => 'icon_font_family',
						'render_slug'    => $render_slug,
						'base_attr_name' => 'dirm_sm_no_results_found_icon',
						'important'      => true,
						'selector'       => '%%order_class%% .dp-icon-dirm_sm_no_results_found_icon',
						'processor'      => array(
							'ET_Builder_Module_Helper_Style_Processor',
							'process_extended_icon',
						),
					)
				);
			}
			/* End Processing Icon: dirm_sm_no_results_found_icon */

			ob_start();
			?>

			<?php
			$order_class = ET_Builder_Element::get_module_order_class( $render_slug );

			// MAP SETTINGS.
			$map_provider   = et_get_option( 'divi_dirm_map_provider' );
			$google_api_key = et_get_option( 'divi_dirm_google_api_key' );

			// MAP GDPR.
			$enable_gdpr                = et_get_option( 'divi_dirm_enable_gdpr' ) ? et_get_option( 'divi_dirm_enable_gdpr' ) : 'false';
			$title_gdpr                 = et_get_option( 'divi_dirm_title_gdpr' );
			$button_label_gdpr          = et_get_option( 'divi_dirm_button_label_gdpr' );
			$enable_always_unblock_gdpr = et_get_option( 'divi_dirm_enable_always_unblock_gdpr' );
			$always_unblock_label_gdpr  = et_get_option( 'divi_dirm_always_unblock_label_gdpr' );
			?>

			<div class='dirm_divi_rock_static_map_container' data-order_class='<?php echo esc_attr( $order_class ); ?>'
				data-center_type='<?php echo esc_attr( $dirm_sm_map_center_type ); ?>'
				data-center_latitude='<?php echo esc_attr( $dirm_sm_center_latitude ); ?>'
				data-center_longitude='<?php echo esc_attr( $dirm_sm_center_longitude ); ?>'
				data-zoom='<?php echo esc_attr( $dirm_sm_map_zoom ); ?>'
				data-preloader_icon='<?php echo esc_attr( $dirm_sm_preloader_icon ); ?>'
				data-preloader_label='<?php echo esc_attr( $dirm_sm_preloader_label ); ?>'
				data-no_results_icon='<?php echo esc_attr( $dirm_sm_no_results_found_icon ); ?>'
				data-no_results_label='<?php echo esc_attr( $dirm_sm_no_result_found_label ); ?>'
				data-map_provider='<?php echo esc_attr( $map_provider ); ?>'
				data-google_api_key='<?php echo esc_attr( $google_api_key ); ?>'
				data-enable_gdpr="<?php echo esc_attr( $enable_gdpr ); ?>"
				data-title_gdpr="<?php echo esc_attr( $title_gdpr ); ?>"
				data-button_label_gdpr="<?php echo esc_attr( $button_label_gdpr ); ?>"
				data-enable_always_unblock_gdpr="<?php echo esc_attr( $enable_always_unblock_gdpr ); ?>"
				data-always_unblock_label_gdpr="<?php echo esc_attr( $always_unblock_label_gdpr ); ?>"
			>
				<?php
					echo wp_kses_post( $this->content );
				?>
			</div>

			<?php

			$output = ob_get_clean();

			return $this->_render_module_wrapper( $output, $render_slug );
		}


		/**
		 *  Require Divi Global Assets
		 *
		 * @param mixed $assets_list Assets list.
		 *
		 * @return mixed
		 */
		public function require_divi_global_assets( $assets_list ) {
			return $assets_list;
		}
	}

	?>
	<?php

	new DIRM_DiviRockStaticMap();
}
