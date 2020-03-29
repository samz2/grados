<template>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<button data-target="#exampleModal" class="btn btn-outline-secondary" data-toggle="modal" data-placement="left" >Decano <i class="fa fa-plus"></i></button>
						</div>
					</div>
				</div>
	            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                        <div class="modal-header text-center bg-secondary">
                            <h5 class="modal-titler" id="exampleModalLabel">Datos Decano</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-4 text-left">
                                    <label>Decano(*)</label>
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
                                    <label>Fecha Inicio(*)</label>
                                </div>
                                <div class="col-md-8">
                                    <input v-model="decano.inicio" @change="validafecha()" type="date" class="form-control">
                                </div>    
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-4 text-left">
                                    <label>Fecha Fin(*)</label>
                                </div>
                                <div class="col-md-8">
                                    <input v-model="decano.fin" @change="validafecha()" type="date" class="form-control">
                                </div>    
                            </div>
                        <div class="modal-footer">
                            <button @click="addDecano(1)" id="add" class="btn btn-outline-success" data-dismiss="modal">Agregar <i class="fa fa-save"></i></button>
                            <button @click="addDecano(2)" id="editar" class="btn btn-outline-success" data-dismiss="modal">Editar <i class="fa fa-pencil"></i></button>
                            <button type="button" class="btn btn-outline-secondary" @click="load()" data-dismiss="modal">Cerrar <i class="fa fa-close"></i></button>
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
                                    <div slot="Acciones" slot-scope="props">
                                     <button data-target="#exampleModal" class="btn btn-info" data-toggle="modal" v-on:click="edit(props.row.IDDecano,props.row.CodDocente,props.row.PeriodoInicio,props.row.PeriodoFin )" data-placement="left" title="Editar"><i class="fas fa-edit" style="color: white" aria-hidden="true"></i></button>
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
            },
            decanos	:[{
                IDDecano:null,
                auxDecano:null,
                CodDocente:null,
                PeriodoInicio:null,
                PeriodoFin:null,
            }],
            columns: ["auxDecano","PeriodoInicio","PeriodoFin","Acciones"],
            options: {
				headings:
				{
                    auxDecano:"Decano",
                    PeriodoInicio:"Fecha de Inicio",
                    PeriodoFin:"Fecha de Fin",
				},
				sortable    : ["auxDecano","PeriodoInicio","PeriodoFin"],
				filterable  : ["auxDecano","PeriodoInicio","PeriodoFin"]
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
               this.decano.inicio == null || this.decano.fin == null)
            {
                swal({
					type: 'error',
					title: 'Llenar los datos obligatorios',
				});
            }else if(e == 1){
                this.$Progress.start();
                axios.post("addDecano",{
                    decano:this.decano
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
                axios.post("updateDecano",{
                    decano:this.decano
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
                this.decano.iddecano    = null;
                this.decano.decano      = null;
                this.decano.inicio      = null;
                this.decano.fin         = null;
		},
		edit(IDDecano,CodDocente,PeriodoInicio,PeriodoFin)
		{
            $('#editar').show();
            $('#add').hide();
            this.decano.iddecano    = IDDecano;
            this.decano.decano      = CodDocente;
            this.decano.inicio      = PeriodoInicio;
            this.decano.fin         = PeriodoFin;
               
		},
        
        validafecha()
        {
            if(this.decano.inicio == null || this.decano.fin == null)
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
            }
        },
    }
}
</script>
