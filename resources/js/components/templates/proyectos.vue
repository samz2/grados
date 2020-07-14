
<template>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<button  class="btn btn-success" id="mas" @click="ocultar('1')">
							Agregar Proyecto de Tesis <i class="fa fa-plus"></i>
							</button>
						</div>
					</div>
				</div>
	            <div class="card card-default"  id="objetivo">
	                <div class="card-header text-center" style="background-color: powderblue !important; color:black; font-weight: bold;">
	                    <h4 class="title">PROYECTOS DE TESIS</h4>  
	                </div>
                    <div class="col-md-5"><label>* Campos obligatorios</label></div>
                    
                    <div class="col-md-5" id="labelInicio"><label>Nota: Primero realizar la búsqueda del(s) tesista(s)</label></div>
                    
					<div class="card-body">
                        <fieldset class="border p-2">
                            <legend class="w-auto">Datos Tesistas 
                                <button v-if="tesistas.length <= 1" data-target="#exampleModal" @click="borrar()" class="btn btn-primary" data-toggle="modal" data-placement="left">
								Buscar Tesistas <i class="fas fa-search"></i>
							    </button>
                            </legend>
                            <div class="form-group row">  
                                <div class="col-md-12">
                                    <table class="center centrartabla" border="1" cellspacing=0 cellspadding=0>
                                        <tr class="text-center bg-secondary">
                                            <td width="80">DNI</td>
                                            <td width="100">Código</td>
                                            <td width="280">Nombre Completo</td>
                                            <td width="80">Acción</td>
                                        </tr >   
                                        <tr v-if="tesistas.length == 0">
                                            <td colspan="4" class="text-center">No se ha seleccionado ningún tesista</td>
                                        </tr>
                                        <tr class="text-center" v-for="t in tesistas" :key="t.DNI">
                                            <td>{{t[0].DNI}}</td>
                                            <td>{{t[0].codigo}}</td>
                                            <td>{{t[0].nombre}}</td>
                                            <td><button @click="(addTesista(t[0].DNI,null,null))" class="btn btn-danger altoBoton"><i class="fa fa-trash"></i></button> </td>
                                        </tr>
                                                  
                                    </table>
                                </div>                                
                            </div>
                        </fieldset>
                        <fieldset class="border p-2">
                            <legend class="w-auto">Datos del Proyecto de Tesis:</legend>
                            <div class="form-group row">
                                <label for="tomo" class="col-md-3 col-form-label">Carrera Profesional* :</label>
                                <div class="col-md-4">
                                    <select type="text" v-model="proyecto.carrera" @change="getLineas(proyecto.carrera)" class="form-control form-control-sm">
                                        <option v-for="e in escuelas" :key="e.IDEscuela" :value="e.IDEscuela">
                                            {{e.Escuela}}
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">Nombre de la Tesis* :</label>
                                <div class="col-md-8">
                                    <input type="text"  v-model="proyecto.tesis" onKeyPress="return soloTesis(event)" maxlength="300" class="form-control form-control-sm">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="tomo" class="col-md-3 col-form-label">Linea de Investigación* :</label>
                                <div class="col-md-4">
                                    <select v-model="proyecto.linea" class="form-control form-control-sm">
                                        <option v-for="l in lineas" :key="l.IDLinea" :value="l.IDLinea">
                                            {{l.Linea}}
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="tomo" class="col-md-3 col-form-label">Docente evaluador :</label>
                                <div class="col-md-4">
                                    <select v-model="proyecto.docente" class="form-control form-control-sm">
                                        <option v-for="d in docentes" :key="d.DNI" :value="d.DNI">
                                            {{d.Docente}}
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-3">
                                    <label>Fecha de registro* :</label>
                                </div>
                                <div class="col-md-3">
                                    <input type="date" max="2030-12-31" v-model="proyecto.fecha" @change='validafecha()' class="form-control form-control-sm">
                                </div>
                                <div class="col-md-3">
                                    <label>Porcentaje Antiplagio :</label>
                                </div>
                                <div class="col-md-1">
                                    <input type="text" v-model="proyecto.porcentaje" onKeyPress="return soloNumeros(event)" maxlength="2" class="form-control form-control-sm">
                                </div>
                                <div class="col-md-2">
                                    <label>%</label>
                                </div>
                            </div>
                             <div class="form-group row" id="archivoproyecto">
                                <div class="col-md-3">
                                <label>Proyecto de Tesis* :</label>
                                </div>
                                <div class="col-md-5">
                                    <label for="proyectoArchivo" class="subir">
                                        <i class="fas fa-cloud-upload-alt"></i> Subir archivo
                                    </label>
                                    <input id="proyectoArchivo" @change='validarPY' onchange='cambiarProyectoArchivo()' type="file" accept="application/pdf" style='display: none;'/>
                                    <span id="infoArchivo">Ningún archivo seleccionado</span>
                                </div> 
                                <div class="col-md-4">
                                    <label>( Formato PDF - Tamaño Max. 5MB )</label>
                                </div>
                            </div>
                        </fieldset>
                        <br>
                        <div class="row">
                            <div class="col-md-4" style="text-align: center;"></div>
                            <div class="col-md-2" id="guardar" style="text-align: center;">
                                <button class="btn btn-success"  @click="addProyecto(1)">Guardar <i class="fa fa-save"></i></button>
                            </div>
                            <div class="col-md-2"  id="editar" style="text-align: center;">
                                <button class="btn btn-success" @click="editExpedito()">Guardar <i class="fa fa-edit"></i></button>
                            </div>
                            <div class="col-md-2" style="text-align: center;">
                                <button class="btn btn-danger" @click="cancelar()">Cancelar <i class="fas fa-times"></i></button>
                            </div>
                            <div class="col-md-4" style="text-align: center;"></div>
                        </div>
	                </div>
				</div>
			</div>
	    	</div>
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                        <div class="modal-header text-center" style="background-color: powderblue !important; color:black; font-weight: bold;">
                            <h5 class="modal-titler" id="exampleModalLabel">Buscar Bachiller</h5>
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
                          
                            <div class="form-group row">
                                <label for="nombre1" class="col-md-2 col-form-label">Bachiller: </label>
                                <div class="col-md-10">
                                    <input type="text" v-model="alumnos.Nombres" readonly class="form-control form-control-sm">
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-4">
                                    <button class="btn btn-primary" id="boton" @click="buscar(alumno.dni,alumno.codigo,alumno.apellido)">Buscar <i class="fa fa-search"></i></button>
                                </div>
                                <div class="col-md-4">
                                    <button class="btn btn-warning" @click="borrar()">Limpiar <i class="fas fa-broom"></i></button>
                                </div>
                                <div class="col-md-4">
                                    <button class="btn btn-success" data-dismiss="modal" type="checkbox" @click="addTesista(alumnos.DNI,alumnos.Codigo,alumnos.Nombres)">Seleccionar <i class="fas fa-check"></i></button>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>    
                <!-- final modal -->
            <div class="row" id="expeditos">
                <div class="col-md-12">
                    <div class="card card-default" >
                            <div class="card-header text-center" style="background-color: powderblue !important; color:black; font-weight: bold;">
                                <h4 class="title">PROYECTOS DE TESIS</h4>  
                            </div>
                        <div class="card-body">
                            <div class="content table-responsive table-full-width t12">
                                <v-client-table :data="proyectos" :columns="columns" :options="options">
                                    <div slot="Estado" slot-scope="props">
                                       <label v-if="props.row.EstadoTramite == 1" class="text-danger">{{"PENDIENTE"}}</label>
                                       <label v-else-if="props.row.EstadoTramite == 2" class="text-primary">{{"EN PROCESO"}}</label>
                                       <label v-else-if="props.row.EstadoTramite == 3" class="text-success">{{"FINALIZADO"}}</label>
                                    </div>
                                    <div slot="Acciones" slot-scope="props">
<<<<<<< HEAD
                                        <button class="btn btn-primary altoBoton" v-on:click="edit(props.row.IDProyecto,props.row.IDCarrera,props.row.NombreTesis,props.row.IDLinea,props.row.CodDocente,props.row.FechaRegistro,props.row.Porcentaje,props.row.Codigos)" data-placement="left" title="Editar"><i class="fas fa-edit" style="color: white" aria-hidden="true"></i></button>
                                        <button v-if="props.row.EstadoTramite == 1" data-target="#datos" class="btn bg-indigo altoBoton" @click="viewData(props.row.IDProyecto,props.row.IDCarrera,props.row.Carrera,props.row.CodDocente,props.row.Tesistas,props.row.NombreTesis)" data-toggle="modal" data-placement="left" title="Cambiar estado"><i class="fa fa-check-double" aria-hidden="true"></i></button>
                                        <button data-target="#historial" @click="getHistorial(props.row.IDProyecto)" title="Ver Historial" class="btn btn-success altoBoton" data-toggle="modal" data-placement="left" ><i class="fa fa-eye"></i></button>
                                        <!-- <button data-target="#correo" @click="setProyecto(props.row.IDProyecto)" title="Enviar Correo" class="btn bg-warning altoBoton" data-toggle="modal" data-placement="left" ><i class="fa fa-envelope"></i></button> -->
=======
                                        <button data-target="#datos" class="btn bg-indigo altoBoton" @click="viewData(props.row.IDProyecto,props.row.IDCarrera,props.row.Carrera,props.row.CodDocente,props.row.Tesistas,props.row.NombreTesis)" data-toggle="modal" data-placement="left" title="Cambiar estado del trámite"><i class="fa fa-check-double" aria-hidden="true"></i></button>
                                        <button data-target="#historial" @click="getHistorial(props.row.IDProyecto)" title="Ver historial de revisiones" class="btn btn-success altoBoton" data-toggle="modal" data-placement="left" ><i class="fa fa-eye"></i></button>
                                        <button data-target="#correo" @click="setProyecto(props.row.IDProyecto)" title="Enviar correo" class="btn bg-warning altoBoton" data-toggle="modal" data-placement="left" ><i class="fa fa-envelope"></i></button>
                                        <button class="btn btn-primary altoBoton" v-on:click="edit(props.row.IDProyecto,props.row.IDCarrera,props.row.NombreTesis,props.row.IDLinea,props.row.CodDocente,props.row.FechaRegistro,props.row.Porcentaje,props.row.Codigos)" data-placement="left" title="Editar registro"><i class="fas fa-edit" style="color: white" aria-hidden="true"></i></button>
                                        
>>>>>>> 5542918ad2fa435f50ce92706f7326a9ae62f038
                                    </div>
                                </v-client-table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- modal2 @click="changeStatus(props.row)"-->
            <div class="modal fade" id="historial" tabindex="-1" role="dialog" aria-labelledby="historialLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                        <div class="modal-header text-center" style="background-color: powderblue !important; color:black; font-weight: bold;">
                            <h5 class="modal-titler text-center" id="historialLabel">Historial Proyecto de Tesis</h5>
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
             <!-- modal2 -->
            <div class="modal fade" id="correo" tabindex="-1" role="dialog" aria-labelledby="historialLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                        <!-- <div class="modal-header text-center">
                            <h5 class="modal-titler text-center" id="historialLabel">Correo</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div> -->
                        <div class="modal-body">
                            <example-component :id="idproyecto"></example-component>
                        </div>
                    </div>
                </div>
            </div> 
            <!-- <example-component></example-component> -->
            <div class="modal fade" id="datos" tabindex="-1" role="dialog" aria-labelledby="Label" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                        <div class="modal-header text-center" style="background-color: powderblue !important; color:black; font-weight: bold;">
                            <h4 class="title" id="Label">Datos</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <fieldset class="border p-2">
                            <legend class="w-auto">Datos a registrar</legend>
                            <div class="form-group row">
                                <div class="col-md-3">
                                <label for="sesion">Número Sesión* :</label>
                                </div>
                                <div class="col-md-2">
                                <select v-model="sesion.sesion" @change="getSession(sesion.sesion)" class="form-control form-control-sm">
                                    <option v-for="s in sesiones" :key="s.NumSesion" :value="s.NumSesion">{{s.NumSesion}}</option>
                                </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-3">
                                <label for="fecha">Fecha de Sesión:</label>
                                </div>
                                <div class="col-md-3">
                                <input type="date" v-model="sesion.fecha" readonly class="form-control form-control-sm"/>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-3">
                                <label for="Tipo">Tipo de Sesión:</label>
                                </div>
                                <div class="col-md-4">
                                <input type="text" v-model="sesion.tipo"  readonly class="form-control form-control-sm"/>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-3">
                                <label for="Tipo">Docente Evaluador:</label>
                                </div>
                                <div class="col-md-6">
                                <select v-model="sesion.docente" @change="selectDocente(sesion.docente)" id="docente" class="form-control form-control-sm">
                                    <option v-for="d in docentes" :key="d.DNI" :value="d.DNI">
                                        {{d.Docente}}
                                    </option>
                                </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4" style="text-align: center;"></div>
                                <div class="col-md-4" style="text-align: center;"> 
                                    <button @click="changeStatus()" class="btn bg-success">Procesar trámite</button>
                                </div>
                                <div class="col-md-4" style="text-align: center;"></div>
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
            lineas:[],
			proyecto:{
                idproyecto:null,
                carrera:null,
                tesis:null,
                linea:null,
                docente:null,
                fecha:null,
                porcentaje:null,
                archivo:null,
            },
            sesion:{
                idproyecto:null,
                sesion:null,
                fecha:null,
                tipo:null,
                docente:null,
                tesistas:null,
                nombretesis:null,
                zdocente:null,
                carrera:null,
            },
            alumno:{
                codigo:null,
                dni:null,
                apellido:null,
            },
            escuelas: [],
            tesistasaux:[],
            tesistasaux2:null,
            tesistas:[],
            alumnos:[],
            docentes:[],
            historial:[],
            proyectos	:[{
				IDProyecto: null,
                Tesistas: null,
                Carrera: null,
                Fecha: null,
                FechaRegistro:null,
                Estado:null,
            }],
            //columns: ["Tesistas","Carrera profesional","Fecha registro","Estado","Acciones"],
            columns: ["Tesistas","Carrera","Fecha","Estado","Acciones"],
            options: {
                texts: {
                   count: "Mostrando {from} al {to} de {count} registros|{count} registros|Un registro",
                    first: 'Primero',
                    last: 'Ultimo',
                    //filter: "Buscar:                                    ",
                    filter: "",
                    filterPlaceholder: "Buscador general..",
                    limit: "Registros:",
                    page: "Pagina:",
                    noResults: "No hay registros",
                    filterBy: "Filtrar por {column}",
                    loading: 'Cargando...',
                    defaultOption: 'Seleccionar {column}',
                    columns: 'Columnas'
                    },
				headings:
				{
                    Carrera: "Carrera profesional",
                    Fecha: "Fecha registro",
                    Tesistas: "Tesistas",
				},
				sortable    : ["Tesistas","Carrera","Fecha"],
				filterable  : ["Tesistas","Carrera","Fecha"]
            },
            cargando:false,
            sesiones: [],
            idproyecto:null,
        }
	},
	created(){
        this.getProyectos();
        // this.getDocentes();
        this.getEscuelas();
        this.getSesiones();
	},
	mounted(){

        $('#objetivo').hide();
        $('#menos').hide();
	},
    methods: {
        setProyecto(id)
        {
            this.idproyecto = id;
            console.log(this.idproyecto);
        },
        changeStatus()
        {
            axios.post("statusProyecto",{
                    sesion:this.sesion,
                }).then(data=>{
                    swal({
                        type: "success",
                        title: "¡Buen trabajo!",
                        text: "Estado actualizado con éxito, se generaron los documentos",
                        showConfirmButton: false,
                        timer: 3000
                    });
                    this.$Progress.finish();
                    setTimeout(() => {
                        location.reload();
                    }, 1500);
                    }).catch(error=>{
                    console.log(error);	
                    swal({
                        type: "error",
                        title: 'Ha ocurrido un problema',
                        text: "Comuníquese con un administrador",
                        showConfirmButton: true
                    });
                })
            
        },
        viewData(id,idcarrera,carrera,docente,tesistas,tema)
        {
            if(docente != null)
            {
                this.selectDocente(docente);
            }
            this.sesion.idproyecto      = id;
            this.sesion.docente         = docente;
            this.sesion.nombretesis     = tema;
            this.sesion.tesistas        = tesistas;
            this.sesion.carrera        = carrera;
            this.getDocentes(idcarrera);
        },
        selectDocente(id)
        {
            this.$Progress.start();
            axios.get("getDocente/"+id)
            .then(data => {
            this.sesion.zdocente = data.data.docente;
            this.$Progress.finish();
            })
            .catch(error => {
            console.log(error);
            });
        },
        getSesiones() {
            this.$Progress.start();
            axios
            .get("getSessions")
            .then(data => {
            this.sesiones = data.data.sesiones;
            this.$Progress.finish();
            })
            .catch(error => {
            console.log(error);
            });
        },
        getSession(e) {
            this.$Progress.start();
            axios
            .get("getSession/" + e)
            .then(data => {
            this.sesion.fecha = data.data.fecha;
            this.sesion.tipo = data.data.tipo;
            this.$Progress.finish();
            })
            .catch(error => {
            console.log(error);
            });
        },
        validarPY(e)
        {
            var size = e.target.files[0].size;
            var type = e.target.files[0].type;
            if(size > 5000001)
            {
                e.target.value = '';
                swal({
                        type: 'error',
                        title: 'Ha ocurrido un error',
                        text: 'El tamaño del archivo debe ser menor o igual a 5mb',
                        showConfirmButton: true,
                    });
                document.getElementById('infoArchivo').innerHTML = 'Ningún archivo seleccionado';
                return;    
            }
            if(type.includes("pdf"))
            {
                var file = new FileReader();
                file.readAsDataURL(e.target.files[0]);
                file.onload = (e) =>
                {
                    this.proyecto.archivo = e.target.result;
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
        getHistorial(id)
        {
            this.cargando = false;
            this.historial = [];
            this.$Progress.start();
            axios.get("getHistorial/"+id)
            .then(data=>
            {
                this.historial = data.data.historial;
                this.cargando = true;
                this.$Progress.finish();
            }
            ).catch(error=>{
                console.log(error);
            })
        },
        getLineas(id) {

            this.getDocentes(id);
            this.$Progress.start();
            axios
            .get("getLineas/"+id)
            .then(data => {
            this.lineas = data.data.lineas;
            this.$Progress.finish();
            })
            .catch(error => {
            console.log(error);
            });
        },
        addTesista(dni,codigo,nombre)
        {
            
            var n = this.tesistasaux.indexOf(dni);
			if(n == -1)
			{
                this.tesistasaux.push(dni);
            }else 
            {
                this.tesistasaux.splice(n,1);
                this.tesistasaux2 = dni;
            }
            this.getTesistas();

        },
        getTesistas()
        {
            axios.post("tesistas",{
                tesistas:this.tesistasaux,
            }).then(data=>{
                this.tesistas = data.data.tesistas;
                console.log(data.data);
                }).catch(error=>{
                console.log(error);	
            });
        },
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
       
        buscar(d,c,a)
        {
            if(d == '') d = null;
            if(c == '') c = null;
            if(a == '') a = null;
            axios.get("getAlumnos/"+d+"/"+c+"/"+a)
            .then(data=>
            {
                if(data.data.alumnos[0] == null)
                {
                    swal({
                        type: "error",
                        title: "Ha ocurrido un error",
                        text: "No se encontraron registros"
                    });
                }else{
                    this.alumnos = data.data.alumnos[0];
                }
                
                this.$Progress.finish();
            }
            ).catch(error=>{
                console.log(error);
            })
        },
        validafecha() {
        if (this.proyecto.fecha != null) {
            var inicio = this.proyecto.fecha;
            var final = "2030-01-01";
            if (final <= inicio) {
            swal({
                type: "warning",
                title: "Ingresar una fecha correcta"
            });
            this.proyecto.fecha = null;
            }
        }
        
        },
        cancelar()
        {
            this.proyecto.idproyecto    = null;
            this.proyecto.carrera       = null;
            this.proyecto.tesis         = null;
            this.proyecto.linea         = null;
            this.proyecto.docente       = null;
            this.proyecto.fecha         = null;
            this.proyecto.porcentaje    = null;
            this.tesistasaux            = [];
            this.tesistas               = [];
            this.lineas                 = [];
            this.tesistasaux2           = null;
            this.cambiarCancelarBachiller();
            $('#objetivo').hide();
            $('#expeditos').show();	
            $('#menos').hide();
            $('#mas').show();
        },
        cambiarCancelarBachiller(){    
            document.getElementById('infoArchivo').innerHTML = 'Ningún archivo seleccionado';
        },
        borrar()
        {
            this.alumno.codigo      = null;
            this.alumno.dni         = null;
            this.alumnos.Nombres    = null;

            this.alumnos = [];
        },
        getProyectos()
        {
            this.$Progress.start();
            axios.get("getProyectos")
            .then(data=>
            {
                this.proyectos = data.data.proyectos;
                this.$Progress.finish();
                console.log(data.data);
            }
            ).catch(error=>{
                console.log(error);
            })
        },
		addProyecto()
		{          
            if(this.proyecto.carrera       == null ||
               this.proyecto.tesis         == null ||
               this.proyecto.linea         == null ||
               this.proyecto.archivo       == null ||
               this.proyecto.fecha         == null)
            {
                swal({
					type: 'warning',
                    title: 'Llenar los campos obligatorios',
                    timer: 3000
                });
                return;
            }else{
                
                this.$Progress.start();
                axios.post("addProyecto",{
                    proyecto:this.proyecto,
                    tesistas:this.tesistas
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
                    // setTimeout(() => {
                    //     location.reload();
                    // }, 1500);
                    this.cancelar();
                    this.getProyectos();
                    }).catch(error=>{
                    console.log(error);	
                    swal({
                        type: "error",
                        title: 'Ha ocurrido un error',
                        text: "Comuníquese con un administrador",
                        showConfirmButton: true
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
                $('#archivoproyecto').show();
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
                $('#archivoproyecto').hide();
			}
			
        },
        estado(id,tipo)
        {
			this.$Progress.start();

            if(tipo == 1)
            {
                swal({
                    title: '¿Deseas cambiar el estado de este registro?',
                    text: "El estado cambiara a En Proceso!",
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
                                'Actualizado!',
                                'El Expedito cambio a En Proceso.',
                                'success'
                                );
                            this.$Progress.finish();
                            setTimeout(() => {
                                location.reload();
                            }, 2000);
                            }
                            }).catch(error => {
                                console.log('Ocurrio un error ' + error);
                                this.$Progress.fail();
                            });
                        }
                    });        
            }else{
                swal({
                    title: '¿Deseas cambiar el estado de este registro?',
                    text: "El estado cambiara a Finalizado!",
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
                                'Actualizado!',
                                'El Expedito cambio a Finalizado.',
                                'success'
                                );
                            this.$Progress.finish();
                            setTimeout(() => {
                                location.reload();
                            }, 2000);
                            }
                            }).catch(error => {
                                console.log('Ocurrio un error ' + error);
                                this.$Progress.fail();
                            });
                        }
                    });
            }
            
		},
        edit(IDProyecto,IDCarrera,NombreTesis,IDLinea,CodDocente,FechaRegistro,Porcentaje,Codigos)
        {
            $("#objetivo").show();
            $("#expeditos").hide();
            $("#buscar").hide();
            $('#labelInicio').hide();
            $('#mas').hide();
            $('#editar').show();
            $('#guardar').hide();
            $('#archivoproyecto').hide();
            
            this.getLineas(IDCarrera);
            this.getDocentes(IDCarrera);
            this.proyecto.idproyecto    = IDProyecto;
            this.proyecto.carrera       = IDCarrera;
            this.proyecto.tesis         = NombreTesis;
            this.proyecto.linea         = IDLinea;
            this.proyecto.docente       = CodDocente;
            this.proyecto.fecha         = FechaRegistro;
            this.proyecto.porcentaje    = Porcentaje;
            this.tesistas               = [];
            this.tesistasaux            = Codigos.split(",");
            this.getTesistas();
            console.log(this.getTesistas());
            // this.tesistasaux
        },
        editExpedito()
        {
            if(this.proyecto.carrera       == null ||
               this.proyecto.tesis         == null ||
               this.proyecto.linea         == null ||
               this.proyecto.fecha         == null)
            {
                swal({
					type: 'warning',
                    title: 'Llenar los datos obligatorios',
                    timer: 3000
                });
                return;
            }else{
                
                this.$Progress.start();
                axios.post("updateProyecto",{
                    proyecto:this.proyecto,
                    tesistas:this.tesistas,
                    tesista:this.tesistasaux2
                }).then(data=>{
                    swal({
                        type: data.data.type,
                        title: data.data.title,
                        text: data.data.text,
                        showConfirmButton: false,
                        timer: 3000
                    });
                    this.$Progress.finish();
                    this.cancelar();
                    this.getProyectos();
                    }).catch(error=>{
                    console.log(error);	
                    swal({
                        type: "error",
                        title: 'Ha ocurrido un error',
                        text: "Comuníquese con un administrador",
                        showConfirmButton: true
                    });
                })
            }
        },
        getEscuelas() 
        {
            axios
                .get("getEscuelas")
                .then(data => {
                this.escuelas = data.data.escuelas;
                })
                .catch(error => {
                console.log("error: " + error);
                });
        }
    }
}
</script>
