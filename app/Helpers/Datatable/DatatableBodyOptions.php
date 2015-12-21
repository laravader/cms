<?php

namespace App\Helpers\Datatable;

class DatatableBodyOptions {

    public static function fill($rows, $configurations, $primaryKeys) {
        $formattedRows = [];

        foreach ($rows as $indexRow => $row) {
            $formatedRow = [];
            $rowKeys = [];

            foreach ($row as $columnName => $columnValue) {
                $configuration = isset($configurations[$columnName]) ? $configurations[$columnName] : [];
                $formatedRow[$columnName] = self::build($columnName, $columnValue, $configuration);

                if (in_array($columnName, $primaryKeys)) {
                    $formatedRow[$columnName]['primary_key'] = true;
                    $rowKeys[$columnName] = $columnValue;
                }

            }

            $formattedRows[] = [
                'columns' => $formatedRow,
                'keys'    => $rowKeys
            ];
        }

        return $formattedRows;
    }

    public static function build($columnName, $columnValue, $overrides) {
        if (isset($overrides['format'])) {
            $columnValue = DatatableFormatter::apply($columnValue, $overrides['format']);
        }

        $default = [
            'align'       => 'left',
            'name'        => $columnName,
            'value'       => $columnValue,
            'primary_key' => false
        ];

        return array_merge($default, $overrides);
    }

}