<div id="modal-crearCC" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                <h4 class="modal-title">Nueva Cuenta Corriente</h4>
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
                {!! Form::open(['route' => 'admin.ccorrientes.store', 'id' =>'form-crear', 'method' => 'POST', 'class' => 'form-horizontal']) !!}
                @include('admin.cuentasCorrientes.contenidoForm')
                {!! Form::submit('Registrar Cuenta Corriente', ['class' => 'btn btn-green btn-block']) !!}
                <button type="button" data-dismiss="modal" class="btn btn-white btn-block">
                    Cerrar</button>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>