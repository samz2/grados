
<template>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<button  class="btn btn-outline-primary" id="mas" @click="ocultar('1')">
							Agregar <i class="fa fa-plus"></i>
							</button>
							<button  class="btn btn-outline-primary" id="menos" @click="ocultar('2')">
								<i class="fa fa-minus"></i>
							</button>
						</div>
					</div>
				</div>
	            <div class="card card-default"  id="objetivo">
	                <div class="card-header text-center bg-secondary">
	                    <h4 class="title">Expedito</h4>  
	                </div>
					<div class="card-body">
                        <fieldset class="border p-2">
                            <legend class="w-auto">Datos Egresado 
                                <button  data-target="#exampleModal" class="btn btn-outline-secondary" data-toggle="modal" data-placement="left">
								<i class="fa fa-plus"></i>
							    </button>
                            </legend>
                            <div class="form-group row">
                                <label for="dni" class="col-md-2 col-form-label">DNI: </label>
                                <div class="col-md-2">
                                    <input type="text" id="dni" readonly class="form-control form-control-sm">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="codigo" class="col-md-2 col-form-label">Código: </label>
                                <div class="col-md-2">
                                    <input type="text" id="codigo" readonly class="form-control form-control-sm">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="nombre" class="col-md-2 col-form-label">Nombre: </label>
                                <div class="col-md-4">
                                    <input type="text" id="nombre" readonly class="form-control form-control-sm">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="carrera" class="col-md-2 col-form-label">Carrera: </label>
                                <div class="col-md-3">
                                    <input type="text" id="carrera" readonly class="form-control form-control-sm">
                                </div>
                            </div>
                        </fieldset>
                        <fieldset class="border p-2">
                            <legend class="w-auto">Datos del Libro de Actas</legend>
                            <div class="form-group row">
                                <label for="tomo" class="col-md-1 col-form-label">Tomo: </label>
                                <div class="col-md-2">
                                    <input type="text" id="tomo" onKeyPress="return soloNumeros(event)" maxlength="3" class="form-control form-control-sm">
                                </div>
                                <label for="folio" class="col-md-1 col-form-label">Fólio: </label>
                                <div class="col-md-2">
                                    <input type="text" id="folio" onKeyPress="return soloNumeros(event)" maxlength="3" class="form-control form-control-sm">
                                </div>
                                <label for="asiento" class="col-md-2 col-form-label">Asiento: </label>
                                <div class="col-md-2">
                                    <input type="text" id="asiento" onKeyPress="return soloNumeros(event)" maxlength="3" class="form-control form-control-sm">
                                </div>
                            </div>
                        </fieldset>
                        <fieldset class="border p-2">
                            <legend class="w-auto">Sesión</legend>
                            <div class="form-group row">
                                <label for="sesion" class="col-md-2 col-form-label"># Sesión: </label>
                                <div class="col-md-1">
                                    <input type="text" id="sesion" onKeyPress="return soloNumeros(event)" maxlength="3" class="form-control form-control-sm">
                                </div>
                                <label for="fecha" class="col-md-1 col-form-label">Fecha: </label>
                                <div class="col-md-3">
                                    <input type="date" id="fecha" class="form-control form-control-sm">
                                </div>
                                <label for="Tipo" class="col-md-1 col-form-label">Tipo: </label>
                                <div class="col-md-3">
                                    <input type="text" id="sesion" readonly maxlength="3" class="form-control form-control-sm">
                                </div>
                            </div>
                        </fieldset>
                        <fieldset class="border p-2">
                            <legend class="w-auto">Datos del trámite</legend>
                            <div class="form-group row">
                                <label for="ingreso" class="col-md-4 col-form-label">Fecha de Ingreso de la solicitud: </label>
                                <div class="col-md-3">
                                    <input type="date" id="ingreso" onKeyPress="return soloNumeros(event)" maxlength="3" class="form-control form-control-sm">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="comienzo" class="col-md-4 col-form-label">Fecha que empienza el trámite </label>
                                <div class="col-md-3">
                                    <input type="date" id="comienzo" onKeyPress="return soloNumeros(event)" maxlength="3" class="form-control form-control-sm">
                                </div>
                            </div>
                        </fieldset>
                        <br>
                        <div class="row">
                            <div class="col-md-2">
                                <button class="btn btn-success" @click="addExpedito()">Guardar <i class="fa fa-save"></i></button>
                            </div>
                            <div class="col-md-2">
                                <button class="btn btn-danger" @click="cancelar()">Cancelar <i class="fa fa-stop"></i></button>
                            </div>
                        </div>
	                </div>
				</div>
			</div>
	    	</div>
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                        <div class="modal-header text-center bg-secondary">
                            <h5 class="modal-titler" id="exampleModalLabel">Buscar Egresado</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group row">
                                <label for="dni" class="col-md-2 col-form-label">DNI: </label>
                                <div class="col-md-4">
                                    <input type="text" id="dni" class="form-control form-control-sm">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="codigo" class="col-md-2 col-form-label">Código: </label>
                                <div class="col-md-4">
                                    <input type="text" id="codigo" class="form-control form-control-sm">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="nombre" class="col-md-2 col-form-label">Apellido: </label>
                                <div class="col-md-8">
                                    <input type="text" id="nombre" class="form-control form-control-sm">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <button class="btn btn-success" @click="buscar()">Buscar <i class="fa fa-search"></i></button>
                                </div>
                                <div class="col-md-2">
                                    <button class="btn btn-danger" @click="reiniciar()">Borrar <i class="fa fa-eraser"></i></button>
                                </div>
                            </div>
                            <fieldset class="border p-2">
                                <legend class="w-auto">Lista de egresados</legend>
                                <table colspadding=0 cellspacing=0 border="1">
                                    <thead>
                                        <tr>
                                            <th>DNI</th>
                                            <th>CÓDIGO</th>
                                            <th>NOMBRES</th>
                                            <th>SELECCIONAR</th>
                                        </tr>
                                    </thead>   
                                    <tbody>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td><input data-dismiss="modal" type="checkbox" @click="seleccionar()" class="form-control form-control-sm"></td>
                                        </tr>
                                    </tbody>        
                                </table>
                            </fieldset>
                        <!-- <div class="modal-footer">
                            <button @click="addDecano(1)" id="add" class="btn btn-outline-success" data-dismiss="modal">Agregar <i class="fa fa-save"></i></button>
                            <button @click="addDecano(2)" id="editar" class="btn btn-outline-success" data-dismiss="modal">Editar <i class="fa fa-pencil"></i></button>
                            <button type="button" class="btn btn-outline-secondary" @click="load()" data-dismiss="modal">Cerrar <i class="fa fa-close"></i></button>
                        </div> -->
                        </div>
                    </div>
                </div>
            </div>    
                <!-- final modal -->
            <div class="row" id="expeditos">
                <div class="col-md-12">
                    <div class="card card-default">
                            <div class="card-header text-center bg-secondary">
                                <h4 class="title">EXPEDITOS</h4>  
                            </div>
                        <div class="card-body">
                            <div class="content table-responsive table-full-width">
                                <v-client-table :data="expeditos" :columns="columns" :options="options">
                                    <div slot="Acciones" slot-scope="props">
                                        <button v-if="props.row.Estado == 'PENDIENTE'" v-on:click="estado(props.row.IDExpedito,1)" class="btn btn-danger" data-toggle="tooltip" data-placement="left" >Pendiente</button>
                                        <button v-if="props.row.Estado == 'EN PROCESO'" v-on:click="estado(props.row.IDExpedito,2)"  class="btn btn-warning" data-toggle="tooltip" data-placement="left" >En Proceso</button>
                                        <button v-if="props.row.Estado == 'FINALIZADO'"  class="btn btn-success" data-toggle="tooltip" data-placement="left" >Finalizado</button>
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
            alumnoz:null,
			expedito:{
                aux:null,
                alumno:null,
                recepcion:null,
                sesion:null,
                tipo:1
			},
            alumnos:[],
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
        // this.getAlumnos();
	},
	mounted(){
        $('#objetivo').hide();
        $('#menos').hide();
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
                this.expeditos = data.data.expeditosb;
                this.$Progress.finish();
                console.log(data.data);
            }
            ).catch(error=>{
                console.log(error);
            })
		},
		addExpedito()
		{
            console.log(this.expedito);
            this.expedito.alumno = this.alumnoz.code;
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
