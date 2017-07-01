<h3>Descripción</h3>
<br>
<div class="form-group hide"><label class="col-sm-3 control-label">Usuario</label>
    <div class="col-sm-9 controls">
        <div class="row">
            <div class="col-xs-12">
                <div class="input-icon right">
                    <i class="fa fa-pencil"></i>
                    {!! Form::text('user_id', Auth::user()->id, ['class' => 'form-control']) !!}                                
                </div>
            </div>
        </div>
    </div>
</div> 
<div class="form-group"><label class="col-sm-3 control-label">Cliente</label>
    <div class="col-sm-9 controls">
        <div class="row">
            <div class="col-xs-12">
                {{--
                <select  id="cliente_id" value="Selecciona un cliente..." class="form-control selectBoot" data-live-search="true">
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
                --}}
                {!! Form::select('cliente_id', $clientesApellido, ['class' => 'form-control selectBoot', 'data-live-search' => 'true', 'readonly' => 'readonly']) !!}
            </div>
        </div>
    </div>
</div> 

<div class="form-group"><label class="col-sm-3 control-label">Fecha</label>
    <div class="col-sm-9 controls">
        <div class="row">
            <div class="col-xs-12">
                <div class="input-icon right date">
                    <i class="fa fa-calendar"></i>
                    {!! Form::text('fecha_apertura', \Carbon\Carbon::now('America/Buenos_Aires')->format('d-m-Y'), ['class' => 'form-control', 'readonly' => 'readonly']) !!}
                </div>
            </div>
        </div>
    </div>
</div> 
<div class="form-group"><label class="col-sm-3 control-label">Hora</label>
    <div class="col-sm-9 controls">
        <div class="row">
            <div class="col-xs-12">
                <div class="input-icon right">
                    <i class="fa fa-clock-o"></i>
                    {!! Form::text('hora_apertura', \Carbon\Carbon::now('America/Buenos_Aires')->format('H:i'), ['class' => 'form-control', 'readonly' => 'readonly']) !!}
                </div>
            </div>
        </div>
    </div>
</div>
<div class="form-group"><label class="col-sm-3 control-label">Saldo Inicial</label>
    <div class="col-sm-9 controls">
        <div class="row">
            <div class="col-xs-12">
                <div class="input-icon right">
                    <i class="fa fa-usd"></i>
                    {!! Form::number('saldo', null, ['class' => 'form-control', 'placeholder' => 'campo requerido'/*, 'min' => '0.01'*/,'required']) !!}
                </div>
            </div>
        </div>
    </div>
</div>  
<br>
<hr/>
<br> 