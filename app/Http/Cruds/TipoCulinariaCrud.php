<?php

namespace App\Http\Cruds;

class TipoCulinariaCrud extends BaseCrud {

    protected $table = 'culinaria';

    protected function setupDatatableHeaderColumns() {
        return [
            'id_culinaria' => [
                'width' => '10%',
                'label' => 'Código'
            ],
            'nome_culinaria' => [
                'width' => '50%',
                'label' => 'Nome Culinária'
            ],
            'created_at' => [
                'label' => 'Data de Criação'
            ],
            'updated_at' => [
                'label' => 'Última Atualização'
            ]
        ];
    }

    protected function setupDatatableBodyColumns() {
        return [
            'nome_culinaria' => [
                'align' => 'left'
            ],
            'created_at' => [
                'format' => 'datetime:br'
            ],
            'updated_at' => [
                'format' => 'datetime:br'
            ]
        ];
    }

}