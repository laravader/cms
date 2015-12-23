<?php

if (!function_exists('select')) {

    /**
     * Create a new select field instance
     *
     * @param array $options List of options
     * @param mixed $selectedValue Selected option
     */
    function select(array $options = [], $selectedValue = null) {
        return app('App\Helpers\Forms\Fields\Select', [$options, $selectedValue]);
    }

}

if (!function_exists('selectTable')) {

    /**
     * Create a new select field instance
     *
     * @param $table string
     * @param $keyColumn string
     * @param $descriptionColumn string
     */
    function selectTable($table, $keyColumn, $descriptionColumn = null) {
        return app('App\Helpers\Forms\Fields\Select')->fromTable($table, $keyColumn, $descriptionColumn);
    }

}