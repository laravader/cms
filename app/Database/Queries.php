<?php

namespace App\Database;

use DB;

class Queries {

    public static function getTablePrimaryKeys($table) {
        $result = DB::select("
            SELECT
                COLUMN_NAME
            FROM
                information_schema.COLUMNS
            WHERE
                TABLE_SCHEMA = ? AND
                TABLE_NAME = ? AND
                COLUMN_KEY = 'PRI'", [env('DB_DATABASE'), $table]);

        return array_map(function($value) {
            return $value->COLUMN_NAME;
        }, $result);
    }

    public static function getTableRows($table, $columns) {
        return DB::table($table)->select($columns)->get();
    }

}