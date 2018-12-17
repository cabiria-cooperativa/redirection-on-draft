<?php
/**
 * Plugin Name: Redirection On Draft
 * Plugin URI: https://www.cabiria.net
 * Description: Se una pagina è un bozza esegue una redirezione alla home
 * Version: 1.0.0
 * Author: Cabiria
 * Author URI: https://www.cabiria.net
 * Text Domain: cabi
 */

class RedirectionOnDraft {
    
    function __construct() {
        add_action('wp_enqueue_scripts', array($this, 'init'));
        add_action( 'template_redirect', array($this, 'redirect'));
        register_activation_hook(__FILE__, array($this, 'activation'));
        register_deactivation_hook( __FILE__, array($this, 'deactivation'));   
    }

    function activation(){}

    function deactivation(){}

    function init() {
        wp_localize_script('init', 'init_ajax', array('url' => admin_url( 'admin-ajax.php' )));
    }

    function redirect() {
        global $post;
	    $status = get_post_status($post->ID);
	    if ($status == 'draft') {
		    wp_redirect(home_url());
		    die;
	    }
    }

}

new RedirectionOnDraft();