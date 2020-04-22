<template>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<button data-target="#exampleModal" class="btn btn-success" data-toggle="modal" data-placement="left" >Agregar Estado <i class="fa fa-plus"></i></button>
						</div>
					</div>
				</div>
	            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                        <div class="modal-header text-center" style="background-color: #007bff55 !important; color:black; font-weight: bold;">
                            <h5 class="modal-titler" id="exampleModalLabel">Datos Estado</h5>
                            <!--<button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>-->
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-3 text-left">
                                        <label>Posición*</label>
                                </div>
                                <div class="col-md-3">
                                    <input v-model="estado.posicion" type="number" min="1" max="5" class="form-control">
                                </div>    
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-3 text-left">
                                    <label>Estado*</label>
                                </div>
                                <div class="col-md-8">
                                    <input v-model="estado.estado" maxlength="35" class="form-control" onKeyPress="return soloLetras(event)">
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-12 text-left">
                                    <label>* Campos obligatorios</label>
                                </div>                                
                            </div>
                        <div class="modal-footer">
                            <button @click="addEstado(1)" id="add" class="btn btn-success">Guardar <i class="fa fa-save"></i></button>
                            <button @click="addEstado(2)" id="editar" class="btn btn-success" data-dismiss="modal">Guardar <i class="fa fa-save"></i></button>
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
                                <h4 class="title">ESTADOS</h4>  
                            </div>
                        <div class="card-body">
                            <div class="content table-responsive table-full-width">
                                <v-client-table :data="estados" :columns="columns" :options="options">
                                    <div slot="Accion" slot-scope="props">
                                     <button data-target="#exampleModal" class="btn btn-info" data-toggle="modal" style="color: white" v-on:click="edit(props.row.IDEstado,props.row.Posicion,props.row.Estado)" data-placement="left" title="Editar">Editar <i class="fas fa-edit" style="color: white" aria-hidden="true"></i></button>
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
			estado:{
                idestado:null,
                posicion:null,
                estado:null,
            },
            estados	:[{
                IDEstado:null,
                Posicion:null,
                Estado:null,
            }],
            columns: ["Posicion","Estado","Accion"],
            options: {
				headings:
				{
                    Posicion:"Posición",
                    Estado:"Estado",
                    
				},
				sortable    : ["Posicion","Estado"],
				filterable  : ["Posicion","Estado"]
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
            axios.get("getEstados")
            .then(data=>
            {
                this.estados = data.data.estados;
                this.$Progress.finish();
            }
            ).catch(error=>{
                console.log(error);
            })
        },
        addEstado(e)
		{
            if(this.estado.posicion == null || this.estado.estado == null)
            {
                swal({
                    type: 'warning',
                    title: 'Llenar los campos obligatorios',
                    //allowOutsideClick: false,
                    timer: 3000
                });
            }else if(e == 1){
                this.$Progress.start();
                axios.post("addEstado",{
                    estado:this.estado
                }).then(data=>{
                    swal({
                        type: data.data.type,
                        title: data.data.title,
                        text: data.data.text,
                        showConfirmButton: false,
                        timer: 3000
                    });
                    this.$Progress.finish();
                    this.getDatos();
                    this.load();
                    $("#exampleModal").modal('hide');
                    }).catch(error=>{
                    console.log(error);	
                    swal({
                        type: 'error',
                        title: 'Ha ocurrido un error',
                        text: 'Comuníquese con un administrador',
                        showConfirmButton: true,
                    });
                })
            }else if(e == 2){
                this.$Progress.start();
                axios.post("updateEstados",{
                    estado:this.estado
                }).then(data=>{
                    swal({
                        type: data.data.type,
                        title: data.data.title,
                        text: data.data.text,
                        showConfirmButton: false,
                        timer: 3000
                    });
                    this.$Progress.finish();
                    this.getDatos();
                    this.load();
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
		load(){
                $('#add').show();
                $('#editar').hide();
                this.estado.estado      = null;
                this.estado.idestado    = null;
                this.estado.posicion     = null;
                
		},
		edit(IDEstado,Posicion,Estado)
		{
            $('#editar').show();
            $('#add').hide();
            this.estado.estado      = Estado;
            this.estado.idestado    = IDEstado;
            this.estado.posicion    = Posicion;
		},
    }
}
</script>
