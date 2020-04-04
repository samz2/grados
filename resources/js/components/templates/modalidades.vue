<template>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
				<div class="row">
					<div class="col-md-8">
						<div class="form-group">
							<button data-target="#exampleModal" class="btn btn-success" data-toggle="modal" data-placement="left" >Agregar Modalidad <i class="fa fa-plus"></i></button>
						</div>
					</div>
				</div>
	            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                        <div class="modal-header text-center" style="background-color: #007bff55 !important; color:black; font-weight: bold;">
                            <h5 class="modal-titler" id="exampleModalLabel">Datos Modalidad</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-3 text-left">
                                    <label>Modalidad(*)</label>
                                </div>
                                <div class="col-md-9">
                                    <input type="text" class="form-control form-control-sm" v-model="modalidad.modalidad" onkeypress="return sololetras(event)" maxlength="30">
                                </div>    
                            </div>
                            <br>
                        <div class="modal-footer">
                            <button @click="addModalidad(1)" id="add" class="btn btn-success" data-dismiss="modal">Agregar <i class="fa fa-save"></i></button>
                            <button @click="addModalidad(2)" id="editar" class="btn btn-success" data-dismiss="modal">Editar <i class="far fa-edit"></i></button>
                            <button type="button" class="btn btn-danger" @click="load()" data-dismiss="modal">Cancelar <i class="fas fa-times"></i></button>
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
                                <h4 class="title">MODALIDADES</h4>  
                            </div>
                        <div class="card-body">
                            <div class="content table-responsive table-full-width">
                                <v-client-table :data="modalidades" :columns="columns" :options="options">
                                    <div slot="Acciones" slot-scope="props">
                                     <button data-target="#exampleModal" class="btn btn-info" data-toggle="modal" v-on:click="edit(props.row.IDModalidad,props.row.Modalidad)" data-placement="left" style="color: white" title="Editar">Editar <i class="fas fa-edit" style="color: white" aria-hidden="true"></i></button>
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
			modalidad:{
                idmodalidad:null,
                modalidad:null,
            },
            modalidades	:[{
                IDModalidad:null,
                Modalidad:null,
            }],
            columns: ["IDModalidad","Modalidad","Acciones"],
            options: {
				headings:
				{
                    IDModalidad:"ID",
                    Modalidad:"Modalidad",
				},
				sortable    : ["IDModalidad","Modalidad"],
				filterable  : ["IDModalidad","Modalidad"]
            },
            docentes:[]
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
        
        addModalidad(e)
		{
            if(this.modalidad.modalidad == null)
            {
                swal({
					type: 'error',
					title: 'Llenar los datos obligatorios',
				});
            }else if(e == 1){
                this.$Progress.start();
                axios.post("addModalidad",{
                    modalidad:this.modalidad
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
                axios.post("updateModalidad",{
                    modalidad:this.modalidad
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
                this.modalidad.idmodalidad    = null;
                this.modalidad.modalidad      = null;
		},
		edit(IDModalidad,Modalidad)
		{
            $('#editar').show();
            $('#add').hide();
            this.modalidad.idmodalidad    = IDModalidad;
            this.modalidad.modalidad      = Modalidad;
               
		},
        
    }
}
</script>
