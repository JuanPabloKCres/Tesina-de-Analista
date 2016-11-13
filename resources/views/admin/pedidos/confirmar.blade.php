
<div id="modal-confirmar" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" data-dismiss="modal" aria-hidden="true" class="close">
                    &times;</button>
                <h4 class="modal-title">
                    Registrar acciones sobre el pedido</h4>
            </div>
            <div class="modal-body">
                {!! Form::open(['route' => ['admin.pedidos.update', $pedido], 'id' =>'form-crear', 'method' => 'PUT', 'class' => 'form-horizontal', 'files' => true]) !!}
                  <br>
                  <div class="form-group hide"><label class="col-sm-3 control-label">Usuario</label>
                      <div class="col-sm-9 controls">
                          <div class="row">
                              <div class="col-xs-12">
                                  <div class="input-icon right">
                                      <i class="fa fa-map-marker"></i>
                                        <input class="form-control" value="{!! Auth::user()->id !!}" name="usuarioPedido" required/>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
                @if ($pedido->pagado)
                    <div class="note note-success">
                        <h3 class="box-heading">Información del pedido</h3>
                        <h4><p>El pago por el pedido ya ha sido cubierto. ¿Desea registrar la entrega del pedido?</p><h4>
                    </div>
                    <div class="form-group hide">
                        <h4>
                           <label class="col-sm-7 control-label">Entregar el pedido</label>
                           <div class="col-sm-1 controls"></div>
                           <div class="col-sm-4 controls">
                               <div class="row">
                                   <div class="col-xs-12">
                                       <div class="input-icon right">
                                             {!! Form::checkbox('entregado','1', '1') !!}
                                       </div>
                                   </div>
                               </div>
                           </div>
                       </h4>
                    </div>                   
                @else
                <div class="form-group hide">
                  <h4>
                    <label class="col-sm-7 control-label">Registrar pago por monto faltante</label>
                    <div class="col-sm-1 controls"></div>
                    <div class="col-sm-4 controls">
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="input-icon right">
                                      {!! Form::checkbox('pagado', '1', '1') !!}
                                </div>
                            </div>
                        </div>
                    </div>
                  </h4>
                </div>
                <div class="note note-warning">
                    <h3 class="box-heading">Registrar pago restante</h3>
                    <h4><p>Usted está a punto de proceder con la registración del pago por el monto faltante. Adicionalmente puede registrar alguna de las siguientes acciones:</p><h4>
                </div>
                <div class="form-group">
                  <h4>
                     <label class="col-sm-7 control-label">Generar factura electrónica</label>
                     <div class="col-sm-1 controls"></div>
                     <div class="col-sm-4 controls">
                         <div class="row">
                             <div class="col-xs-12">
                                 <div class="input-icon right">
                                       {!! Form::checkbox('factura', '1') !!}
                                 </div>
                             </div>
                         </div>
                     </div>
                 </h4>
                </div>
                <div class="form-group">
                  <h4>
                     <label class="col-sm-7 control-label">Entregar el pedido</label>
                     <div class="col-sm-1 controls"></div>
                     <div class="col-sm-4 controls">
                         <div class="row">
                             <div class="col-xs-12">
                                 <div class="input-icon right">
                                       {!! Form::checkbox('entregado', '1') !!}
                                 </div>
                             </div>
                         </div>
                     </div>
                 </h4>
                </div>
                @endif
               <br>
               <hr/>
               <br>                              
               {!! Form::submit('Registrar acción', ['class' => 'btn btn-warning btn-block hide']) !!}
                @if ($pedido->pagado)
               <button class="btn btn-success btn-block" type="button" onclick="generarFactura()">Registrar acción</button>
                @else
                   <button class="btn btn-warning btn-block" type="button" onclick="generarFactura()">Registrar acción</button>
                @endif                               
               <button type="button" data-dismiss="modal" class="btn btn-white btn-block">Cerrar</button>
            {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
