<?php

namespace App\Http\Cruds;

use App\Helpers\Datatable\Actions\DatatableActionsBuilder;
use App\Http\Cruds\BaseCrud;
use App\Helpers\Datatable\Filter\Select;
use DB;

class ChefCrud extends BaseCrud
{
    protected $table = 'chef';
    protected $primaryKeys = ['id_chef'];
    protected $visible = [];
    protected $hidden = [];

    protected function setupDatatableColumns() {
        return [
            'id_chef' => [
                'label' => 'Código'
            ],
            'name' => [
                'label' => 'Nome'
            ],
            'cpf' => [
                'label' => 'CPF'
            ],
            'sexo' => [
                'filter_select' => new Select('sexo', 'descricao')
            ]
        ];
    }

    protected function setupDatatableQuery() {
        return DB::table('chef')
            ->join('sexo', 'sexo.id_sexo', '=', 'chef.fk_sexo')
            ->join('users', 'users.id', '=', 'chef.id_chef')
            ->select('chef.id_chef', 'users.name', 'chef.sobrenome', 'users.email', 'chef.cpf', 'sexo.descricao as sexo');
    }

    protected function setupActions(DatatableActionsBuilder $builder) {
        parent::setupActions($builder);

    }

}