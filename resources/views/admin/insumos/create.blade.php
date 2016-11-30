<div id="modal-config" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" data-dismiss="modal" aria-hidden="true" class="close">
                    &times;</button>
                <h4 class="modal-title">
                    Registrar Insumo</h4>
            </div>
            <div class="modal-body">
                @include('admin.partes.listaErrores')
                {!! Form::open(['route' => 'admin.insumos.store', 'method' => 'POST', 'id' =>'form-crear', 'class' => 'form-horizontal']) !!}
                @include('admin.insumos.contenidoForm')
                {!! Form::submit('Crear registro', ['class' => 'btn btn-green btn-block']) !!}
                <button type="button" data-dismiss="modal" class="btn btn-white btn-block">
                    Cerrar</button>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
