<div class="panel-body">
    <h3>Detalle del presupuesto</h3>
    <br>
    <div class="row mtl">
        <div class="col-md-6">
            <table class="table table-striped table-hover">
                <tbody>
                <tr>
                    <td><h4 class="box-heading">Usuario que registró el pedido:</h4></td>
                    <td><h4>{{ $pedido->usuarioPedido->name }}</h4></td>
                </tr>
                </tbody>
            </table>
        </div>
        <div class="col-md-6">
            <table class="table table-striped table-hover">
                <tbody>
                <tr>
                    <td><h4 class="box-heading">Fecha y hora del pedido:</h4></td>
                    <td><h4>{{ $pedido->fecha_pedido }} - {{ $pedido->hora_pedido }}</h4></td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="row mtl">
        <div class="col-md-6">
            <table class="table table-striped table-hover">
                <tbody>
                <tr class="info">
                    <td><h4 class="box-heading">Seña realizada:</h4></td>
                    @if ($pedido->senado == $pedido->importe())
                        <td><h4>Se abonó la totalidad</h4></td>
                    @else
                        <td><h4>${{ $pedido->senado }}</h4></td>
                    @endif
                </tr>
                </tbody>
            </table>
        </div>
        <div class="col-md-6">
            <table class="table table-striped table-hover">
                <tbody>
                <tr class="warning">
                    <td><h4 class="box-heading">Monto total del pedido:</h4></td>
                    <td><h4 id="montoTotal">${{ $pedido->importe() }}</h4></td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>

    <h3>Datos del Cheque</h3>
    <div class="row mtl">
        <div class="col-md-3">
            <table class="table table-striped table-hover">
                <tbody>
                <tr class="success">
                    <td><h4 class="box-heading">N° Serie:</h4></td>
                    <td><h4>{{ $pedido->cheque->nro_serie }}</h4></td>
                </tr>
                </tbody>
            </table>
        </div>
        <div class="col-md-3">
            <table class="table table-striped table-hover">
                <tbody>
                <tr class="success">
                    <td><h4 class="box-heading">Banco:</h4></td>
                    <td><h4>{{ $pedido->cheque->banco->nombre }} (Sucursal {{ $pedido->cheque->sucursal }})</h4></td>
                </tr>
                </tbody>
            </table>
        </div>
        <div class="col-md-6">
            <table class="table table-striped table-hover">
                <tbody>
                <tr class="success">
                    <td><h4 class="box-heading">Fecha Cobro:</h4></td>
                    <td><h4>{{ $pedido->cheque->fecha_cobro}} (emision {{ $pedido->cheque->fecha_emision}}) </h4></td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

@section('script')
    <script src="{{ URL::asset('js/pluginsPedidos.js') }}"></script>
    <script>
        var listSidebar = "li8";
        var elemFaltante = "nada";
    </script>
@endsection
