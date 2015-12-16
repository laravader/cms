<?php

namespace App\Helpers\Datatable\Actions;

use App\Exceptions\MissingMandatoryParametersException;

trait DatatableActions {

    private function hasFormattedActionsMethod() {
        return method_exists($this, 'setupActions');
    }

    public function loadActions() {
        if (!$this->hasFormattedActionsMethod()) {
            throw new MissingMandatoryParametersException("Mandatory method 'setActions' not defined.");
        }

        $builder = new DatatableActionsBuilder();

        $this->setupActions($builder);

        return $builder->get();
    }

}