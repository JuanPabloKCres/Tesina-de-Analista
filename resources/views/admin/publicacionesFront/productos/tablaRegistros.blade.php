<div id="tab-lista" class="tablaResultados2 col-lg-12 hide">
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-yellow">
                <div class="panel-heading">Productos Registrados</div>
                <div class="panel-body">                    
                    <br>                   
                    @include('admin.partes.msjError')
                    @include('flash::message')         
                    <table class="dataTable display table table-hover table-striped">
                        <thead>
                            <tr>                                                
                                <th>Nombre</th>   
                                <th>Tipo</th>

                                <th>Estado</th>                                               
                                <th class="text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($productos as $producto)
                            <tr>                                                
                                <td>{{ $producto->nombre }}</td>   
                                <td>{{ $producto/*->tipo*/->nombre }}</td>
                                @if ($producto->estado)
                                   <td>Activo   <span class="label label-success"><i class="fa fa-thumbs-o-up"></i></span></td> 
                                @else
                                  <td>Inactivo <span class="label label-warning"><i class="fa fa-exclamation-triangle"></i></span></td>                                                 
                                @endif                                            
                                <td class="text-center">
                                    <a data-toggle="tooltip" data-placement="top" title="Visualizar registro. Al visualizar este registro podrá acceder acciones como edición y eliminación del mismo" href="{{ route('admin.productos.show', $producto->id) }}" class="btn btn-info"> <span class="fa fa-eye" aria-hidden="true"></span></a>
                                </td>
                            </tr>                                                  
                        @endforeach
                        </tbody>
                    </table>
                    {!! $productos->render() !!}
                </div>
            </div>
        </div>
    </div>
</div>