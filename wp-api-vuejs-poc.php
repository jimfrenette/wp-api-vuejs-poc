<?php
/**
 * Plugin Name: WP API Vue.js Proof of Concept
 * Plugin URL: http://jimfrenette.com/wordpress
 * Description: WordPress plugin to edit posts from the front end using the new REST API and Vue.js UI
 * Version: 1.0
 * Author: Jim Frenette
 * Author URI: http://jimfrenette.com
 * Text Domain: wp-api-vuejs-poc
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

if ( ! class_exists( 'WP_API_Vuejs_PoC' ) ) :

/**
 * Main WP_API_Vuejs_PoC Class.
 *
 * @class WP_API_Vuejs_PoC
 * @version    1.0
 * @dependencies page slug, e.g., "api-test"
 */
final class WP_API_Vuejs_PoC {

    /**
     * The single instance of the class.
     *
     * @var WP_API_Vuejs_PoC
     * @since 1.0
     */
    protected static $_instance = null;

    /**
     * Main WP_API_Vuejs_PoC Instance.
     *
     * Ensures only one instance of WP_API_Vuejs_PoC is loaded or can be loaded.
     *
     * @since 1.0
     * @static
     * @see WAVP()
     * @return WP_API_Vuejs_PoC - Main instance.
     */
    public static function instance() {
        if ( is_null( self::$_instance ) ) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    /**
     * Cloning is forbidden.
     * @since 1.0
     */
    public function __clone() {
        _doing_it_wrong( __FUNCTION__, __( 'Cheatin&#8217; huh?', 'wp-api-vuejs-poc' ), '1.0' );
    }

    /**
     * Unserializing instances of this class is forbidden.
     * @since 1.0
     */
    public function __wakeup() {
        _doing_it_wrong( __FUNCTION__, __( 'Cheatin&#8217; huh?', 'wp-api-vuejs-poc' ), '1.0' );
    }

    /**
     * WP_API_Vuejs_PoC Constructor.
     */
    public function __construct() {
        $this->define_constants();
        $this->includes();

        do_action( 'wp-api-vuejs-poc_loaded' );
    }

    /**
     * Define WAVP Constants.
     */
    private function define_constants() {
        $this->define( 'WAVP_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );
        $this->define( 'WAVP_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
    }

    /**
     * Define constant if not already set.
     *
     * @param  string $name
     * @param  string|bool $value
     */
    private function define( $name, $value ) {
        if ( ! defined( $name ) ) {
            define( $name, $value );
        }
    }

    /**
     * What type of request is this?
     *
     * @param  string $type admin, ajax, cron or frontend.
     * @return bool
     */
    private function is_request( $type ) {
        switch ( $type ) {
            case 'admin' :
                return is_admin();
            case 'ajax' :
                return defined( 'DOING_AJAX' );
            case 'cron' :
                return defined( 'DOING_CRON' );
            case 'frontend' :
                return ( ! is_admin() || defined( 'DOING_AJAX' ) ) && ! defined( 'DOING_CRON' );
        }
    }

    public function includes() {
        if ( $this->is_request( 'frontend' ) ) {
            include( 'class-api-vpoc-page.php' );
        }
    }

}

endif;

/**
 * Main instance of WP_API_Vuejs_PoC.
 *
 * Returns the main instance of WAVP to prevent the need to use globals.
 *
 * @since  1.0
 * @return WP_API_Vuejs_PoC
 */
function WAVP() {
    return WP_API_Vuejs_PoC::instance();
}

// Global for backwards compatibility.
$GLOBALS['wp-api-vuejs-poc'] = WAVP();
