<div class="form-group">
    <label class="col-sm-3 control-label">Cliente</label>
    <div class="col-sm-9 controls">
        <div class="row">
            <div class="col-xs-12">
              <select  id="cliente" class="form-control selectBoot" data-live-search="true" required>
                @foreach($clientes as $cliente)
                    <option value="{{ $cliente->id }}">{{ $cliente->apellido }} {{ $cliente->nombre }}</option>
                @endforeach
              </select>
            </div>
        </div>
    </div>
</div>
