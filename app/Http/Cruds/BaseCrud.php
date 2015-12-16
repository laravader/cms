<?php

namespace App\Http\Cruds;

use App\Helpers\Datatable\Actions\DatatableActionsBuilder;
use App\Helpers\Renderer\CrudRenderer;
use App\Http\Controllers\Controller;
use App\Helpers\Datatable\Datatable;

abstract class BaseCrud extends Controller {

    use Datatable;

    public function __construct() {
        CrudRenderer::inicialize(static::class);
    }

    public function getList() {
        return view('crud.list', [
            'page_title'        => CrudRenderer::getPageTitle(),
            'breadcrumb'        => CrudRenderer::getPageBreadcrumb(),
            'datatable_columns' => $this->getDatatableColumns(),
            'datatable_rows'    => $this->getDatatableRows(),
            'datatable_actions' => $this->getDatatableActions()
        ]);
    }

    public function getInsert() {
        return 'getAdicionarRegistro';
    }

    public function getUpdate() {
        return 'getEditarRegistro';
    }

    public function getDelete() {
        return 'getDeletar';
    }

    protected function setupActions(DatatableActionsBuilder $builder) {
        $builder->action('Editar Registro', "icon-database-edit2", function($primaryKeys) {
            return CrudRenderer::getUpdateRoute($primaryKeys);
        });

        $builder->action('Deletar', 'icon-trash', function($primaryKeys) {
            return CrudRenderer::getDeleteRoute($primaryKeys);
        });
    }
}