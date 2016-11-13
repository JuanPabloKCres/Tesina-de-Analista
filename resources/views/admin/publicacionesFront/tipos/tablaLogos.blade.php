<div id="tab-logos" class="col-lg-12">
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-yellow">
                <div class="panel-heading">Tipos de producciones</div>
                <div class="panel-body">
                    <div class="col-lg-8">
                        <br>
                        <strong> Mostrando {!! $tipos->count() !!} registros del total existente.</strong>
                    </div>
                    <br>
                    <br>
                    <hr> 
                    @include('admin.partes.msjError')
                    @include('flash::message')         
                    <div class="row">
                        @foreach($tipos as $tipo)
                        <div class="col-md-3">
                            @if ($tipo->imagen === "sin imagen")
                               <div class="thumbnail"><img class="img-rounded" style="width:300px;height:200px" src="{{ asset('imagenes/tipos/sin-logo.jpg') }}"/>
                                    <div class="caption"><a data-toggle="tooltip" data-placement="left" title="Visualizar registro. Al visualizar este registro podrá acceder acciones como edición y eliminación del mismo" href="{{ route('admin.tipos.show', $tipo->id) }}"> <h3>
                                        <?php 
                                            if (strlen($tipo->nombre)>20) {
                                               echo (substr($tipo->nombre , 0, 17)."...");
                                            }                                                                                   
                                            else {
                                              echo ($tipo->nombre);
                                            }
                                        ?>
                                    </h3></a>                                                

                                    </div>
                                </div>
                            @else
                                <div class="thumbnail"><img class="img-rounded" style="width:300px;height:200px" src="{{ asset('imagenes/tipos/' . $tipo->imagen) }}"/>
                                    <div class="caption"><a data-toggle="tooltip" data-placement="left" title="Visualizar registro. Al visualizar este registro podrá acceder acciones como edición y eliminación del mismo" href="{{ route('admin.tipos.show', $tipo->id) }}"> <h3>
                                        <?php 
                                            if (strlen($tipo->nombre)>20) {
                                               echo (substr($tipo->nombre , 0, 17)."...");
                                            }                                                                                   
                                            else {
                                              echo ($tipo->nombre);
                                            }
                                        ?>
                                    </h3></a>

                                        @if ($tipo->estado)
                                            <p><span class="label label-success"><i class="fa fa-thumbs-o-up"></i></span> Cantidad de Productos: {{ $tipo->productos_publicados->count() }} </p>
                                        @else
                                            <p><span class="label label-warning"><i class="fa fa-exclamation-triangle"></i></span> Cantidad de Productos: {{ $tipo->productos->count() }} </p>
                                        @endif                                                    
                                    </div>
                                </div>                                                 
                            @endif
                        </div>
                        @endforeach
                    </div> 
                    {!! $tipos->render() !!}
                </div>
            </div>
        </div>
    </div>
</div>