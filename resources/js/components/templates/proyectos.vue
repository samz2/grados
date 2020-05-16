
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
	                    <h4 class="title">Proyectos de Tesis</h4>  
	                </div>
                    <div class="col-md-5"><label>* Campos obligatorios.</label></div>
                    
                    <div class="col-md-5" id="labelInicio"><label>Nota: Primero realizar la búsqueda del(los) tesista(s)</label></div>
                    
					<div class="card-body">
                        <fieldset class="border p-2">
                            <legend class="w-auto">Datos Tesistas 
                                <button v-if="tesistas.length <= 1" data-target="#exampleModal" id="buscar" @click="borrar()" class="btn btn-primary" data-toggle="modal" data-placement="left">
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
                                            <td colspan="4" class="text-center">No ha seleccionado alumnos aún</td>
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
                                <div class="col-md-3">
                                    <select type="text" v-model="proyecto.carrera" @change="getLineas(proyecto.carrera)" class="form-control form-control-sm">
                                        <option v-for="e in escuelas" :key="e.IDEscuela" :value="e.IDEscuela">
                                            {{e.Escuela}}
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">Nombre de la Tesis* :</label>
                                <div class="col-md-9">
                                    <input type="text"  v-model="proyecto.tesis" onKeyPress="return soloLetras(event)" maxlength="200" class="form-control form-control-sm">
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
                                            {{d.Nombres}} {{d.Apellidos}}
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">Fecha de registro * :</label>
                                <div class="col-md-3">
                                    <input type="date" v-model="proyecto.fecha" class="form-control form-control-sm">
                                </div>
                                <label class="col-md-3 col-form-label">Porcentaje Antiplagio * :</label>
                                <div class="col-md-1">
                                    <input type="text" v-model="proyecto.porcentaje" onKeyPress="return soloNumeros(event)" maxlength="2" class="form-control form-control-sm">
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
                                <h4 class="title">EXPEDITOS TITULACIÓN</h4>  
                            </div>
                        <div class="card-body">
                            <div class="content table-responsive table-full-width t12">
                                <v-client-table :data="proyectos" :columns="columns" :options="options">
                                    <div slot="Acciones" slot-scope="props">
                                       <button class="btn btn-primary" v-on:click="edit(props.row.IDProyecto,props.row.IDCarrera,props.row.NombreTesis,props.row.IDLinea,props.row.CodDocente,props.row.FechaRegistro,props.row.Porcentaje,props.row.Codigos)" data-placement="left" title="Editar" style="padding: 2px 5px; font-size: 12px;"><i class="fas fa-edit" style="color: white" aria-hidden="true"></i></button>
                                    </div>
                                </v-client-table>
                            </div>
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
            proyectos	:[{
				IDProyecto: null,
                Tesistas: null,
                Carrera: null,
                Fecha: null,
                FechaRegistro:null,
            }],
            columns: ["Tesistas","Carrera","Fecha","Acciones"],
            options: {
				headings:
				{
                    Carrera: "Carrera",
                    Fecha: "Fecha",
                    Tesistas: "Tesistas",
				},
				sortable    : ["Tesistas","Carrera","Fecha"],
				filterable  : ["Tesistas","Carrera","Fecha"]
            },
        }
	},
	created(){
        this.getProyectos();
        this.getDocentes();
        this.getEscuelas();
	},
	mounted(){
        $('#objetivo').hide();
        $('#menos').hide();
	},
    methods: {
        getLineas(id) {
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
                        type: 'error',
                        title: 'No se encontraron registros',
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
            $('#objetivo').hide();
            $('#expeditos').show();	
            $('#menos').hide();
            $('#mas').show();
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
                axios.post("addProyecto",{
                    proyecto:this.proyecto,
                    tesistas:this.tesistas
                }).then(data=>{
                    swal({
                        // position: 'top-end',
                        type: data.data.val,
                        // title: data.data.title,
                        text: data.data.msj,
                        showConfirmButton: false,
                        timer: 2000
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
                        type: 'error',
                        //title: 'Error',
                        text: 'Ocurrió un problema, comuníquese con un administrador',
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
                    title: '¿Deseas cambiar el estado de este expedito?',
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
            this.getLineas(IDCarrera);
            this.proyecto.idproyecto    = IDProyecto;
            this.proyecto.carrera       = IDCarrera;
            this.proyecto.tesis         = NombreTesis;
            this.proyecto.linea         = IDLinea;
            this.proyecto.docente       = CodDocente;
            this.proyecto.fecha         = FechaRegistro;
            this.proyecto.porcentaje    = Porcentaje;
            this.tesistasaux            = Codigos.split(",");
            this.getTesistas();
            // console.log(Codigos.split(","));
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
                        // position: 'top-end',
                        type: data.data.val,
                        // title: data.data.title,
                        text: data.data.msj,
                        showConfirmButton: false,
                        timer: 2000
                    });
                    this.$Progress.finish();
                    this.cancelar();
                    this.getProyectos();
                    }).catch(error=>{
                    console.log(error);	
                    swal({
                        type: 'error',
                        //title: 'Error',
                        text: 'Ocurrió un problema, comuníquese con un administrador',
                        showConfirmButton: true,
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
