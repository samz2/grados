@extends('layouts.app')

@section('content')
<div>                                             </div>
<div>                                             </div>
<div>                                             </div>
<div class="row justify-content-center">
  
      <div class="col-md-4">
        <div class="card-group mb-0">
          
          <div class="card p-4">
            <div style="text-align:center;">
              <img src="img/logo.png" height="140" width="140">
            </div>
          <form class="form-horizontal was-validated" method="POST" action="{{ route('login')}}">
          {{ csrf_field() }}
              <div class="card-body">
              <div class="form-group mb-3{{$errors->has('username' ? 'is-invalid' : '')}}">
                <span class="input-group-addon"><i class="far fa-user"></i></span>
                <input type="text" value="{{old('username')}}" name="username" id="username" class="form-control" placeholder="Usuario">
                {!!$errors->first('username','<span class="invalid-feedback">:message</span>')!!}
              </div>
              <div class="form-group mb-4{{$errors->has('password' ? 'is-invalid' : '')}}">
                <span class="input-group-addon"><i class="fas fa-lock"></i></span>
                <input type="password" name="password" id="password" class="form-control" placeholder="Contraseña">
                {!!$errors->first('password','<span class="invalid-feedback">:message</span>')!!}
              </div>
              <div class="row">
                <div class="col-12" style="text-align:center;">
                  <button type="submit" class="btn px-4" style="background-color:rgb(0,112,210); color:white;">Iniciar sesión</button>
                  {{--<button type="submit" class="btn btn-primary px-4" >Iniciar sesión</button>--}}
                </div>
              </div>
              {{--
              <br>
              <div class="row">
                <div class="col-12" style="text-align:left; font-size: 12px;">
                  <a href="#" >¿Olvidó la contraseña?</button>
                </div>
              </div>--}}
            </div>
          </form>
          </div>
          {{--<div class="card py-5 d-md-down-none" style="width:44%">
            <div class="card-body text-center">
              <div>
                <h2>Sistema de Grados y Títulos</h2>
                <img src="img/logo.png" height="160" width="160">
                {{-- <a href="#" target="_blank" class="btn btn-primary active mt-3"></a> -----
              </div>
            </div>
          </div>--}}
        </div>
      </div>
    </div>
@endsection


