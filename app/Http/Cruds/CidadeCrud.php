<?php

namespace App\Http\Cruds;

class CidadeCrud extends BaseCrud {

    protected $table = 'cidade';
    protected $hidden = ['created_at', 'updated_at'];
    protected $visible = ['id_cidade', 'nome_cidade'];

}