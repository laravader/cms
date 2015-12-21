<?php

namespace App\Http\Cruds;

use App\Helpers\Datatable\Actions\DatatableActionsBuilder;
use App\Helpers\Datatable\DatatableAjaxRequest;
use App\Helpers\Renderer\CrudRenderer;
use App\Http\Controllers\Controller;
use App\Helpers\Datatable\Datatable;
use Illuminate\Http\Request;

abstract class BaseCrud extends Controller {

    use Datatable;

    private $request;

    public function __construct(Request $request) {
        CrudRenderer::inicialize(static::class);
        $this->request = $request;
    }

    public function getList() {
        if ($this->request->ajax()) {
            return $this->getDatatableAjaxRows(new DatatableAjaxRequest($this->request->all()));
        }

        return view('crud.list', [
            'page_title'        => CrudRenderer::getPageTitle(),
            'breadcrumb'        => CrudRenderer::getPageBreadcrumb(),
            'route'             => [
                'list'   => CrudRenderer::getListRoute(),
                'insert' => CrudRenderer::getInsertRoute()
            ],
            'datatable'         => [
                'columns' => $this->getDatatableColumns(),
                'rows'    => $this->getDatatableNonAjaxRows(),
                'actions' => $this->getDatatableActions(),
                'ajax'    => $this->hasAjaxEnabled(),
                'order'   => $this->hasOrderEnabled(),
                'filter'  => $this->hasFilterEnabled()
            ]
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