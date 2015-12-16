<?php

namespace App\Helpers\Datatable;

use App\Database\Metadata;
use App\Exceptions\MissingMandatoryParametersException;

trait DatatableProvider {

    protected function hasHiddenColumns() {
        return property_exists($this, 'hidden');
    }

    protected function hasVisibleColumns() {
        return property_exists($this, 'visible');
    }

    protected function hasActions() {
        $exists = property_exists($this, 'actions');

        return ($exists && $this->actions) || !$exists;
    }

    protected function hasOverridedHeaderColumns() {
        return method_exists($this, 'setupDatatableHeaderColumns');
    }

    protected function hasOverridedBodyColumns() {
        return method_exists($this, 'setupDatatableBodyColumns');
    }

    private function removeUnexistentColumns($associativeColumns) {
        $computed = $this->getComputedColumns();

        foreach ($associativeColumns as $fieldName => $configurations) {
            if (!in_array($fieldName, $computed)) {
                unset($associativeColumns[$fieldName]);
            }
        }

        return $associativeColumns;
    }

    protected function getOverridedHeaderColumns() {
        if (!$this->hasOverridedHeaderColumns()) {
            return [];
        }

       return $this->removeUnexistentColumns($this->setupDatatableHeaderColumns());
    }

    protected function getOverridedBodyColumns() {
        if (!$this->hasOverridedBodyColumns()) {
            return [];
        }

        return $this->removeUnexistentColumns($this->setupDatatableBodyColumns());
    }

    protected function getTable() {
        if (!property_exists($this, 'table')) {
            throw new MissingMandatoryParametersException("Table not specified.");
        }

        return $this->table;
    }

    protected function getTableColumns() {
        return Metadata::getTableColumns($this->getTable());
    }

    protected function getVisibleColumns() {
        if ($this->hasVisibleColumns()) {
            return $this->visible;
        }

        return $this->getTableColumns();
    }

    protected function getHiddenColumns() {
        if ($this->hasHiddenColumns()) {
            return $this->hidden;
        }

        return [];
    }

    public function getComputedColumns() {
        $columns = $this->getTableColumns();

        if ($this->hasVisibleColumns()) {
            $columns = array_intersect($columns, $this->getVisibleColumns());
        }

        if ($this->hasHiddenColumns()) {
            $columns = array_diff($columns, $this->getHiddenColumns());
        }

        return array_values($columns);
    }

}