<?php

/*
 * Plugin Name: Qalep (Beta)
 * Plugin URI: http://www.mnbaa.com/
 * Version: V 1.1
 * Author: Mohammed Anwar
 * Text Domain: qalep
 * Description: Qalep Template & Page Builder
 */

use Aura\Di\Container;
use Aura\Di\Factory;

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
$ioc = DI\ContainerBuilder::buildDevContainer();

// Bind Dependancies to the container
//$ioc->addRule('Qalep\\Classes\\Core\\Config', array('shared' => true));

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
    public $ioc;

    /**
     * Initializing our plugin
     */
    public function __construct(Qalep\Classes\Core\Config $config, Qalep\Classes\Core\Router $router) {

        $this->config = $config;
        $this->router = $router;
        $this->ioc = DI\ContainerBuilder::buildDevContainer();

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

        // Assign our menu routes
        $this->router->mass($this->config->get('routes.menu_routes', 'admin_menu'));
        $this->router->run();
    }

}

if (class_exists('Qalep')) {
    // Installation and uninstallation hooks
    register_activation_hook(__FILE__, array('Qalep', 'activate'));
    register_deactivation_hook(__FILE__, array('Qalep', 'deactivate'));

    // Creating our main Qalep class container instance
    $ioc->get('Qalep');
}
