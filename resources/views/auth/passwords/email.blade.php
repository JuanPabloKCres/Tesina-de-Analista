<!DOCTYPE html>
<html>
<head>
    <title>Login | GN Soluciónes</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @include('admin.partes.estilos') 
</head>
<body>
    <div class="page-content">
        <div id="tab-general">
            <div class="row mbl">
                <div class="col-lg-12">
                    <div class="col-md-12">
                        <div id="area-chart-spline" style="width: 100%; height: 300px; display: none;">
                        </div>
                    </div>
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-md-8 col-md-offset-2">
                                            <div class="panel panel-red">
                                                <div class="panel-heading">
                                                    Restablecer contraseña
                                                </div>
                                                <div class="panel-body">
                                             

                                    @if (session('status'))
                                        <div class="alert alert-success">
                                            {{ session('status') }}
                                        </div>
                                    @endif

                                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/password/email') }}">
                                        {!! csrf_field() !!}

                                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                            <label class="col-md-4 control-label">Correo:</label>

                                            <div class="col-md-6">
                                                <input type="email" class="form-control" name="email" value="{{ old('email') }}">

                                                @if ($errors->has('email'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('email') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-md-6 col-md-offset-4">
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="fa fa-btn fa-envelope"></i> Enviar enlace para restablecer la contraseña
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>                  
            </div>
        </div>                                                                    
    </div>                
    @include('admin.partes.scripts')
</body>
</html>