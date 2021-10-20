<?php
/**
 *  Plugin Name: پاسخ سریع به دیدگاه
 *  Plugin URI: http://siaeb.com
 *  Description: ارسال پاسخ سریع به دیدگاه ها !
 *  Author: سیاوش ابراهیمی
 *  Author URI: http://www.siaeb.com/
 *  Version: 1.0
 */


if ( ! class_exists( 'FastReply' ) ) :
	final class FastReply {

		/**
		 * @var EGL The one true FastReply
		 * @since 1.0
		 */
		private static $instance;

		/**
		 * @var \siaeb\fastreply\includes\Utility
		 */
		public $util;

		/**
		 * Main EGL Instance.
		 *
		 * Insures that only one instance of EGL exists in memory at any one
		 * time. Also prevents needing to define globals all over the place.
		 *
		 * @return object|FastReply The one true EGL
		 * @uses FastReply::constants() Setup the constants needed.
		 * @uses FastReply::includes() Include the required files.
		 * @see  FastReply()
		 * @since 1.0
		 * @static
		 * @staticvar array $instance
		 */
		public static function instance() {

			if ( ! isset( self::$instance ) && ! ( self::$instance instanceof FastReply ) ) {
				self::$instance = new FastReply();
				self::$instance->constants();
				self::$instance->includes();
				self::$instance->setupGlobals();
				self::$instance->init();
			}

			return self::$instance;
		}


		/**
		 * Throw error on object clone.
		 *
		 * The whole idea of the singleton design pattern is that there is a single
		 * object therefore, we don't want the object to be cloned.
		 *
		 * @return void
		 * @since 1.0
		 * @access protected
		 */
		public function __clone() {
			// Cloning instances of the class is forbidden.
			_doing_it_wrong( __FUNCTION__, __( 'Cheatin&#8217; huh?', "fastreply" ), '1.0' );
		}

		/**
		 * Disable unserializing of the class.
		 *
		 * @return void
		 * @since 1.0
		 * @access protected
		 */
		public function __wakeup() {
			// Unserializing instances of the class is forbidden.
			_doing_it_wrong( __FUNCTION__, __( 'Cheatin&#8217; huh?', "fastreply" ), '1.0' );
		}


		/**
		 * Initialize plugin !
		 *
		 * @return void
		 * @since 1.0
		 * @access public
		 */
		private function init() {
			new \siaeb\fastreply\includes\Ajax();
			new \siaeb\fastreply\includes\AssetsLoader();
			new \siaeb\fastreply\includes\Actions();
			new \siaeb\fastreply\includes\Filters();
			new \siaeb\fastreply\includes\Initializer();

			$this->util = new \siaeb\fastreply\includes\Utility();
		}

		/**
		 * Setup plugin constants.
		 *
		 * @access private
		 * @return void
		 * @since 1.0
		 */
		private function constants() {
			$this->defineConstant( 'FR_MAIN_FILE', __FILE__ );
			$this->defineConstant( 'FR_DIR', dirname( FR_MAIN_FILE ) . '/' );
			$this->defineConstant( 'FR_INCLUDES_DIR', FR_DIR . 'includes/' );
			$this->defineConstant( 'FR_VERSION', '1.0' );
			$this->defineConstant( 'FR_PREFIX', 'fr_' );
			$this->defineConstant( 'FR_PLUGIN_URL', trailingslashit( plugin_dir_url( __FILE__ ) ) );
			$this->defineConstant( 'FR_JS_URL', FR_PLUGIN_URL . 'assets/js/' );
			$this->defineConstant( 'FR_CSS_URL', FR_PLUGIN_URL . 'assets/css/' );
			$this->defineConstant( 'FR_IMAGES_URL', FR_PLUGIN_URL . 'assets/images/' );
		}

		/**
		 * Define constants
		 *
		 * @return void
		 * @since 1.0
		 */
		private function defineConstant( $name, $value ) {
			if ( ! defined( $name ) ) {
				define( $name, $value );
			}
		}

		/**
		 * Include required files.
		 *
		 * @access private
		 * @return void
		 * @since 1.0
		 */
		private function includes() {
			require_once FR_DIR . "/libs/cmb2/init.php";
			require_once FR_INCLUDES_DIR . 'autoload.php';
		}

		/**
		 * Setup global variables
		 *
		 * @return void
		 * @since 1.0
		 * @access private
		 */
		private function setupGlobals() {

		}

	}
endif;


/**
 * The main function for that returns FastReply
 *
 * The main function responsible for returning the one true FastReply
 * Instance to functions everywhere.
 *
 * Use this function like you would a global variable, except without needing
 * to declare the global.
 *
 * Example: <?php $fr = fr(); ?>
 *
 * @return object|FastReply The one true FastReply Instance.
 * @since 1.0
 */
function fr() {
	return FastReply::instance();
}

// Get FastReply Running.
fr();
