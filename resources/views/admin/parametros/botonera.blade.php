<div class="btn-group" role="group" aria-label="...">
    <a data-toggle="tooltip"
       data-placement="bottom"
       href="{{ route('admin.colores.index') }}"
       title="Visualizar los registros de colores"
       class="btn btn-info">
       <span class="fa fa-paint-brush" aria-hidden="true"></span>
    Colores</a>

    <a data-toggle="tooltip"
       data-placement="bottom"
       href="{{ route('admin.unidades_medidas.index') }}"
       title="Visualizar los registros de unidades de medidas utilizados para la gestion de insumos"
       class="btn btn-info">
        <span class="fa fa-tachometer" aria-hidden="true"></span>
        Unidades de Medidas</a>

    <a data-toggle="tooltip"
       data-placement="bottom"
       href="{{ route('admin.materiales.index') }}"
       title="Visualizar los registros de materiales"
       class="btn btn-info">
       <span class="fa fa-cubes" aria-hidden="true"></span>
    Materiales</a>
    <a data-toggle="tooltip"
       data-placement="bottom"
       href="{{ route('admin.tipoArticulos.index') }}"
       title="Visualizar los registros de tipos de artículos"
       class="btn btn-info">
       <span class="fa fa fa-futbol-o" aria-hidden="true"></span>
    Tipos de artículos</a>
    <a data-toggle="tooltip"
       data-placement="bottom"
       href="{{ route('admin.responiva.index') }}"
       title="Visualizar los registros de categorías tributarias"
       class="btn btn-info">
       <span class="fa fa-balance-scale" aria-hidden="true"></span>
    Categorías tributarias</a>
</div>
