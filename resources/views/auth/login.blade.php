@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
      <div class="col-md-9">
        <div class="card-group mb-0">
          <div class="card p-4">
          <form class="form-horizontal was-validated" method="POST" action="{{ route('login')}}">
          {{ csrf_field() }}
              <div class="card-body">
              <h1>Acceder</h1>
              <p class="text-muted">Control de acceso al sistema</p>
              <div class="form-group mb-3{{$errors->has('username' ? 'is-invalid' : '')}}">
                <span class="input-group-addon"><i class="far fa-user"></i></span>
                <input type="text" value="{{old('username')}}" name="username" id="username" class="form-control" placeholder="username">
                {!!$errors->first('username','<span class="invalid-feedback">:message</span>')!!}
              </div>
              <div class="form-group mb-4{{$errors->has('password' ? 'is-invalid' : '')}}">
                <span class="input-group-addon"><i class="fas fa-lock"></i></span>
                <input type="password" name="password" id="password" class="form-control" placeholder="Password">
                {!!$errors->first('password','<span class="invalid-feedback">:message</span>')!!}
              </div>
              <div class="row">
                <div class="col-6">
                  <button type="submit" class="btn btn-primary px-4">Acceder</button>
                </div>
              </div>
            </div>
          </form>
          </div>
          <div class="card text-white bg-primary py-5 d-md-down-none" style="width:44%">
            <div class="card-body text-center">
              <div>
                <h2>Sistema de Grados y Títulos</h2>
                <img src="img/logo.png" height="160" width="160">
                {{-- <a href="#" target="_blank" class="btn btn-primary active mt-3"></a> --}}
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
@endsection


