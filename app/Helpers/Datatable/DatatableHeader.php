<?php

namespace App\Helpers\Datatable;

use App\Helpers\Formatters\String;

class DatatableHeader {

    public static function buildOptions($columnName, $overrides) {
        $default = [
            'align' => 'left',
            'label' => String::labelize($columnName),
            'width' => null,
            'name'  => $columnName
        ];

        return array_merge($default, $overrides);
    }

    public static function format($columns, $overrides) {
        $normalizedColumns = [];

        foreach ($columns as $columnName) {
            if (isset($overrides[$columnName])) {
                $normalizedColumns[] = self::buildOptions($columnName, $overrides[$columnName]);
                continue;
            }

            $normalizedColumns[] = self::buildOptions($columnName, []);
        }

        return $normalizedColumns;
    }

}