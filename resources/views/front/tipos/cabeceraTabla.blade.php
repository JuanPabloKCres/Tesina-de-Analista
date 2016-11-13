<br>
<br>
<div id="busqueda" class="panel panel-default hide animated bounceInDown">
    <div class="panel-body">
        <div class="row col-lg-12"> 
       
            <div class="col-lg-6">                                         
                <div class="form-group">
                    <label>Nombre</label>
                    {!! Form::select('bus-nombre', array('-1' => 'Cualquier Tipo')+$tipos, -1, ['class' => 'form-control selectBoot', 'data-live-search' => 'true', 'onchange' => 'enviar()', 'data-container'=>'body', 'id' => 'bus-nombre']) !!}
                </div>
            </div>
           
        </div>  
    </div>
</div>