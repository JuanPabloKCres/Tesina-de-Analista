
<div class="panel-body">
    <h3>Detalle de la compra</h3>
    <br>
    <div class="row mtl">
        <div class="col-md-4">
            <table class="table table-striped table-hover">
                <tbody>
                    <tr>
                        <td><h4 class="box-heading">Usuario que registró la compra:</h4></td>
                        <td><h4>{{ $compra->usuarioCompra->name }}</h4></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="col-md-4">
            <table class="table table-striped table-hover">
                <tbody>
                    <tr>
                        <td><h4 class="box-heading">Fecha y hora del compra:</h4></td>
                        <td><h4>{{ $compra->fecha_compra }} - {{ $compra->hora_compra }}</h4></td>
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
                        <td><h4 class="box-heading">Usuario que concretó la compra:</h4></td>
                        <td><h4>{{ $compra->usuarioCompra->name }}</h4></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="col-md-4">
            <table class="table table-striped table-hover">
                <tbody>
                      <tr>
                        <td><h4 class="box-heading">Fecha y hora de la compra:</h4></td>
                        <td><h4>{{ $compra->fecha_venta }} - {{ $compra->hora_venta }}</h4></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="col-md-4">
            <table class="table table-striped table-hover">
                <tbody>
                    <tr class="warning">
                        <td><h4 class="box-heading">Monto total del compra:</h4></td>
                        <td><h4>${{ $compra->importe }}</h4></td>
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
