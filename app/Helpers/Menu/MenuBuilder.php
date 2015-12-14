<?php

namespace App\Helpers\Menu;

abstract class MenuBuilder {

    protected $route;
    protected $name;
    protected $icon;

    public abstract function getNamespace();
    public abstract function getRoute();

    public function route($route) {
        $this->route = $route;
        return $this;
    }

    public function icon($icon) {
        $this->icon = $icon;
        return $this;
    }

    public function name($name) {
        $this->name = $name;
        return $this;
    }

    public function getIcon() {
        return $this->icon;
    }

    public function getBaseRoute() {
        return $this->route;
    }

    public function getName() {
        return $this->name;
    }

}