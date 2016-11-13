@if ($errors->any())
    <div class="alert alert-warning alert-dismissable">
        <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button>
        <strong>¡Atención!</strong> 
        <ul>
            @foreach($errors->all() as $error)
                <li>
                    {{ $error }}
                </li>
            @endforeach
        </ul>                        
    </div>
@endif