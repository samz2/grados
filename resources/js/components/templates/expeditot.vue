
<template>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<button  class="btn btn-outline-primary" @click="ocultar('1')">
							Expedito <i class="fa fa-plus"></i>
							</button>
							<button  class="btn btn-outline-primary" @click="ocultar('2')">
								<i class="fa fa-minus"></i>
							</button>
						</div>
					</div>
				</div>
	            <div class="card card-default"  id="objetivo">
	                <div class="card-header text-center" style="background-color: #2FA3C6; color: white;">
	                    <h4 class="title">Expeditos</h4>  
	                </div>
					<div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Alumno (*)</label>
                                    <v-select v-model="expedito.alumno" :options="alumnos"> </v-select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Fecha Recepción(*)</label>
                                    <input v-model="expedito.recepcion" type="date" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Fecha Sesión(*)</label>
                                    <input v-model="expedito.sesion" type="date" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row text-left">
                            <div class="col-md-2">
                                <button @click="addExpedito()" id="add" class="btn btn-outline-success">Agregar <i class="fa fa-save"></i></button>
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
                                <h4 class="title">EXPEDITOS</h4>  
                            </div>
                        <div class="card-body">
                            <div class="content table-responsive table-full-width">
                                <v-client-table :data="expeditos" :columns="columns" :options="options">
                                    <div slot="Acciones" slot-scope="props">
                                        <button v-if="props.row.Estado == 'PENDIENTE'" v-on:click="estado(props.row.IDExpedito,1)" class="btn btn-danger" data-toggle="tooltip" data-placement="left" >Pendiente</button>
                                        <button v-if="props.row.Estado == 'EN PROCESO'" v-on:click="estado(props.row.IDExpedito,2)"  class="btn btn-warning" data-toggle="tooltip" data-placement="left" >En Proceso</button>
                                        <button v-if="props.row.Estado == 'FINALIZADO'" class="btn btn-success" data-toggle="tooltip" data-placement="left" >Finalizado</button>
                                        <button class="btn btn-info" data-toggle="tooltip" v-on:click="reg(props.row.IDExpedito)" data-placement="left" title="Registrar"><i class="fas fa-edit" style="color: white" aria-hidden="true"></i></button>
                                        <button class="btn btn-success" data-toggle="tooltip" v-on:click="edit(props.row.IDExpedito)" data-placement="left" title="Acta"><i class="far fa-file-pdf" style="color: white" aria-hidden="true"></i></button>
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
            
			expedito:{
                aux:null,
                alumno:null,
                recepcion:null,
                sesion:null,
                tipo:2
			},
            alumnos:[{label:null,code:null}],
            expeditos	:[{
				IDExpedito:null,
                Alumno:null,
                FechaRecepcion:null,
                FechaSesion:null,
                Estado:null
            }],
            columns: ["Alumno","FechaRecepcion","FechaSesion","Acciones"],
            options: {
				headings:
				{
                    Alumno:"Alumno",
                    FechaRecepcion:"Fecha Recepción",
                    FechaSesion:"Fecha Sesión",
				},
				sortable    : ["Alumno","FechaRecepcion","FechaSesion",],
				filterable  : ["Alumno","FechaRecepcion","FechaSesion",]
            },
        }
	},
	created(){
        this.getExpeditos();
        this.getAlumnos();
	},
	mounted(){
        $('#objetivo').hide();
        $('#editar').hide();
        $('#grado').hide();
        $("#alumnos").hide();
        $("#aux1").hide();
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
        validar()
        {
            $("#alumnos").hide();
            var combo1 = document.getElementById("seleccionado");
            this.expedito.aux = combo1.options[combo1.selectedIndex].text;
            $("#aux").hide();
            $("#aux1").show();
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
            if(this.expedito.alumno == null || this.expedito.recepcion == null || this.expedito.sesion == null)
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
