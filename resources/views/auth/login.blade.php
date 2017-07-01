<!DOCTYPE html>
<html>
<head>
    <title>Login | GNSoluciones</title>
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
                            <div class="panel panel-red animated bounceInLeft">
                                <div class="panel-heading">
                                    GN Soluciones | Login al Sistema de Gestión
                                </div>
                                <div class="panel-body">                                
                                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">


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

                                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                            <label class="col-md-4 control-label">Contraseña:</label>

                                            <div class="col-md-6">
                                                <input type="password" class="form-control" name="password">

                                                @if ($errors->has('password'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('password') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-md-6 col-md-offset-4">
                                                <div class="checkbox">
                                                    <label>
                                                        <input type="checkbox" name="remember"> Recuérdame
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-md-6 col-md-offset-4">
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="fa fa-btn fa-sign-in"></i> Ingresar
                                                </button>
                                                <a class="btn btn-link" href="{{ url('/password/reset') }}">¿Te olvidaste de tu contraseña? &nbsp;&nbsp😅</a>
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