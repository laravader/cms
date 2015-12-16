<?php

namespace App\Helpers\Datatable;

class DatatableBody {

    public static function format($rows, $configurations, $primaryKeys) {
        $formattedRows = [];

        foreach ($rows as $indexRow => $row) {
            $formatedRow = [];
            $rowKeys = [];

            foreach ($row as $columnName => $columnValue) {
                $configuration = isset($configurations[$columnName]) ? $configurations[$columnName] : [];
                $formatedRow[$columnName] = self::buildConfigurations($columnName, $columnValue, $configuration);

                if (in_array($columnName, $primaryKeys)) {
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

    public static function buildConfigurations($columnName, $columnValue, $overrides) {
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