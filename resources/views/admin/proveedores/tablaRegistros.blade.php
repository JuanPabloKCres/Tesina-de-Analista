<div id="tab-lista" class="col-lg-12 hide">
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-yellow">
                <div class="panel-heading">Proveedores Registrados</div>
                <div class="panel-body">
                    <br>
                    @include('admin.partes.msjError')
                    @include('flash::message')
                    <table class="dataTable display table table-hover table-striped">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>CUIT</th>
                                <th>Rubro</th>
                                <th>Horario Atención</th>
                                <th>Email</th>
                                <th>Teléfono</th>
                                <th>Celular</th>
                                <th>Origen</th>
                                <th>Dirección</th>
                                <th class="text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($proveedores as $proveedor)
                            <tr>
                                <td>{{ $proveedor->nombre }}</td>
                                <td>{{ $proveedor->cuit }}</td>
                                <td>{{ $proveedor->rubro->nombre }}</td>
                                <td>{{ $proveedor->horario_atencion }}</td>
                                <td>{{ $proveedor->email }}</td>
                                @if($proveedor->telefono)
                                    <td>{{ $proveedor->telefono }}</td>
                                @else
                                    <td>{{ "No se registro" }}</td>
                                @endif
                                @if($proveedor->celular)
                                    <td>{{ $proveedor->celular }}</td>
                                @else
                                    <td>{{ "No se registro" }}</td>
                                @endif
                                <td>{{ $proveedor->localidad->nombre }} ({{ $proveedor->localidad->provincia->nombre }})</td>
                                <td>{{ $proveedor->calle}} {{ $proveedor->altura }}</td>
                                <td class="text-center">
                                    <a data-toggle="tooltip" data-placement="top" title="Visualizar registro. Al visualizar este registro podrá acceder acciones como edición y eliminación del mismo" href="{{ route('admin.proveedores.show', $proveedor->id) }}" class="btn btn-info"> <span class="fa fa-eye" aria-hidden="true"></span></a>
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
