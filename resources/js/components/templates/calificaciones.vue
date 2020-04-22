<template>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
				<div class="row">
					<div class="col-md-8">
						<div class="form-group">
							<button data-target="#exampleModal" class="btn btn-success" data-toggle="modal" data-placement="left" >Agregar Calificación <i class="fa fa-plus"></i></button>
						</div>
					</div>
				</div>
	            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                        <div class="modal-header text-center" style="background-color: #007bff55 !important; color:black; font-weight: bold;">
                            <h5 class="modal-titler" id="exampleModalLabel">Datos Calificación</h5>
                            <!--<button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>-->
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-3 text-left">
                                    <label>Calificación*</label>
                                </div>
                                <div class="col-md-9">
                                    <input type="text" class="form-control form-control-sm" v-model="calificacion.calificacion" onkeypress="return soloLetras(event)" maxlength="30">
                                </div>    
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-12 text-left">
                                    <label>* Campo obligatorio</label>
                                </div>                                
                            </div>
                        <div class="modal-footer">
                            <button @click="addCalificacion(1)" id="add" class="btn btn-success">Guardar <i class="fa fa-save"></i></button>
                            <button @click="addCalificacion(2)" id="editar" class="btn btn-success">Guardar <i class="fa fa-save"></i></button>
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
                                <h4 class="title">CALIFICACIONES</h4>  
                            </div>
                        <div class="card-body">
                            <div class="content table-responsive table-full-width">
                                <v-client-table :data="calificaciones" :columns="columns" :options="options">
                                    <div slot="Accion" slot-scope="props">
                                     <button data-target="#exampleModal" class="btn btn-info" data-toggle="modal" v-on:click="edit(props.row.IDCalificacion,props.row.Calificacion)" data-placement="left" style="color: white" title="Editar">Editar <i class="fas fa-edit" style="color: white" aria-hidden="true"></i></button>
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
			calificacion:{
                idcalificacion:null,
                calificacion:null,
            },
            calificaciones:[{
                IDCalificacion:null,
                Calificacion:null,
            }],
            columns: ["IDCalificacion","Calificacion","Accion"],
            options: {
				headings:
				{
                    IDCalificacion:"ID",
                    Calificacion:"Calificacion",
				},
				sortable    : ["IDCalificacion","Calificacion"],
				filterable  : ["IDCalificacion","Calificacion"]
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
            axios.get("getCalificaciones")
            .then(data=>
            {
                this.calificaciones = data.data.calificaciones;
                this.$Progress.finish();
            }
            ).catch(error=>{
                console.log(error);
            })
        },
        
        addCalificacion(e)
		{
            if(this.calificacion.calificacion == null)
            {
                swal({
					type: 'warning',
					title: 'Llenar el campo obligatorio',
				});
            }else if(e == 1){
                this.$Progress.start();
                axios.post("addCalificacion",{
                    calificacion:this.calificacion
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
                axios.post("updateCalificacion",{
                    calificacion:this.calificacion
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
            }
		},
		load(){
                $('#add').show();
                $('#editar').hide();
                this.calificacion.idcalificacion    = null;
                this.calificacion.calificacion      = null;
		},
		edit(IDCalificacion,Calificacion)
		{
            $('#editar').show();
            $('#add').hide();
            this.calificacion.idcalificacion    = IDCalificacion;
            this.calificacion.calificacion      = Calificacion;
               
		},
        
    }
}
</script>
