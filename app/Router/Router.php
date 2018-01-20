<?php 

    class Router {
        public $gets = [];
        public $posts = [];
        public $puts = [];
        public $deletes = [];

        public function get($url, $controllerAction) {
            if(is_callable($controllerAction)) {
                // Pass the function as it is
                $this->gets[$url] = [$controllerAction];
            } else {
                if(gettype($controllerAction) === 'string') {
                    $controllerAction = explode('@', $controllerAction);
                    $controller = $controllerAction[0];
                    $action = $controllerAction[1];
                    
                    $this->gets[$url] = [$controller, $action];
                }
            }
        }

        public function post($url, $controllerAction) {
            if(is_callable($controllerAction)) {
                $this->gets[$url] = [$controllerAction];
            } else {
                if(gettype($controllerAction) === 'string') {
                    $controllerAction = explode('@', $controllerAction);
                    $controller = $controllerAction[0];
                    $action = $controllerAction[1];
                    
                    $this->posts[$url] = [$controller, $action];
                }
            }
        }

        public function put($url, $controllerAction) {
            if(is_callable($controllerAction)) {
                $this->gets[$url] = [$controllerAction];
            } else {
                if(gettype($controllerAction) === 'string') {
                    $controllerAction = explode('@', $controllerAction);
                    $controller = $controllerAction[0];
                    $action = $controllerAction[1];
                    
                    $this->put[$url] = [$controller, $action];
                }
            }
        }

        public function delete($url, $controllerAction) {
            if(is_callable($controllerAction)) {
                $this->gets[$url] = [$controllerAction];
            } else {
                if(gettype($controllerAction) === 'string') {
                    $controllerAction = explode('@', $controllerAction);
                    $controller = $controllerAction[0];
                    $action = $controllerAction[1];
                    
                    $this->deletes[$url] = [$controller, $action];
                }
            }
        }
    }