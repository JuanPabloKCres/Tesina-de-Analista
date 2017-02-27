<form role="form" id="form-pedido">
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
    ?>
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
                                    {!! Form::date('fecha_entrega_tentativa',\Carbon\Carbon::now() , ['id'=>'fecha_entrega_date','min'=>$fecha_hoy])!!}
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
