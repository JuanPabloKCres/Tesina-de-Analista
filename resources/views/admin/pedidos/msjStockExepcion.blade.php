{{--
<div id="msjStock" class="alert hide alert-warning alert-dismissable">
      <button type="button" onclick="javascript:$('#msjStock').addClass('hide')" aria-hidden="true" class="close">&times;</button>
    <strong>Atención: ¡problema con la cantidad ingresada!</strong>
        <p>Actualmente el stock disponible para el producto selecionado ha sido agotado o no es suficiente para cubrir lo solicitado.</p>
</div>
--}}
<div id="msjStock" class="alert hide alert-warning animated rollIn alert-dismissable">
    <button type="button" onclick="javascript:$('#msjStock').addClass('hide')" aria-hidden="true" class="close">&times;</button>
    <strong>Atención: ¡problema con la cantidad ingresada!</strong>
    <p>Actualmente el stock disponible para el producto selecionado ha sido agotado o no es suficiente para cubrir lo solicitado.</p>
</div>

{{-- Carteles para los posibles insumos faltantes --}}
<div id="insumo0" class="alert hide alert-warning animated zoomInLeft alert-dismissable">
    <h4><span class="alertMessage"></span></h4>
</div>
<div id="insumo1" class="alert hide alert-warning animated slideInRight alert-dismissable">
    <h4><span class="alertMessage"></span></h4>
</div>
<div id="insumo2" class="alert hide alert-warning animated slideInLeft alert-dismissable">
    <h4><span class="alertMessage"></span></h4>
</div>
{{--------------------------------------------------}}
