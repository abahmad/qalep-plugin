<?php

class Qalep_Autoloader {

    /**
     * Registers Qalep_Autoloader as an SPL autoloader.
     *
     * @param boolean $prepend
     */
    public static function register($prepend = FALSE) {
        if (version_compare(phpversion(), '5.3.0', '>=')) {
            spl_autoload_register(array(new self, 'autoload'), true, $prepend);
        } else {
            spl_autoload_register(array(new self, 'autoload'));
        }
    }

    /**
     * Handles autoloading of Qalep classes.
     *
     * @param string $class
     */
    public static function autoload($className) {
        $className = ltrim($className, '\\');
        $fileName = '';
        $namespace = '';
        if ($lastNsPos = strrpos($className, '\\')) {
            $namespace = str_ireplace(QALEP_PLUGIN_NAME . '\\', '', substr($className, 0, $lastNsPos));
            $className = substr($className, $lastNsPos + 1);
            $fileName = str_ireplace('\\', DIRECTORY_SEPARATOR, $namespace) . DIRECTORY_SEPARATOR;
        }
        $fileName .= str_replace('_', DIRECTORY_SEPARATOR, $className) . '.php';
        $fileName = __DIR__ . DIRECTORY_SEPARATOR . $fileName;
        file_exists($fileName) ? require_once $fileName : true;
    }

}
