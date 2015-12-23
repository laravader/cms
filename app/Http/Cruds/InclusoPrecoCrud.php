<?php

namespace App\Http\Cruds;

use App\Helpers\Datatable\Actions\DatatableActionsBuilder;
use App\Helpers\Datatable\Filter\Select;
use DB;

class InclusoPrecoCrud extends BaseCrud {

    protected $table = 'incluso_preco';
    protected $visible = [];
    protected $hidden = ['created_at', 'updated_at'];

    protected function setupDatatableColumns() {
        return [
            'id_incluso_preco' => [
                'label' => 'Código',
                'width' => '12%'
            ],
            'tipo' => [
                'filter_select' => new Select("incluso_preco_tipo", "descricao")
            ]
        ];
    }

    protected function setupDatatableQuery() {
        return DB::table('incluso_preco')
            ->join('incluso_preco_tipo', 'incluso_preco_tipo.id_incluso_preco_tipo', '=', 'incluso_preco.fk_tipo')
            ->select('incluso_preco.id_incluso_preco', 'incluso_preco.descricao', 'incluso_preco_tipo.descricao as tipo');
    }

    protected function setupActions(DatatableActionsBuilder $builder) {
        parent::setupActions($builder);

    }


}