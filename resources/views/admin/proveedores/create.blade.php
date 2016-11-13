<div id="modal-config" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" data-dismiss="modal" aria-hidden="true" class="close">
                    &times;</button>
                <h4 class="modal-title">
                    Registrar proveedor</h4>
            </div>
            <div class="modal-body">
                @if ($errors->any())
                     <div class="alert alert-warning alert-dismissable">
                        <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button>
                        <strong>¡Atención!</strong>
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>
                                    {{ $error }}
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                    {!! Form::open(['route' => 'admin.proveedores.store', 'method' => 'POST', 'id' =>'form-crear', 'class' => 'form-horizontal', 'files' => true]) !!}
                            @include('admin.proveedores.contenidoForm')
                        {!! Form::submit('Registrar proveedor', ['class' => 'btn btn-green btn-block']) !!}
                        <button type="button" data-dismiss="modal" class="btn btn-white btn-block">
                    Cerrar</button>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
