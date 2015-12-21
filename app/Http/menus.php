<?php

$menu->page('PageController@getDashboard')->label('Dashboard')->name('pages.home')->icon('fa-home')->route('/');

$menu->submenu(function($builder) {

    $builder->crud('TipoCulinariaCrud')->label('Tipos de Culinária')->route('cadastros/tipos-de-culinaria')->name('cadastros.tipo_culinaria')->icon('fa-cubes');
    $builder->crud('TipoRefeicaoCrud')->label('Tipos de Refeição')->route('cadastros/tipos-de-refeicao')->name('cadastros.tipo_refeicao')->icon('fa-cutlery');
    $builder->crud('InclusoPrecoCrud')->label('Incluso no Preço')->route('cadastros/incluso-preco')->name('cadastros.incluso_preco')->icon('fa-money');
    $builder->crud('CidadeCrud')->label('Cidades')->route('cadastros/cidades')->name('cadastros.cidades')->icon('fa-money');

})->icon('fa-sitemap')->label('Cadastros');