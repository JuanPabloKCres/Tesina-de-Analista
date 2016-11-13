<div id="modalProducto"></div>  
<div class="content-block" id="productos">
    <div class="container portfolio-sec">
        <header class="block-heading cleafix">
            <a href="{{ route('productos.index') }}" class="btn btn-o btn-lg pull-right">Ver todos los Productos</a>
            <div class="title-page">
                <p class="main-header">Productos </p>
                <p class="sub-header">Estos son algunos de nuestros productos.</p>
            </div>
        </header>
        {{--  --}}
        @include('front.productos.contenidoTabla')
    </div>
</div>
<button id="boton-modal" class="hide" data-toggle="modal" data-target=".bs-example-modal-lg"></button>

@section('script') 
<script src="{{ asset('js/productos.js') }}"></script>
<script>
    var route = "/productos";
</script>
@endsection