<?php
/**
* pdmx - PlugDigital México
*/
class pdmx {
	public static function view( $name, array $args = array() ) {
		$args = apply_filters( 'pdmx_view_arguments', $args, $name );
		
		foreach ( $args AS $key => $val ) {
			$$key = $val;
		}
		
		load_plugin_textdomain( 'PlugDigital' );

		$file = PLUGDIGITAL__PLUGIN_DIR . 'views/'. $name . '.php';

		include( $file );
	}

	// Add options page
	public static function pdmx_settings_menu() {
		add_options_page( 'Optimización y Rendimiento', 'Optimización y Rendimiento', 'manage_options', 'pdmx-settings-menu', 'pdmx_start_page' );
	}
} // class pdmx end

// Add Plug Digital link at top bar
function pdmx_add_our_link(){
	global $wp_admin_bar;

	$wp_admin_bar->add_menu( array(
		'id'    => 'plugdigital-site',
		'title' => 'Plug Digital',
		'href'  => 'https://www.plugdigital.net'
	) );
}
add_action( 'wp_before_admin_bar_render', 'pdmx_add_our_link' );

// Add Powered By Plug Digital at login form
function pdmx_login_powered() {
	pdmx::view('powered-by');
}
add_action( 'login_footer', 'pdmx_login_powered' );

function pdmx_start_page() {
	pdmx::view('start');
}
add_action( 'admin_menu', 'pdmx::pdmx_settings_menu' );