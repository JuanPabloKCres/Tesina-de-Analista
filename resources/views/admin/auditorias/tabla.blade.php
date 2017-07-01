@extends('admin.partes.index')

@section('title')
    Auditoria
@endsection

@section('sidebar')
    @include('admin.partes.sidebar')
@endsection

@section('content')
    <div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
        <div class="page-header pull-left">
            <div class="page-title">
                Auditoria</div>
        </div>

        <div class="clearfix"></div>

    </div>
    <div class="page-content">
        <div id="tab-general">
            <div class="row mbl">
                <div class="col-lg-12">
                    <div class="col-md-12">
                        <div id="area-chart-spline" style="width: 100%; height: 300px; display: none;">
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-info">
                                <div class="panel-heading">Movimientos en el Sistema</div>
                                <div class="panel-body">
                                    @include('admin.partes.msjError')
                                    @include('flash::message')
                                    <table class="display dataTable table table-hover table-striped">
                                        <thead>
                                            <tr>
                                                <th>id</th>
                                                <th >Tabla</th>
                                                <th class="text-center">id elemento</th>
                                                <th class="text-center">Acción</th>
                                                <th class="text-center">Dato Anterior</th>
                                                <th class="text-center">Dato Nuevo</th>
                                                <th class="text-center">Fecha de Creación</th>
                                                <th class="text-center">Fecha de Modificación</th>
                                                <th class="text-center">id_usuario</th>
                                                <th class="text-center">Ver</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($auditorias as $auditoria)
                                            <tr>
                                                <td class="text-center">{{ $auditoria->id}}</td>

                                                <td class="text-dark text-uppercase">{{ $auditoria->tabla }}</td>

                                                @if($auditoria->elemento_id)
                                                    <td class="text-center">{{ $auditoria->elemento_id}}</td>
                                                @else
                                                    <td class="text-center">{{ "Ninguno" }}</td>
                                                @endif

                                                @if($auditoria->accion)
                                                    @if($auditoria->accion == 'alta')
                                                        <td class="text-center text-green text-uppercase">{{ $auditoria->accion}}</td>
                                                    @elseif($auditoria->accion == 'modificacion')
                                                        <td class="text-center text-yellow text-uppercase">{{ $auditoria->accion}}</td>
                                                    @elseif($auditoria->accion == 'eliminacion')
                                                        <td class="text-center text-red text-uppercase">{{ $auditoria->accion}}</td>
                                                    @endif
                                                @else
                                                    <td class="text-center">{{ "-" }}</td>
                                                @endif

                                                @if($auditoria->dato_anterior)
                                                    <td class="text-center">{{ $auditoria->dato_anterior}}</td>
                                                @else
                                                    <td class="text-center">{{ "-" }}</td>
                                                @endif

                                                @if($auditoria->dato_nuevo)
                                                    <td class="text-center">{{ $auditoria->dato_nuevo}}</td>
                                                @else
                                                    <td class="text-center">{{ "-" }}</td>
                                                @endif

                                                @if($auditoria->created_at)
                                                    <td class="text-center ">{{ $auditoria->created_at }}</td>
                                                @else
                                                    <td>{{ "-" }}</td>
                                                @endif
                                                @if($auditoria->updated_at)
                                                    <td class="text-center ">{{ $auditoria->updated_at }}</td>
                                                @else
                                                    <td>{{ "-" }}</td>
                                                @endif

                                                @if($auditoria->usuario_id)
                                                    <?php $user = \App\User::where('id',$auditoria->usuario_id)->get() ;?>
                                                    <td class="text-center">{{ $auditoria->usuario_id}} ({{ $user }}</td>
                                                @else
                                                    <td class="text-center">{{ "No se registro" }}</td>
                                                @endif

                                                <td class="text-center">
                                                    <a data-toggle="tooltip" data-placement="top" title="Visualizar registro. Al visualizar este registro podrá acceder acciones como edición y eliminación del mismo" href="{{ route('admin.auditorias.show', $auditoria->id) }}" class="btn btn-info"> <span class="fa fa-eye" aria-hidden="true"></span></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        var listSidebar = "li12";
    </script>
@endsection