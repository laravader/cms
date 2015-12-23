<?php

namespace App\Http\Cruds;

class TipoRefeicaoCrud extends BaseCrud {

    protected $table = 'tipo_refeicao';

    protected function setupDatatableColumns() {
        return [
            'id_tipo_refeicao' => [
                'width' => '5%',
                'label' => "Código"
            ],
            'created_at' => [
                'label'  => "Data de Criação",
                'format' => 'datetime:br'
            ],
            'updated_at' => [
                'label'  => "Último Atualização",
                'format' => 'datetime:br'
            ],
        ];
    }

    protected function setupFormFields() {
        return [];
    }

}