<?php

namespace App\Helpers\Formatters;

class String {

    public static function labelize($string) {
        return ucwords(implode(" ", explode("-", $string)));
    }

}