@extends('customer.dash')

@section('content')

<nav aria-label="breadcrumb" style="padding-top: 5px;">
    <ol class="breadcrumb breadcrumb-right-arrow">
        <li class="breadcrumb-item"><a href="{{ url('/') }}">Inicio</a></li>
        <li class="breadcrumb-item"><a href="{{ url('/customer/profile') }}">Perfil</a></li>
        <li class="breadcrumb-item active" aria-current="page">Datos de Cuenta</li>
    </ol>
</nav>        
@if(Session::has('msg'))
    <div class="alert alert-success"> 
        {{ Session::get('msg') }}
    </div>
@elseif (Session::has('msg1'))
    <div class="alert alert-danger"> 
        {{ Session::get('msg1') }}
    </div>
@endif
<section class="content-header">
        <h1>
            Datos de Cuenta 
        </h1> 
</section><br>     

<div class="text-center" style="margin-right: 14%; padding-bottom: 20px;">
    <button class="btn btn-success"  data-toggle="modal" data-target="#update_acount"><i class="fa fa-plus-square" aria-hidden="true"></i> Modificar</button>
    <button class="btn btn-success"  data-toggle="modal" data-target="#update_password"><i class="fa fa-plus-square" aria-hidden="true"></i> Cambiar Contraseña</button>
</div>
<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
    @if($user != null) 
        <label class="lead" for=""><strong>Nombre de Usuario:</strong> {{ $user->username }}</label><br>
        <label class="lead" for=""><strong>Correo:</strong> {{ $user->email }}</label><br>
    @else 
        <label class="lead" for="">Nombre de Usuario: Sin especificar</label><br>
        <label class="lead" for="">Correo: Sin especificar</label><br>
    @endif
</div>



@endsection

@section('acount')

<!-- Modal Update Acount Date-->
<div class="modal fade" id="update_acount" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="myModalLabel">Cambiar Datos de Cuenta</h4>
            </div>
            <div class="modal-body">
                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible" role="alert">
                        <ul><button type="button" class="close" data-dismiss="alert" aria-label="Close" ><span aria-hidden="true">&times;</span></button>
                            @foreach ($errors->all() as $error)
                                <li style="list-style-type: none;">{{ $error }} </li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @if(Session::has('msg'))
                    <div class="alert alert-success"> 
                        {{ Session::get('msg') }}
                    </div>
                @endif
                <form action="{{ route('customer.acount.update') }}" method="post">
                    {{csrf_field()}}
                    <div class="col-12 col-sm-12 col-md-12 col-lg-12" style="padding-bottom: 10px;">
                        <label for="username">Nombre de Usuario:</label>
                        <input type="text" id="username" name="username" maxLength='100' autocomplete="off" required class="form-control" value="{{old('username')}}">
                    </div>
                    <div class="col-12 col-sm-12 col-md-12 col-lg-12" style="padding-bottom: 30px;">
                        <label for="email">Correo:</label>
                        <input type="text" id="email" name="email" maxLength='100' autocomplete="off"  class="form-control" value="{{old('email')}}">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Aceptar</button>
                    </div>              
                </form>
            </div>
          </div>
        </div>
      </div>
    
    <!-- Modal Update Password-->
    <div class="modal fade" id="update_password" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="myModalLabel">Cambiar Contraseña</h4>
            </div>
            <div class="modal-body">
                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible" role="alert">
                        <ul><button type="button" class="close" data-dismiss="alert" aria-label="Close" ><span aria-hidden="true">&times;</span></button>
                            @foreach ($errors->all() as $error)
                                <li style="list-style-type: none;">{{ $error }} </li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @if(Session::has('msg'))
                    <div class="alert alert-success"> 
                        {{ Session::get('msg') }}
                    </div>
                @elseif (Session::has('msg1'))
                    <div class="alert alert-danger"> 
                        {{ Session::get('msg1') }}
                    </div>
                @endif
                <form action="{{ route('customer.acount.update.password') }}" method="post">
                    {{csrf_field()}}
                    <div class="col-12 col-sm-12 col-md-12 col-lg-12" style="padding-bottom: 10px;">
                        <label for="password_actual">Contraseña actual:</label>
                        <input type="password" id="password_actual" name="password_actual" maxLength='100' autocomplete="off" required class="form-control" value="{{old('password_actual')}}">
                    </div>
                    <div class="col-12 col-sm-12 col-md-12 col-lg-12" style="padding-bottom: 30px;">
                        <label for="password">Nueva contraseña:</label>
                        <input type="password" id="password" name="password" maxLength='100' autocomplete="off"  class="form-control" value="{{old('password')}}">
                    </div>
                    <div class="col-12 col-sm-12 col-md-12 col-lg-12" style="padding-bottom: 30px;">
                        <label for="password_confirmed">Repetir contraseña:</label>
                        <input type="password" id="password_confirmed" name="password_confirmed" maxLength='100' autocomplete="off"  class="form-control" value="{{old('password_confirmed')}}">
                    </div>    
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Aceptar</button>
                    </div>              
                </form>
            </div>
          </div>
        </div>
      </div>    
    
@endsection
