<div id="tab-lista" class="tablaResultados2 col-lg-12">
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-red">
                <div class="panel-heading">Cuentas Corrientes Abiertas</div>
                <div class="panel-body">
                    <br>
                    @include('admin.partes.msjError')
                    @include('flash::message')
                    <table id="tab-ccorrientes" class="dataTable display table table-hover table-striped">
                        <thead>
                        <tr>
                            <th class="text-center">Cuenta de </th>
                            <th class="text-center">Debe (cheques por cobrar) </th>
                            <th class="text-center">Haber</th>
                            <th class="text-center">Saldo</th>
                            <th class="text-center">Fecha y hora apertura</th>
                            <th class="text-center">Usuario que abrió la cuenta</th>
                            <th class="text-center">Ver</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($cuentascorrientes as $cuentacorriente)
                            <tr>
                                <td class="text-center">{{ $cuentacorriente->cliente->nombre}} {{ $cuentacorriente->cliente->apellido}}</td>
                                <td class="text-center text-red">${{ $cuentacorriente->debe_cc($cuentacorriente)}} ($)</td>
                                <td class="text-center text-green">${{ $cuentacorriente->haber_cc($cuentacorriente)}}</td>
                                @if($cuentacorriente->totalMovimientos() < 0)
                                    <td class="text-center text-yellow">${{ $cuentacorriente->totalMovimientos()}}</td>
                                @elseif($cuentacorriente->totalMovimientos() < -3000)
                                    <td class="text-center text-red">$ {{ $cuentacorriente->totalMovimientos()}}</td>
                                @else
                                    <td class="text-center text-green">$ {{ $cuentacorriente->totalMovimientos()}}</td>
                                @endif
                                <td class="text-center">$ {{ $cuentacorriente->fecha_apertura }} ({{ $cuentacorriente->hora_apertura }}hs)</td>
                                <td class="text-center">{{ $cuentacorriente->usuarioApertura->name}}</td>
                                <td class="text-center">
                                    <a data-toggle="tooltip" data-placement="top" title="Visualizar registro. Al visualizar este registro podrá acceder a todos los movimientos del mismo." href="{{ route('admin.ccorrientes.show', $cuentacorriente->id) }}" class="btn btn-info"> <span class="fa fa-eye" aria-hidden="true"></span></a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


@section('script')
    <script src="{{ asset('js/pluginsCajas.js') }}"></script>
@endsection
