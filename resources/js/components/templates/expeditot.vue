
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
                    
                    <div class="col-md-4"><label><mark style="background-color: #dc354526; color: #520606f7">- Primero realizar la búsqueda del bachiller.</mark></label></div>
                    
					<div class="card-body">
                        <fieldset class="border p-2">
                            <legend class="w-auto">Datos Bachiller 
                                <button  data-target="#exampleModal" class="btn btn-primary" data-toggle="modal" data-placement="left">
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
                                    <input type="text" v-model="expedito.tesis" onKeyPress="return alfa(event)" maxlength="200" class="form-control form-control-sm">
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
                                    </select>
                                </div>
                                <div class="col-md-3 text-left">
                                <label>Fecha sustentación(*)</label>
                                </div>
                                <div class="col-md-3">
                                    <input type="date" v-model="expedito.sustentacion" class="form-control form-control-sm">
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
                        
                        <fieldset class="border p-2">
                            <legend class="w-auto">Documentos Titulación</legend>
                             <div class="form-group row">
                                
                                <div class="col-md-4">
                                    <label><input type="checkbox" name="check" >   Tesis PDF</label>
                                </div>

                                <div class="col-md-4">
                                    <label><input type="checkbox" name="check" >   Autorización de publicación</label>
                                </div>
                                
                            </div> 

                            <div class="form-group row">
                                
                                <div class="col-md-4">
                                    <label><input type="checkbox" name="check" >   Constancia antiplagio</label>
                                </div>

                                <div class="col-md-4">
                                    <label><input type="checkbox" name="check" >   Constancia URL</label>
                                </div>
                                
                            </div>
                            <div class="form-group row">

                                <div class="col-md-6">
                                    <label><mark style="background-color: #dc354526; color: #520606f7">Nota: Obligatorio tener marcado los 4 documentos para continuar.</mark></label>
                                </div>
                                
                                
                            </div>
                        </fieldset>
                        <fieldset class="border p-2">
                            <legend class="w-auto">Archivos</legend>
                            <div class="form-group row">
                                <div class="col-md-2">
                                    <label>Const. Matrícula(*)</label>
                                </div>
                                <div class="col-md-4">
                                    <input type="file" name="pdf" class="form-control form-control-sm">
                                </div>
                                <div class="col-md-2">
                                <label>Const. Egresado(*)</label>
                                </div>
                                <div class="col-md-4">
                                    <input type="file" name="pdf" class="form-control form-control-sm">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-2">
                                <label>Arch. Tesis PDF(*)</label>
                                </div>
                                <div class="col-md-4">
                                    <input type="file" name="pdf" class="form-control form-control-sm">
                                </div>
                                <div class="col-md-2">
                                <label>Arch. Tesis Word(*)</label>
                                </div>
                                <div class="col-md-4">
                                    <input type="file" name="pdf" class="form-control form-control-sm">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-2">
                                <label>Foto(*)</label>
                                </div>
                                <div class="col-md-4">
                                    <input type="file" name="pdf" class="form-control form-control-sm">
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
                                    <input type="date" id="ingreso" v-model="expedito.ingreso" onKeyPress="return soloNumeros(event)" maxlength="3" class="form-control form-control-sm">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="comienzo" class="col-md-4 col-form-label">Fecha que empieza el trámite </label>
                                <div class="col-md-3">
                                    <input type="date" id="comienzo" v-model="expedito.comienzo" class="form-control form-control-sm">
                                </div>
                            </div>
                        </fieldset>
                        <br>
                        <div class="row">
                            <div class="col-md-2">
                                <button class="btn btn-success" @click="addExpedito()">Guardar <i class="fa fa-save"></i></button>
                            </div>
                            <div class="col-md-2">
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
                                    <input type="text" v-model="alumno.dni" id="dni1" class="form-control form-control-sm">
                                </div>
                                <label for="codigo1" class="col-md-2 col-form-label">Código: </label>
                                <div class="col-md-4">
                                    <input type="text" v-model="alumno.codigo" id="codigo1" class="form-control form-control-sm">
                                </div>
                            </div>
                            <!--<div class="form-group row">
                                <label for="nombre1" class="col-md-2 col-form-label">Apellido: </label>
                                <div class="col-md-10">
                                    <input type="text" id="nombre1"  v-model="alumno.apellido" class="form-control form-control-sm">
                                </div>
                            </div>-->
                            <div class="form-group row">
                                <label for="nombre1" class="col-md-2 col-form-label">Input Creado: </label>
                                <div class="col-md-10">
                                    <table colspadding=0 cellspacing=0 border="1">
                                    <tr class="t10" v-for="a in alumnos" :key="a.Codigo">
                                        <td><input type="text" class="form-control form-control-sm">{{a.Nombres}}</td>
                                        <td><input data-dismiss="modal" type="checkbox" @click="seleccionar(a.DNI,a.Codigo,a.Nombres,a.Carrera)" class="form-control form-control-sm"></td>
                                    </tr>
                                    </table>
                                </div>
                            </div>
                            <!--<fieldset class="border p-2">
                                <legend class="w-auto">Lista de egresados</legend>
                                <table colspadding=0 cellspacing=0 border="1">
                                    <tr>
                                        <td class="text-center"><i class="blanco">aaa</i> DNI <i class="blanco">aaa</i></td>
                                        <td class="text-center"><i class="blanco">a</i>CÓDIGO<i class="blanco">a</i></td>
                                        <td class="text-center"><i class="blanco">aaaaaaaaa</i>NOMBRES<i class="blanco">aaaaaaaaa</i></td>
                                        <td class="text-center">SELECCIONAR</td>
                                    </tr>
                                    <tr class="t10" v-for="a in alumnos" :key="a.Codigo">
                                        <td>{{a.DNI}}</td>
                                        <td>{{a.Codigo}}</td>
                                        <td>{{a.Nombres}}</td>
                                        <td><input data-dismiss="modal" type="checkbox" @click="seleccionar(a.DNI,a.Codigo,a.Nombres,a.Carrera)" class="form-control form-control-sm"></td>
                                    </tr>
                                </table>
                            </fieldset>-->
                            <div class="row">
                                <div class="col-md-4">
                                    <button class="btn btn-primary" @click="buscar(alumno.dni,alumno.codigo,alumno.apellido)">Buscar <i class="fa fa-search"></i></button>
                                </div>
                                <div class="col-md-4">
                                    <button class="btn btn-warning" @click="borrar()">Limpiar <i class="fas fa-broom"></i></button>
                                </div>
                                <div class="col-md-4">
                                    <button class="btn btn-success" data-dismiss="modal" type="checkbox" @click="seleccionar(a.DNI,a.Codigo,a.Nombres,a.Carrera)">Seleccionar <i class="fas fa-check"></i></button>
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
                                        <button v-if="props.row.Estado == 'PENDIENTE'" v-on:click="estado(props.row.IDExpedito,1)" class="btn btn-danger" data-toggle="tooltip" data-placement="left" >Pendiente</button>
                                        <button v-if="props.row.Estado == 'EN PROCESO'" v-on:click="estado(props.row.IDExpedito,2)"  class="btn btn-warning" data-toggle="tooltip" data-placement="left" >En Proceso</button>
                                        <button v-if="props.row.Estado == 'FINALIZADO'"  class="btn btn-success" data-toggle="tooltip" data-placement="left" >Finalizado</button>
                                        <!-- <button class="btn btn-info" data-toggle="tooltip" v-on:click="reg(props.row.IDExpedito)" data-placement="left" title="Registrar"><i class="fas fa-edit" style="color: white" aria-hidden="true"></i></button> -->
                                        <router-link v-if="props.row.Estado == 'FINALIZADO'" class="btn btn-success" target="_blank" :to="'/oficio/'+props.row.IDExpedito" data-toggle="tooltip"  data-placement="left" title="Ver Acta"><i class="far fa-file-pdf" aria-hidden="true"></i></router-link>
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
                tipo:"TITULO"
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
                FechaIngreso: null,
                FechaComienzo: null,
                Estado: null,
                Fecha: null,
                Alumno: null,
            }],
            columns: ["Alumno","Acta","NumSesion","Fecha","FechaIngreso","FechaComienzo","Acciones"],
            options: {
				headings:
				{
                    CodigoAlumno: "Código",
                    NumSesion: "Sesión",
                    FechaIngreso: "Ingreso trámite",
                    FechaComienzo: "Comienzo trámite",
                    Fecha: "Fecha Sesión",
                    Alumno: "Egresado",
                    Acta: "   T-F-A   "
				},
				sortable    : ["Alumno","Acta","NumSesion","Fecha","FechaIngreso","FechaComienzo",],
				filterable  : ["Alumno","Acta","NumSesion","Fecha","FechaIngreso","FechaComienzo",]
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
        buscar(d,c,a)
        {
            if(d == '') d = null;
            if(c == '') c = null;
            if(a == '') a = null;
            axios.get("getAlumnos/"+d+"/"+c+"/"+a)
            .then(data=>
            {
                this.alumnos = data.data.alumnos;
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
                this.expedito.ingreso==null)
            {
                swal({
					type: 'error',
					title: 'Llenar los datos obligatorios',
				});
            }else{
                this.$Progress.start();
                axios.post("addExpedito",{
                    expedito:this.expedito
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
                        title: 'Error',
                        text: 'Comuniquese con un administrador',
                        showConfirmButton: true,
                    });
                })
            }
			
		},
		ocultar(id){
			if(id == '1')
			{
                $('#objetivo').show();
                $('#expeditos').hide();
                $('#menos').show();
                $('#mas').hide();
			}
			else if(id == '2')
			{
				$('#objetivo').hide();
                $('#expeditos').show();	
                $('#menos').hide();
                $('#mas').show();
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
        
    }
}
</script>
