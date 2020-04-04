<template>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<button data-target="#exampleModal" class="btn btn-success" data-toggle="modal" data-placement="left" >Agregar Docente <i class="fa fa-plus"></i></button>
						</div>
					</div>
				</div>
	            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                        <div class="modal-header text-center" style="background-color: #007bff55 !important; color:black; font-weight: bold;">
                            <h5 class="modal-titler" id="exampleModalLabel">Datos Docente</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12 text-center"><b>Datos Personales</b></div>
                                
                            </div>
                            <hr>                                                        
                            <div class="row">
                                <div class="col-md-2 text-left">
                                    <label>Nombres*</label>
                                </div>
                                <div class="col-md-10">
                                    <input v-model="docente.nombres" maxlength="40" class="form-control" onKeyPress="return sololetras(event)">
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-2 text-left">
                                    <label>Apellidos*</label>
                                </div>
                                <div class="col-md-10">
                                    <input v-model="docente.apellidos" maxlength="40" onKeyPress="return sololetras(event)" class="form-control">
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-2 text-left">
                                        <label>DNI*</label>
                                </div>
                                <div class="col-md-4">
                                    <input v-model="docente.dni" maxlength="8" onKeyPress="return soloNumeros(event)" class="form-control">
                                </div>  
                                <div class="col-md-2 text-left">
                                    <label>Celular*</label>
                                </div>
                                <div class="col-md-4">
                                    <input v-model="docente.celular" maxlength="9" onKeyPress="return soloNumeros(event)" class="form-control">
                                </div>  
                            </div>
                            <br>
                            
                            <div class="row">
                                <div class="col-md-12 text-center"><b>Datos Académicos</b></div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-2 text-left">
                                        <label>Código*</label>
                                </div>
                                <div class="col-md-4">
                                    <input v-model="docente.codigo" maxlength="10" class="form-control" onKeyPress="return alfa(event)">
                                </div>
                                <div class="col-md-2 text-left">
                                    <label>Categoria*</label>
                                </div>
                                <div class="col-md-4">
                                    <select class="form-control" v-model="docente.categoria">
                                        <option value="PRINCIPAL">PRINCIPAL</option>
                                        <option value="ASOCIADO">ASOCIADO</option>
                                        <option value="AUXILIAR">AUXILIAR</option>
                                    </select>
                                </div>
                            </div>
                            
                            <br>
                            <div class="row">
                                <div class="col-md-2 text-left">
                                    <label>Dedicación*</label>
                                </div>
                                <div class="col-md-10">
                                    <select class="form-control" v-model="docente.dedicacion">
                                        <option value="TC">TIEMPO COMPLETO</option>
                                        <option value="DE">DEDICACIÓN EXCLUSIVA</option>
                                        <option value="TP">TIEMPO PARCIAL</option>
                                    </select>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-2 text-left">
                                    <label>Escuela*</label>
                                </div>
                                <div class="col-md-10">
                                    <select v-model="docente.escuela" class="form-control">
                                        <option v-for="e in escuelas" :key="e.IDEscuela" :value="e.IDEscuela">{{e.Escuela}}</option>
                                    </select>
                                </div>
                            </div>      
                        <div class="modal-footer">
                            <button @click="addDocente(1)" id="add" class="btn btn-success" data-dismiss="modal">Guardar <i class="fa fa-save"></i></button>
                            <button @click="addDocente(2)" id="editar" class="btn btn-success" data-dismiss="modal">Editar <i class="far fa-edit"></i></button>
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
                            <div class="card-header text-center" style="background-color: #007bff55 !important; color:black; font-weight: bold;">
                                <h4 class="title">DOCENTES</h4>  
                            </div>
                        <div class="card-body">
                            <div class="content table-responsive table-full-width">
                                <v-client-table :data="docentes" :columns="columns" :options="options">
                                    <div slot="Acciones" slot-scope="props">
                                     <button data-target="#exampleModal" class="btn btn-info" data-toggle="modal" v-on:click="edit(props.row.DNI,props.row.Codigo,props.row.Nombres,props.row.Apellidos,props.row.Celular,props.row.Dedicacion,props.row.Categoria,props.row.IDEscuela)" data-placement="left" title="Editar"><i class="fas fa-edit" style="color: white" aria-hidden="true"></i></button>
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
			docente:{
                dni:null,
                nombres:null,
                apellidos:null,
                celular:null,
                escuela:null,
                codigo:null,
                dedicacion:null,
                categoria:null,
			},
            escuelas:[],
            docentes	:[{
                DNI:null,
                Nombres:null,
                Apellidos:null,
                Celular:null,
                Escuela:null,
                IDEscuela:null,
                Codigo:null,
                Dedicacion:null,
                Categoria:null,
            }],
            columns: ["DNI","Codigo","Nombres","Apellidos","Celular","Categoria","Dedicacion","Escuela","Acciones"],
            options: {
				headings:
				{
                    DNI:"DNI",
                    Apellidos:"Apellidos",
                    Celular:"Celular",
                    Escuela:"Escuela",
                    Nombres:"Nombres",
                    Codigo:"Codigo",
                    Dedicacion:"Dedicacion",
                    Categoria:"Categoria",
				},
				sortable    : ["DNI","Codigo","Nombres","Apellidos","Celular","Categoria","Dedicacion","Escuela"],
				filterable  : ["DNI","Codigo","Nombres","Apellidos","Celular","Categoria","Dedicacion","Escuela"]
            },
        }
	},
	created(){
        this.getDatos();
        this.getEscuelas();
	},
	mounted(){
        $('#editar').hide();
	},
    methods: {
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
        
		addDocente(e)
		{
            if(this.docente.nombres == null || this.docente.apellidos == null || this.docente.celular == null 
            || this.docente.escuela == null || this.docente.codigo == null || this.docente.dedicacion == null
            || this.docente.categoria == null || this.docente.dni == null)
            {
                swal({
					type: 'error',
					title: 'Llenar los datos obligatorios',
				});
            }else if(e == 1){
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
                axios.post("updateDocente",{
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
                this.docente.dni = null;
                this.docente.nombres = null;
                this.docente.apellidos = null;
                this.docente.celular = null;
                this.docente.escuela = null;
                this.docente.codigo = null;
                this.docente.dedicacion = null;
                this.docente.categoria = null;
		},
		edit(DNI,Codigo,Nombres,Apellidos,Celular,Dedicacion,Categoria,IDEscuela)
		{
			$('#objetivo').show();
            $('#editar').show();
            $('#add').hide();
            $('#dni').hide();
            $('#aux').show();
            this.docente.dni        = DNI;
            this.docente.nombres    = Nombres;
            this.docente.apellidos  = Apellidos;
            this.docente.celular    = Celular;
            this.docente.escuela    = IDEscuela;
            this.docente.codigo     = Codigo;
            this.docente.dedicacion = Dedicacion;
            this.docente.categoria  = Categoria;
		},
		
    }
}
</script>
