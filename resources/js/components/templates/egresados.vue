<template>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
                            <button data-target="#exampleModal" class="btn btn-outline-secondary" data-toggle="modal" data-placement="left" >Egresado <i class="fa fa-plus"></i></button>
						</div>
					</div>
				</div>
                <!-- ventana modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                        <div class="modal-header text-center bg-secondary">
                            <h5 class="modal-titler" id="exampleModalLabel">Datos Egresado</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">Datos Personales</div>
                                
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-4 text-left">
                                        <label>DNI(*)</label>
                                </div>
                                <div class="col-md-3">
                                    <input v-model="egresado.dni" maxlength="8" onKeyPress="return soloNumeros(event)" class="form-control">
                                </div>    
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-4 text-left">
                                        <label>Código (*)</label>
                                        
                                </div>
                                <div class="col-md-4">
                                    <input v-model="egresado.codigo" maxlength="10" onKeyPress="return soloNumeros(event)" class="form-control">
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-4 text-left">
                                    <label>Nombre(*)</label>
                                </div>
                                <div class="col-md-5">
                                    <input v-model="egresado.nombre" maxlength="50" class="form-control" onKeyPress="return sololetras(event)">
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-4 text-left">
                                    <label>Apellido Paterno(*)</label>
                                </div>
                                <div class="col-md-6">
                                    <input v-model="egresado.paterno" maxlength="50" onKeyPress="return sololetras(event)" class="form-control">
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-4 text-left">
                                    <label>Apellido Materno(*)</label>
                                </div>
                                <div class="col-md-6">
                                    <input v-model="egresado.materno" maxlength="50" onKeyPress="return sololetras(event)" class="form-control">
                                </div>
                            </div>   
                            <br> 
                            <div class="row">
                                <div class="col-md-4 text-left">
                                    <label>Celular(*)</label>
                                </div>
                                <div class="col-md-4">
                                    <input v-model="egresado.celular" maxlength="9" onKeyPress="return soloNumeros(event)" class="form-control">
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-4 text-left">
                                    <label>Correo</label>
                                </div>
                                <div class="col-md-5">
                                    <input v-model="egresado.correo" type="email" maxlength="30" class="form-control">
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-4 text-left">
                                    <label>Género(*)</label>
                                </div>
                                <div class="col-md-5">
                                    <select class="form-control" v-model="egresado.genero">
                                        <option value="M">Masculino</option>
                                        <option value="F">Femenino</option>
                                    </select>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-12">Datos Académicos</div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-4 text-left">
                                    <label>Año Ingreso(*)</label>
                                </div>
                                <div class="col-md-3">
                                    <select class="form-control" v-model="egresado.ingreso" @change="validaFecha()">
                                        <option v-for="a in anios" :key="a" :value="a">{{a}}</option>
                                    </select>
                                </div>
                            </div>
                            <br> 
                            <div class="row">
                                <div class="col-md-4 text-left">
                                    <label>Año Egreso(*)</label>
                                </div>
                                <div class="col-md-3">
                                    <select class="form-control" v-model="egresado.egreso" @change="validaFecha()">
                                        <option v-for="a in anios" :key="a" :value="a">{{a}}</option>
                                    </select>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-4 text-left">
                                    <label>Escuela(*)</label>
                                </div>
                                <div class="col-md-7">
                                    <select v-model="egresado.escuela" class="form-control">
                                        <option v-for="e in escuelas" :key="e.IDEscuela" :value="e.IDEscuela">{{e.Escuela}}</option>
                                    </select>
                                </div>
                            </div>      
                        <div class="modal-footer">
                            <button @click="addEgresado(1)" id="add" class="btn btn-outline-success" data-dismiss="modal">Agregar <i class="fa fa-save"></i></button>
                            <button @click="addEgresado(2)" id="editar" class="btn btn-outline-success" data-dismiss="modal">Editar <i class="fa fa-pencil"></i></button>
                            <button type="button" class="btn btn-outline-secondary" @click="load()" data-dismiss="modal">Cerrar <i class="fa fa-close"></i></button>
                        </div>
                        </div>
                    </div>
                </div>
                <!-- final modal -->
			    </div>
	    	</div>
        </div>    
        <div class="row">
            <div class="col-md-12">
                <div class="card card-default">
                        <div class="card-header text-center bg-secondary">
                            <h4 class="title">EGRESADOS</h4>  
                        </div>
                    <div class="card-body" style="font-size: 11px">
                        <div class="content table-responsive table-full-width">
                            <v-client-table :data="egresados" :columns="columns" :options="options">
                                <div slot="Acciones" slot-scope="props">
                                <button class="btn btn-danger" data-toggle="tooltip" v-on:click="deleteEgresado(props.row.IDEgresado)" data-placement="left" title="Eliminar"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                <button data-target="#exampleModal" class="btn btn-info" data-toggle="modal" v-on:click="edit(props.row.IDEgresado,props.row.Codigo,props.row.DNI,props.row.Paterno,props.row.Materno,props.row.Celular,props.row.Ingreso,props.row.Egreso,props.row.Nombre,props.row.Genero,props.row.Correo,props.row.IDEscuela)" data-placement="left" title="Editar"><i class="fas fa-edit" style="color: white" aria-hidden="true"></i></button>
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
			egresado:{
                IDEgresado:null,
                codigo:null,
                dni:null,
                nombre:null,
                paterno:null,
                materno:null,
                celular:null,
                genero:null,
                ingreso:null,
                egreso:null,
                escuela:null,
                correo:null
			},
            anios:[],
            egresados	:[{
				IDEgresado:null,
				IDEscuela:null,
                Codigo:null,
                DNI:null,
                Paterno:null,
                Materno:null,
                Celular:null,
                Ingreso:null,
                Egreso:null,
                Genero:null,
                Nombre:null,
                Correo:null,
                Escuela:null,
            }],
            columns: ["Escuela","Codigo","DNI","Nombre","Paterno","Celular","Correo","Genero","Ingreso","Egreso","Acciones"],
            options: {
				headings:
				{
                    Codigo:"Código",
                    DNI:"DNI",
                    Paterno:"Apellidos",
                    Celular:"Celular",
                    Ingreso:"Ingreso",
                    Egreso:"Egreso",
                    Nombre:"Nombre",
                    Correo:"Correo",
                    Escuela:"Escuela",
				},
				sortable    : ["Escuela","Codigo","DNI","Nombre","Paterno","Celular","Correo","Ingreso","Egreso"],
				filterable  : ["Escuela","Codigo","DNI","Nombre","Paterno","Celular","Correo","Ingreso","Egreso"]
            },
            escuelas:[],
        }
	},
	created(){
        this.Fecha();
        this.getDatos();
        this.getEscuelas();
	},
	mounted(){
        $('#editar').hide();
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
        validaFecha()
        {
            if(this.egresado.ingreso != null && this.egresado.egreso != null)
            {
                var inicio = parseInt(this.egresado.ingreso);
                var final  = parseInt(this.egresado.egreso);
                if(final<=inicio)
                {
                    swal({
                        // position: 'top-en]d',
                        type: 'error',
                        title: 'Año de Egreso debe ser mayor a año de Ingreso',
                       
                    });
                }
            }
        },
		getDatos()
        {
            this.$Progress.start();
            axios.get("getEgresados")
            .then(data=>
            {
                this.egresados = data.data.egresados;
                this.$Progress.finish();
                console.log(data.data);
            }
            ).catch(error=>{
                console.log(error);
            })
		},
        
        addEgresado(e)
		{
            if(e == 1)
            {
                if(this.egresado.nombre == null || this.egresado.paterno == null || this.egresado.materno == null 
                || this.egresado.genero == null || this.egresado.ingreso == null || this.egresado.egreso == null)
                {
                    swal({
                        type: 'error',
                        title: 'Llenar los datos obligatorios',
                    });
                }else{
                    this.$Progress.start();
                    axios.post("addEgresado",{
                        egresado:this.egresado
                    }).then(data=>{
                        swal({
                            // position: 'top-end',
                            type: data.data.val,
                            title: data.data.title,
                            text: data.data.msj,
                            showConfirmButton: false,
                            timer: 2000
                        });
                        this.$Progress.finish();
                        this.getDatos();
                        this.load();
                        // setTimeout(() => {
                        //     location.reload();
                        // }, 1500);
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
            }
            else if(e == 2)
            {
                if(this.egresado.nombre == null || this.egresado.paterno == null || this.egresado.materno == null 
                || this.egresado.genero == null || this.egresado.ingreso == null || this.egresado.egreso == null)
                {
                    swal({
                        type: 'error',
                        title: 'Llenar los datos obligatorios',
                    });
                }else{
                    this.$Progress.start();
                    axios.post("updateEgresado",{
                        egresado:this.egresado
                    }).then(data=>{
                        swal({
                            // position: 'top-end',
                            type: data.data.val,
                            title: data.data.title,
                            text: data.data.msj,
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
		edit(id,cod,dni,p,m,c,i,e,n,g,co,es)
		{
            $('#editar').show();
            $('#add').hide();
            this.egresado.IDEgresado    = id;
            this.egresado.codigo        = cod;
            this.egresado.dni           = dni;
            this.egresado.nombre        = n;
            this.egresado.paterno       = p;
            this.egresado.materno       = m;
            this.egresado.celular       = c;
            this.egresado.genero        = g;
            this.egresado.ingreso       = i;
            this.egresado.egreso        = e;
            this.egresado.correo        = co;
            this.egresado.escuela       = es;
		},
		load()
		{
            $('#editar').hide();
            $('#add').show();
            this.egresado.IDEgresado    = null;
            this.egresado.codigo        = null;
            this.egresado.dni           = null;
            this.egresado.nombre        = null;
            this.egresado.paterno       = null;
            this.egresado.materno       = null;
            this.egresado.celular       = null;
            this.egresado.fecha         = null;
            this.egresado.ingreso       = null;
            this.egresado.egreso        = null;
            this.egresado.escuela       = null;
            this.egresado.correo        = null;
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
    }
}
</script>
