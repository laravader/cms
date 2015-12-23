<?php

namespace App\Http\Cruds;

use App\Helpers\Datatable\Actions\DatatableActionsBuilder;
use App\Http\Cruds\BaseCrud;
use DB;

class EstadoCrud extends BaseCrud
{
    protected $table = 'estado';
    protected $visible = [];
    protected $hidden = ['updated_at', 'created_at'];

    protected function setupDatatableColumns() {
        return [
            'id_estado' => [
                'label' => "Sigla",
                'width' => '15%'
            ]
        ];
    }

    protected function setupDatatableQuery() {
        return DB::table('estado')
            ->join('pais', 'pais.id_pais', '=', 'estado.fk_pais')
            ->select('estado.id_estado', 'estado.nome_estado', 'pais.nome_pais');
    }

    protected function setupActions(DatatableActionsBuilder $builder) {
        parent::setupActions($builder);

    }

}