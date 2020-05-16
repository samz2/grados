<template>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<button data-target="#exampleModal" class="btn btn-success" data-toggle="modal" data-placement="left" >Agregar Carrera <i class="fa fa-plus"></i></button>
						</div>
					</div>
				</div>
	            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                        <div class="modal-header text-center" style="background-color: #007bff55 !important; color:black; font-weight: bold;">
                            <h5 class="modal-titler" id="exampleModalLabel">Datos Carrera</h5>
                            <!--<button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>-->
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-4 text-left">
                                    <label>Nombre Carrera*</label>
                                </div>
                                <div class="col-md-8">
                                    <input v-model="carrera.carrera" type="text" maxlength="50" class="form-control" onKeyPress="return soloLetras(event)">
                                </div>    
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-12 text-left">
                                    <label>* Campo obligatorio</label>
                                </div>                                
                            </div>
                        <div class="modal-footer">
                            <button @click="addCarrera(1)" id="add" class="btn btn-success">Guardar <i class="fa fa-save"></i></button>
                            <button @click="addCarrera(2)" id="editar" class="btn btn-success" data-dismiss="modal">Guardar <i class="fa fa-save"></i></button>
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
                                <h4 class="title">CARRERAS PROFESIONALES</h4>  
                            </div>
                        <div class="card-body">
                            <div class="content table-responsive table-full-width">
                                <v-client-table :data="carreras" :columns="columns" :options="options">
                                    <div slot="Accion" slot-scope="props">
                                     <button data-target="#exampleModal" class="btn btn-info" data-toggle="modal" v-on:click="edit(props.row.IDEscuela,props.row.Escuela)" data-placement="left" style="color: white" title="Editar">Editar <i class="fas fa-edit" style="color: white" aria-hidden="true"></i></button>
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
                idcarrera:null,
                carrera:null,
            },
            carreras	:[{
                IDEscuela:null,
                Escuela:null,
            }],
            columns: ["Escuela","Accion"],
            options: {
				headings:
				{
                    Escuela:"Nombre Carrera",
				},
				sortable    : ["Escuela"],
				filterable  : ["Escuela"]
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
            axios.get("getEscuelas")
            .then(data=>
            {
                this.carreras = data.data.escuelas;
                this.$Progress.finish();
            }
            ).catch(error=>{
                console.log(error);
            })
        },
        addCarrera(e)
		{
            if(this.carrera.carrera == null)
            {
                swal({
                    type: 'warning',
                    title: 'Llenar el campo obligatorio',
                    //allowOutsideClick: false,
                    timer: 3000
                });
            }else if(e == 1){
                this.$Progress.start();
                axios.post("addCarrera",{
                    carrera:this.carrera
                }).then(data=>{
                    swal({
                        type: data.data.type,
                        title: data.data.title,
                        text: data.data.text,
                        showConfirmButton: false,
                        timer: 4000
                    });
                    this.$Progress.finish();
                    this.getDatos();
                    this.load();
                    $("#exampleModal").modal('hide');
                    }).catch(error=>{
                    console.log(error);	
                    swal({
                        type: 'error',
                        title: "Ha ocurrido un error",
                        text: "Contáctese con un administrador",
                        showConfirmButton: true,
                    });
                })
            }else if(e == 2){
                this.$Progress.start();
                axios.post("updateCarrera",{
                    carrera:this.carrera
                }).then(data=>{
                    swal({
                        type: data.data.type,
                        title: data.data.title,
                        text: data.data.text,
                        showConfirmButton: false,
                        timer: 4000
                    });
                    this.$Progress.finish();
                    this.getDatos();
                    this.load();
                    }).catch(error=>{
                    console.log(error);	
                    swal({
                        type: 'error',
                        title: "Ha ocurrido un error",
                        text: "Contáctese con un administrador",
                        showConfirmButton: true,
                    });
                })
            }
		},
		load(){
                $('#add').show();
                $('#editar').hide();
                this.carrera.idcarrera    = null;
                this.carrera.carrera      = null;
		},
		edit(IDEscuela,Escuela)
		{
            $('#editar').show();
            $('#add').hide();
            this.carrera.idcarrera    = IDEscuela;
            this.carrera.carrera      = Escuela;
		},
    }
}
</script>
