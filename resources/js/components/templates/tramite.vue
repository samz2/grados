
<template>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<button  class="btn btn-outline-primary" @click="ocultar('1')">
							Trámite <i class="fa fa-plus"></i>
							</button>
							<button  class="btn btn-outline-primary" @click="ocultar('2')">
								<i class="fa fa-minus"></i>
							</button>
						</div>
					</div>
				</div>
	            <div class="card card-default"  id="objetivo">
	                <div class="card-header text-center" style="background-color: #2FA3C6; color: white;">
	                    <h4 class="title">Trámite</h4>  
	                </div>
					<div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Alumno (*)</label>
                                    <v-select v-model="alumnoz" :options="alumnos" :value="alumnos.code"> </v-select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Tipo(*)</label>
                                    <select v-model="tramite.tipo" class="form-control" @change="obtener(tramite.tipo)">
                                        <option v-for="t in tipos" :key="t.tipo" :value="t.tipo">
                                            {{t.tipo}}
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4" id="docente">
                                <div class="form-group">
                                    <label>Docente(*)</label>
                                    <select v-model="tramite.docente" class="form-control">
                                        <option v-for="d in docentes" :key="d.DNI" :value="d.DNI">
                                            {{d.Nombres}} {{d.Apellidos}}
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Fecha Recepción(*)</label>
                                    <input v-model="tramite.fechar" type="date" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Tema(*)</label>
                                    <textarea v-model="tramite.tema" maxlength="200" class="form-control"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row text-left">
                            <div class="col-md-2">
                                <button @click="addTramite()" id="add" class="btn btn-outline-success">Registrar <i class="fa fa-save"></i></button>
                            </div>
                        </div>
                        <div class="clearfix"></div>
	                </div>
				</div>
			</div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card card-default">
                        <div class="card-header text-center" style="background-color: #2FA3C6; color: white;">
                            <h4 class="title">TRÁMITES</h4>  
                        </div>
                    <div class="card-body" style="font-size: 11px">
                        <div class="content table-responsive table-full-width">
                            <v-client-table :data="tramites" :columns="columns" :options="options">
                                <div slot="Estados" slot-scope="props">
                                    <!-- <a href="#" class="small-box-footer" data-toggle="modal" title="Opciones" @click="datos(h.Numero,h.Estado,h.Precio)" data-target="#exampleModal">Opciones <i class="fa fa-arrow-circle-right"></i></a> -->
                                    <button v-if="props.row.Estado == 'ACEPTADO'" class="btn btn-success" data-placement="left" >ACEPTADO</button>
                                    <button v-if="props.row.Estado == 'RECIBIDO'" v-on:click="estado(props.row.IDTramite,props.row.Estado)" data-target="#exampleModal" class="btn btn-primary" data-toggle="modal" data-placement="left" >RECIBIDO</button>
                                    <button v-if="props.row.Estado == 'OBSERVADO'" v-on:click="estado(props.row.IDTramite,props.row.Estado)" data-target="#exampleModal" class="btn btn-warning" data-toggle="modal" data-placement="left" >OBSERVADO</button>
                                    <button v-if="props.row.Estado == 'RECHAZADO'" class="btn btn-danger" data-placement="left" >RECHAZADO</button>
                                </div>
                                <!-- <div slot="Acciones" slot-scope="props">
                                <router-link class="btn btn-success" target="_blank" :to="'/oficio/'+props.row.IDDocumento" data-toggle="tooltip"  data-placement="left" title="Eliminar"><i class="far fa-file-pdf" aria-hidden="true"></i></router-link>
                                <button class="btn btn-info" data-toggle="tooltip" v-on:click="edit(props.row.IDEgresado)" data-placement="left" title="Editar"><i class="fas fa-edit" style="color: white" aria-hidden="true"></i></button>
                                </div> -->
                            </v-client-table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- ventana modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                    <div class="modal-header text-center" style="background-color: #2FA3C6 ;color:white">
                        <h5 class="modal-titler" id="exampleModalLabel">Opciones</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
								<div class="form-group">
									<label>Acciones</label>
									<select v-model="tramite.accion" class="form-control" @change="accion(tramite.accion)">
										<option value="1" v-if="tramite.estado == 'RECIBIDO' || tramite.estado != 'ACEPTADO' || tramite.estado == 'OBSERVADO'">Aceptar</option>
										<option value="2" v-if="(tramite.estado == 'RECIBIDO' || tramite.estado != 'OBSERVADO')  && tramite.estado != 'RECHAZADO'">Observar</option>
										<option value="3" v-if="tramite.estado == 'RECIBIDO' || tramite.estado != 'RECHAZADO' || tramite.estado != 'ACEPTADO'">Rechazar</option>
									</select>
								</div>
							</div>
                        </div>
                        <div class="row" id="entrega">
                            <div class="col-md-6">
								<div class="form-group">
									<label>Fecha de Entrega de Observaciones</label>
									<input type="date" v-model="tramite.fechae" class="form-control">
								</div>
							</div>
                        </div>
                        <div class="row" id="aceptacion">
                            <div class="col-md-6">
								<div class="form-group">
									<label>Fecha de Aceptación</label>
									<input type="date" v-model="tramite.fechaa" class="form-control">
								</div>
							</div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-primary" @click="guardar()" data-dismiss="modal">Guargar <i class="fa fa-save"></i></button>
                        <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cerrar <i class="fa fa-close"></i></button>
                    </div>
                    </div>
                </div>
            </div>
        <!-- final modal -->
    </div>
</template>
<script>
    export default {
  
    data() {
        return {
            alumnoz:null,
			tramite:{
                id:null,
                aux:null,
                alumno:null,
                tipo:null,
                docente:null,
                fechar:null,
                fechaa:null,
                fechae:null,
                tema:null,
                estado:null,
                accion:null,
			},
            alumnos:[{label:null,code:null}],
            tipos:[
                {tipo:"TEMA"},
                {tipo:"PLAN DE TESIS"},
                {tipo:"TESIS"},
                ],
            tramites	:[{
                IDTramite:null,
                Codigo:null,
                Alumno:null,
                Docente:null,
                FechaRecepcion:null,
                Escuela:null,
                Tema:null,
                Tipo:null,
                Estado:null,
            }],
            columns: ["Escuela","Codigo","Alumno","Docente","FechaRecepcion","Tema","Tipo","Estados"],
            options: {
				headings:
				{
                    Codigo:"Código",
                    Alumno:"Alumno",
                    Docente:"Docente",
                    FechaRecepcion:"Recepción",
                    Escuela:"Escuela",
                    Tema:"Tema",
                    Tipo:"Tipo",
				},
				sortable    : ["Escuela","Codigo","Alumno","Docente","FechaRecepcion","Tema","Tipo"],
				filterable  : ["Escuela","Codigo","Alumno","Docente","FechaRecepcion","Tema","Tipo"]
            },
            docentes:[]
        }
	},
	created(){
        this.getAlumnos();
        this.getDocentes();
        this.getDocumentos();
	},
	mounted(){
        $('#docente').hide();
        $('#objetivo').hide();
        $('#aceptacion').hide();
        $('#entrega').hide();
        
	},
    methods: {
        getAlumnos()
        {
            axios.get("getAlumnos")
            .then(data=>
            {
                this.alumnos = data.data.egresados;
                console.log(this.alumnos);
                $("#alumnos").show();
                this.$Progress.finish();
            }
            ).catch(error=>{
                console.log(error);
            })
        },
        getDocentes()
        {
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
        obtener(tipo)
        {
            if(tipo != "TEMA")
            {
                $('#docente').show();
            }else{
                $('#docente').hide();
            }
        },
        getDocumentos()
        {
            this.$Progress.start();
            axios.get("getTramites")
            .then(data=>
            {
                this.tramites = data.data.tramites;
                this.$Progress.finish();
                console.log(data.data);
            }
            ).catch(error=>{
                console.log(error);
            })
		},
		addTramite()
		{
            this.tramite.alumno = this.alumnoz.code;
            if(this.tramite.alumno  == null || this.tramite.fechar == null || this.tramite.tipo == null 
            || this.tramite.tema    == null)
            {
                swal({
					type: 'error',
					title: 'Llenar los datos obligatorios',
				});
            }else{
                this.$Progress.start();
                axios.post("addTramite",{
                    tramite:this.tramite
                }).then(data=>{
                    swal({
                        // position: 'top-end',
                        type: 'success',
                        title: 'Datos ingresados correctamente',
                        showConfirmButton: false,
                        timer: 2000
                    });
                    this.$Progress.finish();
                    setTimeout(() => {
                        location.reload();
                    }, 1500);
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
        deleteEgresado(id)
        {
			this.$Progress.start();
            swal({
                title: '¿Deseas eliminar este Egresado?',
                text: "No será posible revertir esta acción!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si',
                cancelButtonText: 'cancelar',
            }).then((result) => {
                if (result.value) {
                    axios.get(`/deleteEgresado/${id}`)
                        .then(data => {
                        if(data.data=="OK"){
                            swal(
                            'Eliminado!',
                            'el egresado ha sido eliminada.',
                            'success'
							);
                        this.$Progress.finish();
                        this.getDatos();
                        }
                        }).catch(error => {
                            console.log('Ocurrio un error ' + error);
                            this.$Progress.fail();
                        });
                     }
                });
		},
		estado(id,estado)
		{
            this.tramite.id = id;
            this.tramite.estado = estado;
		},
        accion(estado)
		{
            if(estado == 1)
            {
                $('#aceptacion').show();
                $('#entrega').hide();
            }else if(estado == 2)
            {
                $('#aceptacion').hide();
                $('#entrega').show();
            }
        },
        ocultar(id){
			if(id == '1')
			{
                $('#objetivo').show();
                $('#nivel').show();
                $('#add').show();
                $('#curso').show();
                $('#editar').hide();
			}
			else if(id == '2')
			{
				$('#objetivo').hide();	
			}
			
		},
		guardar()
		{
			axios.post("updateEstado",{
				tramite:this.tramite
			}).then(data=>{
				console.log(data);
				swal({
					// position: 'top-end',
					type: 'success',
					// title: 'Area editada correctamente',
					showConfirmButton: false,
					timer: 2000
                });
                $('#objetivo').hide();
                this.tramite.id = null;
                this.tramite.accion = null;
                this.tramite.estado = null;
                // setTimeout(() => {
                //         location.reload();
                //     }, 1500);
				this.getDocumentos();
			}).catch(error=>{
				console.log(error);	
				swal({
					type: 'error',
					title: 'Error',
					text: 'Comuniquese con el administrador del sistema',
					showConfirmButton: true,
				});
			})
        },
    }
}
</script>
