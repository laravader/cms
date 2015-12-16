<?php

namespace App\Helpers\Datatable;

use App\Helpers\Datatable\Actions\DatatableActions;
use App\Helpers\Datatable\DatatableHeader as Header;
use App\Helpers\Datatable\DatatableBody as Body;
use App\Database\Queries;

trait Datatable {

    use DatatableProvider, DatatableActions;

    public function getDatatableColumns() {
        return Header::format($this->getComputedColumns(), $this->getOverridedHeaderColumns());
    }

    public function getDatatableRows() {
        $rows = Queries::getTableRows($this->getTable(), $this->getComputedColumns());
        $keys = Queries::getTablePrimaryKeys($this->getTable());
        return Body::format($rows, $this->getOverridedBodyColumns(), $keys);
    }

    public function getDatatableActions() {
        if (!$this->hasActions()) {
            return [];
        }

        return $this->loadActions();
    }

}