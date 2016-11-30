
<div class="panel-body">
    <h3>Detalle de la venta</h3>
    <br>
    <div class="row mtl">
        <div class="col-md-4">
            <table class="table table-striped table-hover">
                <tbody>
                    <tr>
                        <td><h4 class="box-heading">Usuario que registró el pedido:</h4></td>
                        <td><h4>{{ $pedido->usuarioPedido->name }}</h4></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="col-md-4">
            <table class="table table-striped table-hover">
                <tbody>
                    <tr>
                        <td><h4 class="box-heading">Fecha y hora del pedido:</h4></td>
                        <td><h4>{{ $pedido->fecha_pedido }} - {{ $pedido->hora_pedido }}</h4></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="col-md-4">
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
    </div>
    <div class="row mtl">
        <div class="col-md-4">
            <table class="table table-striped table-hover">
                <tbody>
                    <tr>
                        <td><h4 class="box-heading">Usuario que concretó la venta:</h4></td>
                        <td><h4>{{ $pedido->usuarioVenta->name }}</h4></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="col-md-4">
            <table class="table table-striped table-hover">
                <tbody>
                      <tr>
                        <td><h4 class="box-heading">Fecha y hora de la venta:</h4></td>
                        <td><h4>{{ $pedido->fecha_venta }} - {{ $pedido->hora_venta }}</h4></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="col-md-4">
            <table class="table table-striped table-hover">
                <tbody>
                    <tr class="warning">
                        <td><h4 class="box-heading">Monto total del pedido:</h4></td>
                        <td><h4>${{ $pedido->importe() }}</h4></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

@section('script')
    <script>
        var listSidebar = "li9";
        var elemFaltante = "nada";
    </script>
@endsection
