<template>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<button  class="btn btn-outline-primary" @click="ocultar('1')">
							Docente <i class="fa fa-plus"></i>
							</button>
							<button  class="btn btn-outline-primary" @click="ocultar('2')">
								<i class="fa fa-minus"></i>
							</button>
						</div>
					</div>
				</div>
	            <div class="card card-default"  id="objetivo">
	                <div class="card-header text-center" style="background-color: #2FA3C6; color: white;">
	                    <h4 class="title">DOCENTE</h4>  
	                </div>
					<div class="card-body">
                        <div class="row">
                            <!-- <div class="col-md-2">
                                <div class="form-group">
                                    <label>Código (*)</label>
                                    <input v-model="egresado.codigo" maxlength="10" onKeyPress="return soloNumeros(event)" class="form-control">
                                </div>
                            </div> -->
                            <div class="col-md-2" id="dni">
                                <div class="form-group">
                                    <label>DNI (*)</label>
                                    <input v-model="docente.dni" maxlength="8" onKeyPress="return soloNumeros(event)" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-2" id="aux">
                                <div class="form-group">
                                    <label>DNI (*)</label>
                                    <input v-model="docente.dni" maxlength="8" readonly class="form-control">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Nombre(*)</label>
                                    <input v-model="docente.nombres" maxlength="50" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Apellidos (*)</label>
                                    <input v-model="docente.apellidos" maxlength="50" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Celular(*)</label>
                                    <input v-model="docente.celular" maxlength="9" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Escuela(*)</label>
                                    <select v-model="docente.escuela" class="form-control">
                                        <option v-for="e in escuelas" :key="e.IDEscuela" :value="e.IDEscuela">{{e.Escuela}}</option>
                                    </select>
                                </div>
                            </div>
                            
                        <div class="row text-left">
                            <div class="col-md-3"  id="add">
                                <button @click="addDocente()" class="btn btn-outline-success">Agregar <i class="fa fa-save"></i></button>
                            </div>
                            <div class="col-md-3" id="editar">
                                <button @click="editDocente()"  class="btn btn-outline-success">Editar <i class="fa fa-edit"></i></button>
                            </div>
                        </div>
                        <div class="clearfix"></div>
	                </div>
				</div>
			</div>
        </div>
        </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-default">
                            <div class="card-header text-center" style="background-color: #2FA3C6; color: white;">
                                <h4 class="title">DOCENTES</h4>  
                            </div>
                        <div class="card-body">
                            <div class="content table-responsive table-full-width">
                                <v-client-table :data="docentes" :columns="columns" :options="options">
                                    <div slot="Acciones" slot-scope="props">
                                    <button class="btn btn-info" data-toggle="tooltip" v-on:click="edit(props.row.DNI,props.row.Nombres,props.row.Apellidos,props.row.Celular)" data-placement="left" title="Editar"><i class="fas fa-edit" style="color: white" aria-hidden="true"></i></button>
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
			docente:{
                dni:null,
                nombres:null,
                apellidos:null,
                celular:null,
                escuela:null,
			},
            escuelas:[],
            docentes	:[{
                DNI:null,
                Nombres:null,
                Apellidos:null,
                Celular:null,
                Escuela:null,
                IDEscuela:null,
            }],
            columns: ["DNI","Nombres","Apellidos","Celular","Escuela","Acciones"],
            options: {
				headings:
				{
                    DNI:"DNI",
                    Apellidos:"Apellidos",
                    Celular:"Celular",
                    Escuela:"Escuela",
                    Nombres:"Nombres",
				},
				sortable    : ["DNI","Nombres","Apellidos","Celular","Escuela"],
				filterable  : ["DNI","Nombres","Apellidos","Celular","Escuela"]
            },
        }
	},
	created(){
        this.Fecha();
        this.getDatos();
        this.getEscuelas();
	},
	mounted(){
        $('#objetivo').hide();
        $('#editar').hide();
        $('#grado').hide();
        $('#aux').hide();
	},
    methods: {
        Fecha()
        {
            axios.get("getAnios")
            .then(data=>
            {
                this.anios = data.data.anios;
                this.$Progress.finish();
            }
            ).catch(error=>{
                console.log(error);
            })
              
        },
		getDatos()
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
        getEscuelas()
        {
            axios.get("getEscuelas")
            .then(data=>
            {
                this.escuelas = data.data.escuelas;
            }).catch(error=>
            {
                console.log("error: "+error);
            });
        },
        
		addDocente()
		{
            if(this.docente.nombres == null || this.docente.apellidos == null || this.docente.celular == null 
            || this.docente.escuela == null)
            {
                swal({
					type: 'error',
					title: 'Llenar los datos obligatorios',
				});
            }else{
                this.$Progress.start();
                axios.post("addDocente",{
                    docente:this.docente
                }).then(data=>{
                    swal({
                        type: data.data.type,
                        title: data.data.title,
                        text: data.data.text,
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
                this.docente.dni = null;
                this.docente.nombres = null;
                this.docente.apellidos = null;
                this.docente.celular = null;
                this.docente.escuela = null;
			}
			else if(id == '2')
			{
				$('#objetivo').hide();	
			}
			
		},
		edit(dni,nombres,apellidos,celular)
		{
			$('#objetivo').show();
            $('#editar').show();
            $('#add').hide();
            $('#dni').hide();
            $('#aux').show();
            this.docente.dni        = dni;
            this.docente.nombres    = nombres;
            this.docente.apellidos  = apellidos;
            this.docente.celular    = celular;
		},
		editDocente()
		{
			axios.post("updateDocente",{
				docente:this.docente
			}).then(data=>{
				console.log(data);
				swal({
					type: 'success',
					title: 'Docente editado correctamente',
					showConfirmButton: false,
					timer: 2000
                });
                 setTimeout(() => {
                        location.reload();
                    }, 1500);
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
