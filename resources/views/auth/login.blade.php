@extends('app')

@section('content')

    <div class="container-fluid" id="Login-Register-Container">
        <div class="row justify-content-center">
            <div class="col-12 col-sm-6 col-md-4 col-sm-offset-3 col-md-offset-4">
                <div class="card" id="Login-Register-Panel">
                    <div class="card-body">
                        <h4 class="text-center" id="log-in">Iniciar Sesión</h4>
                        <form class="form-horizontal" role="form" method="POST" action="{{ route('auth.login') }}">
                            {!! csrf_field() !!}

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

                            <div class="form-group">
                                <div class="col-md-12 col-md-offset-1">
                                    <div class="custom-control custom-checkbox mr-sm-2">
                                        <input type="checkbox" class="custom-control-input" id="customControlAutosizing">
                                        <label class="custom-control-label" for="customControlAutosizing">Recuérdame</label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-12 col-md-offset-3 text-center">
                                    <button type="submit" class="btn btn-default btn-rounded waves-effect waves-light btn-block">Iniciar Sesión</button>
                                </div>
                                <div class="col-md-12">
                                <br><a href="{{ url('password/email') }}" class="d-block text-center" id="Forgot-Password">Olvidé mi contraseña</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <br><p id="No-Account" class="d-block text-center">¿No tienes una cuenta? <a href="{{ url('/register') }}" id="Sign-up">Registrarse</a></p>
                <div class="" id="Login-Register-Panel" style="padding: 20px, margin-bottom: 20px">
                    <!--<h6 class="text-center">Login as Test Admin User</h6>
                    <h6 class="text-center">Email: test@hotmail.com</h6>
                    <h6 class="text-center">Password: test123</h6>-->
                </div>
            </div>
        </div>
    </div>
@endsection
