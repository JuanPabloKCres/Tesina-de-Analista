<br>
<br>
<div id="busqueda" class="panel panel-default hide animated bounceInDown">
    <div class="panel-body">
        <div class="row col-lg-12"> 
            <div class="col-lg-4">                                         
                <div class="form-group">
                    <div class="form-group">
                        <label>Nombre</label>
                        {!! Form::select('bus-nombre', array('-1' => 'Cualquier Producto')+$productoslista, -1, ['class' => 'form-control selectBoot', 'data-live-search' => 'true', 'onchange' => 'enviar();', 'data-container'=>'body', 'id' => 'bus-nombre']) !!}                                                                                                                                                                            
                    </div>                                                                                                                                                        
                </div>
            </div>
            <div class="col-lg-4">                                         
                <div class="form-group">
                    <label>Tipo</label>
                    {!! Form::select('bus-tipo', array('-1' => 'Cualquier Tipo')+$tipos, -1, ['class' => 'form-control selectBoot', 'data-live-search' => 'true', 'onchange' => 'enviar();', 'data-container'=>'body', 'id' => 'bus-tipo']) !!}
                </div>
            </div>
        </div>  
    </div>
</div>