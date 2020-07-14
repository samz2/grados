
<template>
    <!-- <div class="container-fluid"> -->
        <div class="row">
            <div class="col-md-12">
	            <div class="card card-default"  id="objetivo">
	                <div class="card-header text-center" style="background-color: powderblue !important; color:black; font-weight: bold;">
	                    <h4 class="title">Gestión de Proyecto de Tesis</h4>  
	                </div>
                    <div class="col-md-5"><label>* Campos obligatoriamente.</label></div>
                    
                    <div class="col-md-5" id="labelInicio"><label>Nota: Primero realizar la búsqueda del(los) tesista(s)</label></div>
                    <!--<div class="col-md-12" id="labelInicio"><label>Nota: Fecha de devolución alumno, es para la entrega de observaciones</label></div>-->
                    
					<div class="card-body">
                        <fieldset class="border p-2">
                            <legend class="w-auto">Datos Proyecto de Tesis 
                                <button  data-target="#exampleModal" id="buscar" @click="borrar()" class="btn btn-primary" data-toggle="modal" data-placement="left">
								Buscar Tesista<i class="fas fa-search"></i>
							    </button>
                            </legend>
                            <div class="form-group row" v-for="(t,index) in tesistas" :key="t.DNI">  
                                <div class="col-md-2">
                                    <label>Tesista {{index + 1}}:</label>   
                                </div>                             
                                <div class="col-md-7">
                                    <!-- <input type="text"  readonly class="form-control form-control-sm">
                                     -->
                                    {{t.Nombres}} 
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-2">
                                    <label>Carrera Profesional:</label>   
                                </div> 
                                <div class="col-md-7">
                                    {{proyecto.carrera}}
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-3">
                                    <button data-target="#historial" @click="getHistorial()" class="btn btn-success" data-toggle="modal" data-placement="left" >Historial revisiones <i class="fa fa-eye"></i></button>
                                </div>
                            </div>
                        </fieldset>
                        
                        <fieldset class="border p-2">
                            <legend class="w-auto">Asesor</legend>
                            <!--<div class="form-group row">
                                <div class="col-md-3">
                                <label>Docente Asesor :</label>
                                </div>
                                <div class="col-md-4" v-if="proyecto.docentenombre != null && !editar">
                                {{proyecto.docentenombre}}   
                                </div>
                                <div class="col-md-4" v-if="editar">
                                <select v-model="proyecto.docentedni" class="form-control form-control-sm">
                                        <option v-for="d in docentes" :key="d.DNI" :value="d.DNI">
                                            {{d.Nombres}} {{d.Apellidos}}
                                        </option>
                                    </select>
                                </div>
                                <div class="col-md-1">
                                    <label>Editar :</label>
                                </div>
                                <div class="col-md-4">
                                    <input type="checkbox" id="edit" @click="editarDocente(proyecto.docentedni)"> 
                                </div>
                            </div>-->
                            <div class="form-group row">
                                <div class="col-md-3">
                                <label for="ingreso">Fecha entrega asesor:</label>
                                </div>
                                <div class="col-md-3">
                                    <input type="date" max="2030-12-31"  @change="validafecha()" v-model="proyecto.dingreso" onKeyPress="return soloNumeros(event)" maxlength="3" class="form-control form-control-sm">
                                </div>
                                <div class="col-md-3">
                                <label for="comienzo">Fecha devolución asesor:</label>
                                </div>
                                <div class="col-md-3">
                                    <input type="date" max="2030-12-31" @change="validafecha()" v-model="proyecto.ddevolucion" class="form-control form-control-sm">
                                </div>
                            </div>
                            <div class="form-group row">
                                <!--<div class="col-md-3">
                                <label for="ingreso">Estado :</label>
                                </div>
                                <div class="col-md-3">
                                    <select v-model="proyecto.estado" class="form-control form-control-sm">
                                        <option value="PENDIENTE">PENDIENTE</option>
                                        <option value="EN PROCESO">EN PROCESO</option>
                                        <option value="FINALIZADO">FINALIZADO</option>
                                    </select>
                                </div>-->
                                <div class="col-md-3">
                                <label for="comienzo">Sub Estado:</label>
                                </div>
                                <div class="col-md-3">
                                    <select v-model="proyecto.subestado" class="form-control form-control-sm">
                                        <option value="OBSERVADO">OBSERVADO</option>//EN PROCESO
                                        <option value="CONFORME">CONFORME</option>//EN PROCESO
                                        <option value="FINALIZADO">ANULADO</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-3">
                                <label>Comentarios :</label>
                                </div>
                                <div class="col-md-9">
                                    <input type="text" v-model="proyecto.comentario" maxlength="250" class="form-control form-control-sm">
                                </div>
                            </div>
                        </fieldset>
                        <fieldset class="border p-2">
                            <legend class="w-auto">Fechas Alumno</legend>
                            <div class="form-group row">
                                <div class="col-md-3">
                                <label for="ingreso">Fecha entrega alumno:</label>
                                </div>
                                <div class="col-md-3">
                                    <input type="date" max="2030-12-31" @change="validafecha()" id="ingreso" v-model="proyecto.aingreso" onKeyPress="return soloNumeros(event)" maxlength="3" class="form-control form-control-sm">
                                </div>
                                <div class="col-md-3">
                                <label for="comienzo">Fecha devolución alumno:</label>
                                </div>
                                <div class="col-md-3">
                                    <input type="date" max="2030-12-31" @change="validafecha()" id="comienzo" v-model="proyecto.adevolucion" class="form-control form-control-sm">
                                </div>
                            </div>
                        </fieldset>
                        <br>
                        <div class="row">
                            <div class="col-md-4" style="text-align: center;"></div>
                            <div class="col-md-2" id="guardar" style="text-align: center;">
                                <button class="btn btn-success"  @click="addHistorial(1)">Guardar <i class="fa fa-save"></i></button>
                            </div>
                            <div class="col-md-2"  id="editar" style="text-align: center;">
                                <button class="btn btn-success" @click="editExpedito()">Guardar <i class="fa fa-edit"></i></button>
                            </div>
                            <div class="col-md-2" style="text-align: center;">
                                <button class="btn btn-warning" @click="cancelar()">Limpiar <i class="fas fa-broom"></i></button>
                            </div>
                            <div class="col-md-4" style="text-align: center;"></div>
                        </div>
	                </div>
				</div>
			</div>
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                        <div class="modal-header text-center" style="background-color: powderblue !important; color:black; font-weight: bold;">
                            <h5 class="modal-titler" id="exampleModalLabel">Buscar Tesista(s)</h5>
                            <button type="button" class="close" data-dismiss="modal" @click="borrar()" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group row">
                            <div class="col-md-12">
                                <label>Nota: Ingresar DNI o Código Universitario</label>
                            </div>
                            </div>
                            <div class="form-group row">
                                <label for="dni1" class="col-md-2 col-form-label">DNI: </label>
                                <div class="col-md-4">
                                    <input type="text" v-model="alumno.dni" onKeyPress="return soloNumeros(event)" maxlength="8" id="dni1" class="form-control form-control-sm">
                                </div>
                                <label for="codigo1" class="col-md-2 col-form-label">Código: </label>
                                <div class="col-md-4">
                                    <input type="text" v-model="alumno.codigo" onKeyPress="return soloNumeros(event)" maxlength="10" id="codigo1" class="form-control form-control-sm">
                                </div>
                            </div>
                          
                            <div class="form-group row" v-for="a in alumnos" :key="a.Nombres">
                                <div class="col-md-2"><b>Tesista: </b></div>
                                <div class="col-md-10" >
                                    <!-- <input type="text" value="{{a.Nombres}}" readonly class="form-control form-control-sm"> -->
                                    {{a.Nombres}}
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-4">
                                    <button class="btn btn-primary" id="boton" @click="buscar(alumno.dni,alumno.codigo)">Buscar <i class="fa fa-search"></i></button>
                                </div>
                                <div class="col-md-4">
                                    <button class="btn btn-warning" @click="borrar()">Limpiar <i class="fas fa-broom"></i></button>
                                </div>
                                <div class="col-md-4">
                                    <button class="btn btn-success" data-dismiss="modal" type="checkbox" @click="seleccionar(alumnos,docente)">Seleccionar <i class="fas fa-check"></i></button>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div> 
            <!-- modal2 -->
            <div class="modal fade" id="historial" tabindex="-1" role="dialog" aria-labelledby="historialLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                        <div class="modal-header text-center" style="background-color: powderblue !important; color:black; font-weight: bold;">
                            <h5 class="modal-titler text-center" id="historialLabel">Historial proyecto de tesis</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <fieldset class="border p-2" style="border:red;">
                                <legend class="w-auto text-primary">Historial de revisiones</legend>
                                <!--<div class="text-center">
                                    <div v-if="!cargando" class="spinner-border text-primary" role="status">
                                        <span class="sr-only">Loading...</span>
                                    </div>
                                    <label v-if="historial.length == 0 && cargando" class="text-danger">
                                        Este registro aún no cuenta con revisiones.
                                    </label>
                                </div>-->
                                <div v-for="(h,index) in historial" :key="h.id">
                                    <div class="form-group row">
                                        <div class="col-md-3 t12">
                                            <label>Revisión</label>
                                        </div>
                                        <div class="col-md-1 t12">
                                            : {{index + 1}}
                                        </div>
                                        <div class="col-md-1 t12">
                                            <label>Estado</label>
                                        </div>
                                        <div class="col-md-2 t12">
                                        <b v-if="h.Estado == 'EN PROCESO'" class="text-primary">: {{h.Estado}}</b> 
                                        <b v-if="h.Estado == 'FINALIZADO'" class="text-danger">: {{h.Estado}}</b> 
                                        </div>
                                        <div class="col-md-2 t12">
                                            <label>Sub Estado</label>
                                        </div>
                                        <div class="col-md-3 t12">
                                        <b v-if="h.SubEstado == 'CONFORME'" class="text-success">: {{h.SubEstado}}</b> 
                                        <b v-if="h.SubEstado == 'OBSERVADO'" class="text-danger">: {{h.SubEstado}}</b> 
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-3 t12">
                                            <label>Fecha Entrega Asesor</label>
                                        </div>
                                        <div class="col-md-2 t12">
                                            : {{h.Fecha_Entrega_doc}}
                                        </div>
                                        <div class="col-md-3 t12">
                                            <label>Fecha Devolución Asesor</label>
                                        </div>
                                        <div class="col-md-2 t12">
                                            : {{h.Fecha_Dev_doc}}
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-3 t12">
                                            <label>Fecha Entrega Alumno</label>
                                        </div>
                                        <div class="col-md-2 t12">
                                            : {{h.Fecha_Entrega_alu}}
                                        </div>
                                        <div class="col-md-3 t12">
                                            <label>Fecha Devolución Alumno</label>
                                        </div>
                                        <div class="col-md-2 t12">
                                            : {{h.Fecha_Dev_alu}}
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-3 t12">
                                            <label>Comentarios</label>
                                        </div>
                                        <div class="col-md-9 t12">
                                            : {{h.Comentario}}
                                        </div>
                                    </div>
                                    <hr>
                                </div>
                            </fieldset>
                            
                        </div>
                    </div>
                </div>
            </div> 
            <!-- fin modal 2 -->
        </div>
               
            <!-- final modal -->
            
    <!-- </div> -->
</template>
<script>
    export default {
               
    data() {
        return {
            alumnoz:null,
            proyecto:
            {
                dingreso:null,
                aingreso:null,
                ddevolucion:null,
                adevolucion:null,
                comentario:null,
                docentedni:null,
                docentenombre:null,
                estado:null,
                subestado:null,
                id:null,
            },
            archivos:
            {
                matricula:null,
                egresado:null,
                foto:null,
                word:null,
                tesis:null
            },
			docente:{
                id:null,
                dni:null,
                nombre:null,
            },
            alumno:{
                codigo:null,
                dni:null,
                apellido:null,
            },
            editar:false,
            alumnos:[],
            tesistas:[],
            sesiones:[],
            docentes:[],
            modalidades:[],
            calificaciones:[],
            historial:[],
            
           
        }
	},
	created(){
        this.getExpeditos();
        this.getSesiones();
        this.getModalidades();
        this.getCalificaciones();
        this.getDocentes();
	},
	mounted(){
        // $('#objetivo').hide();
        $('#editar').hide();
        // $('#menos').hide();
	},
    methods: {
        getDocentes()
        {
            this.$Progress.start();
            axios.get("getDocentes")
            .then(data=>
            {
                this.docentes = data.data.docentes;
                this.$Progress.finish();
            }
            ).catch(error=>{
                console.log(error);
            })
        },
        getHistorial()
        {
            var id = this.proyecto.id;
            this.$Progress.start();
            axios.get("getHistorial/"+id)
            .then(data=>
            {
                this.historial = data.data.historial;
                this.$Progress.finish();
            }
            ).catch(error=>{
                console.log(error);
            })
        },
        getModalidades()
        {
            this.$Progress.start();
            axios.get("getModalidades")
            .then(data=>
            {
                this.modalidades = data.data.modalidades;
                this.$Progress.finish();
            }
            ).catch(error=>{
                console.log(error);
            })
        },
        editarDocente(dni)
        {
            var chbx1 = $("#edit").is(":checked");
            if(chbx1)
            {
                this.editar = true;
            }else{
                this.editar = false;
            }
            if(this.editar)
            {
                this.proyecto.docentedni = dni;
            }
        },
        getCalificaciones()
        {
            this.$Progress.start();
            axios.get("getCalificaciones")
            .then(data=>
            {
                this.calificaciones = data.data.calificaciones;
                this.$Progress.finish();
            }
            ).catch(error=>{
                console.log(error);
            })
        },
        validafecha()
        {
            
            if(this.proyecto.dingreso !=null)
            {
                var inicio = this.proyecto.dingreso;
                var final  = '2026-01-01';
                if(final<=inicio)
                {
                    swal({
                        type: 'warning',
                        title: 'Ingresar una fecha correcta',
                       
                    });
                    this.proyecto.dingreso = null;
                }
            }
             if(this.proyecto.ddevolucion !=null)
            {
                var inicio = this.proyecto.ddevolucion;
                var final  = '2026-01-01';
                if(final<=inicio)
                {
                    swal({
                        type: 'warning',
                        title: 'Ingresar una fecha correcta',
                       
                    });
                    this.proyecto.ddevolucion = null;
                }
            }

            if(this.proyecto.aingreso !=null)
            {
                var inicio = this.proyecto.aingreso;
                var final  = '2026-01-01';
                if(final<=inicio)
                {
                    swal({
                        type: 'warning',
                        title: 'Ingresar una fecha correcta',
                       
                    });
                    this.proyecto.aingreso = null;
                }
            }

             if(this.proyecto.adevolucion !=null)
            {
                var inicio = this.proyecto.adevolucion;
                var final  = '2026-01-01';
                if(final<=inicio)
                {
                    swal({
                        type: 'warning',
                        title: 'Ingresar una fecha correcta',
                       
                    });
                    this.proyecto.adevolucion = null;
                }
            }
        },
        buscar(d,c)
        {
            if(d == '') d = null;
            if(c == '') c = null;
            axios.get("getTesistas/"+d+"/"+c)
            .then(data=>
            {
                if(data.data.tesistas[0] == null)
                {
                    swal({
                        type: 'error',
                        title: 'No se encontraron registros',
                    });
                }else{
                    this.alumnos = data.data.tesistas;
                    this.docente.dni = data.data.dni;
                    this.docente.nombre = data.data.docente;
                    this.docente.id = data.data.ID;

                }
                
                this.$Progress.finish();
            }
            ).catch(error=>{
                console.log(error);
            })
        },
        cancelar()
        {
            this.proyecto.carrera     = null;
            this.t.Nombres            = null;
            this.proyecto.subestado   = null;
            this.proyecto.comentario  = null;
            this.proyecto.dingreso    = null;
            this.proyecto.ddevolucion = null;
            this.proyecto.aingreso    = null;
            this.proyecto.adevolucion = null;
        },
        borrar()
        {
            this.alumno.codigo      = null;
            this.alumno.dni         = null;
            this.alumnos.Nombres    = null;

            this.alumnos = [];
        },
        getSesiones()
        {
            this.$Progress.start();
            axios.get("getSessions")
            .then(data=>
            {
                this.sesiones    = data.data.sesiones;
                this.$Progress.finish();
            }
            ).catch(error=>{
                console.log(error);
            })
        },
        getSession(e)
        {
            this.$Progress.start();
            axios.get("getSession/"+e)
            .then(data=>
            {
                this.expedito.sfecha    = data.data.fecha;
                this.expedito.stipo     = data.data.tipo;
                this.$Progress.finish();
            }
            ).catch(error=>{
                console.log(error);
            })
        },
        validar(e)
        {
           console.log(e);
        },
        getExpeditos()
        {
            this.$Progress.start();
            axios.get("getExpeditos")
            .then(data=>
            {
                this.expeditos = data.data.expeditost;
                this.$Progress.finish();
                console.log(data.data);
            }
            ).catch(error=>{
                console.log(error);
            })
        },
        cambiarCancelarTitulo(){    
        document.getElementById('info').innerHTML = 'Ningún archivo seleccionado';
        document.getElementById('info2').innerHTML = 'Ningún archivo seleccionado';
        document.getElementById('info3').innerHTML = 'Ningún archivo seleccionado';
        document.getElementById('info4').innerHTML = 'Ningún archivo seleccionado';
        document.getElementById('info5').innerHTML = 'Ningún archivo seleccionado';
        },
		addHistorial()
		{          
            console.log(this.proyecto);
           
            if( this.proyecto.dingreso==null||
                this.proyecto.docentedni==null||
                this.proyecto.id==null)
            {
                swal({
					type: 'warning',
                    title: 'Llenar los datos obligatorios',
                    timer: 3000
				});
            }else{
                this.$Progress.start();
                axios.post("addHistorial",{
                    proyecto:this.proyecto,
                }).then(data=>{
                    swal({
                        // position: 'top-end',
                        type: data.data.type,
                        title: data.data.title,
                        text: data.data.text,
                        showConfirmButton: false,
                        timer: 3000
                    });
                    this.$Progress.finish();
                    }).catch(error=>{
                    console.log(error);	
                    swal({
                        type: 'error',
                        title: 'Ha ocurrido un error',
                        text: 'Comuníquese con un administrador',
                        showConfirmButton: true,
                    });
                })
            }
			
		},
        ocultar(id)
        {
			if(id == '1')
			{
                $('#objetivo').show();
                $('#documentos').show();
                $('#buscar').show();
                $('#archivos').show();
                $('#guardar').show();
                $('#expeditos').hide();
                $('#editar').hide();
                $('#menos').show();
                $('#mas').hide();
                $('#labelInicio').show();
			}
			else if(id == '2')
			{
				$('#objetivo').hide();
				$('#archivos').hide();
				$('#editar').hide();
				$('#guardar').hide();
                $('#buscar').hide();                
                $('#expeditos').show();	
                $('#menos').hide();
                $('#mas').show();
                $('#labelInicio').hide();
			}
			
        },
        estado(id,tipo)
        {
			this.$Progress.start();

            if(tipo == 1)
            {
                swal({
                    title: '¿Deseas cambiar el estado de este expedito?',
                    text: "El estado cambiara a En Proceso",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si',
                    cancelButtonText: 'cancelar',
                }).then((result) => {
                    if (result.value) {
                        axios.get('/updateExpedito/'+id+'/'+tipo)
                            .then(data => {
                            if(data.data=="OK"){
                                swal(
                                '¡Buen trabajo!',
                                'El Expedito cambió a En Proceso.',
                                'success'
                                );
                            this.$Progress.finish();
                            setTimeout(() => {
                                location.reload();
                            }, 2000);
                            }
                            }).catch(error => {
                                console.log('Ha ocurrido un error ' + error);
                                this.$Progress.fail();
                            });
                        }
                    });        
            }else{
                swal({
                    title: '¿Deseas cambiar el estado de este expedito?',
                    text: "El estado cambiará a Finalizado",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si',
                    cancelButtonText: 'cancelar',
                }).then((result) => {
                    if (result.value) {
                        axios.get('/updateExpedito/'+id+'/'+tipo)
                            .then(data => {
                            if(data.data=="OK"){
                                swal(
                                '¡Buen trabajo!',
                                'El Expedito cambió a Finalizado',
                                'success'
                                );
                            this.$Progress.finish();
                            setTimeout(() => {
                                location.reload();
                            }, 2000);
                            }
                            }).catch(error => {
                                console.log('Ha ocurrido un error ' + error);
                                this.$Progress.fail();
                            });
                        }
                    });
            }
            
		},
        seleccionar(alumnos,docente)
        {
            this.tesistas = alumnos;
            this.proyecto.carrera       = this.tesistas[0].Carrera;
            this.proyecto.docentedni    = docente.dni;
            this.proyecto.docentenombre = docente.nombre;
            this.proyecto.id            = docente.id;
        },
        validarMatricula(e)
        {
            var size = e.target.files[0].size;
            var type = e.target.files[0].type;
            if(size > 1024001)
            {
               e.target.value = '';
               swal({
                        type: 'error',
                        title: 'Ha ocurrido un error',
                        text: 'El tamaño del archivo debe ser menor o igual a 1mb',
                        showConfirmButton: true,
                    });
                document.getElementById('info').innerHTML = 'Ningún archivo seleccionado';
                return;    
            }
            if(type.includes("pdf"))
            {
                var file = new FileReader();
                file.readAsDataURL(e.target.files[0]);
                file.onload = (e) =>
                {
                    this.archivos.matricula = e.target.result;
                }
            }else
            {
                e.target.value = '';
                this.archivos.matricula = null;
                swal({
                        type: 'error',
                        title: 'Ha ocurrido un error',
                        text: 'El archivo debe ser PDF, por favor intente subiendo otro archivo',
                        showConfirmButton: true,
                    });
                return;     
            }
            
        },
        validarEgresado(e)
        {
            var size = e.target.files[0].size;
            var type = e.target.files[0].type;
            if(size > 1024001)
            {
                e.target.value = '';
                swal({
                        type: 'error',
                        title: 'Ha ocurrido un error',
                        text: 'El tamaño del archivo debe ser menor o igual a 1mb',
                        showConfirmButton: true,
                    });
                document.getElementById('info2').innerHTML = 'Ningún archivo seleccionado';
                return;    
            }
            if(type.includes("pdf"))
            {
                var file = new FileReader();
                file.readAsDataURL(e.target.files[0]);
                file.onload = (e) =>
                {
                    this.archivos.egresado = e.target.result;
                }
            }else
            {
                e.target.value = '';
                swal({
                        type: 'error',
                        title: 'Ha ocurrido un error',
                        text: 'El archivo debe ser PDF, por favor intente subiendo otro archivo',
                        showConfirmButton: true,
                    });
                return;     
            }
            
        },
        validarFoto(e)
        {
            var size = e.target.files[0].size;
            var type = e.target.files[0].type;
            if(size > 1024001)
            {
                e.target.value = '';
                swal({
                        type: 'error',
                        title: 'Ha ocurrido un error',
                        text: 'El tamaño del archivo debe ser menor o igual a 1mb',
                        showConfirmButton: true,
                    });
                document.getElementById('info3').innerHTML = 'Ningún archivo seleccionado';
                return;    
            }
            if(type.includes("image"))
            {
                var file = new FileReader();
                file.readAsDataURL(e.target.files[0]);
                file.onload = (e) =>
                {
                    this.archivos.foto = e.target.result;
                }
                
            }else
            {
                e.target.value = '';
                swal({
                        type: 'error',
                        title: 'Ha ocurrido un error',
                        text: 'El archivo debe ser una imagen, por favor intente subiendo otro archivo',
                        showConfirmButton: true,
                    });
                return;     
            }
            
        },
        validarTesis(e)
        {
            var size = e.target.files[0].size;
            var type = e.target.files[0].type;
            if(size > 5000001)
            {
                e.target.value = '';
                swal({
                        type: 'error',
                        title: 'Ha ocurrido un error',
                        text: 'El tamaño del archivo debe ser menor o igual a 1mb',
                        showConfirmButton: true,
                    });
                document.getElementById('info4').innerHTML = 'Ningún archivo seleccionado';
                return;    
            }
            if(type.includes("pdf"))
            {
                var file = new FileReader();
                file.readAsDataURL(e.target.files[0]);
                file.onload = (e) =>
                {
                    this.archivos.tesis = e.target.result;
                }
                
            }else
            {
                e.target.value = '';
                swal({
                        type: 'error',
                        title: 'Ha ocurrido un error',
                        text: 'El archivo debe ser PDF, por favor intente subiendo otro archivo',
                        showConfirmButton: true,
                    });
                return;     
            }
            
        },
        validarWord(e)
        {
            var size = e.target.files[0].size;
            var type = e.target.files[0].type;
            console.log(type);
            if(size > 5000001)
            {
                e.target.value = '';
                swal({
                        type: 'error',
                        title: 'Ha ocurrido un error',
                        text: 'El tamaño del archivo debe ser menor o igual a 1mb',
                        showConfirmButton: true,
                    });
                document.getElementById('info5').innerHTML = 'Ningún archivo seleccionado';
                return;    
            }
            if(type.includes("word"))
            {
                var file = new FileReader();
                file.readAsDataURL(e.target.files[0]);
                file.onload = (e) =>
                {
                    this.archivos.word = e.target.result;
                }
                
            }else
            {
                e.target.value = '';
                swal({
                        type: 'error',
                        title: 'Ha ocurrido un error',
                        text: 'El archivo debe ser un documento en Word, por favor intente subiendo otro archivo',
                        showConfirmButton: true,
                    });
                return;     
            }
            
        },
        edit(IDExpedito,Tipo,CodigoAlumno,Tomo,Folio,Asiento,NumSesion,FechaIngreso,FechaComienzo,IDSesion,Fecha,Escuela,Alumno,DNI,IDModalidad,Modalidad,NombreTesis,Asesor,IDCalificacion,Calificacion,FechaT)
        {
            $("#objetivo").show();
            $("#expeditos").hide();
            $("#archivos").hide();
            $("#documentos").hide();
            $("#buscar").hide();
            $('#labelInicio').hide();
            $('#mas').hide();
            $('#editar').show();
            $('#guardar').hide();
            this.expedito.idexpedito = IDExpedito;
            this.expedito.codigo     = CodigoAlumno;
            this.expedito.dni        = DNI;
            this.expedito.alumno     = Alumno;
            this.expedito.carrera    = Escuela;
            this.expedito.tomo       = Tomo;
            this.expedito.folio      = Folio;
            this.expedito.asiento    = Asiento;
            this.expedito.sesion     = NumSesion;
            this.expedito.sfecha     = Fecha;
            this.expedito.stipo      = Tipo;
            this.expedito.ingreso    = FechaIngreso;
            this.expedito.comienzo   = FechaComienzo;
            this.expedito.tesis      = NombreTesis;
            this.expedito.sustentacion = FechaT;
            this.expedito.calificacion = IDCalificacion;
            this.expedito.asesor     = Asesor;
            this.expedito.modalidad  = IDModalidad;
        },
        editExpedito()
        {
            if( this.expedito.codigo==null || this.expedito.dni==null ||
                this.expedito.alumno==null || this.expedito.carrera==null ||
                this.expedito.tomo==null || this.expedito.folio==null || this.expedito.asiento==null ||
                this.expedito.sesion==null || this.expedito.sfecha==null || this.expedito.stipo==null ||
                this.expedito.ingreso==null || this.expedito.tesis== null || this.expedito.sustentacion == null || this.expedito.calificacion == null || this.expedito.asesor == null || this.expedito.modalidad  == null)
            {
                swal({
                    type: 'warning',
                    title: 'Llenar los campos obligatorios',
                    timer: 3000
                });
                return;
            }else{
                this.$Progress.start();
                axios.post("updateExpeditoT",{
                    expedito:this.expedito,
                    archivos:this.archivos
                }).then(data=>{
                    swal({
                        type: data.data.type,
                        title: data.data.title,
                        text: data.data.text,
                        showConfirmButton: false,
                        timer: 3000
                    });
                    this.$Progress.finish();
                    // setTimeout(() => {
                    //     location.reload();
                    // }, 1500);
                    this.cancelar();
                    this.getExpeditos();
                    }).catch(error=>{
                    console.log(error);	
                    swal({
                        type: 'error',
                        title: 'Ha ocurrido un error',
                        text: 'Comuníquese con un administrador',
                        showConfirmButton: true,
                    });
                })
            }
        }
    }
}
</script>
