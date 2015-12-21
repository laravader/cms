<?php

namespace App\Helpers\Datatable;

use App\Helpers\Datatable\Actions\DatatableActions;
use App\Exceptions\MissingMandatoryParametersException;
use App\Helpers\Datatable\Actions\DatatableActionsBuilder;
use App\Database\Queries;

trait Datatable {

    use DatatableProvider;

    /**
     * Return the datatable's header columns formatted with options
     *
     * @return array
     */
    protected function getDatatableColumns() {
        return DatatableHeaderOptions::fill($this->getColumns(), $this->getOverridedHeaderColumns(), $this->getDefaultProperties());
    }

    /**
     * Return all the rows from the crud's table when the crud
     * is not set to use ajax requests, if a override query
     * has been set, then it will return the result of it
     *
     * @return array
     */
    protected function getDatatableNonAjaxRows() {

        // If crud's ajax is enabled, then return nothing
        if ($this->hasAjaxEnabled()) {
            return [];
        }

        $rows = Queries::getTableRows($this->getTable(), $this->getComputedColumns());
        $keys = $this->getTablePrimaryKeys();

        return DatatableBodyOptions::fill($rows, $this->getOverridedBodyColumns(), $keys);
    }

    /**
     * Return all the rows from the crud table when the crud
     * is set to use ajax requests, if a override query
     * has been set, then it will return the result of it filtered,
     * ordered and paginated
     *
     * @return array
     */
    public function getDatatableAjaxRows(DatatableAjaxRequest $ajaxRequest) {

        // If a custom list query was not defined
        if (!$this->hasOverridedQueryList()) {
            $result = Queries::getFilteredAjaxTableRows(
                $this->getTable(),
                $this->getColumns(),
                $ajaxRequest->getPagitionStart(),
                $ajaxRequest->getPaginationLength(),
                $ajaxRequest->getFilters($this->getResolvedAmbiguousColumns()),
                $ajaxRequest->getOrder()
            );

        // If it was
        } else {
            $result = Queries::getFilteredQueryListRows(
                $this->getOverridedListQuery(),
                $ajaxRequest->getPagitionStart(),
                $ajaxRequest->getPaginationLength(),
                $ajaxRequest->getFilters($this->getResolvedAmbiguousColumns()),
                $ajaxRequest->getOrder()
            );
        }

        return new DatatableAjaxResponse(
            DatatableBodyOptions::fill($result['rows'], $this->getOverridedBodyColumns(), $this->getTablePrimaryKeys()),
            $this->getDatatableActions(),
            $result['count_filtered'],
            $result['count_total'],
            $ajaxRequest->getDraw());
    }

    /**
     * Return the datatable actions loaded
     *
     * @return array
     */
    protected function getDatatableActions() {
        if (!$this->hasActions()) {
            return [];
        }

        return $this->getLoadedActions();
    }

    /**
     * Load and return the datatable actions
     *
     * @return array
     */
    protected function getLoadedActions() {
        if (!$this->hasFormattedActionsMethod()) {
            throw new MissingMandatoryParametersException("Mandatory method 'setActions' not defined.");
        }

        $builder = new DatatableActionsBuilder();

        $this->setupActions($builder);

        return $builder->get();
    }

    /**
     * Return the primary keys from the crud's table
     *
     * @return array
     */
    protected function getTablePrimaryKeys() {
        return Queries::getTablePrimaryKeys($this->getTable());
    }

    /**
     * Return the columns from the crud's table, if an override query was set,
     * then it will return the columns listed in the query
     *
     * @return array
     */
    private function getColumns() {
        if ($this->hasOverridedQueryList()) {
            return $this->getOverridedQueryColumns();
        }

        return $this->getComputedColumns();
    }

    /**
     * Return the columns listed in the overrided list query
     *
     * @return array
     */
    private function getOverridedQueryColumns() {
        return Queries::getQueryColumns($this->getOverridedListQuery());
    }
}