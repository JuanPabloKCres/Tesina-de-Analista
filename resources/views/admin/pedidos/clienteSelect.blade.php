<div class="form-group">
    <label class="col-sm-3 control-label text-orange">Cliente</label>
    <div class="col-sm-8 controls">
        <div class="row">
            <div class="col-xs-8">
              <select  id="cliente" value="Selecciona un cliente..." class="form-control selectBoot" data-live-search="true">
                  <option selected disabled>Seleccione un cliente registrado...</option>
                @foreach($clientes as $cliente)
                    @if($cliente->cuit)
                        @if($cliente->empresa)
                              <option value="{{ $cliente->id }}">{{$cliente->empresa}} -  CUIT: {{ $cliente->cuit }} &nbsp;&nbsp;&nbsp;(representante: {{ $cliente->apellido }}, {{ $cliente->nombre }})  </option>
                        @else
                              <option value="{{ $cliente->id }}">{{ $cliente->apellido }}, {{ $cliente->nombre }} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(CUIT: {{ $cliente->cuit }})  </option>
                        @endif
                    @else
                      <option value="{{ $cliente->id }}">{{ $cliente->apellido }}, {{ $cliente->nombre }} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(DNI: {{ $cliente->dni }})  </option>
                    @endif
                @endforeach
              </select>
            </div>
        </div>
    </div>
</div>
