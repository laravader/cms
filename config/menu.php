<?php

return [

    'Dashboard' => page('PageController@getDashboard')->route('/')->name('pages.home')->icon('fa-home'),

    'Cadastros' => [

        'Tipos de Culinária' => crud('TipoCulinariaCrud')->route('cadastros/tipos-de-culinaria')->name('cadastros.tipo_culinaria')->icon('fa-cubes'),
        'Tipos de Refeição'  => crud('TipoRefeicaoCrud')->route('cadastros/tipos-de-refeicao')->name('cadastros.tipo_refeicao')->icon('fa-cutlery'),
        'Incluso no Preço'   => crud('InclusoPrecoCrud')->route('cadastros/incluso-preco')->name('cadastros.incluso_preco')->icon('fa-money')

    ]

];