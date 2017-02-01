    <div id="modal-confirmar" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" data-dismiss="modal" aria-hidden="true" class="close">
                    &times;</button>
                <h4 class="modal-title">
                    Eliminar registro: {{ $insumo->nombre }}</h4>
            </div>
           <!-- Aca falta poner condicional de mostrar alerta si hay VENTAS asociadas al cliente para que no elemine-->

            <div class="modal-body">
                {!! Form::open(['route' => ['admin.insumos.destroy', $insumo], 'method' => 'DELETE']) !!}
                @include('admin.partes.msjConfirmar')
                <hr>
                <div class="pull-right">
                    <button type="button" data-dismiss="modal" class="btn btn-white"> Cerrar</button>
                    {!! Form::submit('Eliminar registro', ['class' => 'btn btn-danger ']) !!}
                </div>
                <br>
                {!! Form::close() !!}
                <br>
            </div>

        </div>
    </div>
</div>
