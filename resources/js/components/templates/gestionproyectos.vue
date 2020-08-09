
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
                                    {{t.Nombres}} 
                                </div>
                            </div>
                            <div class="form-group row" v-if="docente.nombre != null">
                                <div class="col-md-2">
                                    <label>Carrera Profesional:</label>   
                                </div> 
                                <div class="col-md-7">
                                    {{proyecto.carrera}}
                                </div>
                            </div>
                            <div class="form-group row" v-if="docente.nombre != null">
                                <div class="col-md-2"><b>Docente: </b></div>
                                <div class="col-md-10" >
                                    <!-- <input type="text" value="{{a.Nombres}}" readonly class="form-control form-control-sm"> -->
                                    {{docente.nombre}}
                                </div>
                            </div>
                            <div class="form-group row" v-if="docente.nombre != null">
                                <div class="col-md-3">
                                    <button data-target="#historial" @click="getHistorial()" class="btn btn-success" data-toggle="modal" data-placement="left" >Historial revisiones <i class="fa fa-eye"></i></button>
                                </div>
                            </div>
                        </fieldset>
                        <fieldset class="border p-2">
                            <legend class="w-auto">Docente Evaluador</legend>
                            
                            <div class="form-group row">
                                <div class="col-md-3">
                                <label for="ingreso">Fecha entrega Docente Evaluador:</label>
                                </div>
                                <div class="col-md-3">
                                    <input type="date" v-model="proyecto.dingreso" class="form-control form-control-sm">
                                </div>
                                <div class="col-md-3">
                                <label for="comienzo">Fecha devolución Docente Evaluador:</label>
                                </div>
                                <div class="col-md-3">
                                    <input type="date" max="2030-12-31" @change="validafecha()" v-model="proyecto.ddevolucion" class="form-control form-control-sm">
                                </div>
                            </div>
                            <div class="form-group row">
                          
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
                        <fieldset class="border p-2" v-if="proyecto.subestado == 'CONFORME'">
                            <legend class="w-auto">Datos Asesor</legend>
                            <div class="form-group row">
                                <div class="col-md-3">
                                <label for="ingreso">Docente Asesor:</label>
                                </div>
                                <div class="col-md-6">
                                   <select v-model="proyecto.docenteasesor" class="form-control form-control-sm">
                                        <option v-for="d in docentes" :key="d.DNI" :value="d.DNI">
                                            {{d.Docente}}
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </fieldset>
                        <br>
                        <div class="row">
                            <div class="col-md-2" id="guardar" style="text-align: center;">
                                <button class="btn btn-success"  @click="addHistorial(1)">Guardar <i class="fa fa-save"></i></button>
                            </div>
                            <div class="col-md-2" style="text-align: center;">
                                <button class="btn bg-indigo" @click="addHistorial(2)">Actualizar <i class="fa fa-edit"></i></button>
                            </div>
                            <div class="col-md-2" style="text-align: center;">
                                <button class="btn btn-warning" @click="cancelar()">Limpiar <i class="fas fa-broom"></i></button>
                            </div>
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
                            <div class="text-center">
                                <div v-if="!cargando1" class="spinner-border text-primary" role="status">
                                        <span class="sr-only">Loading...</span>
                                </div>
                            </div>
                            <br>
                            <div class="form-group row" v-for="a in alumnos" :key="a.Nombres">
                                <div class="col-md-2"><b>Tesista: </b></div>
                                
                                <div class="col-md-10">
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
                    <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
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
                                <div class="text-center">
                                    <div v-if="!cargando" class="spinner-border text-primary" role="status">
                                        <span class="sr-only">Loading...</span>
                                    </div>
                                    <label v-if="historial.length == 0 && cargando" class="text-danger">
                                        Este registro aún no cuenta con revisiones.
                                    </label>
                                </div>
                                <div v-if="cargando">
                                    <div v-for="(h,index) in historial" :key="h.id">
                                        <div class="form-group row">
                                            <div class="col-md-3 t12">
                                                <label>Revisión</label>
                                            </div>
                                            <div class="col-md-1 t12">
                                                : {{index + 1}}
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
                                            <div class="col-md-6 t12">
                                                : {{h.Comentario}}
                                            </div>
                                            <div class="col-md-3 t12" v-if="h.SubEstado == 'OBSERVADO' && index == 0">
                                                <a :href="'Archivos/'+proyecto.id+'/informeObservaciones.pdf'" download="Informe.pdf" class="btn bg-indigo" target="_blank" data-placement="left" title="oficio"><i class="fa fa-file" aria-hidden="true"></i>Descargar Informe</a>
                                            </div>
                                            <div class="col-md-3 t12" v-if="h.SubEstado == 'OBSERVADO' && index != 0">
                                                <a :href="'Archivos/'+proyecto.id+'/informeObservaciones'+index+'.pdf'" download="Informe.pdf" class="btn bg-indigo" target="_blank" data-placement="left" title="oficio"><i class="fa fa-file" aria-hidden="true"></i>Descargar Informe</a>
                                            </div>
                                        </div>
                                        <hr>
                                    </div>
                                </div>
                            </fieldset>
                        </div>
                    </div>
                </div>
            </div> 
        </div>
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
                docenteasesor:null,
                tipo:null,
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
            alumnos:[],
            tesistas:[],
            docentes:[],
            historial:[],
            cargando: false,
            cargando1: true,
            zhistorial:null,
           
        }
	},
	created(){
	},
	mounted(){
        $('#editar').hide();
	},
    methods: {
        getDocentes(i)
        {
            this.$Progress.start();
            axios.get("getDocentes/"+i)
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
            this.cargando = false;
            var id = this.proyecto.id;
            this.$Progress.start();
            axios.get("getHistorial/"+id)
            .then(data=>
            {
                this.cargando = true;
                this.historial = data.data.historial;
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
            this.cargando1 = false;
            if(d == '') d = null;
            if(c == '') c = null;
            axios.get("getTesistas/"+d+"/"+c)
            .then(data=>
            {
                this.cargando1 = true;
                if(data.data.tesistas[0] == null)
                {
                    swal({
                        type: 'error',
                        title: 'No se encontraron registros',
                    });
                }else{
                    this.alumnos            = data.data.tesistas;
                    this.docente.dni        = data.data.dni;
                    this.docente.nombre     = data.data.docente;
                    this.docente.id         = data.data.ID;
                    this.proyecto.dingreso  = data.data.fechaasignacion;
                    this.proyecto.ddevolucion = data.data.fechadevdoc;
                    this.proyecto.aingreso  = data.data.fechaentalu;
                    this.proyecto.adevolucion  = data.data.fechadevalu;
                    this.proyecto.subestado = data.data.subestado;
                    this.proyecto.comentario  = data.data.comentarios;
                    this.zhistorial         = data.data.historial;
                    if(this.zhistorial != null)
                    {
                        this.getDocentes(this.zhistorial.IDCarrera);
                    }
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
            this.proyecto.Nombres            = null;
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
        
		addHistorial(i)
		{          
            this.proyecto.tipo = i;
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
                    zhistorial:this.zhistorial,
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
                    setTimeout(() => {
                                location.reload();
                            }, 2000);
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
        
        seleccionar(alumnos,docente)
        {
            this.tesistas = alumnos;
            this.proyecto.carrera       = this.tesistas[0].Carrera;
            this.proyecto.docentedni    = docente.dni;
            this.proyecto.docentenombre = docente.nombre;
            this.proyecto.id            = docente.id;
        },
    }
}
</script>
