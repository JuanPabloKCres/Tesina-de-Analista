<div id="modal-confirmar" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" data-dismiss="modal" aria-hidden="true" class="close">
                    &times;</button>
                <h4 class="modal-title">
                    Eliminar registro: {{ $proveedor->nombre }}</h4>
            </div>
                @if ($proveedor->insumo_compra->count()!=0)
                    @include('admin.proveedores.msjComprasAsociadas')
                    {!! Form::open(['route' => ['admin.proveedores.edit', $proveedor], 'method' => 'GET']) !!}
                    {{--
                    @include('admin.partes.msjConfirmar')
                    --}}
                    <hr>
                    <div class="pull-right">
                        <button type="button" data-dismiss="modal" class="btn btn-white"> Cerrar</button>
                        {!! Form::submit('Modificar estado', ['class' => 'btn btn-danger ']) !!}
                    </div>
                    <br>
                    {!! Form::close() !!}
                <br>
                @else

                    <div class="modal-body">
                        {!! Form::open(['route' => ['admin.proveedores.destroy', $proveedor], 'method' => 'DELETE']) !!}
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
                @endif

        </div>
    </div>
</div>
