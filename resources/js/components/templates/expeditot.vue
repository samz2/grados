
<template>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<button  class="btn btn-success" id="mas" @click="ocultar('1')">
							Agregar Expedito Título <i class="fa fa-plus"></i>
							</button>
						</div>
					</div>
				</div>
	            <div class="card card-default"  id="objetivo">
	                <div class="card-header text-center" style="background-color: #007bff55 !important; color:black; font-weight: bold;">
	                    <h4 class="title">Expeditos Títulación</h4>  
	                </div>
                    <div class="col-md-4"><label><mark style="background-color: #dc354526; color: #520606f7">- (*) Llenar datos obligatoriamente.</mark></label></div>
                    
                    <div class="col-md-4" id="labelInicio"><label><mark style="background-color: #dc354526; color: #520606f7">- Primero realizar la búsqueda del bachiller.</mark></label></div>
                    
					<div class="card-body">
                        <fieldset class="border p-2">
                            <legend class="w-auto">Datos Bachiller 
                                <button  data-target="#exampleModal" id="buscar" class="btn btn-primary" data-toggle="modal" data-placement="left">
								Buscar Bachiller <i class="fas fa-search"></i>
							    </button>
                            </legend>
                            <div class="form-group row">  
                                
                                <div class="col-md-2">
                                <label>Nro. DNI:</label>   
                                </div>                             
                                <div class="col-md-2">
                                    <input type="text" v-model="expedito.dni" id="dni" readonly class="form-control form-control-sm">
                                </div>
                                 <div class="col-md-2 text-left">
                                        <label>Nro. Código:</label>
                                 </div>
                                <div class="col-md-2">
                                    <input type="text" v-model="expedito.codigo" id="codigo" readonly class="form-control form-control-sm">
                                </div>
                            </div>
                            <div class="form-group row">
                                
                                <div class="col-md-2 text-left">
                                        <label>Nombre Completo:</label>
                                </div>
                                <div class="col-md-6">
                                    <input type="text" v-model="expedito.alumno" id="nombre" readonly class="form-control form-control-sm">
                                </div>
                            </div>
                            <div class="form-group row">
                                
                                <label for="carrera" class="col-md-2 col-form-label">Carrera Profesional: </label>
                                <div class="col-md-6">
                                    <input type="text" v-model="expedito.carrera" id="carrera" readonly class="form-control form-control-sm">
                                </div>
                            </div>
                        </fieldset>
                        <fieldset class="border p-2">
                            <legend class="w-auto">Datos del Libro de Actas</legend>
                            <div class="form-group row">
                                
                                <label for="tomo" class="col-md-2 col-form-label">Número Tomo(*)</label>
                                <div class="col-md-2">
                                    <input type="text" id="tomo" v-model="expedito.tomo" onKeyPress="return soloNumeros(event)" maxlength="3" class="form-control form-control-sm">
                                </div>
                                <label for="folio" class="col-md-2 col-form-label">Número Folio(*)</label>
                                <div class="col-md-2">
                                    <input type="text" id="folio" v-model="expedito.folio" onKeyPress="return soloNumeros(event)" maxlength="3" class="form-control form-control-sm">
                                </div>
                                <label for="asiento" class="col-md-2 col-form-label">Número Asiento(*)</label>
                                <div class="col-md-2">
                                    <input type="text" id="asiento" v-model="expedito.asiento" onKeyPress="return soloNumeros(event)" maxlength="3" class="form-control form-control-sm">
                                </div>
                            </div>
                        </fieldset>
                        <fieldset class="border p-2">
                            <legend class="w-auto">Datos titulación</legend>
                            <div class="form-group row">
                                <div class="col-md-2 text-left">
                                <label>Modalidad(*)</label>
                                </div>
                                <div class="col-md-3">
                                    <select v-model="expedito.modalidad" class="form-control form-control-sm">
                                        <option v-for="m in modalidades" :key="m.IDModalidad" :value="m.IDModalidad">
                                            {{m.Modalidad}}
                                        </option>                                            
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-2 text-left">
                                <label>Nombre Tesis(*)</label>
                                </div>
                                <div class="col-md-9">
                                    <input type="text" v-model="expedito.tesis" onKeyPress="return soloTesis(event)" maxlength="300" class="form-control form-control-sm">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-2 text-left">
                                <label>Asesor(*)</label>
                                </div>
                                <div class="col-md-9">
                                    <select v-model="expedito.asesor" class="form-control form-control-sm">
                                        <option v-for="d in docentes" :key="d.DNI" :value="d.DNI">
                                            {{d.Nombres}} {{d.Apellidos}}
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-2 text-left">
                                <label>Calificación(*)</label>
                                </div>
                                <div class="col-md-3">
                                    <select v-model="expedito.calificacion" class="form-control form-control-sm">
                                        <option value="SOBRESALIENTE">SOBRESALIENTE</option>
                                        <option value="UNANIMIDAD">UNANIMIDAD</option>
                                        <option value="MAYORIA">MAYORIA</option>
                                        <option value="DESAPROBADO">DESAPROBADO</option>
                                    </select>
                                </div>
                                <div class="col-md-3 text-left">
                                <label>Fecha sustentación(*)</label>
                                </div>
                                <div class="col-md-3">
                                    <input type="date" v-model="expedito.sustentacion" @change="validafecha()" class="form-control form-control-sm">
                                </div>
                            </div>
                        </fieldset>
                        <fieldset class="border p-2">
                            <legend class="w-auto">Sesión</legend>
                            <div class="form-group row">
                                
                                <label for="sesion" class="col-md-2 col-form-label">Nro. Sesión(*)</label>
                                <div class="col-md-2">
                                    <select id="sesion" v-model="expedito.sesion" @change="getSession(expedito.sesion)" class="form-control form-control-sm">
                                        <option v-for="s in sesiones" :key="s.NumSesion" :value="s.NumSesion">{{s.NumSesion}}</option>    
                                    </select>
                                </div>
                                <label for="fecha" class="col-md-1 col-form-label">Fecha</label>
                                <div class="col-md-3">
                                    <input type="date" id="fecha" v-model="expedito.sfecha" readonly class="form-control form-control-sm">
                                </div>
                                <label for="Tipo" class="col-md-1 col-form-label">Tipo</label>
                                <div class="col-md-3">
                                    <input type="text" id="tipo" v-model="expedito.stipo" readonly maxlength="3" class="form-control form-control-sm">
                                </div>
                            </div>
                        </fieldset>
                        
                        <fieldset class="border p-2" id="documentos">
                            <legend class="w-auto">Documentos Titulación</legend>
                             <div class="form-group row">
                                
                                <div class="col-md-4">
                                    <label><input type="checkbox" id="chbx1" name="check" >   Tesis PDF</label>
                                </div>

                                <div class="col-md-4">
                                    <label><input type="checkbox" id="chbx2" name="check" >   Autorización de publicación</label>
                                </div>
                                
                            </div> 

                            <div class="form-group row">
                                
                                <div class="col-md-4">
                                    <label><input type="checkbox" id="chbx3" name="check" >   Constancia antiplagio</label>
                                </div>

                                <div class="col-md-4">
                                    <label><input type="checkbox" id="chbx4" name="check" >   Constancia URL</label>
                                </div>
                                
                            </div>
                            <div class="form-group row">

                                <div class="col-md-12">
                                    <label><mark style="background-color: #dc354526; color: #520606f7; text-align : justify;">Nota: Verificar si se cuenta con estos documentos obligatorios marcando el check que le corresponde, si no se cuenta con uno o más de éstos no se podrá continuar.</mark></label>
                                </div>
                                
                                
                            </div>
                        </fieldset>
                        <fieldset class="border p-2" id="archivos">
                            <legend class="w-auto">Archivos</legend>
                            <div class="form-group row">
                                <div class="col-md-2">
                                    <label>Const. Matrícula(*)</label>
                                </div>
                                <div class="col-md-4">
                                    <input type="file" id="matricula" @change="validarMatricula" class="form-control form-control-sm" accept="application/pdf"> 
                                </div>
                                <div class="col-md-2">
                                <label>Const. Egresado(*)</label>
                                </div>
                                <div class="col-md-4">
                                    <input type="file" id="egresado"  @change="validarEgresado" class="form-control form-control-sm" accept="application/pdf">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-2">
                                <label>Arch. Tesis PDF(*)</label>
                                </div>
                                <div class="col-md-4">
                                    <input type="file" id="tesis" @change="validarTesis" class="form-control form-control-sm" accept="application/pdf">
                                </div>
                                <div class="col-md-2">
                                <label>Arch. Tesis Word(*)</label>
                                </div>
                                <div class="col-md-4">
                                    <input type="file" id="word" @change="validarWord" class="form-control form-control-sm" accept=".doc, .docx">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-2">
                                <label>Foto(*)</label>
                                </div>
                                <div class="col-md-4">
                                    <input type="file" id="foto" @change="validarFoto" class="form-control form-control-sm" accept="image/jpeg">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-7">
                                    <label><mark style="background-color: #dc354526; color: #520606f7">* Constancias en formato PDF (Tam. max. 1mb c/u)</mark></label>
                                </div>
                                <div class="col-md-7">
                                    <label><mark style="background-color: #dc354526; color: #520606f7">* Archivo Tesis en formato PDF (Editable) y Word (Tam. max. 3mb c/u)</mark></label>
                                </div>
                                <div class="col-md-7">
                                    <label><mark style="background-color: #dc354526; color: #520606f7">* Foto en formato JPG (Tam. max. 1mb)</mark></label>
                                </div>
                            </div>
                            
                        </fieldset>
                        <fieldset class="border p-2">
                            <legend class="w-auto">Datos del trámite</legend>
                            <div class="form-group row">
                                <label for="ingreso" class="col-md-4 col-form-label">Fecha de Ingreso de la solicitud(*)</label>
                                <div class="col-md-3">
                                    <input type="date" max="2030-12-31" id="ingreso" v-model="expedito.ingreso" @change="validafecha()" onKeyPress="return soloNumeros(event)" maxlength="3" class="form-control form-control-sm">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="comienzo" class="col-md-4 col-form-label">Fecha que empieza el trámite </label>
                                <div class="col-md-3">
                                    <input type="date" max="2030-12-31" id="comienzo" v-model="expedito.comienzo" @change="validafecha()" class="form-control form-control-sm">
                                </div>
                            </div>
                        </fieldset>
                        <br>
                        <div class="row">
                            <div class="col-md-2" id="guardar" style="text-align: center;">
                                <button class="btn btn-success"  @click="addExpedito(1)">Guardar <i class="fa fa-save"></i></button>
                            </div>
                            <div class="col-md-2"  id="editar" style="text-align: center;">
                                <button class="btn btn-success" @click="editExpedito()">Editar <i class="fa fa-edit"></i></button>
                            </div>
                            <div class="col-md-2" style="text-align: center;">
                                <button class="btn btn-danger" @click="cancelar()">Cancelar <i class="fas fa-times"></i></button>
                            </div>
                        </div>
	                </div>
				</div>
			</div>
	    	</div>
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                        <div class="modal-header text-center" style="background-color: #007bff55 !important; color:black; font-weight: bold;">
                            <h5 class="modal-titler" id="exampleModalLabel">Buscar Bachiller</h5>
                            <button type="button" class="close" data-dismiss="modal" @click="borrar()" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group row">
                                <label for="dni1" class="col-md-2 col-form-label">DNI: </label>
                                <div class="col-md-4">
                                    <input type="text" v-model="alumno.dni" onKeyPress="return solonumeros(event)" maxlength="8" id="dni1" class="form-control form-control-sm">
                                </div>
                                <label for="codigo1" class="col-md-2 col-form-label">Código: </label>
                                <div class="col-md-4">
                                    <input type="text" v-model="alumno.codigo" onKeyPress="return solonumeros(event)" maxlength="10" id="codigo1" class="form-control form-control-sm">
                                </div>
                            </div>
                          
                            <div class="form-group row">
                                <label for="nombre1" class="col-md-2 col-form-label">Egresado: </label>
                                <div class="col-md-10">
                                    <input type="text" v-model="alumnos.Nombres" readonly class="form-control form-control-sm">
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-4">
                                    <button class="btn btn-primary" @click="buscar(alumno.dni,alumno.codigo,alumno.apellido)">Buscar <i class="fa fa-search"></i></button>
                                </div>
                                <div class="col-md-4">
                                    <button class="btn btn-warning" @click="borrar()">Limpiar <i class="fas fa-broom"></i></button>
                                </div>
                                <div class="col-md-4">
                                    <button class="btn btn-success" data-dismiss="modal" type="checkbox" @click="seleccionar(alumnos.DNI,alumnos.Codigo,alumnos.Nombres,alumnos.Carrera)">Seleccionar <i class="fas fa-check"></i></button>
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
                            <div class="card-header text-center" style="background-color: #007bff55 !important; color:black; font-weight: bold;">
                                <h4 class="title">EXPEDITOS TITULACIÓN</h4>  
                            </div>
                        <div class="card-body">
                            <div class="content table-responsive table-full-width t12">
                                <v-client-table :data="expeditos" :columns="columns" :options="options">
                                    <div slot="Acciones" slot-scope="props">
                                        <button v-if="props.row.Estado == 'PENDIENTE'" v-on:click="estado(props.row.IDExpedito,1)" class="btn btn-danger" data-toggle="tooltip" data-placement="left" title="Hacer click para cambiar de estado" style="padding: 2px 6px; font-size: 11px;">Pendiente   </button>
                                        <button v-if="props.row.Estado == 'EN PROCESO'" v-on:click="estado(props.row.IDExpedito,2)"  class="btn btn-warning" data-toggle="tooltip" data-placement="left" title="Hacer click para cambiar de estado" style="padding: 2px 8px; font-size: 11px;">En Proceso</button>
                                        <button v-if="props.row.Estado == 'FINALIZADO'"  class="btn btn-success" data-toggle="tooltip" data-placement="left" title="Estado final" style="padding: 2px 8px; font-size: 11px;">Finalizado  </button>
                                       <button class="btn btn-primary" v-on:click="edit(props.row.IDExpedito,props.row.Tipo,props.row.CodigoAlumno,props.row.Tomo,props.row.Folio,props.row.Asiento,props.row.NumSesion,props.row.FechaIngreso,props.row.FechaComienzo,props.row.IDSesion,props.row.Fecha,props.row.Escuela,props.row.Alumno,props.row.DNI,props.row.IDModalidad,props.row.Modalidad,props.row.NombreTesis,props.row.Asesor,props.row.Calificacion,props.row.FechaT)" data-placement="left" title="Editar" style="padding: 2px 5px; font-size: 12px;"><i class="fas fa-edit" style="color: white" aria-hidden="true"></i></button>
                                        <router-link v-if="props.row.Estado == 'FINALIZADO'" class="btn btn-info" target="_blank" :to="'/oficio2/'+props.row.IDExpedito" data-toggle="tooltip"  data-placement="left" title="Ver oficio" style="padding: 2px 8px; font-size: 12px; color: white;"><i class="far fa-file-pdf" aria-hidden="true"></i></router-link>
                                        <!-- <button class="btn btn-success" data-toggle="tooltip" v-on:click="edit(props.row.IDExpedito)" data-placement="left" title="Acta"><i class="far fa-file-pdf" style="color: white" aria-hidden="true"></i></button> -->
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
            archivos:
            {
                matricula:null,
                egresado:null,
                foto:null,
                word:null,
                tesis:null
            },
			expedito:{
                codigo:null,
                dni:null,
                alumno:null,
                carrera:null,
                tomo:null,
                folio:null,
                asiento:null,
                sesion:null,
                sfecha:null,
                stipo:null,
                ingreso:null,
                comienzo:null,
                tipo:"TITULO",
                tesis:null,
                sustentacion:null,
                calificacion:null,
                asesor:null,
                modalidad:null,

            },
            alumno:{
                codigo:null,
                dni:null,
                apellido:null,
            },
            alumnos:[],
            sesiones:[],
            docentes:[],
            modalidades:[],
            expeditos	:[{
				IDExpedito: null,
                Tipo: null,
                CodigoAlumno: null,
                Acta: null,
                NumSesion: null,
                FechaIngresoAux: null,
                FechaComienzoAux: null,
                Estado: null,
                FechaAux: null,
                Alumno: null,
                IDModalidad: null,
                Modalidad: null,
                NombreTesis: null,
                Asesor: null,
                Calificacion: null,
                FechaT:null
            }],
            columns: ["Alumno","Acta","NumSesion","FechaAux","FechaIngresoAux","FechaComienzoAux","Acciones"],
            options: {
				headings:
				{
                    CodigoAlumno: "Código",
                    NumSesion: "Sesión",
                    FechaIngresoAux: "Ingr. trámite",
                    FechaComienzoAux: "Inic. trámite",
                    FechaAux: "F. Sesión",
                    Alumno: "Nombre Completo",
                    Acta: "   T/F/A/M   "
				},
				sortable    : ["Alumno","Acta","NumSesion","FechaAux","FechaIngresoAux","FechaComienzoAux",],
				filterable  : ["Alumno","Acta","NumSesion","FechaAux","FechaIngresoAux","FechaComienzoAux",]
            },
        }
	},
	created(){
        this.getExpeditos();
        this.getSesiones();
        this.getModalidades();
        this.getDocentes();
	},
	mounted(){
        $('#objetivo').hide();
        $('#menos').hide();
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
        validafecha()
        {
            
            if(this.expedito.ingreso !=null)
            {
                var inicio = this.expedito.ingreso;
                var final  = '2022-01-01';
                if(final<=inicio)
                {
                    swal({
                        type: 'warning',
                        title: 'Ingresar una fecha correcta',
                       
                    });
                    this.expedito.ingreso = null;
                }
            }
             if(this.expedito.comienzo !=null)
            {
                var inicio = this.expedito.comienzo;
                var final  = '2026-01-01';
                if(final<=inicio)
                {
                    swal({
                        type: 'warning',
                        title: 'Ingresar una fecha correcta',
                       
                    });
                    this.expedito.comienzo = null;
                }
            }

            if(this.expedito.sustentacion !=null)
            {
                var inicio = this.expedito.sustentacion;
                var final  = '2026-01-01';
                if(final<=inicio)
                {
                    swal({
                        type: 'warning',
                        title: 'Ingresar una fecha correcta',
                       
                    });
                    this.expedito.sustentacion = null;
                }
            }
            
            
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
            this.expedito.codigo      = null;
            this.expedito.dni         = null;
            this.expedito.alumno      = null;
            this.expedito.carrera     = null;
            this.expedito.tomo        = null;
            this.expedito.folio       = null;
            this.expedito.asiento     = null;
            this.expedito.tesis       = null;
            this.expedito.sustentacion= null;
            this.expedito.calificacion= null;
            this.expedito.asesor      = null;
            this.expedito.modalidad   = null;
            this.expedito.sesion      = null;
            this.expedito.sfecha      = null;
            this.expedito.stipo       = null;
            this.expedito.ingreso     = null;
            this.expedito.comienzo    = null;
            $('#objetivo').hide();
            $('#expeditos').show();	
            $('#menos').hide();
            $('#mas').show();
        },
        borrar()
        {
            this.alumno.codigo      = null;
            this.alumno.dni         = null;
            this.alumno.apellido    = null;
        },
        seleccionar(d,c,n,ca)
        {
            this.expedito.codigo     = c;
            this.expedito.dni        = d;
            this.expedito.alumno     = n;
            this.expedito.carrera    = ca;

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
		addExpedito()
		{          
            if( this.expedito.codigo==null || this.expedito.dni==null ||
                this.expedito.alumno==null || this.expedito.carrera==null ||
                this.expedito.tomo==null || this.expedito.folio==null || this.expedito.asiento==null ||
                this.expedito.sesion==null || this.expedito.sfecha==null || this.expedito.stipo==null ||
                this.expedito.ingreso==null || this.archivos.foto == null || this.archivos.egresado == null || 
                this.archivos.matricula == null || this.archivos.tesis == null || this.archivos.word==null || this.expedito.tesis== null || this.expedito.sustentacion == null || this.expedito.calificacion == null || this.expedito.asesor == null || this.expedito.modalidad  == null)
            {
                swal({
					type: 'warning',
                    title: 'Llenar los datos obligatorios',
                    timer: 3000
				});
            }else{
                
                this.$Progress.start();
                axios.post("addExpeditoT",{
                    expedito:this.expedito,
                    archivos:this.archivos
                }).then(data=>{
                    swal({
                        // position: 'top-end',
                        type: data.data.type,
                        title: data.data.title,
                        text: data.data.text,
                        showConfirmButton: false,
                        timer: 2000
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
        seleccionar(d,c,n,ca)
        {
            this.expedito.codigo     = c;
            this.expedito.dni        = d;
            this.expedito.alumno     = n;
            this.expedito.carrera    = ca;

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
                        //title: 'Error',
                        text: 'El tamaño del archivo debe ser menor o igual a 1mb',
                        showConfirmButton: true,
                    });
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
                        //title: 'Error',
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
                        //title: 'Error',
                        text: 'El tamaño del archivo debe ser menor o igual a 1mb',
                        showConfirmButton: true,
                    });
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
                        //title: 'Error',
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
                        //title: 'Error',
                        text: 'El tamaño del archivo debe ser menor o igual a 1mb',
                        showConfirmButton: true,
                    });
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
                        //title: 'Error',
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
            if(size > 1024001)
            {
                e.target.value = '';
                swal({
                        type: 'error',
                        //title: 'Error',
                        text: 'El tamaño del archivo debe ser menor o igual a 1mb',
                        showConfirmButton: true,
                    });
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
                        //title: 'Error',
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
            if(size > 1024001)
            {
                e.target.value = '';
                swal({
                        type: 'error',
                        //title: 'Error',
                        text: 'El tamaño del archivo debe ser menor o igual a 1mb',
                        showConfirmButton: true,
                    });
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
                        //title: 'Error',
                        text: 'El archivo debe ser un documento en Word, por favor intente subiendo otro archivo',
                        showConfirmButton: true,
                    });
                return;     
            }
            
        },
        edit(IDExpedito,Tipo,CodigoAlumno,Tomo,Folio,Asiento,NumSesion,FechaIngreso,FechaComienzo,IDSesion,Fecha,Escuela,Alumno,DNI,IDModalidad,Modalidad,NombreTesis,Asesor,Calificacion,FechaT)
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
            this.expedito.calificacion = Calificacion;
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
                        text: data.data.text,
                        showConfirmButton: false,
                        timer: 2000
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
                        //title: 'Error',
                        text: 'Hay un problema, comuníquese con un administrador',
                        showConfirmButton: true,
                    });
                })
            }
        }
    }
}
</script>
