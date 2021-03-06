<?php
/**
 * Sample implementation of the Custom Header feature.
 *
 * You can add an optional custom header image to header.php like so ...
 *
	<?php if ( get_header_image() ) : ?>
	<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
		<img src="<?php header_image(); ?>" width="<?php echo esc_attr( get_custom_header()->width ); ?>" height="<?php echo esc_attr( get_custom_header()->height ); ?>" alt="">
	</a>
	<?php endif; // End header image check. ?>
 *
 * @link https://developer.wordpress.org/themes/functionality/custom-headers/
 *
 * @package Pfersick
 */


/**
 * Add logo to site branding.
 */
function pfersick_site_logo() {
	$css = <<<'HTML'
	<style>
		.site-branding {
			background-image: url(%s);
		}
	</style>
HTML;

	printf( $css, esc_url( get_stylesheet_directory_uri() . '/images/felicity.svg' ) );
}
add_action( 'wp_head', 'pfersick_site_logo' );

/**
 * Set up the WordPress core custom header feature.
 *
 * @uses pfersick_header_style()
 */
function pfersick_custom_header_setup() {
	add_theme_support( 'custom-header', apply_filters( 'pfersick_custom_header_args', array(
		'default-image'          => '',
		'default-text-color'     => '005c60',
		'width'                  => 1200,
		'height'                 => 320,
		'flex-height'            => true,
		'wp-head-callback'       => 'pfersick_header_style',
	) ) );
}
add_action( 'after_setup_theme', 'pfersick_custom_header_setup' );

if ( ! function_exists( 'pfersick_header_style' ) ) :
/**
 * Styles the header image and text displayed on the blog.
 *
 * @see pfersick_custom_header_setup().
 */
function pfersick_header_style() {
	$header_text_color = get_header_textcolor();

	/*
	 * If no custom options for text are set, let's bail.
	 * get_header_textcolor() options: Any hex value, 'blank' to hide text. Default: HEADER_TEXTCOLOR.
	 */
	if ( HEADER_TEXTCOLOR === $header_text_color ) {
		return;
	}

	// If we get this far, we have custom styles. Let's do this.
	?>
	<style type="text/css">
	<?php
		// Has the text been hidden?
		if ( ! display_header_text() ) :
	?>
		.site-title,
		.site-description {
			position: absolute;
			clip: rect(1px, 1px, 1px, 1px);
		}
	<?php
		// If the user has set a custom color for the text use that.
		else :
	?>
		.site-title a,
		.site-description {
			color: #<?php echo esc_attr( $header_text_color ); ?>;
		}
	<?php endif; ?>
	</style>
	<?php
}
endif;
