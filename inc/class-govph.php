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
	<div class="wrap govph-options-page">
	<h1>Theme Options</h1>
	<p>Configure your site branding, layout, content, and accessibility links.</p>
	<nav class="govph-options-nav" aria-label="Theme options sections">
		<span>Jump to:</span>
		<a href="#govph-branding-anchor">Site identity and search</a>
		<a href="#govph-layout-anchor">Header, slider, and navigation</a>
		<a href="#govph-styling-anchor">Theme styling</a>
		<a href="#govph-publishing-anchor">Publishing</a>
		<a href="#govph-accessibility-anchor">Accessibility</a>
	</nav>
	<form action="options.php" method="post" enctype="multipart/form-data">
		<?php settings_fields( 'govph_options' ); ?>
		<?php submit_button( __( 'Save Changes', 'gwt_wp' ), 'primary', 'submit_top', false ); ?>
		<?php do_settings_sections( __FILE__ ); ?>
		<?php submit_button( __( 'Save Changes', 'gwt_wp' ) ); ?>
	</form>
	</div>
		<?php
	}

	/**
	 * Registers theme settings, sections, and fields.
	 */
	public function register_settings_fields() {
		register_setting( 'govph_options', 'govph_options' );
		add_settings_section( 'govph_branding_section', 'Site Identity and Search', array( $this, 'govph_main_section_cb' ), __FILE__ );
		add_settings_section( 'govph_layout_section', 'Header, Slider, and Navigation', array( $this, 'govph_general_section' ), __FILE__ );
		add_settings_section( 'govph_styling_section', 'Theme Styling', array( $this, 'govph_custom_section' ), __FILE__ );
		add_settings_section( 'govph_publishing_section', 'Publishing', array( $this, 'govph_content_section' ), __FILE__ );
		add_settings_section( 'govph_accessibility_section', 'Accessibility', array( $this, 'govph_acc_link_section' ), __FILE__ );

		add_settings_field( 'govph_disable_search', 'Search', array( $this, 'govph_disable_search' ), __FILE__, 'govph_branding_section', array( 'label_for' => 'govph_disable_search_input' ) );
		add_settings_field( 'govph_logo_enable', 'Image logo', array( $this, 'govph_logo_enable' ), __FILE__, 'govph_branding_section', array( 'label_for' => 'govph_logo_enable_input' ) );
		add_settings_field( 'govph_agency_name', 'Agency name', array( $this, 'govph_agency_name' ), __FILE__, 'govph_branding_section', array( 'label_for' => 'govph_agency_name' ) );
		add_settings_field( 'govph_agency_tagline', 'Agency tagline', array( $this, 'govph_agency_tagline' ), __FILE__, 'govph_branding_section', array( 'label_for' => 'govph_agency_tagline' ) );
		add_settings_field( 'govph_header_font_color', 'Header text color', array( $this, 'govph_header_font_color' ), __FILE__, 'govph_branding_section', array( 'label_for' => 'color-field-header-font' ) );
		add_settings_field( 'govph_logo_position', 'Logo position', array( $this, 'govph_logo_position_setting' ), __FILE__, 'govph_branding_section', array( 'label_for' => 'govph_logo_position_left' ) );
		add_settings_field( 'govph_logo', 'Logo image', array( $this, 'govph_logo_setting' ), __FILE__, 'govph_branding_section', array( 'label_for' => 'upload_image' ) );

		add_settings_field( 'govph_headercolor', 'Header background color', array( $this, 'govph_header_color_setting' ), __FILE__, 'govph_layout_section', array( 'label_for' => 'color-field-header-bg' ) );
		add_settings_field( 'govph_headerimage', 'Header background image', array( $this, 'govph_header_image_setting' ), __FILE__, 'govph_layout_section', array( 'label_for' => 'header_image_background' ) );
		add_settings_field( 'govph_slidercolor', 'Slider background color', array( $this, 'govph_slider_color_setting' ), __FILE__, 'govph_layout_section', array( 'label_for' => 'color-field-slider' ) );
		add_settings_field( 'govph_sliderimage', 'Slider background image', array( $this, 'govph_slider_image_setting' ), __FILE__, 'govph_layout_section', array( 'label_for' => 'slider_image_background' ) );
		add_settings_field( 'govph_slider_fullwidth', 'Slider width', array( $this, 'govph_slider_fullwidth' ), __FILE__, 'govph_layout_section', array( 'label_for' => 'govph_slider_fullwidth_input' ) );
		add_settings_field( 'govph_breadcrumbs_enable', 'Breadcrumbs', array( $this, 'govph_breadcrumbs_enable' ), __FILE__, 'govph_layout_section', array( 'label_for' => 'govph_breadcrumbs_enable_input' ) );
		add_settings_field( 'govph_breadcrumbs_separator', 'Breadcrumb separator', array( $this, 'govph_breadcrumbs_separator' ), __FILE__, 'govph_layout_section', array( 'label_for' => 'govph_breadcrumbs_separator_input' ) );
		add_settings_field( 'govph_breadcrumbs_show_home', 'Breadcrumb home link', array( $this, 'govph_breadcrumbs_show_home' ), __FILE__, 'govph_layout_section', array( 'label_for' => 'govph_breadcrumbs_show_home_input' ) );

		add_settings_field( 'govph_custom_pst', 'Philippine Standard Time text', array( $this, 'govph_custom_pst' ), __FILE__, 'govph_styling_section', array( 'label_for' => 'color-field-pst' ) );
		add_settings_field( 'govph_custom_anchorcolor', 'Link color', array( $this, 'govph_custom_anchorcolor' ), __FILE__, 'govph_styling_section', array( 'label_for' => 'color-field-anchor' ) );
		add_settings_field( 'govph_custom_anchorcolor_hover', 'Link hover color', array( $this, 'govph_custom_anchorcolor_hover' ), __FILE__, 'govph_styling_section', array( 'label_for' => 'color-field-anchor-hover' ) );
		add_settings_field( 'govph_custom_panel_top', 'Top panel color', array( $this, 'govph_custom_panel_top' ), __FILE__, 'govph_styling_section', array( 'label_for' => 'color-field-panel-top' ) );
		add_settings_field( 'govph_custom_panel_bottom', 'Bottom panel color', array( $this, 'govph_custom_panel_bottom' ), __FILE__, 'govph_styling_section', array( 'label_for' => 'color-field-panel-bottom' ) );
		add_settings_field( 'govph_custom_border_width', 'Border width', array( $this, 'govph_custom_border_width' ), __FILE__, 'govph_styling_section', array( 'label_for' => 'govph_custom_border_width_input' ) );
		add_settings_field( 'govph_custom_border_radius', 'Border radius', array( $this, 'govph_custom_border_radius' ), __FILE__, 'govph_styling_section', array( 'label_for' => 'govph_custom_border_radius_input' ) );
		add_settings_field( 'govph_custom_border_color', 'Border color', array( $this, 'govph_custom_border_color' ), __FILE__, 'govph_styling_section', array( 'label_for' => 'color-field-border-color' ) );
		add_settings_field( 'govph_custom_background_color', 'Content and widget background color', array( $this, 'govph_custom_background_color' ), __FILE__, 'govph_styling_section', array( 'label_for' => 'color-field-widget-bg' ) );
		add_settings_field( 'govph_custom_headings_text', 'Blog title text style', array( $this, 'govph_custom_headings_text' ), __FILE__, 'govph_styling_section', array( 'label_for' => 'govph_custom_headings_text_input' ) );
		add_settings_field( 'govph_custom_headings_size', 'Blog title size', array( $this, 'govph_custom_headings_size' ), __FILE__, 'govph_styling_section', array( 'label_for' => 'govph_custom_headings_size_input' ) );
		add_settings_field( 'govph_custom_headings_inner_page_size', 'Inner page title size', array( $this, 'govph_custom_headings_inner_page_size' ), __FILE__, 'govph_styling_section', array( 'label_for' => 'govph_custom_headings_inner_page_size_input' ) );
		add_settings_field( 'govph_custom_footer_background_color', 'Agency footer background color', array( $this, 'govph_custom_footer_background_color' ), __FILE__, 'govph_styling_section', array( 'label_for' => 'color-field-footer-bg' ) );

		add_settings_field( 'govph_content_show_pub_date', 'Published date', array( $this, 'govph_content_show_pub_date' ), __FILE__, 'govph_publishing_section', array( 'label_for' => 'govph_content_show_pub_date_input' ) );
		add_settings_field( 'govph_content_pub_date_lbl', 'Published date label', array( $this, 'govph_content_pub_date_lbl' ), __FILE__, 'govph_publishing_section', array( 'label_for' => 'govph_content_pub_date_lbl_input' ) );
		add_settings_field( 'govph_content_show_author', 'Publisher', array( $this, 'govph_content_show_author' ), __FILE__, 'govph_publishing_section', array( 'label_for' => 'govph_content_show_author_input' ) );
		add_settings_field( 'govph_content_pub_author_lbl', 'Publisher label', array( $this, 'govph_content_pub_author_lbl' ), __FILE__, 'govph_publishing_section', array( 'label_for' => 'govph_content_pub_author_lbl_input' ) );

		add_settings_field( 'govph_acc_link_statement', 'Accessibility statement (0)', array( $this, 'govph_acc_link_statement' ), __FILE__, 'govph_accessibility_section', array( 'label_for' => 'govph_acc_link_statement_input' ) );
		add_settings_field( 'govph_acc_link_home', 'Home page (H)', array( $this, 'govph_acc_link_home' ), __FILE__, 'govph_accessibility_section', array( 'label_for' => 'govph_acc_link_home_input' ) );
		add_settings_field( 'govph_acc_link_main_content', 'Main content (R)', array( $this, 'govph_acc_link_main_content' ), __FILE__, 'govph_accessibility_section', array( 'label_for' => 'govph_acc_link_main_content_input' ) );
		add_settings_field( 'govph_acc_link_contact', 'Contact (C)', array( $this, 'govph_acc_link_contact' ), __FILE__, 'govph_accessibility_section', array( 'label_for' => 'govph_acc_link_contact_input' ) );
		add_settings_field( 'govph_acc_link_feedback', 'Feedback (K)', array( $this, 'govph_acc_link_feedback' ), __FILE__, 'govph_accessibility_section', array( 'label_for' => 'govph_acc_link_feedback_input' ) );
		add_settings_field( 'govph_acc_link_faq', 'FAQ (Q)', array( $this, 'govph_acc_link_faq' ), __FILE__, 'govph_accessibility_section', array( 'label_for' => 'govph_acc_link_faq_input' ) );
		add_settings_field( 'govph_acc_link_sitemap', 'Site map (M)', array( $this, 'govph_acc_link_sitemap' ), __FILE__, 'govph_accessibility_section', array( 'label_for' => 'govph_acc_link_sitemap_input' ) );
		add_settings_field( 'govph_acc_link_search', 'Search page (S)', array( $this, 'govph_acc_link_search' ), __FILE__, 'govph_accessibility_section', array( 'label_for' => 'govph_acc_link_search_input' ) );
	}

	/**
	 * Describes the branding settings.
	 */
	public function govph_main_section_cb() {
		echo '<span class="govph-options-anchor" id="govph-branding-anchor" tabindex="-1"></span>';
		echo '<p>Set the agency identity and choose whether to show a search field.</p>';
	}

	/**
	 * Describes the header, slider, and navigation settings.
	 */
	public function govph_general_section() {
		echo '<span class="govph-options-anchor" id="govph-layout-anchor" tabindex="-1"></span>';
		echo '<p>Customize the site header and slider, and configure breadcrumb navigation.</p>';
	}

	/**
	 * Renders the search visibility control.
	 */
	public function govph_disable_search() {
		?>
	<label for="govph_disable_search_input">
		<input id="govph_disable_search_input" type="checkbox" name="govph_options[govph_disable_search]" value="true" <?php checked( 'true', $this->options['govph_disable_search'] ); ?>>
		Show the search field
	</label>
		<?php
	}

	/**
	 * Renders the logo position controls.
	 */
	public function govph_logo_position_setting() {
		?>
	<fieldset>
		<legend class="screen-reader-text">Logo position</legend>
	<label><input id="govph_logo_position_left" type="radio" name="govph_options[govph_logo_position]" value="left" <?php checked( 'left', $this->options['govph_logo_position'] ); ?>> Left</label><br>
	<label><input type="radio" name="govph_options[govph_logo_position]" value="center" <?php checked( 'center', $this->options['govph_logo_position'] ); ?>> Center</label>
	</fieldset>
	<p class="description">Choose where the logo appears in the header.</p>
		<?php
	}

	/**
	 * Renders the logo image field.
	 */
	public function govph_logo_setting() {
		?>
	<input id="upload_image" type="url" class="regular-text" name="govph_options[govph_logo]" value="<?php echo esc_attr( $this->options['govph_logo'] ); ?>" />
	<input id="upload_image_button" class="button" type="button" value="Choose logo" />
	<p class="description">Enter an image URL or choose an image from the Media Library.</p>
	<div id="upload_image_preview" class="govph-image-preview" <?php echo empty( $this->options['govph_logo'] ) ? 'hidden' : ''; ?>>
		<img <?php echo ! empty( $this->options['govph_logo'] ) ? 'src="' . esc_url( $this->options['govph_logo'] ) . '"' : ''; ?> alt="Selected logo preview" <?php echo empty( $this->options['govph_logo'] ) ? 'hidden' : ''; ?>>
		<button class="button govph-remove-image" type="button" data-target="upload_image">Remove logo</button>
	</div>
		<?php
	}

	/**
	 * Renders the image logo enable controls.
	 */
	public function govph_logo_enable() {
		$logo_enable_option = isset( $this->options['govph_logo_enable'] ) ? $this->options['govph_logo_enable'] : 1;
		?>
	<fieldset>
		<legend class="screen-reader-text">Choose the site header branding</legend>
	<label><input type="radio" name="govph_options[govph_logo_enable]" id="govph_logo_enable_input" value="1" <?php checked( 1, absint( $logo_enable_option ) ); ?>> Use an image logo</label><br>
	<label><input type="radio" name="govph_options[govph_logo_enable]" id="govph_logo_disable_input" value="0" <?php checked( 0, absint( $logo_enable_option ) ); ?>> Use the agency name</label>
	</fieldset>
	<p class="description">When enabled, the image logo replaces the agency name in the header.</p>
		<?php
	}

	/**
	 * Renders the agency name field.
	 */
	public function govph_agency_name() {
		$value = $this->options['govph_agency_name'] ? $this->options['govph_agency_name'] : '';
		?>
	<input id="govph_agency_name" type="text" class="regular-text" name="govph_options[govph_agency_name]" value="<?php echo esc_attr( $value ); ?>"><br/>
	<span class="description">The agency website name.</span>
		<?php
	}

	/**
	 * Renders the agency tagline field.
	 */
	public function govph_agency_tagline() {
		$value = $this->options['govph_agency_tagline'] ? $this->options['govph_agency_tagline'] : '';
		?>
	<input id="govph_agency_tagline" type="text" class="regular-text" name="govph_options[govph_agency_tagline]" value="<?php echo esc_attr( $value ); ?>"><br/>
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
	<input id="header_image_background" type="url" class="regular-text" name="govph_options[govph_headerimage]" value="<?php echo esc_attr( $this->options['govph_headerimage'] ); ?>" />
	<input id="header_image_background_button" class="button" type="button" value="Choose image" aria-label="Choose header background image" />
	<p class="description">Enter an image URL or choose a background image from the Media Library.</p>
	<div id="header_image_background_preview" class="govph-image-preview" <?php echo empty( $this->options['govph_headerimage'] ) ? 'hidden' : ''; ?>>
		<img <?php echo ! empty( $this->options['govph_headerimage'] ) ? 'src="' . esc_url( $this->options['govph_headerimage'] ) . '"' : ''; ?> alt="Selected header background preview" <?php echo empty( $this->options['govph_headerimage'] ) ? 'hidden' : ''; ?>>
		<button class="button govph-remove-image" type="button" data-target="header_image_background">Remove header image</button>
	</div>
		<?php
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
	<input id="slider_image_background" type="url" class="regular-text" name="govph_options[govph_sliderimage]" value="<?php echo esc_attr( $this->options['govph_sliderimage'] ); ?>" />
	<input id="slider_image_background_button" class="button" type="button" value="Choose image" aria-label="Choose slider background image" />
	<p class="description">Enter an image URL or choose a background image from the Media Library.</p>
	<div id="slider_image_background_preview" class="govph-image-preview" <?php echo empty( $this->options['govph_sliderimage'] ) ? 'hidden' : ''; ?>>
		<img <?php echo ! empty( $this->options['govph_sliderimage'] ) ? 'src="' . esc_url( $this->options['govph_sliderimage'] ) . '"' : ''; ?> alt="Selected slider background preview" <?php echo empty( $this->options['govph_sliderimage'] ) ? 'hidden' : ''; ?>>
		<button class="button govph-remove-image" type="button" data-target="slider_image_background">Remove slider image</button>
	</div>
		<?php
	}

	/**
	 * Renders the slider width control.
	 */
	public function govph_slider_fullwidth() {
		?>
	<label for="govph_slider_fullwidth_input">
		<input id="govph_slider_fullwidth_input" type="checkbox" name="govph_options[govph_slider_fullwidth]" value="true" <?php checked( 'true', $this->options['govph_slider_fullwidth'] ); ?>>
		Stretch the slider to the full width of the page
	</label>
		<?php
	}

	/**
	 * Renders the breadcrumb enable control.
	 */
	public function govph_breadcrumbs_enable() {
		?>
	<label for="govph_breadcrumbs_enable_input">
		<input id="govph_breadcrumbs_enable_input" type="checkbox" name="govph_options[govph_breadcrumbs_enable]" value="true" <?php checked( 'true', $this->options['govph_breadcrumbs_enable'] ); ?>>
		Show breadcrumbs
	</label>
		<?php
	}

	/**
	 * Renders the breadcrumb separator field.
	 */
	public function govph_breadcrumbs_separator() {
		$value = $this->options['govph_breadcrumbs_separator'] ? $this->options['govph_breadcrumbs_separator'] : ' › ';
		?>
	<input id="govph_breadcrumbs_separator_input" type="text" class="regular-text" name="govph_options[govph_breadcrumbs_separator]" value="<?php echo esc_attr( $value ); ?>"><br/>
	<span class="description">Separator symbol in between breadcrumb links</span>
		<?php
	}

	/**
	 * Renders the breadcrumb home-link control.
	 */
	public function govph_breadcrumbs_show_home() {
		?>
	<label for="govph_breadcrumbs_show_home_input">
		<input id="govph_breadcrumbs_show_home_input" type="checkbox" name="govph_options[govph_breadcrumbs_show_home]" value="true" <?php checked( 'true', $this->options['govph_breadcrumbs_show_home'] ); ?>>
		Show a home link at the start of breadcrumbs
	</label>
		<?php
	}

	/**
	 * Describes the theme styling settings.
	 */
	public function govph_custom_section() {
		echo '<span class="govph-options-anchor" id="govph-styling-anchor" tabindex="-1"></span>';
		echo '<p>Adjust theme colors, borders, and heading styles.</p>';
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
	<select id="govph_custom_border_width_input" name="govph_options[govph_custom_border_width]">
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
	<select id="govph_custom_border_radius_input" name="govph_options[govph_custom_border_radius]">
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
	<select id="govph_custom_headings_text_input" name="govph_options[govph_custom_headings_text]">
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
	<select id="govph_custom_headings_size_input" name="govph_options[govph_custom_headings_size]">
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
	<select id="govph_custom_headings_inner_page_size_input" name="govph_options[govph_custom_headings_inner_page_size]">
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
	 * Describes the publishing settings.
	 */
	public function govph_content_section() {
		echo '<span class="govph-options-anchor" id="govph-publishing-anchor" tabindex="-1"></span>';
		echo '<p>Choose which post details to display and customize their labels.</p>';
	}

	/**
	 * Renders the published date visibility control.
	 */
	public function govph_content_show_pub_date() {
		?>
	<label for="govph_content_show_pub_date_input">
		<input id="govph_content_show_pub_date_input" type="checkbox" name="govph_options[govph_content_show_pub_date]" value="true" <?php checked( 'true', $this->options['govph_content_show_pub_date'] ); ?>>
		Show the published date on posts
	</label>
		<?php
	}

	/**
	 * Renders the published date label field.
	 */
	public function govph_content_pub_date_lbl() {
		$default = ! empty( $this->options['govph_content_pub_date_lbl'] ) ? $this->options['govph_content_pub_date_lbl'] : 'Posted on';
		?>
	<input id="govph_content_pub_date_lbl_input" type="text" class="regular-text" name="govph_options[govph_content_pub_date_lbl]" value="<?php echo esc_attr( $default ); ?>"><br/>
	<span class="description">Publish date display label</span>
		<?php
	}

	/**
	 * Renders the author visibility control.
	 */
	public function govph_content_show_author() {
		?>
	<label for="govph_content_show_author_input">
		<input id="govph_content_show_author_input" type="checkbox" name="govph_options[govph_content_show_author]" value="true" <?php checked( 'true', $this->options['govph_content_show_author'] ); ?>>
		Show the publisher on posts
	</label>
		<?php
	}

	/**
	 * Renders the author label field.
	 */
	public function govph_content_pub_author_lbl() {
		$default = ! empty( $this->options['govph_content_pub_author_lbl'] ) ? $this->options['govph_content_pub_author_lbl'] : 'by';
		?>
	<input id="govph_content_pub_author_lbl_input" type="text" class="regular-text" name="govph_options[govph_content_pub_author_lbl]" value="<?php echo esc_attr( $default ); ?>"><br/>
	<span class="description">Publish author display label<br/></span>
		<?php
	}

	/**
	 * Describes accessibility shortcuts and link settings.
	 */
	public function govph_acc_link_section() {
		?>
	<span class="govph-options-anchor" id="govph-accessibility-anchor" tabindex="-1"></span>
	<p>Set destinations for keyboard shortcuts. The key combination depends on the browser:</p>
	<ul>
		<li>Chrome on Linux and Firefox: Alt + Shift + the shortcut key</li>
			<li>Chrome on Windows: Alt + the shortcut key</li>
			<li>Internet Explorer: Alt + Shift + the shortcut key, then Enter</li>
			<li>macOS: Control + Option + the shortcut key</li>
	</ul>
		<p class="description">Shortcuts configured by this theme: 0 (accessibility statement), H (home), R (main content), C (contact), K (feedback), Q (FAQ), M (site map), and S (search).</p>
			<?php
	}

	/**
	 * Renders the accessibility statement link field.
	 */
	public function govph_acc_link_statement() {
		$value = $this->options['govph_acc_link_statement'] ? $this->options['govph_acc_link_statement'] : '';
		?>
	<span class="field-prefix"><?php echo esc_url( get_site_url() ); ?>/ </span>
	<input id="govph_acc_link_statement_input" type="text" class="regular-text" name="govph_options[govph_acc_link_statement]" value="<?php echo esc_attr( $value ); ?>"><br/>
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
	<input id="govph_acc_link_home_input" type="text" class="regular-text" name="govph_options[govph_acc_link_home]" value="<?php echo esc_attr( $value ); ?>"><br/>
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
	<input id="govph_acc_link_main_content_input" type="text" class="regular-text" name="govph_options[govph_acc_link_main_content]" value="<?php echo esc_attr( $value ); ?>"><br/>
	<span class="description">Default: #main-content</span>
		<?php
	}

	/**
	 * Renders the contact shortcut link field.
	 */
	public function govph_acc_link_contact() {
		?>
	<span class="field-prefix"><?php echo esc_url( get_site_url() ); ?>/ </span>
	<input id="govph_acc_link_contact_input" type="text" class="regular-text" name="govph_options[govph_acc_link_contact]" value="<?php echo esc_attr( $this->options['govph_acc_link_contact'] ); ?>">
		<?php
	}

	/**
	 * Renders the feedback shortcut link field.
	 */
	public function govph_acc_link_feedback() {
		?>
	<span class="field-prefix"><?php echo esc_url( get_site_url() ); ?>/ </span>
	<input id="govph_acc_link_feedback_input" type="text" class="regular-text" name="govph_options[govph_acc_link_feedback]" value="<?php echo esc_attr( $this->options['govph_acc_link_feedback'] ); ?>">
		<?php
	}

	/**
	 * Renders the FAQ shortcut link field.
	 */
	public function govph_acc_link_faq() {
		?>
	<span class="field-prefix"><?php echo esc_url( get_site_url() ); ?>/ </span>
	<input id="govph_acc_link_faq_input" type="text" class="regular-text" name="govph_options[govph_acc_link_faq]" value="<?php echo esc_attr( $this->options['govph_acc_link_faq'] ); ?>">
		<?php
	}

	/**
	 * Renders the sitemap shortcut link field.
	 */
	public function govph_acc_link_sitemap() {
		$value = $this->options['govph_acc_link_sitemap'] ? $this->options['govph_acc_link_sitemap'] : '#gwt-standard-footer';
		?>
	<span class="field-prefix">{current_url}/ </span>
	<input id="govph_acc_link_sitemap_input" type="text" class="regular-text" name="govph_options[govph_acc_link_sitemap]" value="<?php echo esc_attr( $value ); ?>"><br/>
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
	<input id="govph_acc_link_search_input" type="text" class="regular-text" name="govph_options[govph_acc_link_search]" value="<?php echo esc_attr( $this->options['govph_acc_link_search'] ); ?>"><br/>
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
	if ( 'appearance_page_govph-options' !== $hook_suffix ) {
		return;
	}

	// Enqueue media and color-picker assets for the options page.
	wp_enqueue_media();
	wp_enqueue_style( 'wp-color-picker' );
	wp_add_inline_style(
		'wp-color-picker',
		'.govph-options-nav{position:sticky;top:32px;z-index:10;display:flex;flex-wrap:wrap;align-items:center;gap:8px 16px;margin:16px 0 20px;padding:12px 16px;background:#fff;border:1px solid #c3c4c7;box-shadow:0 2px 4px rgba(0,0,0,.08)}.govph-options-nav a{font-weight:600}.govph-options-nav a:focus,.govph-options-anchor:focus,.govph-options-page h2:focus{outline:2px solid #2271b1;outline-offset:2px}.govph-options-anchor{display:block;scroll-margin-top:100px}.govph-options-page input.regular-text,.govph-options-page select{max-width:100%}.govph-options-page .field-prefix{display:inline-block;max-width:100%;overflow-wrap:anywhere}.govph-image-preview{margin-top:8px}.govph-image-preview img{display:block;width:auto;max-width:min(100%,400px);max-height:200px;object-fit:contain}.govph-image-preview button{margin-top:6px}@media(max-width:782px){.govph-options-nav{position:static;gap:8px 12px}.govph-options-anchor{scroll-margin-top:24px}.govph-options-page .form-table th,.govph-options-page .form-table td{display:block;width:auto;padding:8px 10px}.govph-options-page .form-table th{padding-bottom:0}.govph-options-page input.regular-text{width:100%}}'
	);
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
