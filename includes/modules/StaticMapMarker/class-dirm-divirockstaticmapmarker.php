<?php
/**
 * Divi Rock Static Map Marker Module Class
 *
 * @package   DiviRockStaticMapMarkerModuleClass
 * @since     1.0.0
 */

if ( ! class_exists( 'DIRM_DiviRockStaticMapMarker' ) ) {
	/**
	 * Divi Rock Static Map Marker Module Class
	 */
	class DIRM_DiviRockStaticMapMarker extends ET_Builder_Module {

		/**
		 * Module slug
		 *
		 * @var string
		 */
		public $slug = 'dirm_divi_rock_static_map_marker';
		/**
		 * Module type
		 *
		 * @var string
		 */
		public $type = 'child';
		/**
		 * Module child_title_var
		 *
		 * @var string
		 */
		public $child_title_var = 'admin_title';
		/**
		 * Module child_title_fallback_var
		 *
		 * @var string
		 */
		public $child_title_fallback_var = 'dirm_sm_marker_title';
		/**
		 * Module vb_support
		 *
		 * @var string
		 */
		public $vb_support = 'off';

		/**
		 * Init fuction
		 *
		 * @return void
		 */
		public function init() {
			$this->name             = esc_html__( 'Field', 'et_builder' );
			$this->main_css_element = '%%order_class%%';
		}

		/**
		 * Get_fields function
		 *
		 * @return array[]
		 */
		public function get_fields(): array {
			return array(
				'dirm_sm_marker_title'       => array(
					'label'          => __( 'Marker Title', 'dirm-divi-rock-maps' ),
					'type'           => 'text',
					'mobile_options' => false,
					'default'        => '',
					'tab_slug'       => 'general',
					'toggle_slug'    => 'content',
					'description'    => __( 'Marker title', 'dirm-divi-rock-maps' ),
				),
				'dirm_sm_marker_description' => array(
					'label'          => __( 'Marker Description', 'dirm-divi-rock-maps' ),
					'type'           => 'tiny_mce',
					'mobile_options' => true,
					'default'        => '',
					'tab_slug'       => 'general',
					'toggle_slug'    => 'content',
					'description'    => __( 'Marker description', 'dirm-divi-rock-maps' ),
				),
				'dirm_sm_marker_latitude'    => array(
					'label'          => __( 'Marker Latitude', 'dirm-divi-rock-maps' ),
					'type'           => 'text',
					'mobile_options' => false,
					'default'        => '',
					'tab_slug'       => 'general',
					'toggle_slug'    => 'content',
					'description'    => __( 'Marker latitude', 'dirm-divi-rock-maps' ),
				),
				'dirm_sm_marker_longitude'   => array(
					'label'          => __( 'Marker Longitude', 'dirm-divi-rock-maps' ),
					'type'           => 'text',
					'mobile_options' => false,
					'default'        => '',
					'tab_slug'       => 'general',
					'toggle_slug'    => 'content',
					'description'    => __( 'Marker longitude', 'dirm-divi-rock-maps' ),
				),
				'admin_title'                => array(
					'label'       => esc_html__( 'Admin Label', 'dirm-divi-rock-maps' ),
					'type'        => 'text',
					'description' => esc_html__( 'This will change the label of the item in the builder for easy identification.', 'dirm-divi-rock-maps' ),
					'toggle_slug' => 'admin_label',
				),
			);
		}

		/**
		 * Get_settings_modal_toggles fuction
		 *
		 * @return array[]
		 */
		public function get_settings_modal_toggles(): array {

			return array(
				'general'  => array(
					'toggles' => array(
						'group_1'     => esc_html__( 'Preloader', 'dirm-divi-rock-maps' ),
						'group_2'     => esc_html__( 'No results found', 'dirm-divi-rock-maps' ),
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
		 * Get_advanced_fields_config fuction
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
					'use_background_layout' => false,
					'css'                   => array(
						'text_orientation' => '%%order_class%%',
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
					'dirm_sm_marker_title'       => array(
						'label'       => __( 'Marker Title', 'dirm-divi-rock-maps' ),
						'css'         => array(
							'main'      => '{$this->main_css_element} .dirm_sm_marker_title',
							'important' => 'all',
						),
						'line_height' => array(
							'default' => floatval( et_get_option( 'body_font_height', '1.7' ) ) . 'em',
						),
						'font_size'   => array(
							'default' => absint( et_get_option( 'body_font_size', '14' ) ) . 'px',
						),
					),
					'dirm_sm_marker_description' => array(
						'label'       => __( 'Marker Description', 'dirm-divi-rock-maps' ),
						'css'         => array(
							'main'      => '{$this->main_css_element} .dirm_sm_marker_description',
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
			);
		}

		/**
		 * Get_custom_css_fields_config fuction
		 *
		 * @return array[]
		 */
		public function get_custom_css_fields_config(): array {
			return array(
				'dirm_sm_marker_title'       => array(
					'label'    => __( 'Marker Title', 'dirm-divi-rock-maps' ),
					'selector' => '.dirm_sm_marker_title',
				),
				'dirm_sm_marker_description' => array(
					'label'    => __( 'Marker Description', 'dirm-divi-rock-maps' ),
					'selector' => '.dirm_sm_marker_description',
				),
			);
		}

		/**
		 * Render function
		 *
		 * @param mixed $attrs Attrs.
		 * @param mixed $content Content.
		 * @param mixed $render_slug Render_slug.
		 *
		 * @return string
		 */
		public function render( $attrs, $content, $render_slug ): string {
			$dirm_sm_marker_title              = $this->props['dirm_sm_marker_title'];
			$dirm_sm_marker_description        = $this->props['dirm_sm_marker_description'];
			$dirm_sm_marker_description_tablet = $this->props['dirm_sm_marker_description_tablet'];
			$dirm_sm_marker_description_phone  = $this->props['dirm_sm_marker_description_phone'];
			$dirm_sm_marker_latitude           = $this->props['dirm_sm_marker_latitude'];
			$dirm_sm_marker_longitude          = $this->props['dirm_sm_marker_longitude'];

			$this->add_classname(
				array(
					$this->get_text_orientation_classname(),
					'dp_dmb_repeat_item',
					'dp_dmb_module_1477_item',
				)
			);

			$this->remove_classname( array( 'et_pb_module' ) );

			ob_start();
			?>

			<?php
			$order_class = ET_Builder_Element::get_module_order_class( $render_slug );
			?>

			<div class='dirm_divi_rock_static_map_marker_container'
				data-order_class='<?php echo esc_attr( $order_class ); ?>'
				data-title='<?php echo esc_attr( $dirm_sm_marker_title ); ?>'
				data-description='<?php echo esc_attr( $dirm_sm_marker_description ); ?>'
				data-latitude='<?php echo esc_attr( $dirm_sm_marker_latitude ); ?>'
				data-longitude='<?php echo esc_attr( $dirm_sm_marker_longitude ); ?>'>
			</div>

			<?php

			$output = ob_get_clean();

			return $this->_render_module_wrapper( $output, $render_slug );
		}

	}

	new DIRM_DiviRockStaticMapMarker();
}
