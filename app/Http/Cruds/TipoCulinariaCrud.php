<?php

namespace App\Http\Cruds;

class TipoCulinariaCrud extends BaseCrud {

    protected $table = 'culinaria';

    protected function setupDatatableColumns() {
        return [
            'id_culinaria' => [
                'width' => '10%',
                'label' => 'Código'
            ],
            'nome_culinaria' => [
                'width' => '50%',
                'label' => 'Nome Culinária',
                'align' => 'left'
            ],
            'created_at' => [
                'label' => 'Data de Criação',
                'format' => 'datetime:br'
            ],
            'updated_at' => [
                'label' => 'Última Atualização',
                'format' => 'datetime:br'
            ]
        ];
    }

}