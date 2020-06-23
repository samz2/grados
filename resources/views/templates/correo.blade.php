@extends('layouts.template')

@section('content')
@php
    $listar = null;
        $directorio = opendir(public_path());
        // while($elemento = readdir($directorio))
        // {
        //     $dir = public_path()."/Archivos bachiller"."/$elemento";
        //     if(is_dir($dir))
        //     {
        //         $listar = "<li><a href='$dir'>$elemento</a></li>";
        //     }else
        //     {
        //         $listar = "<li><a href='$dir'>$elemento</a></li>";
        //     }
        // }
@endphp
<div class="row">
    <div class="col-md-12">
    <div class="card card-primary ">
      <div class="card-header bg-teal">
        <h3 class="card-title">Redactar correo</h3>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <div class="form-group">
          <input class="form-control" placeholder="Para:">
        </div>
        <div class="form-group">
          <input class="form-control" placeholder="Asunto:">
        </div>
        <div class="form-group">
            <textarea id="compose-textarea" class="form-control" style="height: 200px">
              
            </textarea>
        </div>
        <div class="form-group">
          <div class="btn btn-default btn-file">
            <button data-target="#adjuntos" title="Enviar Correo" class="btn bg-warning altoBoton" data-toggle="modal" data-placement="left" name="attachment">
              <i class="fas fa-paperclip"></i> adjuntar
            </button>
          </div>
        
      </div>
      <!-- /.card-body -->
      <div class="card-footer">
        <div class="float-right">
          <button type="submit" class="btn btn-primary"><i class="far fa-envelope"></i> Enviar</button>
        </div>
      </div>
      <!-- /.card-footer -->
    </div>
    <!-- /.card -->
  </div>
</div>  
<div class="modal fade" id="adjuntos" tabindex="-1" role="dialog" aria-labelledby="adjuntoslabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
          <div class="modal-content">
          <div class="modal-header text-center">
              <h5 class="modal-titler text-center" id="adjuntoslabel">Archivos</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <div class="modal-body">
              @while ($elemento = readdir($directorio))
            
                <li><a href="{{public_path().'/'.$elemento}}" target="_blank">{{$elemento}}</a></li>
                  
              @endwhile
          </div>
      </div>
  </div>
</div> 
</div>

@endsection