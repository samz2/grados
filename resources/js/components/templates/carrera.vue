<template>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<button data-target="#exampleModal" class="btn btn-outline-secondary" data-toggle="modal" data-placement="left" >Carrera <i class="fa fa-plus"></i></button>
						</div>
					</div>
				</div>
	            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                        <div class="modal-header text-center bg-secondary">
                            <h5 class="modal-titler" id="exampleModalLabel">Datos Carrera</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-4 text-left">
                                    <label>Nombre(*)</label>
                                </div>
                                <div class="col-md-3">
                                    <input v-model="carrera.carrera" type="text" maxlength="3" class="form-control" onKeyPress="return solonumeros(event)">
                                </div>    
                            </div>
                        <div class="modal-footer">
                            <button @click="addEscuela(1)" id="add" class="btn btn-outline-success" data-dismiss="modal">Agregar <i class="fa fa-save"></i></button>
                            <button @click="addEscuela(2)" id="editar" class="btn btn-outline-success" data-dismiss="modal">Editar <i class="fa fa-pencil"></i></button>
                            <button type="button" class="btn btn-outline-secondary" @click="load()" data-dismiss="modal">Cerrar <i class="fa fa-close"></i></button>
                        </div>
                        </div>
                    </div>
                </div>
                <!-- final modal -->
        </div>
        
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-secondary">
                            <div class="card-header text-center">
                                <h4 class="title">SESIONES</h4>  
                            </div>
                        <div class="card-body">
                            <div class="content table-responsive table-full-width">
                                <v-client-table :data="sesiones" :columns="columns" :options="options">
                                    <div slot="Acciones" slot-scope="props">
                                     <button data-target="#exampleModal" class="btn btn-info" data-toggle="modal" v-on:click="edit(props.row.IDSesion,props.row.NumSesion,props.row.Fecha,props.row.Tipo)" data-placement="left" title="Editar"><i class="fas fa-edit" style="color: white" aria-hidden="true"></i></button>
                                    </div>
                                </v-client-table>
                            </div>
                        </div>
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
			carrera:{
                idsesion:null,
                carrera:null,
                fecha:null,
                tipo:null,
            },
            sesiones	:[{
                IDSesion:null,
                NumSesion:null,
                Fecha:null,
                Tipo:null,
            }],
            columns: ["NumSesion","Tipo","Fecha","Acciones"],
            options: {
				headings:
				{
                    NumSesion:"Número de Sesión",
                    Fecha:"Fecha",
                    Tipo:"Tipo"
                    
				},
				sortable    : ["NumSesion","Tipo","Fecha",],
				filterable  : ["NumSesion","Tipo","Fecha",]
            },
        }
	},
	created(){
        this.getDatos();
	},
	mounted(){
        $('#editar').hide();
	},
    methods: {
		getDatos()
        {
            this.$Progress.start();
            axios.get("getSesiones")
            .then(data=>
            {
                this.sesiones = data.data.sesiones;
                this.$Progress.finish();
            }
            ).catch(error=>{
                console.log(error);
            })
        },
        addEscuela(e)
		{
            if(this.carrera.carrera == null || this.carrera.tipo == null || this.carrera.fecha == null)
            {
                swal({
					type: 'error',
					title: 'Llenar los datos obligatorios',
				});
            }else if(e == 1){
                this.$Progress.start();
                axios.post("addEscuela",{
                    carrera:this.carrera
                }).then(data=>{
                    swal({
                        type: data.data.type,
                        title: data.data.title,
                        text: data.data.text,
                        showConfirmButton: false,
                        timer: 2000
                    });
                    this.$Progress.finish();
                    this.getDatos();
                    this.load();
                    }).catch(error=>{
                    console.log(error);	
                    swal({
                        type: 'error',
                        title: 'Error',
                        text: 'Comuniquese con un administrador',
                        showConfirmButton: true,
                    });
                })
            }else if(e == 2){
                this.$Progress.start();
                axios.post("updateSesion",{
                    carrera:this.carrera
                }).then(data=>{
                    swal({
                        type: data.data.type,
                        title: data.data.title,
                        text: data.data.text,
                        showConfirmButton: false,
                        timer: 2000
                    });
                    this.$Progress.finish();
                    this.getDatos();
                    this.load();
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
		load(){
                $('#add').show();
                $('#editar').hide();
                this.sesion.idsesion    = null;
                this.sesion.sesion      = null;
                this.sesion.fecha       = null;
                this.sesion.tipo        = null;
                
		},
		edit(IDSesion,NumSesion,Fecha,Tipo)
		{
            $('#editar').show();
            $('#add').hide();
            this.sesion.idsesion    = IDSesion;
            this.sesion.sesion      = NumSesion;
            this.sesion.fecha       = Fecha;
            this.sesion.tipo        = Tipo;
		},
    }
}
</script>
