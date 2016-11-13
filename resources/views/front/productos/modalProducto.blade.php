<div id="myModal" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Detalle del Producto</h4>
      </div>
      <div class="modal-body">
        <div class="row">
        <div class="col-md-12">
            <div class="row mtl">
                <div class="col-md-1">                                                                                                                                                 
                </div>
                <div class="col-md-4">
                    @if ($producto->imagen === "sin imagen")
                        <div class="form-group">
                            <div class="text-center mbl"><img src="{{ asset('imagenes/productos/sin-logo.jpg') }}" alt=""  style="width:400px;height:300px" class="img-thumbnail"/></div>
                        </div>  
                    @else
                        <div class="form-group">
                            <div class="text-center mbl"><img src="{{ asset('imagenes/productos/' . $producto->imagen) }}" alt="" style="width:400px;height:300px" class="img-thumbnail"/></div>
                        </div>                                   
                    @endif                                                                                                      
                </div>
                <div class="col-md-6">                                    
                     <div class="col-lg-12"><h4 class="box-heading">Descripción</h4>
                      <p class="text-justify">{{ $producto->descripcion }} </p>                                   
                        <br>                       
                    </div>
                </div>  
            </div>                          
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="row mtl">
                    <div class="col-md-1"></div>
                    <div class="col-md-10">                                                                                  
                        <table class="table table-striped table-hover">
                            <tbody>                                                       
                                <tr>
                                    <td class="text-center"><h4 class="box-heading">Nombre:</h4></td>
                                    <td class="text-center"><h4>{{ $producto->nombre }}</h4></td>
                                </tr>
                                <tr>
                                    <td class="text-center"><h4 class="box-heading">Tipo:</h4></td>
                                    <td class="text-center"><h4>{{ $producto->tipo->nombre }}</h4></td>
                                </tr>

                            </tbody>
                        </table> 
                    </div> 
                    <div class="col-md-1"></div>                                                                          
                </div>  
            </div>                          
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>