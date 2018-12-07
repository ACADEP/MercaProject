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
                        <h4 class="text-center" id="log-in">Recuperar Contraseña</h4>
                        <form class="form-horizontal" role="form" method="POST" action="{{ url('/password/reset') }}">

                            <input type="hidden" name="token" value="{{ $token }}">
                            {!! csrf_field() !!}

                            <input type="hidden" name="token" value="{{ $token }}">

                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <div class="col-md-12 col-md-offset-1">
                                    <input type="email" class="form-control" name="email" value="{{ $email or old('email') }}" placeholder="Correo">
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
                                    <button type="submit" class="btn btn-primary btn-rounded waves-effect waves-light btn-block">Recuperar Contraseña</button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection