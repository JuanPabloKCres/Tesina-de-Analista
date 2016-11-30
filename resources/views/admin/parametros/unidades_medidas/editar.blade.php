<div id="modal-actualizar" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" data-dismiss="modal" aria-hidden="true" class="close">
                    &times;</button>
                <h4 class="modal-title">
                    Editar Unidad</h4>
            </div>
            <div class="modal-body">
                @if ($errors->any())
                    @include('admin.partes.listaErrores')
                @endif
                {!! Form::model($unidad_medida, ['route' => ['admin.unidades_medidas.update', $unidad_medida], 'id' =>'form-actualizar', 'method' => 'PUT', 'class' => 'form-horizontal', 'files' => true]) !!}
                @include('admin.parametros.unidades_medidas.contenidoForm')
                {!! Form::submit('Actualizar registro', ['class' => 'btn btn-warning btn-block']) !!}
                <button type="button" data-dismiss="modal" class="btn btn-white btn-block">
                    Cerrar</button>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
