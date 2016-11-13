<div id="busqueda" class="panel panel-default hide">
    <div class="panel-body">
        <div class="row col-lg-12"> 
            <div class="col-lg-4">                                         
                <div class="form-group">
                    <label>Nombre</label>
                    {!! Form::select('bus-nombre', array('-1' => 'Cualquier Empresa')+$proveedoreslista, -1, ['class' => 'form-control selectBoot', 'data-live-search' => 'true', 'onchange' => 'enviar()', 'id' => 'bus-nombre']) !!}
                </div>
            </div>
            <div class="col-lg-4">                                         
                <div class="form-group">
                    <label>Empresa Proveedora</label>
                    {!! Form::select('bus-rubro', array('-1' => 'Cualquier Rubro')+$rubros, -1, ['class' => 'form-control selectBoot', 'data-live-search' => 'true', 'onchange' => 'enviar()', 'id' => 'bus-rubros']) !!}                                                                                                                                                                            
                </div>
            </div>  
            <div class="col-lg-4"> 
                <div class="form-group">
                    <label >Estado</label>
                    {!! Form::select('bus-origen', array('-1' => 'Cualquier Origen')+$localidades, -1, ['class' => 'form-control selectBoot', 'data-live-search' => 'true', 'onchange' => 'enviar()', 'id' => 'bus-origen']) !!}                                                                                                                                                                                                                                                                      
                </div> 
            </div> 
        </div>  
    </div>
</div>