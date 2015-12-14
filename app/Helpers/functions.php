<?php

use App\Helpers\Menu\MenuCrud;
use App\Helpers\Menu\MenuPage;

function crud($target) {
    return new MenuCrud($target);
}

function page($route, $target, $name = null) {
    return new MenuPage($route, $target, $name);
}