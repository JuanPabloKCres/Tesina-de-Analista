<div id="tab-logos" class="col-lg-12">
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-">
                <div class="panel-heading">Proveedores Registrados</div>
                <div class="panel-body">
                    <div class="col-lg-8">
                        <br>
                        <strong> Mostrando {!! $proveedores->count() !!} registros del total existente.</strong>
                    </div>
                    <br>
                    <br>
                    <hr> 
                    @include('admin.partes.msjError')
                    @include('flash::message')         
                    <div class="row"> 
                        @foreach($proveedores as $proveedor)
                            @if($proveedor->estado == 'activo')
                                <div class="col-md-3">
                                    @if ($proveedor->imagen === "sin imagen")
                                       <div class="thumbnail"><img class="img-rounded" style="width:300px;height:200px" src="{{ asset('imagenes/proveedores/sin-logo.jpg') }}"/>
                                             <div class="caption"><a data-toggle="tooltip" data-placement="left" title="Visualizar registro. Al visualizar este registro podrá acceder acciones como edición y eliminación del mismo" href="{{ route('admin.proveedores.show', $proveedor->id) }}"> <h3>{{ $proveedor->nombre }}</h3></a>

                                                <p><h4>Origen: {{ $proveedor->localidad->nombre }}</h4></p>
                                                <p>Rubro: {{ $proveedor->rubro->nombre }}</p>
                                            </div>
                                        </div>
                                    @else
                                        <div class="thumbnail"><img class="img-rounded" style="width:300px;height:200px" src="{{ asset('imagenes/proveedores/' . $proveedor->imagen) }}"/>
                                            <div class="caption"><a data-toggle="tooltip" data-placement="left" title="Visualizar registro. Al visualizar este registro podrá acceder acciones como edición y eliminación del mismo" href="{{ route('admin.proveedores.show', $proveedor->id) }}"> <h3><b>{{ $proveedor->nombre }}</b></h3></a>
                                                <p><h5>{{ $proveedor->localidad->nombre." (".$proveedor->localidad->provincia->nombre.")" }}</h5></p>
                                                <p><h5>Rubro: {{ $proveedor->rubro->nombre }}</h5></p>

                                                <p><h4>Dirección: {{ $proveedor->calle." ".$proveedor->altura }}</h4></p>
                                                <p><h4><b>Horario Atención:</b> {{ $proveedor->hora_a_manana}} a {{ $proveedor->hora_c_manana}} y {{ $proveedor->hora_a_tarde}} a {{ $proveedor->hora_c_tarde}}</h4></p>

                                            </div>
                                        </div>
                                    @endif
                                </div>
                            @else
                                <div class="col-md-3 ui-state-disabled">
                                    @if ($proveedor->imagen === "sin imagen")
                                        <div class="thumbnail"><img class="img-rounded" style="width:300px;height:200px" src="{{ asset('imagenes/proveedores/sin-logo.jpg') }}"/>
                                            <div class="caption"><a data-toggle="tooltip" data-placement="left" title="Visualizar registro. Al visualizar este registro podrá acceder acciones como edición y eliminación del mismo" href="{{ route('admin.proveedores.show', $proveedor->id) }}"> <h3>{{ $proveedor->nombre }}</h3></a>
                                                <p><h4>Origen: {{ $proveedor->localidad->nombre }}</h4></p>
                                                <p>Rubro: {{ $proveedor->rubro->nombre }}</p>
                                                <p><h2 class="text-danger">Proveedor Inactivo</h2></p>
                                            </div>
                                        </div>
                                    @else
                                        <div class="thumbnail ui-state-disabled"><img class="img-rounded" style="width:300px;height:200px" src="{{ asset('imagenes/proveedores/' . $proveedor->imagen) }}"/>
                                            <div class="caption"><a data-toggle="tooltip" data-placement="left" title="Visualizar registro. Al visualizar este registro podrá acceder acciones como edición y eliminación del mismo" href="{{ route('admin.proveedores.show', $proveedor->id) }}"> <h3><b>{{ $proveedor->nombre }}</b></h3></a>
                                                <p><h5>{{ $proveedor->localidad->nombre." (".$proveedor->localidad->provincia->nombre.")" }}</h5></p>
                                                <p><h5>Rubro: {{ $proveedor->rubro->nombre }}</h5></p>
                                                <p><h2 class="text-danger">Proveedor Inactivo</h2></p>

                                            </div>
                                        </div>
                                    @endif
                                </div>
                            @endif
                                @endforeach
                    </div> 
                    {!! $proveedores->render() !!}
                </div>
            </div>
        </div>
    </div>
</div>

@section('script')
    <script src="{{ asset('js/proveedores.js') }}"></script>
@endsection