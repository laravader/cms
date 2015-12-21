<?php

namespace App\Helpers\Datatable;

use App\Database\Metadata;
use App\Exceptions\MissingMandatoryParametersException;

trait DatatableProvider {

    /**
     * All columns after processig $visible and $hien properties
     *
     * @var array
     */
    private $computedColumns;

    /**
     * All the table columns without processig $visible and $hien properties
     *
     * @var array
     */
    private $tableColumns;

    /**
     * Check if there is a hien column property set
     *
     * @return bool
     */
    protected function hasHiddenColumns() {
        return property_exists($this, 'hidden');
    }

    /**
     * Check if there is a visible column property set
     *
     * @return bool
     */
    protected function hasVisibleColumns() {
        return property_exists($this, 'visible') && !empty($this->visible);
    }

    /**
     * Check if there is an ajax column property set and is set to true
     *
     * @return bool
     */
    protected function hasAjaxEnabled() {
        return property_exists($this, 'ajax') && $this->ajax;
    }

    /**
     * Check if there is an order column property set and is set to true
     * OR if the property does not exists
     *
     * @return bool
     */
    protected function hasOrderEnabled() {
        $propertyExists = property_exists($this, 'order');
        return ($propertyExists && $this->order) || !$propertyExists;
    }

    /**
     * Check if there is an filter column property set and is set to true
     * OR if the property does not exists
     *
     * @return bool
     */
    protected function hasFilterEnabled() {
        $propertyExists = property_exists($this, 'filter');
        return ($propertyExists && $this->filter) || !$propertyExists;
    }

    /**
     * Check if there is an actions column property set and is set to true
     * OR if the property does not exists
     *
     * @return bool
     */
    protected function hasActions() {
        $exists = property_exists($this, 'actions');

        return ($exists && $this->actions) || !$exists;
    }

    /**
     * Check if there is a custom function to override header columns properties
     *
     * @return bool
     */
    protected function hasOverridedHeaderColumns() {
        return method_exists($this, 'setupDatatableHeaderColumns');
    }

    /**
     * Check if there is a custom function to override body columns properties
     *
     * @return bool
     */
    protected function hasOverridedBodyColumns() {
        return method_exists($this, 'setupDatatableBodyColumns');
    }

    /**
     * Check if there is a custom function to override the datatable query to list
     *
     * @return bool
     */
    protected function hasOverridedQueryList() {
        return method_exists($this, 'setupDatatableQuery');
    }

    /**
     * Check if there is a custom function to a or override datatable actions
     *
     * @return bool
     */
    private function hasFormattedActionsMethod() {
        return method_exists($this, 'setupActions');
    }

    /**
     * Get the computed columns and remove all the columns
     * that does not exist in the database
     *
     * @return bool
     */
    protected function removeUnexistentColumns($associativeColumns) {
        $computed = $this->getComputedColumns();

        foreach ($associativeColumns as $fieldName => $configurations) {
            if (!in_array($fieldName, $computed)) {
                unset($associativeColumns[$fieldName]);
            }
        }

        return $associativeColumns;
    }

    /**
     * Return the overrided array of header columns and its properties
     *
     * @return array
     */
    protected function getOverridedHeaderColumns() {
        if (!$this->hasOverridedHeaderColumns()) {
            return [];
        }

       return $this->removeUnexistentColumns($this->setupDatatableHeaderColumns());
    }

    /**
     * Return the overrided array of body columns and its properties
     *
     * @return array
     */
    protected function getOverridedBodyColumns() {
        if (!$this->hasOverridedBodyColumns()) {
            return [];
        }

        return $this->removeUnexistentColumns($this->setupDatatableBodyColumns());
    }

    /**
     * Return the crud's table name
     *
     * @throws \App\Exceptions\MissingMandatoryParametersException
     * @return array
     */
    protected function getTable() {
        if (!property_exists($this, 'table')) {
            throw new MissingMandatoryParametersException("Table not specified.");
        }

        return $this->table;
    }

    /**
     * Return the crud's table columns
     *
     * @return array
     */
    protected function getTableColumns() {
        if (!empty($this->tableColumns)) {
            return $this->tableColumns;
        }
        return $this->tableColumns = Metadata::getTableColumns($this->getTable());
    }

    /**
     * Return the visible columns (the only columns that will be shown in datatable)
     *
     * @return array
     */
    protected function getVisibleColumns() {
        if ($this->hasVisibleColumns()) {
            return $this->visible;
        }

        return $this->getTableColumns();
    }

    /**
     * Return the hien columns (the columns that will be removed from the datatable)
     *
     * @return array
     */
    protected function getHiddenColumns() {
        if ($this->hasHiddenColumns()) {
            return $this->hidden;
        }

        return [];
    }

    /**
     * Return the overrided datatable query list
     *
     * @return \Illuminate\Database\Query\Builder
     */
    protected function getOverridedListQuery() {
        return $this->setupDatatableQuery();
    }

    /**
     * Return the array of resolved ambiguous columns
     *
     * @return array
     */
    protected function getResolvedAmbiguousColumns() {
        if (!$this->hasOverridedHeaderColumns()) {
            return [];
        }

        $overridedColumns = $this->setupDatatableHeaderColumns();
        $resolvedAmbiguous = [];

        foreach ($overridedColumns as $columnName => $columnOverrides) {
            if (isset($columnOverrides['table'])) {
                $resolvedAmbiguous[$columnName] = sprintf("%s.%s", $columnOverrides['table'], $columnName);
            }
        }

        return $resolvedAmbiguous;
    }

    /**
     * Return the computed columns (all columns minus hidden and only visible)
     *
     * @return array
     */
    protected function getComputedColumns() {
        if (!empty($this->computedColumns)) {
            return $this->computedColumns;
        }

        $columns = $this->getTableColumns();

        if ($this->hasVisibleColumns()) {
            $columns = array_intersect($columns, $this->getVisibleColumns());
        }

        if ($this->hasHiddenColumns()) {
            $columns = array_diff($columns, $this->getHiddenColumns());
        }

        return $this->computedColumns = array_values($columns);
    }

    /**
     * Get the default properties of all columns, these properties can be overrided
     * using the method DatatableProvider::setupDatatableHeaderColumns
     *
     * @return array
     */
    protected function getDefaultProperties() {
        return [
            'order'  => $this->hasOrderEnabled(),
            'filter' => $this->hasFilterEnabled()
        ];
    }
}