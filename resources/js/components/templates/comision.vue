<template>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<button data-target="#exampleModal" class="btn btn-success" data-toggle="modal" data-placement="left" >Agregar Comisión <i class="fa fa-plus"></i></button>
						</div>
					</div>
				</div>
	            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                        <div class="modal-header text-center" style="background-color: #007bff55 !important; color:black; font-weight: bold;">
                            <h5 class="modal-titler" id="exampleModalLabel">Datos Comisión</h5>
                            <!--<button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>-->
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-4 text-left">
                                    <label>Semestre*</label>
                                </div>
                                <div class="col-md-8">
                                    <input v-model="comision.semestre" style="text-transform:uppercase" type="text" maxlength="7" class="form-control" onKeyPress="return soloSemestre(event)">
                                </div>    
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-4 text-left">
                                    <label>Presidente*</label>
                                </div>
                                <div class="col-md-8">
                                    <select v-model="comision.presidente" @change="valida()" class="form-control">
                                        <option v-for="d in docentes" :key="d.DNI" :value="d.DNI">
                                            {{d.Nombres}} {{d.Apellidos}}
                                        </option>
                                    </select>
                                </div>    
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-4 text-left">
                                    <label>Miembro 1*</label>
                                </div>
                                <div class="col-md-8">
                                    <select v-model="comision.miembro1" @change="valida()" class="form-control">
                                        <option v-for="d in docentes" :key="d.DNI" :value="d.DNI">
                                            {{d.Nombres}} {{d.Apellidos}}
                                        </option>
                                    </select>
                                </div>    
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-4 text-left">
                                    <label>Miembro 2*</label>
                                </div>
                                <div class="col-md-8">
                                    <select v-model="comision.miembro2" @change="valida()" class="form-control">
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
                                    <input v-model="comision.inicio" @change="validafecha()" type="date" class="form-control">
                                </div>    
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-4 text-left">
                                    <label>Fecha Fin*</label>
                                </div>
                                <div class="col-md-8">
                                    <input v-model="comision.fin" @change="validafecha()" type="date" class="form-control">
                                </div>    
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-4 text-left">
                                    <label>Estado*</label>
                                </div>
                                <div class="col-md-8">
                                    <select v-model="comision.estado" class="form-control">
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
                            <button @click="addComision(1)" id="add" class="btn btn-success">Guardar <i class="fa fa-save"></i></button>
                            <button @click="addComision(2)" id="editar" class="btn btn-success">Guardar <i class="fa fa-save"></i></button>
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
                                <h4 class="title">COMISIONES</h4>  
                            </div>
                        <div class="card-body">
                            <div class="content table-responsive table-full-width t12">
                                <v-client-table :data="comisiones" :columns="columns" :options="options">
                                    <div slot="Accion" slot-scope="props">
                                     <button data-target="#exampleModal" class="btn btn-info" data-toggle="modal" v-on:click="edit(props.row.IDComision,props.row.Semestre,props.row.Presidente,props.row.Miembro1,props.row.Miembro2,props.row.FechaInicio,props.row.FechaFin,props.row.Estado)" data-placement="left" title="Editar"><i class="fas fa-edit" style="color: white" aria-hidden="true"></i></button>
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
			comision:{
                idcomision:null,
                semestre:null,
                presidente:null,
                miembro1:null,
                miembro2:null,
                inicio:null,
                fin:null,
                estado:null,
            },
            comisiones	:[{
                IDComision:null,
                Semestre:null,
                Presidente:null,
                Miembro1:null,
                Miembro2:null,
                auxMiembro1:null,
                auxMiembro2:null,
                auxPresidente:null,
                FechaInicioAux:null,
                FechaFinAux:null,
                Estado:null,
            }],
            columns: ["Semestre","auxPresidente","auxMiembro1","auxMiembro2","FechaInicioAux","FechaFinAux","Estado","Accion"],
            options: {
				headings:
				{
                    Semestre:"Semestre",
                    auxPresidente:"Presidente",
                    auxMiembro1:"Miembro 1",
                    auxMiembro2:"Miembro 2",
                    FechaInicioAux:"Inicio",
                    FechaFinAux:"Fin",
				},
				sortable    : ["Semestre","Presidente","Miembro1","Miembro2","FechaInicioAux","FechaFinAux","Estado"],
				filterable  : ["Semestre","Presidente","Miembro1","Miembro2","FechaInicioAux","FechaFinAux","Estado"]
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
            axios.get("getComisiones")
            .then(data=>
            {
                this.comisiones = data.data.comisiones;
                this.$Progress.finish();
            }
            ).catch(error=>{
                console.log(error);
            })
        },
        getDocentes()
        {
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
        addComision(e)
		{
            if( this.comision.semestre == null || this.comision.presidente == null || this.comision.miembro1 == null ||
                this.comision.miembro2 == null || this.comision.inicio == null || this.comision.fin == null || this.comision.estado == null)
            {
                swal({
                    type: 'warning',
                    title: 'Llenar los campos obligatorios',
                    //allowOutsideClick: false,
                    timer: 3000
                });
            }else if(e == 1){
                if(this.comision.inicio >= this.comision.fin){

                    swal({
                        type: 'warning',
                        title: 'Ha ocurrido un error',
                        text: 'La fecha de inicio no puede ser mayor a la fecha de fin'
                       
                    });
                    this.comision.inicio = null;
                    this.comision.fin = null;

                }else{
                this.$Progress.start();
                axios.post("addComision",{
                    comision:this.comision
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
                if(this.comision.inicio >= this.comision.fin){

                    swal({
                        type: 'warning',
                        title: 'Ha ocurrido un error',
                        text:'La fecha de inicio no puede ser mayor a la fecha de fin'
                       
                    });
                    this.comision.inicio = null;
                    this.comision.fin = null;

                }else{
                this.$Progress.start();
                axios.post("updateComision",{
                    comision:this.comision
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
                this.comision.idcomision    = null;
                this.comision.semestre      = null;
                this.comision.presidente    = null;
                this.comision.miembro1      = null;
                this.comision.miembro2      = null;
                this.comision.inicio        = null;
                this.comision.fin           = null;
                this.comision.estado        = null;
        },
		edit(IDComision,Semestre,Presidente,Miembro1,Miembro2,FechaInicio,FechaFin,Estado)
		{
            $('#editar').show();
            $('#add').hide();
            this.comision.idcomision    = IDComision;
            this.comision.semestre      = Semestre;
            this.comision.presidente    = Presidente;
            this.comision.miembro1      = Miembro1;
            this.comision.miembro2      = Miembro2;
            this.comision.inicio        = FechaInicio;
            this.comision.fin           = FechaFin;
            this.comision.estado        = Estado;
                
		},
        valida()
        {
            if(this.comision.presidente == null || this.comision.miembro1 == null || this.comision.miembro2 == null)
            {
                return;
            }
            if(this.comision.presidente == this.comision.miembro1)
            {
                swal({
                        type: 'warning',
                        title: 'Ha ocurrido un error',
                        text: 'Presidente debe ser diferente al Miembro 1',
                        showConfirmButton: true,
                    });
                this.comision.presidente = null;
                this.comision.miembro1 = null;
            }
            if(this.comision.miembro1 == this.comision.miembro2)
            {
                swal({
                        type: 'warning',
                        title: 'Ha ocurrido un error',
                        text: 'Miembro 1 debe ser diferente al Miembro 2',
                        showConfirmButton: true,
                    });
                this.comision.miembro1 = null;
                this.comision.miembro2 = null;
            }
            if(this.comision.presidente == this.comision.miembro2)
            {
                swal({
                        type: 'warning',
                        title: 'Ha ocurrido un error',
                        text: 'Presidente debe ser diferente al Miembro 2',
                        showConfirmButton: true,
                    });
                this.comision.presidente = null;
                this.comision.miembro2 = null;
            }
        },
        validafecha()
        {
            /*if(this.comision.inicio == null || this.comision.fin == null)
            {
                return;
            }
            if(this.comision.inicio >= this.comision.fin)
            {
                swal({
                        type: 'error',
                        //title: 'Error',
                        text: 'Fecha inicio debe ser menor a Fecha Fin',
                        showConfirmButton: true,
                    });
                this.comision.inicio = null;
                this.comision.fin = null;
            }*/
            if(this.comision.inicio !=null)
            {
                var inicio = this.comision.inicio;
                var final  = '2022-01-01';
                if(final<=inicio)
                {
                    swal({
                        type: 'warning',
                        title: 'Ingresar una fecha correcta',
                       
                    });
                    this.comision.inicio = null;
                }
            }
             if(this.comision.fin !=null)
            {
                var inicio = this.comision.fin;
                var final  = '2026-01-01';
                if(final<=inicio)
                {
                    swal({
                        type: 'warning',
                        title: 'Ingresar una fecha correcta',
                       
                    });
                    this.comision.fin = null;
                }
            }
            
        },
    }
}
</script>
