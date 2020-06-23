<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Grados y Títulos</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bbootstrap 4 -->
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<style>     
  .centrartabla{
        margin: auto;
    }
  .altoBoton
  {
    padding: 2px 6px; 
    font-size: 11px;
  }
  .subir{
    padding: 2px 30px;
    background-color: rgba(170, 220, 250, 1);
    color:#000;
    border:0px solid #fff;

    border-radius: 131px 131px 131px 131px;
    -moz-border-radius: 131px 131px 131px 131px;
    -webkit-border-radius: 131px 131px 131px 131px;
    border: 0px solid #000000;
  }
 
  .subir:hover{
    color:#fff;
    background: #f7cb15;
  }
  .blanco
  {
    color: #ffffff;
  }
 
  .t10
  {
    font-size: 10px;
  }
  .t11
  {
    font-size: 11px;
  }
  .t12
  {
    font-size: 12px;
  }
  .t13
  {
    font-size: 13px;
  }
  .t14
  {
    font-size: 14px;
  }
  .t15
  {
    font-size: 15px;
  }
</style>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper" id="app">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>
      {{-- <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Cerrar Sesión</a>
      </li> --}}
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
				<!-- Messages Dropdown Menu -->
				<li class="nav-item dropdown">
					<a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
						@switch(Auth::user()->tipo)
							@case(1)
								Administrador({{Auth::user()->username}}) <span class="caret"></span>	
								@break
							@case(2)
								Decano({{Auth::user()->username}}) <span class="caret"></span>	
								@break
							@case(3)
								Asistente({{Auth::user()->username}}) <span class="caret"></span>	
								@break
								
							@default
								
						@endswitch
						{{-- {{ Auth::user()->user }} <span class="caret"></span> --}}
					</a>
					<div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
						<a class="dropdown-item" href="{{ route('logout') }}"
							onclick="event.preventDefault();
										  document.getElementById('logout-form').submit();">
							 {{ __('Cerrar Sesión') }}
						 </a>

						 <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
							 @csrf
						 </form>
					</div>
				</li>
			</ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4" style="background-color: powderblue !important;">
    <!-- Brand Logo -->
    <router-link to="/home" class="brand-link">
        <!--<img src="" alt="GyT" class="brand-image img-circle elevation-3"> -->
      <span class="brand-text font-weight-light">Grados y Títulos</span>
    </router-link>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
			<a href="#" class="d-block">
			PERFIL
			</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2"> 
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          @switch(\Auth::user()->tipo)
              @case(1)
                <li class="nav-item has-treeview">
                  <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-folder"></i>
                    <p >
                      Configuración
                      <i class="fas fa-angle-left right"></i>
                    </p>
                  </a>
                  <ul class="nav nav-treeview">
                    <li class="nav-item">
                      <router-link to="docentes" class="nav-link">
                             <i class="fas fa-user-tie"></i>
                        <p>Docentes</p>
                      </router-link>
                    </li>
                    <li class="nav-item">
                      <router-link to="estados" class="nav-link">
                             <i class="fas fa-chart-line"></i>
                        <p>Estados</p>
                      </router-link>
                    </li>
                    <li class="nav-item">
                      <router-link to="sesion" class="nav-link">
                             <i class="far fa-calendar-alt"></i>
                         <p>Sesión</p>
                      </router-link>
                    </li>
                    <li class="nav-item">
                      <router-link to="carreras" class="nav-link">
                             <i class="fas fa-school"></i>
                        <p>Carrera</p>
                      </router-link>
                    </li>
                    <li class="nav-item">
                      <router-link to="comisiones" class="nav-link">
                             <i class="fas fa-users"></i>
                        <p>Comisión</p>
                      </router-link>
                    </li>
                    <li class="nav-item">
                      <router-link to="decano" class="nav-link">
                             <i class="fas fa-user-tie"></i>
                      <p>Decano</p>
                      </router-link>
                    </li>
                    <li class="nav-item">
                      <router-link to="modalidad" class="nav-link">
                            <i class="far fa-list-alt"></i>
                      <p>Modalidad</p>
                      </router-link>
                    <li class="nav-item">
                      <router-link to="calificacion" class="nav-link">
                            <i class="far fa-list-alt"></i>
                      <p>Calificación</p>
                      </router-link>
                    <li class="nav-item">
                      <router-link to="lineas-de-investigacion" class="nav-link">
                            <i class="far fa-list-alt"></i>
                      <p>Lineas de Investigación</p>
                      </router-link>
                    </li>
                    <!--<li class="nav-item">
                      <router-link to="usuarios" class="nav-link">
                        <i class="far fa-circle 0160 nav-icon"></i>
                        <p>Usuarios</p>
                      </router-link>
                    </li>-->
                  </ul>
                </li> 
                <li class="nav-item has-treeview">
                  <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-folder"></i>
                    <p>
                      Egresados
                      <i class="fas fa-angle-left right"></i>
                    </p>
                  </a>
                  <ul class="nav nav-treeview">
                    <li class="nav-item">
                      <router-link to="egresados" class="nav-link">
                            <i class="fas fa-user-graduate"></i>
                        <p>Egresados</p>
                      </router-link>
                    </li>
                    </li>
                  </ul>
                </li>
                <li class="nav-item has-treeview">
                  <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-folder"></i>
                    <p>
                      Proyecto de Tesis
                      <i class="fas fa-angle-left right"></i>
                    </p>
                  </a>
                  <ul class="nav nav-treeview">
                    <li class="nav-item">
                      <router-link to="proyecto-de-tesis" class="nav-link">
                            <i class="fas fa-user-graduate"></i>
                        <p>Proyecto de Tesis</p>
                      </router-link>
                    </li>
                    <li class="nav-item">
                      <router-link to="gestion-proyecto" class="nav-link">
                            <i class="fas fa-list"></i>
                        <p>Gestión</p>
                      </router-link>
                    </li>
                  </ul>
                </li>
                <li class="nav-item has-treeview">
                  <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-folder"></i>
                    <p>
                      Trámites
                      <i class="fas fa-angle-left right"></i>
                    </p>
                  </a>
                  <ul class="nav nav-treeview">
                    <li class="nav-item">
                      <router-link to="expeditobachiller" class="nav-link">
                              <i class="fas fa-copy"></i>
                        <p>Expedito Bachiller</p>
                      </router-link>
                    </li>
                    <li class="nav-item">
                      <router-link to="expeditotitulo" class="nav-link">
                              <i class="fas fa-copy"></i>
                        <p>Expedito Título</p>
                      </router-link>
                    </li>
                  </ul>
                </li>
                <li class="nav-item has-treeview">
                  <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-folder"></i>
                    <p>
                      Reportes
                      <i class="fas fa-angle-left right"></i>
                    </p>
                  </a>
                  <ul class="nav nav-treeview">
                   
                    <li class="nav-item">
                      <router-link to="reporte-bachiller" class="nav-link">
                              <i class="fas fa-copy"></i>
                        <p>Expedito Bachiller</p>
                      </router-link>
                    </li>
                    <li class="nav-item">
                      <router-link to="reporte-titulo" class="nav-link">
                              <i class="fas fa-copy"></i>
                        <p>Expedito Título</p>
                      </router-link>
                    </li>
                  </ul>
                </li>
               
                  @break
              @case(2)
                  
                  @break
              @default
                  
          @endswitch
         
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <section class="content">
      <div class="container-fluid">
		    @yield("content")
	    </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  @php
      $Anio = date("Y");
  @endphp
  <footer class="main-footer">
    <strong>Copyright &copy; {{$Anio}} <a href="#">Oficina de Grados y Títulos</a>.</strong>
    Todos los derechos reservados.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 1.0
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js">
</script>
<!-- jQuery UI 1.11.4 -->
{{-- <script src="plugins/jquery-ui/jquery-ui.min.js"></script> --}}
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
{{-- <script>
  $.widget.bridge('uibutton', $.ui.button)
</script> --}}
<!-- Bootstrap 4 -->
{{-- <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script> --}}
<!-- ChartJS -->
<script src="dist/js/adminlte.js"></script>
<script src="{{ asset('js/app.js') }}"></script>

<script type="text/javascript">
  

</script>


<script type="text/javascript">

function cambiarMatriculaBachiller(){
    var pdrs = document.getElementById('matricula').files[0].name;
    document.getElementById('info').innerHTML = pdrs;
}
function cambiarEgresadoBachiller(){
    var pdrs = document.getElementById('egresado').files[0].name;
    document.getElementById('info2').innerHTML = pdrs;
}
function cambiarFotoBachiller(){
    var pdrs = document.getElementById('foto').files[0].name;
    document.getElementById('info3').innerHTML = pdrs;
}


function cambiarMatriculaTitulo(){
    var pdrs = document.getElementById('matricula').files[0].name;
    document.getElementById('info').innerHTML = pdrs;
}
function cambiarEgresadoTitulo(){
    var pdrs = document.getElementById('egresado').files[0].name;
    document.getElementById('info2').innerHTML = pdrs;
}
function cambiarFotoTitulo(){
    var pdrs = document.getElementById('foto').files[0].name;
    document.getElementById('info3').innerHTML = pdrs;
}
function cambiarTesisTitulo(){
    var pdrs = document.getElementById('tesis').files[0].name;
    document.getElementById('info4').innerHTML = pdrs;
}
function cambiarWordTitulo(){
    var pdrs = document.getElementById('word').files[0].name;
    document.getElementById('info5').innerHTML = pdrs;
}

function pulsar(e) {
    if (e.keyCode === 13 && !e.shiftKey) {
        e.preventDefault();
        var boton = document.getElementById("boton");
        angular.element(boton).triggerHandler('click');
    }
}

//function cambiarCancelarBachiller(){
    //var pdrs = document.getElementById('file-upload').files[0].name;
    //document.getElementById('info').innerHTML = 'Ningún archivo seleccionado';
    //document.getElementById('info2').innerHTML = 'Ningún archivo seleccionado';
    //document.getElementById('info3').innerHTML = 'Ningún archivo seleccionado';
//}

  function soloNumeros(event)
  {
    return event.charCode >= 48 && event.charCode <= 57
  }

  function soloLetras(e){
       key = e.keyCode || e.which;
       tecla = String.fromCharCode(key).toLowerCase();
       letras = " áéíóúabcdefghijklmnñopqrstuvwxyz'";
       especiales = "8-37-38-46-164";

       tecla_especial = false
       for(var i in especiales){
            if(key == especiales[i]){
                tecla_especial = true;
                break;
            }
        }

        if(letras.indexOf(tecla)==-1 && !tecla_especial){
            return false;
        }
    }

    function soloTesis(e){
       key = e.keyCode || e.which;
       tecla = String.fromCharCode(key).toLowerCase();
       letras = " áéíóúabcdefghijklmnñopqrstuvwxyz'-_0123456789.,;:/()";
       especiales = "8-37-38-46-164";

       tecla_especial = false
       for(var i in especiales){
            if(key == especiales[i]){
                tecla_especial = true;
                break;
            }
        }

        if(letras.indexOf(tecla)==-1 && !tecla_especial){
            return false;
        }
    }

    function soloEmail(e){
       key = e.keyCode || e.which;
       tecla = String.fromCharCode(key).toLowerCase();
       letras = " áéíóúabcdefghijklmnñopqrstuvwxyz-_.@0123456789";
       especiales = "8-37-38-46-164";

       tecla_especial = false
       for(var i in especiales){
            if(key == especiales[i]){
                tecla_especial = true;
                break;
            }
        }

        if(letras.indexOf(tecla)==-1 && !tecla_especial){
            return false;
        }
    }
    
    

    function soloCodigoDocente(e){
       key = e.keyCode || e.which;
       tecla = String.fromCharCode(key).toLowerCase();
       letras = " áéíóúabcdefghijklmnñopqrstuvwxyz-_0123456789";
       especiales = "8-37-38-46-164";

       tecla_especial = false
       for(var i in especiales){
            if(key == especiales[i]){
                tecla_especial = true;
                break;
            }
        }

        if(letras.indexOf(tecla)==-1 && !tecla_especial){
            return false;
        }
    }

    function soloSemestre(e){
       key = e.keyCode || e.which;
       tecla = String.fromCharCode(key).toLowerCase();
       letras = " i-0123456789";
       especiales = "8-37-38-46-164";

       tecla_especial = false
       for(var i in especiales){
            if(key == especiales[i]){
                tecla_especial = true;
                break;
            }
        }

        if(letras.indexOf(tecla)==-1 && !tecla_especial){
            return false;
        }
    }
  

  function alfa(event)
  {
    return (event.charCode >= 164 || (event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode >= 44 && event.charCode <= 57))
  }
  function alfa1(event)
  {
    return ((event.charCode >= 48 && event.charCode <= 57) || event.charCode == 45)
  }


</script>	
</body>
</html>
