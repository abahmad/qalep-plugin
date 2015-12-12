<?php

namespace Qalep\Classes\Core;

class Router {

    private $routes = array();

    public function add($route_slug, $hook_name, $hook_class, $callback, $params = null) {

        if (isset($route_slug, $hook_name, $hook_class, $callback)) {
            $this->routes[$route_slug] = array(
                'hook_name' => $hook_name,
                'hook_class' => $hook_class,
                'callback' => $callback,
                'params' => !$params == null ? $params : false
            );

            return true;
        }

        return false;
    }

    public function delete($route_slug) {
        if (isset($route_slug)) {
            if (array_key_exists($route_slug, $this->routes)) {
                unset($this->routes[$route_slug]);
                return true;
            }
            return false;
        }

        return false;
    }

    public function reset() {
        $this->routes = array();
    }
    
    public function mass(array $routes) {
        if (count($routes) > 0) {
            foreach ($routes as $route) {
                $this->add($route['route_slug'], $route['hook_name'], $route['hook_class'], $route['callback']);
            }

            return true;
        }

        return false;
    }

    public function run() {
        if (is_array($this->routes) && count($this->routes) > 0) {
            foreach ($this->routes as /* $slug => */ $route) {
<<<<<<< HEAD

                add_action($route['hook_name'], array($this->ioc->get($route['hook_class']), $route['callback']));

                add_action($route['hook_name'], array($this->ioc->get($route['hook_class']), $route['callback']));

=======
                call_user_func([DI()->get($route['hook_class']), $route['callback']]);
>>>>>>> 7097eff52e03a1cc49f4221603327bab50b3ab7d
            }
        }
        return false;
    }

}
