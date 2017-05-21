@extends('admin.partes.index')

@section('title')
    Detalle de configuración del sistema
@endsection

@section('sidebar')
     @include('admin.partes.sidebar')
@endsection

@section('content')
    @include('admin.configuracion.editar')
    <div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
        <div class="page-header pull-left">
            <div class="page-title">
              Configuración del sistema</div>
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
                    <div class="row mtl">                         
                        <div class="col-md-12">
                            <div class="panel">                               
                                <div class="panel-body">                                                                                
                                    <h3>Detalles del Registro</h3>
                                    <br>
                                    @include('admin.partes.msjError')
                                    @include('flash::message') 
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="row mtl">
                                                <div class="col-md-4">
                                                    @if ($configuracion->imagen === "sin imagen")                                           
                                                        <div class="form-group">
                                                            <div class="text-center mbl"><img src=" {{ asset('imagenes/configuraciones/sin-logo.jpg') }} " alt=""  style="width:250px;height:250px" class="img-thumbnail"/></div>
                                                        </div>  
                                                    @else
                                                        <div class="form-group">
                                                            <div class="text-center mbl"><img src="{{ asset('imagenes/configuraciones/' . $configuracion->imagen) }}" alt="" style="width:250px;height:250px" class="img-thumbnail"/></div>
                                                        </div>                                   
                                                    @endif                                                 
                                                </div>
                                                <div class="col-md-8">                                    
                                                    <table class="table table-striped table-hover">
                                                        <tbody> 
                                                            <tr>
                                                                <td><h4 class="box-heading">Nombre:</h4></td>
                                                                <td><h4>{{ $configuracion->nombre }}</h4></td>
                                                            </tr>
                                                            <tr>
                                                                <td><h4 class="box-heading">Cuit:</h4></td>
                                                                <td><h4>{{ $configuracion->cuit }}</h4></td>
                                                            </tr>
                                                            <tr>
                                                                <td><h4 class="box-heading">Dirección:</h4></td>
                                                                <td><h4>{{ $configuracion->direccion }} - {{ $configuracion->localidad->nombre }}</h4></td>
                                                            </tr>   
                                                            <tr>
                                                                <td><h4 class="box-heading">Teléfono:</h4></td>
                                                                <td><h4>{{ $configuracion->telefono }}</h4></td>
                                                            </tr>
                                                            <tr>
                                                                <td><h4 class="box-heading">Correo:</h4></td>
                                                                <td><h4>{{ $configuracion->email }}</h4></td>
                                                            </tr>
                                                            <tr>
                                                                <td><h4 class="box-heading">Se permite pago c/ cheque a Consumidor Final:</h4></td>
                                                                @if($configuracion->pago_cheque_cf == true)
                                                                    <td><h4>Si</h4></td>
                                                                @else
                                                                    <td><h4>No</h4></td>
                                                                @endif
                                                            </tr>
                                                            <tr>
                                                                <td><h4 class="box-heading">Se permite la venta sin stock de insumos:</h4></td>
                                                                @if($configuracion->ventas_sin_stock == true)
                                                                    <td><h4>Si</h4></td>
                                                                @else
                                                                    <td><h4>No</h4></td>
                                                                @endif
                                                            </tr>
                                                        </tbody>
                                                    </table>                            
                                                </div>
                                                <div class="col-md-1"></div>                                                                          
                                            </div>  
                                        </div>                          
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <hr/>
                                            <br>   
                                            <div class="pull-right"> 
                                                <button type="button"  data-hover="tooltip"  data-toggle="modal" data-target="#modal-actualizar"  title="Visualizar la pantalla de actualización de datos. En ella podrá actualizar los datos pertinentes al registro."  class="btn btn-warning">  Actualizar Datos</i></button>                                                                          
                                            </div>    
                                        </div>                            
                                    </div>  
                                </div>
                            </div>
                        </div>                            
                    </div>
                </div>
            </div>
        </div>          
    </div>                    
</div>
@endsection
