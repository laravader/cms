<?php

namespace App\Helpers\Menu;

use stdClass;

class MenuRenderer {

    private $list;

    public function get() {
        $this->list = $this->build(config('menu'));
        return $this->list;
    }

    public function build($menus) {
        $listMenus = [];

        foreach ($menus as $name => $menu) {
            $std = new stdClass();
            $std->has_submenus = false;
            $std->label = $name;
            $std->icon = "";

            if (is_array($menu)) {
                $std->route = "#";
                $std->has_submenus = true;
                $std->submenus = $this->build($menu);
            } else {
                $std->icon = $menu->getIcon();
                $std->route = $menu->getRoute();
            }

            $listMenus[] = $std;
        }

        return $listMenus;
    }

}