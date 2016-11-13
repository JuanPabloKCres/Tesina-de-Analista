<div id="modal-actualizar" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" data-dismiss="modal" aria-hidden="true" class="close">
                    &times;</button>
                <h4 class="modal-title">
                    Actualizar registro: {{ $provincia->nombre }}</h4>
            </div>
            <div class="modal-body">   
                @include('admin.partes.listaErrores')                                    
{!! Form::model($provincia, ['route' => ['admin.provincias.update', $provincia], 'id' =>'form-actualizar', 'method' => 'PUT', 'class' => 'form-horizontal']) !!}
                        @include('admin.provincias.contenidoForm')                                    
                    {!! Form::submit('Actualizar Registro', ['class' => 'btn btn-warning btn-block']) !!}  
                    <button type="button" data-dismiss="modal" class="btn btn-white btn-block">
                    Cerrar</button>                        
                {!! Form::close() !!}
            </div>                        
        </div>
    </div>
</div>

@section('script')  
    <script>
         $(document).ready(function () {
            constructorSelect();
        });
    </script>
@endsection