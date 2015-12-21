<?php

namespace App\Http\Cruds;

use App\Helpers\Datatable\Actions\DatatableActionsBuilder;
use App\Http\Cruds\BaseCrud;
use App\Helpers\Datatable\Filter\Select;
use DB;

class CidadeCrud extends BaseCrud
{
    protected $table = 'cidade';
    protected $ajax = true;
    protected $visible = [];
    protected $hidden = ['created_at', 'updated_at'];

    protected function setupDatatableHeaderColumns() {
        return [
            'id_cidade' => [
                'width' => '5%',
                'label' => 'Código'
            ],
            'fk_estado' => [
                'width' => '10%',
                'filter_select' => new Select('estado', 'id_estado')
            ]
        ];
    }

    protected function setupDatatableBodyColumns() {
        return [];
    }

    protected function setupActions(DatatableActionsBuilder $builder) {
        parent::setupActions($builder);

    }

}