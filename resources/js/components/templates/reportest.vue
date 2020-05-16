
<template>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
	            <div class="card card-default">
	                <div class="card-header text-center" style="background-color: powderblue !important; color:black; font-weight: bold;">
	                    <h4 class="title">REPORTES EXPEDITOS TÍTULO</h4>  
	                </div>
					<div class="card-body">
                        <fieldset class="border p-2">
                            <legend class="w-auto t15"><b>Reporte detallado</b></legend>
                            <div class="form-group row">
                                <label class="col-md-2 col-form-label">Fecha Inicio* :</label>
                                <div class="col-md-3">
                                    <input v-model="reporte.inicio" type="date" class="form-control form-control-sm">
                                </div>
                                <label class="col-md-2 col-form-label">Fecha Inicio* :</label>
                                <div class="col-md-3">
                                    <input v-model="reporte.final" type="date" class="form-control form-control-sm">
                                </div>
                                <div class="col-md-2">&nbsp;</div>
                                <label class="col-md-2 t13 col-form-label">Carrera Profesional* :</label>
                                <div class="col-md-3">
                                    <select type="text" v-model="reporte.carrera" class="form-control form-control-sm">
                                        <option v-for="e in escuelas" :key="e.IDEscuela" :value="e.IDEscuela">
                                            {{e.Escuela}}
                                        </option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <router-link class="btn btn-success btn-sm" target="_blank" :to="'/reporte_titulo/'+reporte.inicio+'/'+reporte.final+'/'+reporte.carrera"
                                    data-toggle="tooltip" data-placement="left">generar reporte
                                    <!-- <i class="far fa-file-pdf" aria-hidden="true"></i> -->
                                    </router-link>
                                    
                                </div>
                            </div>
                        </fieldset>
                        <fieldset class="border p-2">
                            <legend class="w-auto t15"><b>Reporte gráfico</b></legend>
                            <div class="form-group row">
                                <label class="col-md-2 col-form-label">Fecha Inicio* :</label>
                                <div class="col-md-3">
                                    <input v-model="reporte.iniciog" type="date" class="form-control form-control-sm">
                                </div>
                                <label class="col-md-2 col-form-label">Fecha Inicio* :</label>
                                <div class="col-md-3">
                                    <input v-model="reporte.finalg" type="date" class="form-control form-control-sm">
                                </div>
                                <div class="col-md-2">
                                    <button @click="getReporte(reporte.iniciog,reporte.finalg)" class="btn btn-success btn-sm">generar reporte
                                    
                                    </button>
                                    
                                </div>
                            </div>
                        </fieldset>
                        <button id="print" class="btn btn-success btn-sm" @click="printDiv('graph')" value="guardar"> print
                        </button>    
                        <div id="graph" style="margin: auto;">
							<apexchart width="500" type="donut" :options="options" :series="series"></apexchart>
                            <i class="nav-icon fa fa-circle text-primary"></i> Ing. de Sistemas <br>
                            <i class="nav-icon fa fa-circle text-success"></i> Ing. Civil <br>
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
            lineas:[],
			reporte:{
                inicio:null,
                iniciog:null,
                carrera:null,
                final:null,
                finalg:null,
            },
            options: {
                labels: ['Ing. de Sistemas', 'Ing. civil'],
                legend: {
                    show: false,
                }
			},
			series: [],
            escuelas: [],
            
        }
	},
	created(){
        this.getEscuelas();
	},
	mounted(){
        $("#graph").hide();
        $("#print").hide();
	},
    methods: {
        printDiv(nombreDiv) {
            // var w = window.open('', nombreDiv, 'width=300,height=400');  
            var contenido= document.getElementById(nombreDiv).innerHTML;
            var contenidoOriginal= document.body.innerHTML;

            document.body.innerHTML = contenido;

            window.print();

            document.body.innerHTML = contenidoOriginal;
        },
        getReporte(inicio,final)
        {
            this.$Progress.start();
            axios.get("reporte_titulo/"+inicio+"/"+final)
            .then(data=>
            {
                this.series = data.data.num;
                $("#graph").show();
                $("#print").show();
                this.$Progress.finish();
            }
            ).catch(error=>{
                console.log(error);
            })
        },
        getModalidades()
        {
            this.$Progress.start();
            axios.get("getModalidades")
            .then(data=>
            {
                this.modalidades = data.data.modalidades;
                this.$Progress.finish();
            }
            ).catch(error=>{
                console.log(error);
            })
        },
       
        buscar(d,c,a)
        {
            if(d == '') d = null;
            if(c == '') c = null;
            if(a == '') a = null;
            axios.get("getAlumnos/"+d+"/"+c+"/"+a)
            .then(data=>
            {
                if(data.data.alumnos[0] == null)
                {
                    swal({
                        type: 'error',
                        title: 'No se encontraron registros',
                    });
                }else{
                    this.alumnos = data.data.alumnos[0];
                }
                
                this.$Progress.finish();
            }
            ).catch(error=>{
                console.log(error);
            })
        },
        cancelar()
        {
            this.proyecto.idproyecto    = null;
            this.proyecto.carrera       = null;
            this.proyecto.tesis         = null;
            this.proyecto.linea         = null;
            this.proyecto.docente       = null;
            this.proyecto.fecha         = null;
            this.proyecto.porcentaje    = null;
            this.tesistasaux            = [];
            this.tesistas               = [];
            this.lineas                 = [];
            this.tesistasaux2           = null;
            $('#objetivo').hide();
            $('#expeditos').show();	
            $('#menos').hide();
            $('#mas').show();
        },
        borrar()
        {
            this.alumno.codigo      = null;
            this.alumno.dni         = null;
            this.alumnos.Nombres    = null;

            this.alumnos = [];
        },
       
       
        getProyectos()
        {
            this.$Progress.start();
            axios.get("getProyectos")
            .then(data=>
            {
                this.proyectos = data.data.proyectos;
                this.$Progress.finish();
                console.log(data.data);
            }
            ).catch(error=>{
                console.log(error);
            })
        },
       
		addProyecto()
		{          
            if(this.proyecto.carrera       == null ||
               this.proyecto.tesis         == null ||
               this.proyecto.linea         == null ||
               this.proyecto.fecha         == null)
            {
                swal({
					type: 'warning',
                    title: 'Llenar los datos obligatorios',
                    timer: 3000
                });
                return;
            }else{
                
                this.$Progress.start();
                axios.post("addProyecto",{
                    proyecto:this.proyecto,
                    tesistas:this.tesistas
                }).then(data=>{
                    swal({
                        // position: 'top-end',
                        type: data.data.val,
                        // title: data.data.title,
                        text: data.data.msj,
                        showConfirmButton: false,
                        timer: 2000
                    });
                    this.$Progress.finish();
                    // setTimeout(() => {
                    //     location.reload();
                    // }, 1500);
                    this.cancelar();
                    this.getProyectos();
                    }).catch(error=>{
                    console.log(error);	
                    swal({
                        type: 'error',
                        //title: 'Error',
                        text: 'Ocurrió un problema, comuníquese con un administrador',
                        showConfirmButton: true,
                    });
                })
            }
			
		},
        ocultar(id)
        {
			if(id == '1')
			{
                $('#objetivo').show();
                $('#documentos').show();
                $('#buscar').show();
                $('#archivos').show();
                $('#guardar').show();
                $('#expeditos').hide();
                $('#editar').hide();
                $('#menos').show();
                $('#mas').hide();
                $('#labelInicio').show();
			}
			else if(id == '2')
			{
				$('#objetivo').hide();
				$('#archivos').hide();
				$('#editar').hide();
				$('#guardar').hide();
                $('#buscar').hide();                
                $('#expeditos').show();	
                $('#menos').hide();
                $('#mas').show();
                $('#labelInicio').hide();
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
        edit(IDProyecto,IDCarrera,NombreTesis,IDLinea,CodDocente,FechaRegistro,Porcentaje,Codigos)
        {
            $("#objetivo").show();
            $("#expeditos").hide();
            $("#buscar").hide();
            $('#labelInicio').hide();
            $('#mas').hide();
            $('#editar').show();
            $('#guardar').hide();
            this.getLineas(IDCarrera);
            this.proyecto.idproyecto    = IDProyecto;
            this.proyecto.carrera       = IDCarrera;
            this.proyecto.tesis         = NombreTesis;
            this.proyecto.linea         = IDLinea;
            this.proyecto.docente       = CodDocente;
            this.proyecto.fecha         = FechaRegistro;
            this.proyecto.porcentaje    = Porcentaje;
            this.tesistasaux            = Codigos.split(",");
            this.getTesistas();
            // console.log(Codigos.split(","));
            // this.tesistasaux
        },
        editExpedito()
        {
            if(this.proyecto.carrera       == null ||
               this.proyecto.tesis         == null ||
               this.proyecto.linea         == null ||
               this.proyecto.fecha         == null)
            {
                swal({
					type: 'warning',
                    title: 'Llenar los datos obligatorios',
                    timer: 3000
                });
                return;
            }else{
                
                this.$Progress.start();
                axios.post("updateProyecto",{
                    proyecto:this.proyecto,
                    tesistas:this.tesistas,
                    tesista:this.tesistasaux2
                }).then(data=>{
                    swal({
                        // position: 'top-end',
                        type: data.data.val,
                        // title: data.data.title,
                        text: data.data.msj,
                        showConfirmButton: false,
                        timer: 2000
                    });
                    this.$Progress.finish();
                    this.cancelar();
                    this.getProyectos();
                    }).catch(error=>{
                    console.log(error);	
                    swal({
                        type: 'error',
                        //title: 'Error',
                        text: 'Ocurrió un problema, comuníquese con un administrador',
                        showConfirmButton: true,
                    });
                })
            }
        },
        getEscuelas() 
        {
            axios
                .get("getEscuelas")
                .then(data => {
                this.escuelas = data.data.escuelas;
                })
                .catch(error => {
                console.log("error: " + error);
                });
        }
    }
}
</script>
