<template>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<button data-target="#exampleModal" class="btn btn-success" data-toggle="modal" data-placement="left" >Agregar Decano <i class="fa fa-plus"></i></button>
						</div>
					</div>
				</div>
	            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                        <div class="modal-header text-center" style="background-color: #007bff55 !important; color:black; font-weight: bold;">
                            <h5 class="modal-titler" id="exampleModalLabel">Datos Decano</h5>
                            <!--<button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>-->
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-4 text-left">
                                    <label>Decano*</label>
                                </div>
                                <div class="col-md-8">
                                    <select v-model="decano.decano" class="form-control">
                                        <option v-for="d in docentes" :key="d.DNI" :value="d.DNI">
                                            {{d.Nombres}} {{d.Apellidos}}
                                        </option>
                                    </select>
                                </div>    
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-4 text-left">
                                    <label>Fecha Inicio*</label>
                                </div>
                                <div class="col-md-8">
                                    <input v-model="decano.inicio" @change="validafecha()" type="date" class="form-control">
                                </div>    
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-4 text-left">
                                    <label>Fecha Fin*</label>
                                </div>
                                <div class="col-md-8">
                                    <input v-model="decano.fin" @change="validafecha()" type="date" class="form-control">
                                </div>    
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-4 text-left">
                                    <label>Estado*</label>
                                </div>
                                <div class="col-md-8">
                                    <select v-model="decano.estado" class="form-control">
                                        <option value="ACTIVO">ACTIVO</option>
                                        <option value="INACTIVO">INACTIVO</option>
                                    </select>
                                </div>    
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-12 text-left">
                                    <label>* Campos obligatorios</label>
                                </div>                                
                            </div>
                        <div class="modal-footer">
                            <button @click="addDecano(1)" id="add" class="btn btn-success">Guardar <i class="fa fa-save"></i></button>
                            <button @click="addDecano(2)" id="editar" class="btn btn-success">Guardar <i class="fa fa-save"></i></button>
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
                                <h4 class="title">DECANOS</h4>  
                            </div>
                        <div class="card-body">
                            <div class="content table-responsive table-full-width">
                                <v-client-table :data="decanos" :columns="columns" :options="options">
                                    <div slot="Accion" slot-scope="props">
                                     <button data-target="#exampleModal" class="btn btn-info" data-toggle="modal" v-on:click="edit(props.row.IDDecano,props.row.CodDocente,props.row.PeriodoInicio,props.row.PeriodoFin,props.row.Estado)" data-placement="left" style="color: white" title="Editar">Editar <i class="fas fa-edit" style="color: white" aria-hidden="true"></i></button>
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
			decano:{
                iddecano:null,
                decano:null,
                inicio:null,
                fin:null,
                estado:null,
            },
            decanos	:[{
                IDDecano:null,
                auxDecano:null,
                CodDocente:null,
                FechaInicioAux:null,
                FechaFinAux:null,
                Estado:null,
            }],
            columns: ["auxDecano","FechaInicioAux","FechaFinAux","Estado","Accion"],
            options: {
                texts: {
                   count: "Mostrando {from} al {to} de {count} registros|{count} registros|Un registro",
                    first: 'Primero',
                    last: 'Ultimo',
                    //filter: "Buscar:                                    ",
                    filter: "",
                    filterPlaceholder: "Buscador general..",
                    limit: "Registros:",
                    page: "Pagina:",
                    noResults: "No hay registros",
                    filterBy: "Filtrar por {column}",
                    loading: 'Cargando...',
                    defaultOption: 'Seleccionar {column}',
                    columns: 'Columnas'
                    },
				headings:
				{
                    auxDecano:"Decano",
                    FechaInicioAux:"Fecha de Inicio",
                    FechaFinAux:"Fecha de Fin",
                    Estado:"Estado",
				},
				sortable    : ["auxDecano","FechaInicioAux","FechaFinAux","Estado"],
				filterable  : ["auxDecano","FechaInicioAux","FechaFinAux","Estado"]
            },
            docentes:[]
        }
	},
	created(){
        this.getDatos();
        this.getDocentes();
	},
	mounted(){
        $('#editar').hide();
	},
    methods: {
		getDatos()
        {
            this.$Progress.start();
            axios.get("getDecanos")
            .then(data=>
            {
                this.decanos = data.data.decanos;
                this.$Progress.finish();
            }
            ).catch(error=>{
                console.log(error);
            })
        },
        getDocentes()
        {
            axios.get("getPrincipales")
            .then(data=>
            {
                this.docentes = data.data.docentes;
                this.$Progress.finish();
            }
            ).catch(error=>{
                console.log(error);
            })
        },
        addDecano(e)
		{
            if(this.decano.decano == null||  
               this.decano.inicio == null || this.decano.fin == null || this.decano.estado == null)
            {
                swal({
                    type: 'warning',
                    title: 'Llenar los campos obligatorios',
                    //allowOutsideClick: false,
                    timer: 3000
                });
            }else if(e == 1){
                if(this.decano.inicio >= this.decano.fin){

                    swal({
                        type: 'warning',
                        title: 'Ha ocurrido un error',
                        text: 'La fecha de inicio no puede ser mayor a la fecha de fin'
                       
                    });
                    this.decano.inicio = null;
                    this.decano.fin = null;

                }else{
                this.$Progress.start();
                axios.post("addDecano",{
                    decano:this.decano
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
            }else if(e == 2){
                if(this.decano.inicio >= this.decano.fin){

                    swal({
                        type: 'warning',
                        title: 'Ha ocurrido un error',
                        text:'La fecha de inicio no puede ser mayor a la fecha de fin'
                       
                    });
                    this.decano.inicio = null;
                    this.decano.fin = null;

                }else{
                this.$Progress.start();
                axios.post("updateDecano",{
                    decano:this.decano
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
            }
		},
		load(){
                $('#add').show();
                $('#editar').hide();
                this.decano.iddecano    = null;
                this.decano.decano      = null;
                this.decano.inicio      = null;
                this.decano.fin         = null;
                this.decano.estado         = null;
        },        
		edit(IDDecano,CodDocente,PeriodoInicio,PeriodoFin,Estado)
		{
            $('#editar').show();
            $('#add').hide();
            this.decano.iddecano    = IDDecano;
            this.decano.decano      = CodDocente;
            this.decano.inicio      = PeriodoInicio;
            this.decano.fin         = PeriodoFin;
            this.decano.estado      = Estado;
               
		},
        
        validafecha()
        {
            /*if(this.decano.inicio == null || this.decano.fin == null)
            {
                return;
            }
            if(this.decano.inicio >= this.decano.fin)
            {
                swal({
                        type: 'error',
                        title: 'Error',
                        text: 'Fecha inicio debe ser menor a Fecha Fin',
                        showConfirmButton: true,
                    });
                this.decano.inicio = null;
                this.decano.fin = null;
            }*/
             if(this.decano.inicio !=null)
            {
                var inicio = this.decano.inicio;
                var final  = '2022-01-01';
                if(final<=inicio)
                {
                    swal({
                        type: 'warning',
                        title: 'Ingresar una fecha correcta',
                       
                    });
                    this.decano.inicio = null;
                }
            }
             if(this.decano.fin !=null)
            {
                var inicio = this.decano.fin;
                var final  = '2026-01-01';
                if(final<=inicio)
                {
                    swal({
                        type: 'warning',
                        title: 'Ingresar una fecha correcta',
                       
                    });
                    this.decano.fin = null;
                }
            }
        },
    }
}
</script>
