@extends('admin.partes.index')

@section('title')
    Detalle del usuario
@endsection

@section('sidebar')
     @include('admin.partes.sidebar')
@endsection

@section('content')
    @include('admin.usuarios.editar')
    @include('admin.usuarios.confirmar')
    @if ($usuario->id == Auth::user()->id)
        @include('admin.usuarios.actPass')
    @endif
    
    <div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
        <div class="page-header pull-left">
            <div class="page-title">
              Usuario: {{ $usuario->name }}</div>
        </div>        
        <div class="page-header pull-right">
            <div class="page-toolbar">         
                <a data-toggle="tooltip" data-placement="bottom" href="{{ route('admin.usuarios.index') }}" title="Volver a los registros de usuarios"  class="btn btn-blue"> <span class="fa fa-arrow-circle-o-left" aria-hidden="true"></span> Volver</a>                         
            </div>
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
                                    <h3>Detalles del registro</h3>
                                    <br>
                                    @include('admin.partes.msjError')
                                    @include('flash::message') 
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="row mtl">
                                                <div class="col-md-4">
                                                    @if ($usuario->imagen === "sin imagen")                                           
                                                        <div class="form-group">
                                                            <div class="text-center mbl"><img src=" {{ asset('imagenes/usuarios/sin-logo.png') }} " alt=""  style="width:250px;height:250px" class="img-thumbnail"/></div>
                                                        </div>  
                                                    @else
                                                        <div class="form-group">
                                                            <div class="text-center mbl"><img src="{{ asset('imagenes/usuarios/' . $usuario->imagen) }}" alt="" style="width:250px;height:250px" class="img-thumbnail"/></div>
                                                        </div>                                   
                                                    @endif                                                 
                                                </div>
                                                <div class="col-md-8">                                    
                                                    <table class="table table-striped table-hover">
                                                        <tbody> 
                                                            <tr>
                                                                <td><h4 class="box-heading">Nombre y apellido:</h4></td>
                                                                <td><h4>{{ $usuario->name }}</h4></td>
                                                            </tr> 
                                                            <tr>
                                                                <td><h4 class="box-heading">Email:</h4></td>
                                                                <td><h4>{{ $usuario->email }}</h4></td>
                                                            </tr> 
                                                            <tr>
                                                                <td><h4 class="box-heading">Fecha de alta:</h4></td>
                                                                <td><h4>{{ $usuario->created_at->diffForHumans() }}</h4></td>
                                                            </tr>                                                                                                                                    
                                                        </tbody>
                                                    </table>                            
                                                </div>
                                            </div>  
                                        </div>                          
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <hr/>
                                            <br>   
                                            <div class="pull-right"> 
                                                @if ($usuario->id == Auth::user()->id)
                                                    <button type="button"  data-hover="tooltip"  data-toggle="modal" data-target="#modal-actualizarPass"  title="Acceder a la pantalla de actualización de contraseña."  class="btn btn-info">  Actualizar contraseña</i></button>                                                                          
                                                @endif                                                
                                                <button type="button"  data-hover="tooltip"  data-toggle="modal" data-target="#modal-actualizar"  title="Visualizar la pantalla de actualización de datos. En ella podrá actualizar los datos pertinentes al registro."  class="btn btn-warning">  Actualizar datos</i></button>                                                                          
                                                <button type="button"  data-hover="tooltip" title="Confirmar eliminación de datos. " data-toggle="modal" data-target="#modal-confirmar"  class="btn btn-danger">Eliminar Registro</i></button>
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

@section('script') 
    <script>
        var listSidebar = "li1";
        var elemFaltante = "nada";
    </script>
@endsection