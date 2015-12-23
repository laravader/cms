<?php

namespace App\Http\Cruds;

use App\Helpers\Datatable\Actions\DatatableActionsBuilder;
use App\Http\Cruds\BaseCrud;

class ConfiguracaoSiteCrud extends BaseCrud
{
    protected $table = 'configuracao_site';
    protected $visible = [];
    protected $hidden = [];

    protected function setupDatatableColumns() {
        return [
            'chave' => [
                'width' => '30%'
            ]
        ];
    }

    protected function setupActions(DatatableActionsBuilder $builder) {
        parent::setupActions($builder);

    }

}