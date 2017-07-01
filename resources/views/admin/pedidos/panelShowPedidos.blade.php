@include('admin.pedidos.editarProgreso')

<div class="panel-body">
    <h3>Detalle del presupuesto y pago</h3>
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
        <div class="col-md-3">
            <table class="table table-striped table-hover">
                <tbody>
                <tr>
                    <td><h4 class="box-heading">Monto total del pedido:</h4></td>
                    <td><h4>${{ $pedido->importe() }}</h4></td>
                </tr>
                </tbody>
            </table>
        </div>
        <div class="col-md-3">
            <table class="table table-striped table-hover">
                <tbody>
                <tr>
                    <td><h4 class="box-heading">Progreso del pedido:</h4></td>
                    <td onclick="$('#modal-editar-progreso').modal()"><h4>{{ $pedido->progreso }}%</h4></td>
                </tr>
                </tbody>
            </table>
        </div>
        @if($pedido->pagado == 0)
            <div class="col-md-3">
                <table class="table table-striped table-hover">
                    <tbody>
                    <tr>
                        <td><h4 class="box-heading">Restan abonar:</h4></td>
                        <input type="hidden" name="restaAbonar_oculto" id="restaAbonar_oculto" value="{{ $pedido->importe() - $pedido->senado }}"> {{-- Invisible--}}
                        <td class="text-yellow"><h4>${{ $pedido->importe() - $pedido->senado }}</h4></td>
                    </tr>
                    </tbody>
                </table>
            </div>
        @endif
        <div class="col-md-3">
            <table class="table table-striped table-hover">
                <tbody>
                <tr>
                    <td><h4 class="box-heading">Factura Autorizada:</h4></td>
                    @if($pedido->nro_cae)
                        <td><h4>✔️</h4></td>
                    @else
                        <td><h4>❌️</h4></td>
                    @endif
                </tr>
                </tbody>
            </table>
        </div>
    </div>
    {{-- Si pago TODO → Mostrar estos datos--}}
    @if($pedido->pagado == 1)
        <div class="row mtl">
            <div class="col-md-6">
                <table class="table table-striped table-hover">
                    <tbody>
                    <tr class="badge-info">
                        <td class="text-facebook text-center"><h4 class="box-heading">** Se abonó la totalidad **</h4></td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-md-6">
                <table class="table table-striped table-hover">
                    <tbody>
                    <tr class="success">
                        <td><h4 class="box-heading">Fecha de entrega establecida:</h4></td>
                        <td><h4>{{ $pedido->fecha_entrega_estimada }} {{-- (hace {{ $pedido->diasDeDemora($pedido->fecha_entrega_estimada) }} días)--}}</h4></td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    @endif
    @if($pedido->forma_pago == 'efectivo')
        <div class="row mtl">
            <div class="col-md-12">
                <table class="table table-striped table-hover">
                    <tbody>
                    <tr class="info">
                        <td class="text-dark text-center"><h4 class="box-heading">Totalidad en Efectivo</h4></td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    @endif

    @if($pedido->forma_pago == 'seña c/ cheque')
        <div class="row mtl">
            <div class="col-md-12">
                <table class="table table-striped table-hover">
                    <tbody>
                    <tr class="info">
                        <td class="text-dark text-center"><h4 class="box-heading">${{ $pedido->senado }} pagados con Cheque</h4></td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    @endif

    {{-- Si pago con cheque → Mostrar datos del cheque--}}
    @if($pedido->cheque)
        <h3>Datos del Cheque  🏛 </h3>
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
                        <td><h4 class="box-heading">Banco: </h4></td>
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
    @endif
    {{-- /Si pago con cheque → Mostrar datos del cheque--}}
</div>

@section('script')
    <script src="{{ URL::asset('js/pluginsPedidos.js') }}"></script>
    <script>
        var listSidebar = "li8";
        var elemFaltante = "nada";
    </script>
@endsection
