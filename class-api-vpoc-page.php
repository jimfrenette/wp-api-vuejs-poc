<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * WP_API_Vuejs_PoC_Page class.
 */
class WP_API_Vuejs_PoC_Page {

    /**
     * Access
     */
    private static $user_can = 'edit_posts';
    private static $page_slug = 'api-test';

    /**
     * Constructor.
     */
    public function __construct() {
        add_action( 'wp_enqueue_scripts', array( $this, 'page_scripts' ) );
        add_filter( 'the_content', array( $this, 'page_content' ) );
    }

    public function page_scripts() {
        if ( is_page( self::$page_slug ) ) {
            // load the Vue.js app
            wp_enqueue_script( 'wp-api-vuejs-poc', WAVP_PLUGIN_URL . 'dist/build.js', array(), false, true );

            // localize data for script
            wp_localize_script( 'wp-api-vuejs-poc', 'wp_api_vuejs_poc', array(
                'rest_url' => esc_url_raw( rest_url() ),
                'nonce' => wp_create_nonce( 'wp_rest' ),
                'success' => __( 'Post submitted', 'wp-api-vuejs-poc' ),
                'failure' => __( 'Post could not be processed.', 'wp-api-vuejs-poc' ),
                'current_user_id' => get_current_user_id()
                )
            );
        }
    }

    public function page_content($content) {
        if ( is_page( self::$page_slug ) ) {
            // output only to logged in users who can edit posts
            if ( is_user_logged_in() && current_user_can( self::$user_can ) ) {
                ob_start();?>
                <div id="app"></div>
                <?php
                $content .= ob_get_clean();
            }else{
                $content .=  sprintf( '<a href="%1s">%2s</a>', esc_url( wp_login_url() ), __( 'Log in', 'wp-api-vuejs-poc' ) );
            }
        }

        return $content;
    }

}

return new WP_API_Vuejs_PoC_Page();
