<?php

namespace App\Http\Cruds;

use App\Http\Controllers\Controller;

abstract class BaseCrud extends Controller {

    public function getListarRegistros() {
        return 'getListarRegistros';
    }

    public function getAdicionarRegistro() {
        return 'getAdicionarRegistro';
    }

    public function getEditarRegistro() {
        return 'getEditarRegistro';
    }

    public function getDeletar() {
        return 'getDeletar';
    }

}