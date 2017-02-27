<div id="modal-actualizar" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" data-dismiss="modal" aria-hidden="true" class="close">
                    &times;</button>
                <h4 class="modal-title">
                    Actualizar registro: {{ $rol->nombre }}</h4>
            </div>
            <div class="modal-body">   
                @include('admin.partes.listaErrores')                                    
{!! Form::model($rol, ['route' => ['admin.roles.update', $rol], 'method' => 'PUT', 'id' =>'form-actualizar', 'class' => 'form-horizontal']) !!}
                         @include('admin.roles.contenidoForm')
                    {!! Form::submit('Actualizar Registro', ['class' => 'btn btn-warning btn-block']) !!}  
                    <button type="button" data-dismiss="modal" class="btn btn-white btn-block">
                    Cerrar</button>                        
                {!! Form::close() !!}
            </div>                        
        </div>
    </div>
</div>