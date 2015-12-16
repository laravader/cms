@extends('templates.layout')

@section('header.js')
    <script type="text/javascript" src="/assets/js/plugins/tables/datatables/datatables.min.js"></script>
    <script type="text/javascript" src="/assets/js/plugins/forms/selects/select2.min.js"></script>
    <script type="text/javascript" src="/assets/js/core/app.js"></script>
    <script type="text/javascript" src="/assets/js/pages/datatables_basic.js"></script>
@endsection

@section('page.title', $page_title)

@section('page.subtitle')
    <ul class="breadcrumb breadcrumb-caret position-right">
        <li><a href="/">Home</a></li>
        @foreach($breadcrumb as $link)
            <li>{{ $link }}</li>
        @endforeach
    </ul>
@endsection

@section('page.heading-elements')

    <div class="heading-elements">
        <div class="heading-btn-group">
            <a href="#" class="btn bg-blue btn-labeled heading-btn"><b><i class="icon-googleplus5"></i></b> Novo Registro</a>
            <a href="#" class="btn bg-warning-800 btn-labeled heading-btn"><b><i class="icon-trash"></i></b> Excluir</a>
        </div>
    </div>

@endsection


@section('content')

    <!-- Basic datatable -->
    <div class="panel panel-flat">

        <table class="table table-bordered table-hover table-striped datatable-basic">
            <thead>
            <tr>
                @foreach($datatable_columns as $header_column)
                    <th
                        class="text-{{ $header_column['align'] }}"
                        @if(!empty($header_column['width']))
                            width="{{ $header_column['width'] }}"
                        @endif
                        data-name="{{ $header_column['name'] }}">
                            {{ $header_column['label'] }}
                    </th>
                @endforeach

                @if(count($datatable_actions))
                    <th class="text-center" width="5%">Ações</th>
                @endif
            </tr>
            </thead>
            <tbody>
                @foreach($datatable_rows as $row)
                    <tr>
                        @foreach($row['columns'] as $column)
                            <td class="text-{{ $column['align'] }}">{{ $column['value'] }}</td>
                        @endforeach

                        @if(count($datatable_actions))
                            <td class="text-center">
                                <ul class="icons-list">
                                    <li class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                            <i class="icon-menu9"></i>
                                        </a>

                                        <ul class="dropdown-menu dropdown-menu-right">
                                            @foreach($datatable_actions as $action)
                                                <li><a href="{{ $action->getRoute($row['keys']) }}"><i class="{{ $action->getIcon() }}"></i> {{ $action->getLabel() }}</a></li>
                                            @endforeach
                                        </ul>
                                    </li>
                                </ul>
                            </td>
                        @endif
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <!-- /basic datatable -->

@endsection