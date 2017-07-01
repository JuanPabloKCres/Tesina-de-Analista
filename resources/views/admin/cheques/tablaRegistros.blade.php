<div id="tab-lista" class="tablaResultados2 col-lg-12">
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-green">
                <div class="panel-heading">Cartera de Cheques</div>
                <div class="panel-body">
                    <br>
                    @include('admin.partes.msjError')
                    @include('flash::message')
                    @include('admin.cheques.msjOperacionExitosa')
                    <table id="tab-ccorrientes" class="dataTable display table table-hover table-striped">
                        <thead>
                        <tr>
                            <th class="text-center">N°</th>
                            <th class="text-center">Cheque de </th>
                            <th class="text-center">Fecha Emision</th>
                            <th class="text-center">Fecha Cobro</th>
                            <th class="text-center">Monto</th>
                            <th class="text-center">Banco</th>
                            <th class="text-center">Sucursal</th>
                            <th class="text-center">Plaza</th>
                            <th class="text-center">Cobrado</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($cheques as $cheque)
                            <tr>
                                <td class="text-center">{{ $cheque->nro_serie }}</td>
                                @if($cheque->cliente->empresa)
                                    <td class="text-center">{{ $cheque->cliente->empresa}} (responsable Sr. {{ $cheque->cliente->nombre.' '.$cheque->cliente->apellido}})</td>
                                @else
                                    <td class="text-center">{{ $cheque->cliente->nombre}} {{ $cheque->cliente->apellido}}</td>
                                @endif
                                    <td class="text-center">{{ $cheque->fecha_emision }}</td>
                                    <td class="text-center text-red">{{ $cheque->fecha_cobro }}</td>
                                    <td class="text-center">$ {{ $cheque->monto }}</td>
                                    <td class="text-center text-success">{{ $cheque->banco->nombre }}</td>
                                    <td class="text-center">{{ $cheque->sucursal }}</td>
                                    <td class="text-center">Resistencia (CP 3500)</td>
                                @if($cheque->cobrado)
                                    <td class="text-center">Si ✔️</td>
                                @else
                                    <td class="text-center">

                                        <a data-toggle="modal" data-target="#modal-editar-cheque"  data-cheque-id="{{ $cheque->id }}" href="#modal-editar-cheque" {{--onclick="registrarPagoCheque({{$cheque->id}})" --}} title="Cambiar el estado del cheque" class="">No ❌</a>
                                    ️</td>
                                @endif
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
