<?php

namespace App\Helpers\Formatters;

class Vector {

    public static function getLastSplited($string, $splitBy) {
        $splited = explode($splitBy, $string);
        return end($splited);
    }

    public static function resolveFormatter($formatter) {
        $resolvedFormatter = [];

        $split = explode(":", $formatter);
        $resolvedFormatter['formatter_name'] = $split[0];

        if (count($split) > 1) {
            $resolvedFormatter['parameters'] = explode(",", $split[1]);
            return $resolvedFormatter;
        }

        $resolvedFormatter['parameters'] = [];

        return $resolvedFormatter;
    }

}