<div id="modal-create" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" data-dismiss="modal" aria-hidden="true" class="close">
                    &times;</button>
                <h4 class="modal-title">
                    Registrar cliente</h4>
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
                <form class = 'form-horizontal'>
                @include('admin.clientes.contenidoForm')
                <button type="button" onclick="registrarCliente();" class="btn btn-success btn-block">Crear registro</button>
                <button type="button" data-dismiss="modal" class="btn btn-white btn-block">Cerrar</button>
                  </form>
            </div>
        </div>
    </div>
</div>
