<div class="form-group">
    <label class="col-sm-3 control-label">Cliente</label>
    <div class="col-sm-9 controls">
        <div class="row">
            <div class="col-xs-12">
              <div class="input-icon right">
                  <i class="fa fa-user"></i>
                  <input class="form-control hide" type="text" id="cliente" value="{{ $cliente->id }}"/>
                  <input class="form-control" type="text" value="{{ $cliente->apellido }} {{ $cliente->nombre }}" readonly="readonly"/>
              </div>
            </div>
        </div>
    </div>
</div>
