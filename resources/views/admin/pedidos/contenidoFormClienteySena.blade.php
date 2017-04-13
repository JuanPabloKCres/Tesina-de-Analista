
<?php
        $array_fecha = getdate();
        $año = $array_fecha['year'];
        $mes = $array_fecha['mon'];
        $dia = $array_fecha['mday'];

        if(strlen ($mes)==1){                       #si mes tiene un digito anteponer un 0 al mes
            if(strlen ($dia)==1){                       #si dia tambien tiene un digito anteponer un 0 al dia
                $fecha_hoy = $año.'-0'.$mes.'-0'.$dia;
            }else{
                $fecha_hoy = $año.'-0'.$mes.'-'.$dia;
            }
        }else{
            if(strlen ($dia)==1){                       #si dia tiene un digito anteponer un 0 al dia
                $fecha_hoy = $año.'-'.$mes.'-0'.$dia;
            }else{
                $fecha_hoy = $año.'-'.$mes.'-'.$dia;
            }
        }

$fecha_elegida=null; //la declaro global para usarla en el popup
?>



{{-- Sigue funcionando ;)

<form role="form" id="form-pedido">
    <div class="form-horizontal" align="right">
        <div class="row text-center">
            <div class="col-lg-11" align="right">
                <div id="divCliente">
                    @include('admin.pedidos.clienteSelect')
                </div>
                <div class="form-group hide"><label class="col-sm-3 control-label">Usuario</label>
                    <div class="col-sm-8 controls">
                        <div class="row">
                            <div class="col-xs-8">
                                <div class="input-icon right">
                                    <i class="fa fa-map-marker"></i>
                                    <input class="form-control" value="{!! Auth::user()->id !!}" id="usuarioPedido" required/>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group"><label class="col-sm-3 control-label">Info Tributaria</label>
                    <div class="col-sm-8 controls" align="right">
                        <div class="row">
                            <div class="col-xs-8">
                                <div class="input-icon right">
                                    <input class="form-control text-center" id="responiva_select" readonly type="text"/>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group"><label class="col-sm-3 control-label">IVA (%)</label>
                    <div class="col-sm-8 controls">
                        <div class="row">
                            <div class="col-xs-8">
                                <div class="input-icon right">
                                    <!--
                                    <input class="form-control" id="iva_select" readonly type="text"/>
                                    -->
                                    <select class="form-control text-center" id="iva_select" readonly align="center">
                                        <option value='21'>21%</option>
                                        <option value='10.5'>10.5%</option>
                                        <option value='0'>0%</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <div class="form-group"><label class="col-sm-3 control-label">FECHA ENTREGA ESTIMADA:</label>
                    <div class="col-sm-8 controls">
                        <div class="row">
                            <div class="col-xs-4">
                                <div class="input-icon right">
                                    {!! Form::date('fecha_entrega_date',\Carbon\Carbon::now() , ['id'=>'fecha_entrega_date','min'=>$fecha_hoy])!!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div id="divSena" class="form-group hide animated pulse">
                    <label class="col-sm-3 control-label">Seña</label>
                    <div class="col-sm-8 controls">
                        <div class="row">
                            <div class="col-xs-8">
                                <div class="input-icon right">
                                    <i class="fa fa-usd"></i>
                                    <input class="form-control" type="number" step="any" id="sena" data-parsley-type="number"  min="0" max="1000000" placeholder="campo requerido" required/>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <input class="hide" id="botonMandar" type="submit" value="Submit">
</form>
<button id="botonModalidad" class="btn btn-primary btn-block" title="Haga click para fijar un monto de Seña al pedido, de lo contrario se abona la totalidad del mismo." > Quiero señar el pedido</button>

--}}
<div id="alertBox" class="alert alert-warning animated rollIn" style="display:none;">
    <!-- boton para quitar el popup
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    -->
    <h4><span class="alertMessage"></span></h4>
</div>

<a class="btn gray mini mr5" id="item-publish">
    <span class="popuptext"></span>
</a>
{{--
<div class="popup" onclick="mostrarPopup()">Fecha de entrega
    <span class="popuptext" id="myPopup">
            ***la fecha elegida era: ***
        Hay {{$i}} que esperan ser entregados para esa fecha 😓
    </span>
</div>
--}}

{{--Steps--}}
<form role="form" id="form-pedido" class="clearfix">
    <div id="example-basic" style=background:white>
        <h2>Cliente</h2>
        <section>
            <div id="divCliente">
                @include('admin.pedidos.clienteSelect')
            </div>
            <div class="form-group hide" style=background:white><label class="col-sm-3 control-label">Usuario</label>
                <div class="col-sm-8 controls">
                    <div class="row">
                        <div class="col-xs-8">
                            <div class="input-icon right">
                                <i class="fa fa-map-marker"></i>
                                <input class="form-control" value="{!! Auth::user()->id !!}" id="usuarioPedido" required/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group"><label class="col-sm-3 control-label">Info Tributaria</label>
                <div class="col-sm-8 controls" align="right">
                    <div class="row">
                        <div class="col-xs-8">
                            <div class="input-icon right">
                                <input class="form-control text-center" id="responiva_select" readonly type="text" required/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group"><label class="col-sm-3 control-label">IVA (%)</label>
                <div class="col-sm-8 controls">
                    <div class="row">
                        <div class="col-xs-8">
                            <div class="input-icon right">
                                <!--
                                <input class="form-control" id="iva_select" readonly type="text"/>
                                -->
                                <select class="form-control text-center" id="iva_select" readonly align="center">
                                    <option value='21'>21%</option>
                                    <option value='10.5'>10.5%</option>
                                    <option value='0'>0%</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <h2>Modalidad de Pago</h2>
        <section>
            {{-- Seña / Pago Total --}}
            <div id="divModoPago" class="form-group">
                <div id="divChk" class="form-group animated pulse">
                    <label class="col-sm-4 control-label">Como va a abonar ahora mismo?</label>
                    <div class="row">
                        <div class="col-sm-3">
                            <form id="radioGroupPago">
                                <input type="radio" name="chkefectivo" value="" checked="checked" id="chkEfectivo">Efectivo
                                &nbsp; &nbsp; &nbsp; &nbsp;
                                <input type="radio" name="chkefectivo" id="chkCheque">Cheque
                            </form>
                        </div>
                    </div>
                </div>

                <div id="divSena" class="form-group hide animated pulse">
                    <div class="col-sm-5 controls">
                        <div class="row">
                            <label class="col-sm-5 control-label">Seña:</label>
                            <div class="col-xs-5">
                                <div class="input-icon right">
                                    <i class="fa fa-usd"></i>
                                    <input class="form-control" type="number" step="any" id="sena" data-parsley-type="number"  min="0" max="1000000" placeholder="campo requerido" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <br><br><br>
                <button id="botonModalidad" class="btn btn-primary btn-block" title="Haga click para fijar un monto de Seña al pedido, de lo contrario se abona la totalidad del mismo." > Quiero señar el pedido</button>
            </div>
            {{-- Seña / Pago Total --}}
        </section>
        <h2>Fecha de entrega</h2>
        <section>
            {{-- ENTREGA --}}
            {{--
            <div class="form-group"><label class="col-sm-3 control-label">FECHA ENTREGA ESTIMADA:</label>
                <div class="col-sm-8 controls">
                    <div class="row">
                        <div class="col-xs-4">
                            <div class="input-icon right">
                                {!! Form::date('fecha_entrega_date',\Carbon\Carbon::now() , ['id'=>'fecha_entrega_date','min'=>$fecha_hoy])!!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            --}}
            {{-- /ENTREGA --}}

            <div class="form-group"><label class="col-sm-3 control-label">FECHA ENTREGA ESTIMADA:</label>
                <div class="col-sm-8 controls">
                    <div class="row">
                        <div class="col-xs-4">
                            <div class="input-icon right">
                                <input class="DateFrom" type="text" id="fecha_entrega_date" name="fecha_entrega_date" value="" {{--min="{{$fecha_hoy}}"--}}>
                            </div>
                        </div>



                    </div>
                </div>
            </div>

        </section>
    </div>
</form>
<input  class="hide" id="botonMandar" type="submit" value="Submit">
<button id="volverWizard" class="btn btn-primary btn-block hide" title="Haga click para volver al asistente." > Volver al asistente de pedido</button>





{{-- JavaScript para el radioButton en divChk --}}
<script>
    function check() {
        document.getElementById("chkEfectivo").checked = true;
    }
    function uncheck() {
        document.getElementById("chkEfectivo").checked = false;
    }




</script>
{{--Estilo del popup --}}
<link type="text/css" rel="stylesheet" href="{{ asset('plantillas/KAdmin-Dark/styles/popup.css') }}">
{{--/Estilo del popup --}}



<script>


    function mostrarPopup() {
        alert($('#fecha_entrega_date').val());
        var popup = document.getElementById("myPopup");
        popup.classList.toggle("show");
    }
    /** */


    function bootstrap_alert(elem, message, timeout) {
        $(elem + " .alertMessage").text(message)
        $(elem).show().alert()

        if (timeout || timeout === 0) {
            setTimeout(function() {
                $(elem).hide();
            }, timeout);
        }
    };



</script>

<script>

</script>