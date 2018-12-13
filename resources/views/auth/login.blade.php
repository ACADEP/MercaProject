@extends('app')

@section('content')

    <div class="container-fluid" id="Login-Register-Container">
        <div class="row justify-content-center">
            <div class="col-12 col-sm-6 col-md-4 col-sm-offset-3 col-md-offset-4">
                <div class="card" id="Login-Register-Panel">
                    <div class="card-body">
                        @if(session('flash'))
                            <div class="alert alert-primary">
                                {{session('flash')}}
                            </div>
                        @endif    
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
                                    <button type="submit" class="btn btn-primary btn-rounded waves-effect waves-light btn-block">Iniciar Sesión</button>
                                </div>
                                <div class="col-md-12">
                                    <br><a href="{{ url('password/email') }}" class="d-block text-center" id="Forgot-Password">Olvidé mi contraseña</a>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-12 col-md-offset-3 text-center">
                                    <a href="{{ url('/register') }}" id="Sign-up" class="btn btn-primary btn-rounded waves-effect waves-light btn-block">Registrase</a>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
