<?php

namespace App\Helpers\Menu;

use App\Helpers\Menu\MenuBuilder;
use Illuminate\Routing\Router;

class MenuCrud extends MenuBuilder {

    private $target;

    public function __construct($target) {
        $this->target = $target;
    }

    public function getNamespace() {
        return 'App\Http\Cruds';
    }

    public function registerRoutes(Router $router) {
        $router->get($this->buildRoute('listar-registros'), $this->buildTarget("getListarRegistros"))->name($this->buildRouteName("listar"));
        $router->get($this->buildRoute('adicionar'),        $this->buildTarget("getAdicionarRegistro"))->name($this->buildRouteName("adicionar.get"));
        $router->post($this->buildRoute('adicionar'),       $this->buildTarget("postAdicionarRegistro"))->name($this->buildRouteName("adicionar.post"));
        $router->get($this->buildRoute('editar'),           $this->buildTarget("getEditarRegistro"))->name($this->buildRouteName("editar.get"));
        $router->post($this->buildRoute('editar'),          $this->buildTarget("postEditarRegistro"))->name($this->buildRouteName("editar.post"));
        $router->get($this->buildRoute('deletar'),          $this->buildTarget("getDeletar"))->name($this->buildRouteName("deletar.get"));
    }

    private function buildRoute($route) {
        return $this->getBaseRoute() . DIRECTORY_SEPARATOR . $route;
    }

    private function buildTarget($target) {
        return $this->target . "@" . $target;
    }

    private function buildRouteName($name) {
        return $this->getName() . "." . $name;
    }

    public function getRoute() {
        return route($this->buildRouteName('listar'));
    }

}