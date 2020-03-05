
<template>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<button  class="btn btn-outline-primary" @click="ocultar('1')">
							Documento <i class="fa fa-plus"></i>
							</button>
							<button  class="btn btn-outline-primary" @click="ocultar('2')">
								<i class="fa fa-minus"></i>
							</button>
						</div>
					</div>
				</div>
	            <div class="card card-default"  id="objetivo">
	                <div class="card-header text-center" style="background-color: #2FA3C6; color: white;">
	                    <h4 class="title">Documentos</h4>  
	                </div>
					<div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Alumno (*)</label>
                                    <input type="text" id="aux" v-model="documentos.aux" autocomplete="off" @keyup="getAlumnos(documentos.aux)" class="form-control">
                                    <input type="text" id="aux1" readonly v-model="documentos.aux" class="form-control">
                                    <p id="alumnos">
                                        <select v-model="documentos.alumno" id="seleccionado" class="form-control" @change="validar()">
                                            <option v-for="a in alumnos" :key="a.Codigo" :value="a.Codigo">
                                                {{a.Nombres}}
                                            </option>
                                        </select>
                                    </p>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Tipo Documento(*)</label>
                                    <select v-model="documentos.tipo" class="form-control">
                                        <option v-for="t in tipos" :key="t.documento" :value="t.documento">
                                            {{t.documento}}
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Número(*)</label>
                                    <input v-model="documentos.num" maxlength="50" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Sesión(*)</label>
                                    <input v-model="documentos.sesion" maxlength="50" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Tomo(*)</label>
                                    <input v-model="documentos.tomo" maxlength="50" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Fecha(*)</label>
                                    <input v-model="documentos.fecha" type="date" maxlength="50" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Folio(*)</label>
                                    <input class="form-control" v-model="documentos.folio">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Asiento(*)</label>
                                    <input class="form-control" v-model="documentos.asiento">
                                        
                                </div>
                            </div>
                        </div>
                        <div class="row text-left">
                            <div class="col-md-2">
                                <button @click="addDocumento()" id="add" class="btn btn-outline-success">Agregar <i class="fa fa-save"></i></button>
                            </div>
                            <div class="col-md-2">
                                <button @click="editArea()" id="editar" class="btn btn-outline-success">Editar <i class="fa fa-edit"></i></button>
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
                                <h4 class="title">DOCUMENTOS</h4>  
                            </div>
                        <div class="card-body">
                            <div class="content table-responsive table-full-width">
                                <v-client-table :data="zdocumentos" :columns="columns" :options="options">
                                    <div slot="Acciones" slot-scope="props">
                                    <router-link class="btn btn-success" target="_blank" :to="'/oficio/'+props.row.IDDocumento" data-toggle="tooltip"  data-placement="left" title="Eliminar"><i class="far fa-file-pdf" aria-hidden="true"></i></router-link>
                                    <!--button class="btn btn-info" data-toggle="tooltip" v-on:click="edit(props.row.IDEgresado)" data-placement="left" title="Editar"><i class="fas fa-edit" style="color: white" aria-hidden="true"></i></button-->
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
            
			documentos:{
                aux:null,
                alumno:null,
                tipo:null,
                num:null,
                sesion:null,
                tomo:null,
                fecha:null,
                folio:null,
                asiento:null,
			},
            alumnos:[],
            tipos:[
                {documento:"OFICIO"},
                {documento:"INFORME"},
                {documento:"MEMORANDUM"},
                ],
            zdocumentos	:[{
				IDDocumento:null,
                TipoDocumento:null,
                Numero:null,
                Fecha:null,
                Escuela:null,
                Paterno:null,
                Materno:null,
                Nombre:null,
            }],
            columns: ["TipoDocumento","Nombre","Paterno","Materno","Numero","Fecha","Escuela","Acciones"],
            options: {
				headings:
				{
                    TipoDocumento:"Tipo",
                    Numero:"Número",
                    Fecha:"Fecha",
                    Escuela:"Escuela",
                    Paterno:"Apellido Paterno",
                    Materno:"Apellido Materno",
                    Nombre:"Nombre",
				},
				sortable    : ["TipoDocumento","Nombre","Paterno","Materno","Numero","Fecha","Escuela",],
				filterable  : ["TipoDocumento","Nombre","Paterno","Materno","Numero","Fecha","Escuela",]
            },
        }
	},
	created(){
        this.getDocumentos();
	},
	mounted(){
        $('#objetivo').hide();
        $('#editar').hide();
        $('#grado').hide();
        $("#alumnos").hide();
        $("#aux1").hide();
	},
    methods: {
        getAlumnos(id)
        {
            var num = id.length;
            console.log(num);
            if(num>=3)
            {
                axios.get("getAlumnos/"+id)
                .then(data=>
                {
                    this.alumnos = data.data.alumnos;
                    console.log(this.alumnos);
                    $("#alumnos").show();
                    this.$Progress.finish();
                }
                ).catch(error=>{
                    console.log(error);
                })
            }else{
                $("#alumnos").hide();
            }
            
              
        },
        validar()
        {
            $("#alumnos").hide();
            var combo1 = document.getElementById("seleccionado");
            this.documentos.aux = combo1.options[combo1.selectedIndex].text;
            $("#aux").hide();
            $("#aux1").show();
        },
        getDocumentos()
        {
            this.$Progress.start();
            axios.get("getDocumentos")
            .then(data=>
            {
                this.zdocumentos = data.data.documentos;
                this.$Progress.finish();
                console.log(data.data);
            }
            ).catch(error=>{
                console.log(error);
            })
		},
		addDocumento()
		{
            if(this.documentos.fecha == null || this.documentos.alumno == null || this.documentos.tipo == null 
            || this.documentos.asiento == null || this.documentos.tomo == null || this.documentos.sesion == null)
            {
                swal({
					type: 'error',
					title: 'Llenar los datos obligatorios',
				});
            }else{
                this.$Progress.start();
                axios.post("addDocumento",{
                    documentos:this.documentos
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
		edit(id,area)
		{
			$('#objetivo').show();
            $('#editar').show();
            $('#add').hide();
            $('#nivel').hide();
            $('#curso').hide();
            this.area.id = id;
            this.area.area = area;
		},
		editArea()
		{
			axios.post("editArea",{
				area:this.area
			}).then(data=>{
				console.log(data);
				swal({
					// position: 'top-end',
					type: 'success',
					title: 'Area editada correctamente',
					showConfirmButton: false,
					timer: 2000
                });
                $('#objetivo').hide();
                $('#editar').hide();
                $('#add').show();
                this.area.id = null;
                this.area.area = null;
				this.getAreas();
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
