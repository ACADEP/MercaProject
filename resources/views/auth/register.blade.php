@extends('app')

@section('content')

    <div class="container-fluid" id="Login-Register-Container">
        <div class="row justify-content-center">
            <div class="col-12 col-sm-6 col-md-4 col-sm-offset-3 col-md-offset-4">
                <div class="card" id="Login-Register-Panel">
                    <div class="card-body">
                    @if(session('flash'))
                        <div class="alert alert-success">
                            {{session('flash')}}
                        </div>
                    @endif
                        <h4 class="text-center" id="log-in">Registrarse</h4>
                        <form class="form-horizontal" role="form" method="POST" action="{{ route('auth.register') }}">
                            {!! csrf_field() !!}

                            <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                                <div class="col-md-12 col-md-offset-1">
                                    <input type="text" class="form-control" name="username" value="{{ old('username') }}" placeholder="Usuario">
                                    @if ($errors->has('username'))
                                        <span class="form-text">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('account') ? ' has-error' : '' }}">
                                <div class="col-md-12 col-md-offset-1">
                                    <select class="form-control" id="SelectAccount" name="account" value="{{ old('account') }}">
                                        <option value="0" selected>Cliente</option>
                                        <option value="1">Vendedor</option>
                                    </select>
                                    @if ($errors->has('account'))
                                        <span class="form-text">
                                        <strong>{{ $errors->first('account') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <div class="col-md-12 col-md-offset-1">
                                    <input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Correo">
                                    @if ($errors->has('email'))
                                        <span class="form-text">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <div class="col-md-12 col-md-offset-1">
                                    <input type="password" class="form-control" name="password" placeholder="Contraseña">
                                    @if ($errors->has('password'))
                                        <span class="form-text">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                                <div class="col-md-12 col-md-offset-1">
                                    <input type="password" class="form-control" name="password_confirmation" placeholder="Confirmar Contraseña">
                                    @if ($errors->has('password_confirmation'))
                                        <span class="form-text">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-12 col-md-offset-3 text-center">
                                <input type="hidden" id="registerCookie" name="cookieProductos">
                                <script>document.getElementById("registerCookie").value=Cookies.get("productos");</script>
                                    <br><button type="submit" class="btn btn-default btn-rounded waves-effect waves-light btn-block">Registrarse</button>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-12 col-md-offset-3 text-center">
                                    <a href="{{ url('/login') }}" id="Sign-up" class="btn btn-default btn-rounded waves-effect waves-light btn-block">Inicia Sesión</a>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
