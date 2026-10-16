<?php
/**
 * Theme options manager implementation.
 *
 * @package GWT
 */

/**
 * Manages the GWT theme options page and settings.
 */
class GOVPH {

	/**
	 * Theme option values.
	 *
	 * @var array
	 */
	public $options;
	/**
	 * Default theme option values.
	 *
	 * @var array
	 */
	private $default_options = array(
		'govph_disable_search'                  => '',
		'govph_logo_position'                   => '',
		'govph_logo'                            => '',
		'govph_logo_enable'                     => '',
		'govph_agency_name'                     => '',
		'govph_agency_tagline'                  => '',
		'govph_headercolor'                     => '',
		'govph_header_font_color'               => '',
		'govph_headerimage'                     => '',
		'govph_slidercolor'                     => '',
		'govph_sliderimage'                     => '',
		'govph_slider_fullwidth'                => '',
		'govph_breadcrumbs_enable'              => '',
		'govph_breadcrumbs_separator'           => '',
		'govph_breadcrumbs_show_home'           => '',
		'govph_custom_pst'                      => '',
		'govph_custom_anchorcolor'              => '',
		'govph_custom_anchorcolor_hover'        => '',
		'govph_custom_panel_top'                => '',
		'govph_custom_border_color'             => '',
		'govph_custom_panel_bottom'             => '',
		'govph_custom_border_width'             => '',
		'govph_custom_border_radius'            => '',
		'govph_custom_background_color'         => '',
		'govph_custom_headings_text'            => '',
		'govph_custom_headings_inner_page_size' => '',
		'govph_custom_footer_background_color'  => '',
		'govph_content_show_pub_date'           => '',
		'govph_content_pub_date_lbl'            => '',
		'govph_content_show_author'             => '',
		'govph_content_pub_author_lbl'          => '',
		'govph_acc_link_statement'              => '',
		'govph_acc_link_home'                   => '',
		'govph_acc_link_main_content'           => '',
		'govph_acc_link_contact'                => '',
		'govph_acc_link_feedback'               => '',
		'govph_acc_link_faq'                    => '',
		'govph_acc_link_sitemap'                => '',
		'govph_acc_link_search'                 => '',
	);

	/**
	 * Initializes options and registers settings fields.
	 */
	public function __construct() {
		$this->options = get_option( 'govph_options' );
		if ( is_array( $this->options ) && count( $this->options ) > 0 ) {
			$this->options = array_merge( $this->default_options, $this->options );
		} else {
			$this->options = $this->default_options;
		}

		$this->register_settings_fields();
	}

	/**
	 * Adds the theme options page.
	 */
	public static function add_menu_page() {
		add_theme_page( 'Theme Options', 'Theme Options', 'manage_options', 'govph-options', array( new GOVPH(), 'govph_options_page' ), 6 );
	}

	/**
	 * Renders the theme options form.
	 */
	public function govph_options_page() {
		?>
	<div class="wrap">
	<h2>Theme Options Page</h2>
	<form action="options.php" method="post" enctype="multipart/form-data">
		<?php settings_fields( 'govph_options' ); ?>
		<?php do_settings_sections( __FILE__ ); ?>
		<p class="class"><input id="submit" name="submit" type="submit" class="button-primary" value="Save Changes"></p>
	</form>
	</div>
		<?php
	}

	/**
	 * Registers theme settings, sections, and fields.
	 */
	public function register_settings_fields() {
		register_setting( 'govph_options', 'govph_options' );
		add_settings_section( 'govph_main_section', '', array( $this, 'govph_main_section_cb' ), __FILE__ );
		add_settings_field( 'govph_general_section', '<h3>General Options<h3>', array( $this, 'govph_general_section' ), __FILE__, 'govph_main_section' );
		add_settings_field( 'govph_disable_search', 'Search Enable', array( $this, 'govph_disable_search' ), __FILE__, 'govph_main_section' );
		add_settings_field( 'govph_logo_enable', 'Enable Image Logo', array( $this, 'govph_logo_enable' ), __FILE__, 'govph_main_section' );
		add_settings_field( 'govph_agency_name', 'Agency Name', array( $this, 'govph_agency_name' ), __FILE__, 'govph_main_section' );
		add_settings_field( 'govph_agency_tagline', 'Agency Tagline', array( $this, 'govph_agency_tagline' ), __FILE__, 'govph_main_section' );
		add_settings_field( 'govph_header_font_color', 'Header Font Color', array( $this, 'govph_header_font_color' ), __FILE__, 'govph_main_section' );
		add_settings_field( 'govph_logo_position', 'Logo Position', array( $this, 'govph_logo_position_setting' ), __FILE__, 'govph_main_section' );
		add_settings_field( 'govph_logo', 'Image Logo', array( $this, 'govph_logo_setting' ), __FILE__, 'govph_main_section' );
		add_settings_field( 'govph_headercolor', 'Header Background Color', array( $this, 'govph_header_color_setting' ), __FILE__, 'govph_main_section' );
		add_settings_field( 'govph_headerimage', 'Header Background Image', array( $this, 'govph_header_image_setting' ), __FILE__, 'govph_main_section' );
		add_settings_field( 'govph_slidercolor', 'Slider Background Color', array( $this, 'govph_slider_color_setting' ), __FILE__, 'govph_main_section' );
		add_settings_field( 'govph_sliderimage', 'Slider Background Image', array( $this, 'govph_slider_image_setting' ), __FILE__, 'govph_main_section' );
		add_settings_field( 'govph_slider_fullwidth', 'Slider Full Width', array( $this, 'govph_slider_fullwidth' ), __FILE__, 'govph_main_section' );
		add_settings_field( 'govph_breadcrumbs_enable', 'Enable Breadcrumbs', array( $this, 'govph_breadcrumbs_enable' ), __FILE__, 'govph_main_section' );
		add_settings_field( 'govph_breadcrumbs_separator', 'Breadcrumbs Separator', array( $this, 'govph_breadcrumbs_separator' ), __FILE__, 'govph_main_section' );
		add_settings_field( 'govph_breadcrumbs_show_home', 'Breadcrumb Homepage Link', array( $this, 'govph_breadcrumbs_show_home' ), __FILE__, 'govph_main_section' );
		add_settings_field( 'govph_custom_section', '<h3>Theme Styling<h3>', array( $this, 'govph_custom_section' ), __FILE__, 'govph_main_section' );
		add_settings_field( 'govph_custom_pst', 'Philippine Standard Time', array( $this, 'govph_custom_pst' ), __FILE__, 'govph_main_section' );
		add_settings_field( 'govph_custom_anchorcolor', 'Anchor Color Settings', array( $this, 'govph_custom_anchorcolor' ), __FILE__, 'govph_main_section' );
		add_settings_field( 'govph_custom_anchorcolor_hover', 'Anchor Color Settings (Hover)', array( $this, 'govph_custom_anchorcolor_hover' ), __FILE__, 'govph_main_section' );
		add_settings_field( 'govph_custom_panel_top', 'Panel Top Color', array( $this, 'govph_custom_panel_top' ), __FILE__, 'govph_main_section' );
		add_settings_field( 'govph_custom_panel_bottom', 'Panel Bottom Color', array( $this, 'govph_custom_panel_bottom' ), __FILE__, 'govph_main_section' );
		add_settings_field( 'govph_custom_border_width', 'Border Width', array( $this, 'govph_custom_border_width' ), __FILE__, 'govph_main_section' );
		add_settings_field( 'govph_custom_border_radius', 'Border Radius', array( $this, 'govph_custom_border_radius' ), __FILE__, 'govph_main_section' );
		add_settings_field( 'govph_custom_border_color', 'Border Color', array( $this, 'govph_custom_border_color' ), __FILE__, 'govph_main_section' );
		add_settings_field( 'govph_custom_background_color', 'Background Color', array( $this, 'govph_custom_background_color' ), __FILE__, 'govph_main_section' );
		add_settings_field( 'govph_custom_headings_text', 'Header Rendering', array( $this, 'govph_custom_headings_text' ), __FILE__, 'govph_main_section' );
		add_settings_field( 'govph_custom_headings_size', 'Blog Title Header', array( $this, 'govph_custom_headings_size' ), __FILE__, 'govph_main_section' );
		add_settings_field( 'govph_custom_headings_inner_page_size', 'Banner Title Header', array( $this, 'govph_custom_headings_inner_page_size' ), __FILE__, 'govph_main_section' );
		add_settings_field( 'govph_custom_footer_background_color', 'Agency Footer Color', array( $this, 'govph_custom_footer_background_color' ), __FILE__, 'govph_main_section' );
		add_settings_field( 'govph_content_section', '<h3>Publishing Options<h3>', array( $this, 'govph_content_section' ), __FILE__, 'govph_main_section' );
		add_settings_field( 'govph_content_show_pub_date', 'Show Published Date', array( $this, 'govph_content_show_pub_date' ), __FILE__, 'govph_main_section' );
		add_settings_field( 'govph_content_pub_date_lbl', 'Publish Date Label', array( $this, 'govph_content_pub_date_lbl' ), __FILE__, 'govph_main_section' );
		add_settings_field( 'govph_content_show_author', 'Show Publisher', array( $this, 'govph_content_show_author' ), __FILE__, 'govph_main_section' );
		add_settings_field( 'govph_content_pub_author_lbl', 'Publish Author Label', array( $this, 'govph_content_pub_author_lbl' ), __FILE__, 'govph_main_section' );
		add_settings_field( 'govph_acc_link_section', '<h3>Accessibility<h3>', array( $this, 'govph_acc_link_section' ), __FILE__, 'govph_main_section' );
		add_settings_field( 'govph_acc_link_keys', 'Accessibility Combination Keys', array( $this, 'govph_acc_link_keys' ), __FILE__, 'govph_main_section' );
		add_settings_field( 'govph_acc_link_statement', 'Accessibility Statement<br/>(Combination + 0)', array( $this, 'govph_acc_link_statement' ), __FILE__, 'govph_main_section' );
		add_settings_field( 'govph_acc_link_home', 'Home Page<br/>(Combination + H)', array( $this, 'govph_acc_link_home' ), __FILE__, 'govph_main_section' );
		add_settings_field( 'govph_acc_link_main_content', 'Main Content<br/>(Combination + R)', array( $this, 'govph_acc_link_main_content' ), __FILE__, 'govph_main_section' );
		add_settings_field( 'govph_acc_link_contact', 'Contact<br/>(Combination + C)', array( $this, 'govph_acc_link_contact' ), __FILE__, 'govph_main_section' );
		add_settings_field( 'govph_acc_link_feedback', 'Feedback<br/>(Combination + K)', array( $this, 'govph_acc_link_feedback' ), __FILE__, 'govph_main_section' );
		add_settings_field( 'govph_acc_link_faq', 'FAQ<br/>(Combination + Q)', array( $this, 'govph_acc_link_faq' ), __FILE__, 'govph_main_section' );
		add_settings_field( 'govph_acc_link_sitemap', 'Site Map<br/>(Combination + M)', array( $this, 'govph_acc_link_sitemap' ), __FILE__, 'govph_main_section' );
		add_settings_field( 'govph_acc_link_search', 'Search<br/>(Combination + S)', array( $this, 'govph_acc_link_search' ), __FILE__, 'govph_main_section' );
	}

	/**
	 * Outputs the main settings section description.
	 */
	public function govph_main_section_cb() { }

	/**
	 * Outputs the general options section separator.
	 */
	public function govph_general_section() {
		?>
	<hr/>
		<?php
	}

	/**
	 * Renders the search visibility control.
	 */
	public function govph_disable_search() {
		?>
	<input type="checkbox" name="govph_options[govph_disable_search]" value="true" <?php checked( 'true', $this->options['govph_disable_search'] ); ?>>
	<span class="description">Check to display search field</span>
		<?php
	}

	/**
	 * Renders the logo position controls.
	 */
	public function govph_logo_position_setting() {
		?>
	<input type="radio" name="govph_options[govph_logo_position]" value="left" <?php checked( 'left', $this->options['govph_logo_position'] ); ?>> Left <br>
	<input type="radio" name="govph_options[govph_logo_position]" value="center" <?php checked( 'center', $this->options['govph_logo_position'] ); ?>> Center
	<br/><span class="description">Set position for logo</span>
		<?php
	}

	/**
	 * Renders the logo image field.
	 */
	public function govph_logo_setting() {
		?>
	<label for="upload_image">
		<input id="upload_image" type="text" size="36" name="govph_options[govph_logo]" value="<?php echo esc_attr( $this->options['govph_logo'] ); ?>" />
		<input id="upload_image_button" class="button" type="button" value="Upload Logo" />
		<br/><span class="description">Enter a URL or upload an image</span>
	</label>
		<?php
		if ( ! empty( $this->options['govph_logo'] ) ) {
			echo '<br/><img src="' . esc_url( $this->options['govph_logo'] ) . '" height="100px" alt="" style="background: #ddd; padding: 10px;">';
		}
	}

	/**
	 * Renders the image logo enable controls.
	 */
	public function govph_logo_enable() {
		$logo_enable_option = isset( $this->options['govph_logo_enable'] ) ? $this->options['govph_logo_enable'] : 1;
		?>
	<label for="logo_enabled">
		<input type="radio" name="govph_options[govph_logo_enable]" id="govph_logo_enable" value="1" <?php checked( 1, absint( $logo_enable_option ) ); ?>> <label for="govph_logo_enable">Enable</label> <br>
		<input type="radio" name="govph_options[govph_logo_enable]" id="govph_logo_disable" value="0" <?php checked( 0, absint( $logo_enable_option ) ); ?>> <label for="govph_logo_disable">Disable</label>
		<br/><span class="description">If enabled, the website name will be hidden and image logo will be shown (if exists).</span>
	</label>
		<?php
	}

	/**
	 * Renders the agency name field.
	 */
	public function govph_agency_name() {
		$value = $this->options['govph_agency_name'] ? $this->options['govph_agency_name'] : '';
		?>
	<input type="text" name="govph_options[govph_agency_name]" value="<?php echo esc_attr( $value ); ?>" style="width: 400px;"><br/>
	<span class="description">The agency website name.</span>
		<?php
	}

	/**
	 * Renders the agency tagline field.
	 */
	public function govph_agency_tagline() {
		$value = $this->options['govph_agency_tagline'] ? $this->options['govph_agency_tagline'] : '';
		?>
	<input type="text" name="govph_options[govph_agency_tagline]" value="<?php echo esc_attr( $value ); ?>" style="width: 400px;"><br/>
	<span class="description">The agency tagline.</span>
		<?php
	}

	/**
	 * Renders the header background color field.
	 */
	public function govph_header_color_setting() {
		?>
	<input name="govph_options[govph_headercolor]" type="text" value="<?php echo esc_attr( $this->options['govph_headercolor'] ); ?>" class="my-color-field" id="color-field-header-bg" data-default-color="#142745" />
		<?php
	}

	/**
	 * Renders the header font color field.
	 */
	public function govph_header_font_color() {
		$header_font_color = ! empty( $this->options['govph_header_font_color'] ) ? $this->options['govph_header_font_color'] : '#000';
		?>
	<input name="govph_options[govph_header_font_color]" type="text" value="<?php echo esc_attr( $header_font_color ); ?>" class="my-color-field" id="color-field-header-font" data-default-color="#000" />
		<?php
	}

	/**
	 * Renders the header background image field.
	 */
	public function govph_header_image_setting() {
		?>
	<label for="header_image_background">
		<input id="header_image_background" type="text" size="36" name="govph_options[govph_headerimage]" value="<?php echo esc_attr( $this->options['govph_headerimage'] ); ?>" />
		<input id="header_image_background_button" class="button" type="button" value="Upload Image" />
		<br /><span class="description">Enter a URL or upload an image for header background.</span>
	</label>
		<?php
		if ( ! empty( $this->options['govph_headerimage'] ) ) {
			echo '<br/><img src="' . esc_url( $this->options['govph_headerimage'] ) . '" height="100px" style="background: #ddd; padding: 10px;">';
		}
	}

	/**
	 * Renders the slider background color field.
	 */
	public function govph_slider_color_setting() {
		?>
	<input name="govph_options[govph_slidercolor]" type="text" value="<?php echo esc_attr( $this->options['govph_slidercolor'] ); ?>" class="my-color-field" id="color-field-slider" data-default-color="#1f3a70" />
		<?php
	}

	/**
	 * Renders the slider background image field.
	 */
	public function govph_slider_image_setting() {
		?>
	<label for="slider_image_background">
		<input id="slider_image_background" type="text" size="36" name="govph_options[govph_sliderimage]" value="<?php echo esc_attr( $this->options['govph_sliderimage'] ); ?>" />
		<input id="slider_image_background_button" class="button" type="button" value="Upload Image" />
		<br/><span class="description">Enter a URL or upload an image for header background</span>
	</label>
		<?php
		if ( ! empty( $this->options['govph_sliderimage'] ) ) {
			echo '<br/><img src="' . esc_url( $this->options['govph_sliderimage'] ) . '" height="200px" alt="" style="background: #ddd; padding: 10px;">';
		}
	}

	/**
	 * Renders the slider width control.
	 */
	public function govph_slider_fullwidth() {
		?>
	<input type="checkbox" name="govph_options[govph_slider_fullwidth]" value="true" <?php checked( 'true', $this->options['govph_slider_fullwidth'] ); ?>>
	<span class="description">Check to display the slider in full width</span>
		<?php
	}

	/**
	 * Renders the breadcrumb enable control.
	 */
	public function govph_breadcrumbs_enable() {
		?>
	<input type="checkbox" name="govph_options[govph_breadcrumbs_enable]" value="true" <?php checked( 'true', $this->options['govph_breadcrumbs_enable'] ); ?>>
	<span class="description">Check to display Breadcrumbs</span>
		<?php
	}

	/**
	 * Renders the breadcrumb separator field.
	 */
	public function govph_breadcrumbs_separator() {
		$value = $this->options['govph_breadcrumbs_separator'] ? $this->options['govph_breadcrumbs_separator'] : ' › ';
		?>
	<input type="text" name="govph_options[govph_breadcrumbs_separator]" value="<?php echo esc_attr( $value ); ?>"><br/>
	<span class="description">Separator symbol in between breadcrumb links</span>
		<?php
	}

	/**
	 * Renders the breadcrumb home-link control.
	 */
	public function govph_breadcrumbs_show_home() {
		?>
	<input type="checkbox" name="govph_options[govph_breadcrumbs_show_home]" value="true" <?php checked( 'true', $this->options['govph_breadcrumbs_show_home'] ); ?>>
	<span class="description">Check to show homepage link at the start of the breadcrumbs</span>
		<?php
	}

	/**
	 * Theme styling
	 */
	public function govph_custom_section() {
		?>
	<hr></hr>
		<?php
	}

	/**
	 * Renders the Philippine Standard Time color field.
	 */
	public function govph_custom_pst() {
		$govph_custom_pst = ! empty( $this->options['govph_custom_pst'] ) ? $this->options['govph_custom_pst'] : '#000000';
		?>
	<input name="govph_options[govph_custom_pst]" type="text" value="<?php echo esc_attr( $this->options['govph_custom_pst'] ); ?>" class="my-color-field" id="color-field-pst" data-default-color="#000000" />
	<br><span class="description">Philippine Standard Time (PST) font customization</span>
		<?php
	}

	/**
	 * Renders the link color field.
	 */
	public function govph_custom_anchorcolor() {
		?>
	<input name="govph_options[govph_custom_anchorcolor]" type="text" value="<?php echo esc_attr( $this->options['govph_custom_anchorcolor'] ); ?>" class="my-color-field" id="color-field-anchor" data-default-color="#2ba6cb" />
	<br><span class="description">Change active links font color</span>
		<?php
	}

	/**
	 * Renders the link hover color field.
	 */
	public function govph_custom_anchorcolor_hover() {
		?>
	<input name="govph_options[govph_custom_anchorcolor_hover]" type="text" value="<?php echo esc_attr( $this->options['govph_custom_anchorcolor_hover'] ); ?>" class="my-color-field" id="color-field-anchor-hover" data-default-color="#258faf" />
	<br><span class="description">Change active links font color</span>
		<?php
	}

	/**
	 * Renders the top panel color field.
	 */
	public function govph_custom_panel_top() {
		$govph_custom_panel_top = ! empty( $this->options['govph_custom_panel_top'] ) ? $this->options['govph_custom_panel_top'] : '#fffff';
		?>
	<input name="govph_options[govph_custom_panel_top]" type="text" value="<?php echo esc_attr( $this->options['govph_custom_panel_top'] ); ?>" class="my-color-field" id="color-field-panel-top" data-default-color="#ffffff" />
	<br><span class="description">Background color for Panel Top section</span>
		<?php
	}

	/**
	 * Renders the bottom panel color field.
	 */
	public function govph_custom_panel_bottom() {
		$govph_custom_border_color = ! empty( $this->options['govph_custom_border_color'] ) ? $this->options['govph_custom_panel_bottom'] : '#fffff';
		?>
	<input name="govph_options[govph_custom_panel_bottom]" type="text" value="<?php echo esc_attr( $this->options['govph_custom_panel_bottom'] ); ?>" class="my-color-field" id="color-field-panel-bottom" data-default-color="#fffff" />
	<br><span class="description">Background color for Panel Bottom section</span>
		<?php
	}

	/**
	 * Renders the border width control.
	 */
	public function govph_custom_border_width() {
		?>
	<select name="govph_options[govph_custom_border_width]">
		<option value="">-- Select --</option>
		<option value="0" <?php selected( '0', $this->options['govph_custom_border_width'] ); ?>>0px</option>
		<option value="1" <?php selected( '1', $this->options['govph_custom_border_width'] ); ?>>1px</option>
		<option value="2" <?php selected( '2', $this->options['govph_custom_border_width'] ); ?>>2px</option>
		<option value="3" <?php selected( '3', $this->options['govph_custom_border_width'] ); ?>>3px</option>
		<option value="4" <?php selected( '4', $this->options['govph_custom_border_width'] ); ?>>4px</option>
		<option value="5" <?php selected( '5', $this->options['govph_custom_border_width'] ); ?>>5px</option>
	</select>
	<br><span class="description">Adjust border width for main content area and widgets</span>
		<?php
	}

	/**
	 * Renders the border radius control.
	 */
	public function govph_custom_border_radius() {
		?>
	<select name="govph_options[govph_custom_border_radius]">
		<option value="">-- Select --</option>
		<option value="0" <?php selected( '0', $this->options['govph_custom_border_radius'] ); ?>>0px</option>
		<option value="2" <?php selected( '2', $this->options['govph_custom_border_radius'] ); ?>>2px</option>
		<option value="4" <?php selected( '4', $this->options['govph_custom_border_radius'] ); ?>>4px</option>
		<option value="6" <?php selected( '6', $this->options['govph_custom_border_radius'] ); ?>>6px</option>
		<option value="8" <?php selected( '8', $this->options['govph_custom_border_radius'] ); ?>>8px</option>
		<option value="10" <?php selected( '10', $this->options['govph_custom_border_radius'] ); ?>>10px</option>
		<option value="12" <?php selected( '12', $this->options['govph_custom_border_radius'] ); ?>>12px</option>
		<option value="14" <?php selected( '14', $this->options['govph_custom_border_radius'] ); ?>>14px</option>
		<option value="16" <?php selected( '16', $this->options['govph_custom_border_radius'] ); ?>>16px</option>
		<option value="18" <?php selected( '18', $this->options['govph_custom_border_radius'] ); ?>>18px</option>
		<option value="20" <?php selected( '20', $this->options['govph_custom_border_radius'] ); ?>>20px</option>
	</select>
	<br><span class="description">Adjust border radius for main content area and widgets</span>
		<?php
	}

	/**
	 * Renders the border color field.
	 */
	public function govph_custom_border_color() {
		$govph_custom_border_color = ! empty( $this->options['govph_custom_border_color'] ) ? $this->options['govph_custom_border_color'] : '#bfbfbf';
		?>
	<input name="govph_options[govph_custom_border_color]" type="text" value="<?php echo esc_attr( $this->options['govph_custom_border_color'] ); ?>" class="my-color-field" id="color-field-border-color" data-default-color="#bfbfbf" />
	<br><span class="description">Border color for widgets and main content area</span>
		<?php
	}

	/**
	 * Renders the widget background color field.
	 */
	public function govph_custom_background_color() {
		$govph_custom_background_color = ! empty( $this->options['govph_custom_background_color'] ) ? $this->options['govph_custom_background_color'] : '#fcfcfc';
		?>
	<input name="govph_options[govph_custom_background_color]" type="text" value="<?php echo esc_attr( $this->options['govph_custom_background_color'] ); ?>" class="my-color-field" id="color-field-widget-bg" data-default-color="#fcfcfc" />
	<br><span class="description">Background color for widgets and main content area</span>
		<?php
	}

	/**
	 * Renders the heading text transform control.
	 */
	public function govph_custom_headings_text() {
		?>
	<select name="govph_options[govph_custom_headings_text]">
		<option value="">-- Select --</option>
		<option value="none" <?php selected( 'none', $this->options['govph_custom_headings_text'] ); ?>>normal</option>
		<option value="uppercase" <?php selected( 'uppercase', $this->options['govph_custom_headings_text'] ); ?>>UPPERCASE</option>
		<option value="lowercase" <?php selected( 'lowercase', $this->options['govph_custom_headings_text'] ); ?>>lowercase</option>
		<option value="capitalize" <?php selected( 'capitalize', $this->options['govph_custom_headings_text'] ); ?>>Capitalize</option>
	</select>
	<br><span class="description">Blog section title text rendering</span>
		<?php
	}

	/**
	 * Renders the blog heading size control.
	 */
	public function govph_custom_headings_size() {
		?>
	<select name="govph_options[govph_custom_headings_size]">
		<option value="">-- Select --</option>
		<option value="0.8" <?php selected( '0.8', $this->options['govph_custom_headings_size'] ); ?>>small</option>
		<option value="1" <?php selected( '1', $this->options['govph_custom_headings_size'] ); ?>>normal</option>
		<option value="1.6" <?php selected( '1.6', $this->options['govph_custom_headings_size'] ); ?>>large</option>
	</select>
	<br><span class="description">Adjust blog section title font sizes</span>
		<?php
	}

	/**
	 * Renders the inner page heading size control.
	 */
	public function govph_custom_headings_inner_page_size() {
		?>
	<select name="govph_options[govph_custom_headings_inner_page_size]">
		<option value="">-- Select --</option>
		<option value="2" <?php selected( '2', $this->options['govph_custom_headings_inner_page_size'] ); ?>>small</option>
		<option value="2.69" <?php selected( '2.69', $this->options['govph_custom_headings_inner_page_size'] ); ?>>normal</option>
		<option value="3.5" <?php selected( '3.5', $this->options['govph_custom_headings_inner_page_size'] ); ?>>large</option>
	</select>
	<br><span class="description">Adjust inner posts and pages title font sizes</span>
		<?php
	}

	/**
	 * Renders the agency footer background color field.
	 */
	public function govph_custom_footer_background_color() {
		$govph_custom_footer_background_color = ! empty( $this->options['govph_custom_footer_background_color'] ) ? $this->options['govph_custom_footer_background_color'] : '#E9E9E9';
		?>
	<input name="govph_options[govph_custom_footer_background_color]" type="text" value="<?php echo esc_attr( $this->options['govph_custom_footer_background_color'] ); ?>" class="my-color-field" id="color-field-footer-bg" data-default-color="#E9E9E9" />
	<br><span class="description">Background color for agency footer section</span>
		<?php
	}

	/**
	 * Displays the publishing options section separator.
	 */
	public function govph_content_section() {
		?>
	<hr></hr>
		<?php
	}

	/**
	 * Renders the published date visibility control.
	 */
	public function govph_content_show_pub_date() {
		?>
	<input type="checkbox" name="govph_options[govph_content_show_pub_date]" value="true" <?php checked( 'true', $this->options['govph_content_show_pub_date'] ); ?>>
	<span class="description">Check to display the published date on posts</span>
		<?php
	}

	/**
	 * Renders the published date label field.
	 */
	public function govph_content_pub_date_lbl() {
		$default = ! empty( $this->options['govph_content_pub_date_lbl'] ) ? $this->options['govph_content_pub_date_lbl'] : 'Posted on';
		?>
	<input type="text" name="govph_options[govph_content_pub_date_lbl]" value="<?php echo esc_attr( $default ); ?>"><br/>
	<span class="description">Publish date display label</span>
		<?php
	}

	/**
	 * Renders the author visibility control.
	 */
	public function govph_content_show_author() {
		?>
	<input type="checkbox" name="govph_options[govph_content_show_author]" value="true" <?php checked( 'true', $this->options['govph_content_show_author'] ); ?>>
	<span class="description">Check to display the author</span>
		<?php
	}

	/**
	 * Renders the author label field.
	 */
	public function govph_content_pub_author_lbl() {
		$default = ! empty( $this->options['govph_content_pub_author_lbl'] ) ? $this->options['govph_content_pub_author_lbl'] : 'by';
		?>
	<input type="text" name="govph_options[govph_content_pub_author_lbl]" value="<?php echo esc_attr( $default ); ?>"><br/>
	<span class="description">Publish author display label<br/></span>
		<?php
	}

	/**
	 * Displays the accessibility options section separator.
	 */
	public function govph_acc_link_section() {
		?>
	<hr/>
		<?php
	}

	/**
	 * Displays accessibility shortcut key instructions.
	 */
	public function govph_acc_link_keys() {
		?>
	<p>Shortcut Keys Combination Activation<br/>
	Combination keys used for each browser.</p>
	<ul>
		<li>Chrome for Linux press (Alt+Shift+shortcut_key)</li>
		<li>Chrome for Windows press (Alt+shortcut_key)</li>
		<li>For Firefox press (Alt+Shift+shortcut_key)</li>
		<li>For Internet Explorer press (Alt+Shift+shortcut_key) then press (enter)</li>
		<li>On Mac OS press (Ctrl+Opt+shortcut_key)</li>
	</ul>
		<?php
	}

	/**
	 * Renders the accessibility statement link field.
	 */
	public function govph_acc_link_statement() {
		$value = $this->options['govph_acc_link_statement'] ? $this->options['govph_acc_link_statement'] : '';
		?>
	<span class="field-prefix"><?php echo esc_url( get_site_url() ); ?>/ </span>
	<input type="text" name="govph_options[govph_acc_link_statement]" value="<?php echo esc_attr( $value ); ?>"><br/>
	<span class="description">Statement accessibility page</span>
		<?php
	}

	/**
	 * Renders the home page shortcut link field.
	 */
	public function govph_acc_link_home() {
		$value = $this->options['govph_acc_link_home'] ? $this->options['govph_acc_link_home'] : '';
		?>
	<span class="field-prefix"><?php echo esc_url( get_site_url() ); ?>/ </span>
	<input type="text" name="govph_options[govph_acc_link_home]" value="<?php echo esc_attr( $value ); ?>"><br/>
	<span class="description">The home page of the website<br/>Default: blank</span>
		<?php
	}

	/**
	 * Renders the main content shortcut link field.
	 */
	public function govph_acc_link_main_content() {
		$value = $this->options['govph_acc_link_main_content'] ? $this->options['govph_acc_link_main_content'] : '#main-content';
		?>
	<span class="field-prefix">{current_url}/ </span>
	<input type="text" name="govph_options[govph_acc_link_main_content]" value="<?php echo esc_attr( $value ); ?>"><br/>
	<span class="description">Default: #main-content</span>
		<?php
	}

	/**
	 * Renders the contact shortcut link field.
	 */
	public function govph_acc_link_contact() {
		?>
	<span class="field-prefix"><?php echo esc_url( get_site_url() ); ?>/ </span>
	<input type="text" name="govph_options[govph_acc_link_contact]" value="<?php echo esc_attr( $this->options['govph_acc_link_contact'] ); ?>">
		<?php
	}

	/**
	 * Renders the feedback shortcut link field.
	 */
	public function govph_acc_link_feedback() {
		?>
	<span class="field-prefix"><?php echo esc_url( get_site_url() ); ?>/ </span>
	<input type="text" name="govph_options[govph_acc_link_feedback]" value="<?php echo esc_attr( $this->options['govph_acc_link_feedback'] ); ?>">
		<?php
	}

	/**
	 * Renders the FAQ shortcut link field.
	 */
	public function govph_acc_link_faq() {
		?>
	<span class="field-prefix"><?php echo esc_url( get_site_url() ); ?>/ </span>
	<input type="text" name="govph_options[govph_acc_link_faq]" value="<?php echo esc_attr( $this->options['govph_acc_link_faq'] ); ?>">
		<?php
	}

	/**
	 * Renders the sitemap shortcut link field.
	 */
	public function govph_acc_link_sitemap() {
		$value = $this->options['govph_acc_link_sitemap'] ? $this->options['govph_acc_link_sitemap'] : '#gwt-standard-footer';
		?>
	<span class="field-prefix">{current_url}/ </span>
	<input type="text" name="govph_options[govph_acc_link_sitemap]" value="<?php echo esc_attr( $value ); ?>"><br/>
	<span class="description">Note: If the sitemap is a page, use the full URL of the website: <?php echo esc_url( get_site_url() ); ?>/{sitemap_page}<br/>
		Default: #gwt-standard-footer</span>
		<?php
	}

	/**
	 * Renders the search shortcut link field.
	 */
	public function govph_acc_link_search() {
		?>
	<span class="field-prefix"><?php echo esc_url( get_site_url() ); ?>/ </span>
	<input type="text" name="govph_options[govph_acc_link_search]" value="<?php echo esc_attr( $this->options['govph_acc_link_search'] ); ?>"><br/>
	<span class="description">Note: Create a new page by going to "Pages" and selecting "Add New." Title the page "Search," and choose "Search Page" on Page Attributes from the Template drop-down menu. Click "Publish."<br/>
		The link will be coming from the created page's permalink.
	</span>
		<?php
	}
}

// phpcs:disable Universal.Files.SeparateFunctionsFromOO.Mixed -- Keep the legacy options callbacks with the class they configure.
add_action( 'admin_menu', 'govph_options_menu' );
/**
 * Adds the options page to the admin menu.
 */
function govph_options_menu() {
	GOVPH::add_menu_page();
}

add_action( 'admin_init', 'govph_options_init' );
/**
 * Initializes theme option registration.
 */
function govph_options_init() {
	new GOVPH();
}

if ( is_admin() ) {
	add_action( 'admin_enqueue_scripts', 'mw_enqueue_color_picker' ); }
/**
 * Enqueues media and color-picker assets.
 *
 * @param string $hook_suffix The current admin page hook.
 */
function mw_enqueue_color_picker( $hook_suffix ) {
	unset( $hook_suffix );
	// Enqueue media and color-picker assets for the options page.
	wp_enqueue_media();
	wp_enqueue_style( 'wp-color-picker' );
	wp_enqueue_script( 'my-script-handle', get_template_directory_uri() . '/js/color.js', array( 'jquery', 'wp-color-picker' ), wp_get_theme()->get( 'Version' ), true );
}

/**
 * Displays a configured theme option.
 *
 * @param string $options The option key to display.
 * @return mixed The option value when the option is not directly output.
 */
function govph_displayoptions( $options ) {
	$option = get_option( 'govph_options', array() );
	$option = wp_parse_args(
		$option,
		array(
			'govph_logo_enable'      => '',
			'govph_agency_name'      => '',
			'govph_agency_tagline'   => '',
			'govph_slider_fullwidth' => '',
			'govph_disable_search'   => '',
		)
	);

	switch ( $options ) {
		case 'govph_logo_enable':
			return ( ! empty( $option['govph_logo_enable'] ) && 1 === absint( $option['govph_logo_enable'] ) );
		case 'govph_logo_setting':
			$logo_setting  = ( ! empty( $option['govph_header_font_color'] ) ? 'color:' . $option['govph_header_font_color'] . ';' : '' );
			$logo_setting .= ( ! empty( $option['govph_logo_position'] ) ? 'text-align:' . $option['govph_logo_position'] . ';' : '' );
			echo wp_kses( safecss_filter_attr( $logo_setting ), array() );
			break;
		case 'govph_logo':
			$logo_image = ! empty( $option['govph_logo'] ) ? esc_url( $option['govph_logo'] ) : esc_url( get_template_directory_uri() . '/images/logo-masthead-large.png' );
			$add_logo   = 1 === absint( $option['govph_logo_enable'] ) ? '<img src="' . $logo_image . '" />' :
			'<div id="textlogo-wrapper">
				<div id="textlogo-image"><img alt="' . esc_attr( $option['govph_agency_name'] ) . ' Official Logo" src="' . $logo_image . '" height="100px" width="100px"/></div>
        <div id="textlogo-inner-wrapper">
          <div id="agency-heading">Republic of the Philippines</div>
					<div id="agency-name">' . esc_html( $option['govph_agency_name'] ) . '</div>
					<div id="agency-tagline">' . esc_html( $option['govph_agency_tagline'] ) . '</div>
        </div>
       </div>';
			echo wp_kses_post( $add_logo );
			break;
		case 'govph_header_setting':
			$header_setting  = ( ! empty( $option['govph_headercolor'] ) ? 'background-color:' . $option['govph_headercolor'] . ';' : '' );
			$header_setting .= ( ! empty( $option['govph_headerimage'] ) ? 'background-image:url("' . esc_url( $option['govph_headerimage'] ) . '");' : '' );
			echo wp_kses( safecss_filter_attr( $header_setting ), array() );
			break;
		case 'govph_slider_setting':
			$slider_setting  = ( ! empty( $option['govph_sliderimage'] ) ? 'background-image:url("' . esc_url( $option['govph_sliderimage'] ) . '");background-size:cover;' : '' );
			$slider_setting .= ( ! empty( $option['govph_slidercolor'] ) ? 'background-color:' . $option['govph_slidercolor'] . ';' : '' );
			if ( 'true' === $option['govph_slider_fullwidth'] ) {
				$slider_setting .= 'padding: 0;';
				$slider_setting .= 'border-top: none;';
			}
			echo wp_kses( safecss_filter_attr( $slider_setting ), array() );
			break;
		case 'govph_anchorcolor':
			$anchor_color = ( ! empty( $option['govph_custom_anchorcolor'] ) ? 'color:' . $option['govph_custom_anchorcolor'] . ' !important;' : '' );
			echo wp_kses( safecss_filter_attr( $anchor_color ), array() );
			break;
		case 'govph_anchorcolor_hover':
			$anchor_color = ( ! empty( $option['govph_custom_anchorcolor_hover'] ) ? 'color:' . $option['govph_custom_anchorcolor_hover'] . ' !important;' : '' );
			echo wp_kses( safecss_filter_attr( $anchor_color ), array() );
			break;
		case 'govph_disable_search':
			return ( $option['govph_disable_search'] ? true : false );
		case 'govph_content_position':
			$content_class = 'large-12 medium-12 ';
			if ( is_active_sidebar( 'left-sidebar' ) ) {
				$content_class = 'large-8 medium-8 large-push-4 medium-push-4 ';
				if ( is_active_sidebar( 'right-sidebar' ) ) {
					$content_class = 'large-6 medium-6 large-push-3 medium-push-3 ';
				}
			} elseif ( is_active_sidebar( 'right-sidebar' ) ) {
				$content_class = 'large-8 medium-8 ';
			}
			echo esc_attr( $content_class );
			break;
		case 'govph_sidebar_position_left':
			$sidebar_class = '';
			if ( is_active_sidebar( 'left-sidebar' ) ) {
				$sidebar_class = 'large-4 medium-4 large-pull-8 medium-pull-8 ';
				if ( is_active_sidebar( 'right-sidebar' ) ) {
					$sidebar_class = 'large-3 medium-3 large-pull-6 medium-pull-6 ';
				}
			} elseif ( is_active_sidebar( 'right-sidebar' ) ) {
				$sidebar_class = 'large-4 medium-4 large-pull-8 medium-pull-8 ';
			}
			echo esc_attr( $sidebar_class );
			break;
		case 'govph_sidebar_position_right':
			$sidebar_class = '';
			if ( is_active_sidebar( 'left-sidebar' ) ) {
				$sidebar_class = 'large-4 medium-4 ';
				if ( is_active_sidebar( 'right-sidebar' ) ) {
					$sidebar_class = 'large-3 medium-3 ';
				}
			} elseif ( is_active_sidebar( 'right-sidebar' ) ) {
				$sidebar_class = 'large-4 medium-4 ';
			}
			echo esc_attr( $sidebar_class );
			break;
		case 'govph_sidebar_left':
			get_sidebar( 'left' );
			break;
		case 'govph_sidebar_right':
			get_sidebar( 'right' );
			break;
		case 'govph_panel_top':
			get_sidebar( 'panel-top' );
			break;
		case 'govph_position_panel_top':
			$ctr = 0;
			for ( $i = 1; $i < 5; $i++ ) {
				if ( is_active_sidebar( 'panel-top-' . $i ) ) {
					++$ctr;
				}
			}
			$val = '';
			if ( 1 === $ctr ) {
				$val = 'large-12 columns';
			}
			if ( 2 === $ctr ) {
				$val = 'large-6 columns';
			}
			if ( 3 === $ctr ) {
				$val = 'large-4 columns';
			}
			if ( 4 === $ctr ) {
				$val = 'large-3 columns';
			}

			echo esc_attr( $val );
			break;
		case 'govph_panel_bottom':
			get_sidebar( 'panel-bottom' );
			break;
		case 'govph_position_panel_bottom':
			$ctr = 0;
			for ( $i = 1; $i < 5; $i++ ) {
				if ( is_active_sidebar( 'panel-bottom-' . $i ) ) {
					++$ctr;
				}
			}
			$val = '';
			if ( 1 === $ctr ) {
				$val = 'large-12 columns';
			}
			if ( 2 === $ctr ) {
				$val = 'large-6 columns';
			}
			if ( 3 === $ctr ) {
				$val = 'large-4 columns';
			}
			if ( 4 === $ctr ) {
				$val = 'large-3 columns';
			}

			echo esc_attr( $val );
			break;
		case 'govph_position_agency_footer':
			$ctr = 0;
			for ( $i = 1; $i < 5; $i++ ) {
				if ( is_active_sidebar( 'footer-' . $i ) ) {
					++$ctr;
				}
			}
			$val = '';
			if ( 1 === $ctr ) {
				$val = 'large-12 columns';
			}
			if ( 2 === $ctr ) {
				$val = 'large-6 columns';
			}
			if ( 3 === $ctr ) {
				$val = 'large-4 columns';
			}
			if ( 4 === $ctr ) {
				$val = 'large-3 columns';
			}

			echo esc_attr( $val );
			break;
		case 'govph_slider_full':
			if ( 'true' === $option['govph_slider_fullwidth'] ) {
				return 'active';
			}
			break;
		case 'govph_slider_start':
			if ( 'true' === $option['govph_slider_fullwidth'] ) {
				echo '';
			} elseif ( 'true' !== $option['govph_slider_fullwidth'] || is_active_sidebar( 'banner-section-1' ) || is_active_sidebar( 'banner-section-2' ) ) {
				echo '<div class="row">';
			}
			break;
		case 'govph_slider_end':
			if ( 'true' === $option['govph_slider_fullwidth'] ) {
				echo '';
			} elseif ( 'true' !== $option['govph_slider_fullwidth'] || is_active_sidebar( 'banner-section-1' ) || is_active_sidebar( 'banner-section-2' ) ) {
				echo '</div>';
			}
			break;
		case 'govph_banner_title_start':
			if ( 'true' === $option['govph_slider_fullwidth'] ) {
				echo '<div class="row">';
			} elseif ( 'true' !== $option['govph_slider_fullwidth'] ) {
				echo '';
			}
			break;
		case 'govph_banner_title_end':
			if ( 'true' === $option['govph_slider_fullwidth'] ) {
				echo '</div>';
			} elseif ( 'true' !== $option['govph_slider_fullwidth'] ) {
				echo '';
			}
			break;
		case 'govph_slider_fullwidth':
			if ( 'true' !== $option['govph_slider_fullwidth'] ) {
				echo 'display: block;';
			} else {
				echo 'display: none;';
			}
			break;
		case 'govph_acc_link_statement':
			if ( ! empty( $option['govph_acc_link_statement'] ) ) {
				$value  = '';
				$value .= get_site_url() . '/';
				$value .= $option['govph_acc_link_statement'];
				return $value;
			}
			break;
		case 'govph_acc_link_contact':
			if ( ! empty( $option['govph_acc_link_contact'] ) ) {
				$value  = '';
				$value .= get_site_url() . '/';
				$value .= $option['govph_acc_link_contact'];
				return $value;
			}
			break;
		case 'govph_acc_link_feedback':
			if ( ! empty( $option['govph_acc_link_feedback'] ) ) {
				$value  = '';
				$value .= get_site_url() . '/';
				$value .= $option['govph_acc_link_feedback'];
				return $value;
			}
			break;
		case 'govph_acc_link_faq':
			if ( ! empty( $option['govph_acc_link_faq'] ) ) {
				$value  = '';
				$value .= get_site_url() . '/';
				$value .= $option['govph_acc_link_faq'];
				return $value;
			}
			break;
		case 'govph_acc_link_search':
			if ( ! empty( $option['govph_acc_link_search'] ) ) {
				$value  = '';
				$value .= get_site_url() . '/';
				$value  = $option['govph_acc_link_search'];
				return $value;
			}
			break;
		case 'govph_acc_link_home':
			$value  = '';
			$value .= get_site_url() . '/';
			$value .= isset( $option['govph_acc_link_home'] ) ? $option['govph_acc_link_home'] : '';
			return $value;
		case 'govph_acc_link_main_content':
			$value  = '';
			$value .= isset( $option['govph_acc_link_main_content'] ) ? $option['govph_acc_link_main_content'] : '#main-content';
			return $value;
		case 'govph_acc_link_sitemap':
			$value  = '';
			$value .= isset( $option['govph_acc_link_sitemap'] ) ? $option['govph_acc_link_sitemap'] : '#gwt-standard-footer';
			return $value;
		case 'govph_content_show_pub_date':
			return isset( $option['govph_content_show_pub_date'] ) ? $option['govph_content_show_pub_date'] : '';
		case 'govph_content_pub_date_lbl':
			return isset( $option['govph_content_pub_date_lbl'] ) ? $option['govph_content_pub_date_lbl'] : '';
		case 'govph_content_show_author':
			return isset( $option['govph_content_show_author'] ) ? $option['govph_content_show_author'] : '';
		case 'govph_content_pub_author_lbl':
			return isset( $option['govph_content_pub_author_lbl'] ) ? $option['govph_content_pub_author_lbl'] : '';
		case 'govph_custom_pst':
			$bg = ! empty( $option['govph_custom_pst'] ) ? 'color:' . sanitize_hex_color( $option['govph_custom_pst'] ) . ';' : '';
			echo wp_kses( safecss_filter_attr( $bg ), array() );
			break;
		case 'govph_custom_panel_top':
			$bg = ! empty( $option['govph_custom_panel_top'] ) ? 'background-color:' . sanitize_hex_color( $option['govph_custom_panel_top'] ) . ';' : '';
			echo wp_kses( safecss_filter_attr( $bg ), array() );
			break;
		case 'govph_custom_panel_bottom':
			$bg = ! empty( $option['govph_custom_panel_bottom'] ) ? 'background-color:' . sanitize_hex_color( $option['govph_custom_panel_bottom'] ) . ';' : '';
			echo wp_kses( safecss_filter_attr( $bg ), array() );
			break;
		case 'govph_widget_setting':
			$widget_setting  = isset( $option['govph_custom_border_width'] ) ? 'border:' . absint( $option['govph_custom_border_width'] ) . 'px solid' : '0';
			$widget_setting .= ( ! empty( $option['govph_custom_border_color'] ) ? ' ' . sanitize_hex_color( $option['govph_custom_border_color'] ) . ';' : '' );
			$widget_setting .= isset( $option['govph_custom_border_radius'] ) ? 'border-radius:' . absint( $option['govph_custom_border_radius'] ) . 'px ;' : '0';
			$widget_setting .= ( ! empty( $option['govph_custom_background_color'] ) ? 'background-color:' . sanitize_hex_color( $option['govph_custom_background_color'] ) . ';' : '' );
			echo wp_kses( safecss_filter_attr( $widget_setting ), array() );
			break;
		case 'govph_headings_setting':
			$headings  = ( ! empty( $option['govph_custom_headings_text'] ) ? 'text-transform:' . $option['govph_custom_headings_text'] . ';' : '' );
			$headings .= ( ! empty( $option['govph_custom_headings_size'] ) ? 'font-size:' . $option['govph_custom_headings_size'] . 'em;' : '' );
			echo wp_kses( safecss_filter_attr( $headings ), array() );
			break;
		case 'govph_inner_headings_setting':
			$size  = ( ! empty( $option['govph_custom_headings_inner_page_size'] ) ? 'font-size:' . $option['govph_custom_headings_inner_page_size'] . 'em;' : '' );
			$size .= ( ! empty( $option['govph_custom_headings_text'] ) ? 'text-transform:' . $option['govph_custom_headings_text'] . ';' : '' );
			echo wp_kses( safecss_filter_attr( $size ), array() );
			break;
		case 'govph_custom_footer_background_color':
			$bg = ( ! empty( $option['govph_custom_footer_background_color'] ) ? 'background-color:' . $option['govph_custom_footer_background_color'] . ';' : '' );
			echo wp_kses( safecss_filter_attr( $bg ), array() );
			break;
	}
}
