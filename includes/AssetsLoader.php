<?php


namespace siaeb\fastreply\includes;


class AssetsLoader {

	public function __construct() {
		add_action( 'admin_enqueue_scripts', [ $this, 'loadAdminAssets' ], 11 );
	}

	/**
	 * Load admin assets
	 *
	 * @since 1.0
	 */
	public function loadAdminAssets() {
		$option = get_option( "fast_reply_options" );
		// Styles
		wp_enqueue_style( FR_PREFIX . 'main', FR_CSS_URL . "/fast-reply.css" );
		// Scripts
		wp_enqueue_script( FR_PREFIX . 'main', FR_JS_URL . "/fast-reply.js", [], time(), true );
		wp_localize_script( FR_PREFIX . 'main', "fr_templates", isset( $option['templates'] ) ? $option['templates'] : [] );
	}

}
