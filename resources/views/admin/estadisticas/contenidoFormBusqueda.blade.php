{!! Form::open(['route' => 'admin.estadisticas.index', 'method' => 'GET']) !!}
  <div class="col-xs-1"></div>
  <div class="col-xs-4">
      <div class="input-icon right">
        <i class="fa fa-calendar"></i>
        <input type="text"  class="form-control" onchange="cambio();" id="idFechaAuditoriaInicio" value="{{ $fecha1 }}" name="fechaInicio" placeholder="Buscar a partir" value="" required/>
      </div>
  </div>
  <div class="col-xs-4">
     <div class="input-icon right">
       <i class="fa fa-calendar"></i>
       <input type="text"  class="form-control" onchange="cambio();" id="idFechaAuditoriaFin" value="{{ $fecha2 }}" name="fechaFin" placeholder="Buscar hasta" required/>
     </div>
  </div>
  {!! Form::submit('Buscar ventas', ['class' => 'btn btn-primary']) !!}
{!! Form::close() !!}
