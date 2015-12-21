<?php

namespace App\Helpers\Datatable\Filter;

/**
 * Class used to create a datatable select filter from a database table
 *
 * Class DatatableFilterSelect
 * @package App\Helpers\Datatable
 */
class Select {

    /**
     * The name of the table
     *
     * @var string
     */
    private $table;

    /**
     * The name of the key column that will be used to filter the datatable
     *
     * @var string
     */
    private $keyColumn;

    /**
     * The name of the column that will be displayed in the select filter
     *
     * @var string
     */
    private $descriptionColumn;

    /**
     * Set the information to get list of select filter from the database
     *
     * @param $table
     * @param $keyColumn
     * @param $descriptionColumn
     */
    public function __construct($table, $keyColumn, $descriptionColumn = null) {
        $this->table             = $table;
        $this->keyColumn         = $keyColumn;
        $this->descriptionColumn = $descriptionColumn ?: $keyColumn;
    }

    /**
     * Return the name of the table
     *
     * @return string
     */
    public function getTable() {
        return $this->table;
    }

    /**
     * Return the name of the key column
     *
     * @return string
     */
    public function getKeyColumn() {
        return $this->keyColumn;
    }

    /**
     * Return the name of the description column
     *
     * @return string
     */
    public function getDescriptionColumn() {
        return $this->descriptionColumn;
    }
}