<?php

/*
 * Plugin Name: Qalep (Beta)
 * Plugin URI: http://www.mnbaa.com/
 * Version: V 1.1
 * Author: Mohammed Anwar
 * Text Domain: qalep
 * Description: Qalep Template & Page Builder
 */

// Make sure we can't call this file directly
if (!defined('WPINC')) {
    die;
}

// Define our plugin pathes
if (!defined('QALEP_DIR_PATH'))
    define('QALEP_DIR_PATH', plugin_dir_path(__FILE__));
if (!defined('QALEP_URL_PATH'))
    define('QALEP_URL_PATH', plugins_url(__FILE__));
if (!defined('QALEP_PLUGIN_NAME'))
    define('QALEP_PLUGIN_NAME', basename(dirname(__FILE__)));
if (!defined('QALEP_TEXT_DOMAIN'))
    define('QALEP_TEXT_DOMAIN', 'qlp');

// Including our autoloader
//require_once 'Qalep_Autoloader.php';
//qalep_autoloader::register();
// Load Text Domain

require 'vendor/autoload.php';

load_plugin_textdomain(QALEP_TEXT_DOMAIN, false, dirname(plugin_basename(__FILE__)) . '/languages/');

// including our ioc container

$ioc = \DI\ContainerBuilder::buildDevContainer();

function DI() {
    global $ioc;
    return $ioc;
}

// Bind Dependancies to the container

/**
 * @package Qalep
 * Qalep's main class
 */
class Qalep {

    /**
     *
     * @var Qalep\Classes\Core\Router
     */
    private $config;
    private $router;

    /**
     * Initializing our plugin
     */
    public function __construct(Qalep\Classes\Core\Config $config, \Qalep\Classes\Core\Router $router) {

        $this->config = $config;
        $this->router = $router;

        $this->init();
    }

    /**
     * Activate the plugin
     */
    public static function activate() {
        
    }

    /**
     * Deactivate the plugin
     */
    public static function deactivate() {
        
    }

    /**
     * Plugin bootstrap
     */
    public function init() {
        // Loading Helpers
        
        $helpers = $this->config->get('app', 'helpers');
        

        if (is_array($helpers) && !empty($helpers)) {
            foreach ($helpers as $helper) {

                if (file_exists(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'helpers' . DIRECTORY_SEPARATOR . $helper . '.php')) {
                    include dirname(__FILE__) . DIRECTORY_SEPARATOR . 'helpers' . DIRECTORY_SEPARATOR . $helper . '.php';
                }
            }
        }
        
        DI()->get('Qalep\App\Controllers\ScriptLoader');

        // add qalep custom post
        $this->router->add('custom_post', 'init', 'Qalep\App\Controllers\CustomPost', '_create_post_type_template');

        //
        
        DI()->get("Qalep\App\Controllers\Templater");
        DI()->get("Qalep\App\Controllers\ShortCode");
        //

        add_filter('post_row_actions', array('Qalep\App\Controllers\CustomPost', 'qalep_action_row'), 10, 2);
        add_shortcode('qalep template', array("Qalep\App\Controllers\ShortCode", 'draw_qalep_template'));
        
        //
        add_action( 'wp_ajax_add_foobar', 'prefix_ajax_add_foobar' );
        add_action('wp_ajax_get_input', array('Qalep\Classes\Core\Input', 'get_input'));

        $this->router->run();
    }

}

if (class_exists('Qalep')) {
    // Installation and uninstallation hooks
    register_activation_hook(__FILE__, array('Qalep', 'activate'));
    register_deactivation_hook(__FILE__, array('Qalep', 'deactivate'));

    // Creating our main Qalep class container instance
    add_action('init', function() {
       \DI()->get('Qalep');
        //DI()->set($name, $value);
    });
}
