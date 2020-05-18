
<template>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
	            <div class="card card-default">
	                <div class="card-header text-center" style="background-color: powderblue !important; color:black; font-weight: bold;">
	                    <h4 class="title">REPORTES EXPEDITOS BACHILLER</h4>  
	                </div>
                    <div class="col-md-5">
                        <label>* Campos obligatorios</label>
                    </div>

                    <div class="col-md-5" id="labelInicio">
                        <label>Nota: Llenar los campos solicitados para cada reporte</label>
                    </div>
					<div class="card-body">
                        <fieldset class="border p-2">
                            <legend class="w-auto t15"><b>Reporte detallado</b></legend>
                            <div class="form-group row">
                                <div class="col-md-2">
                                    <label>Fecha Inicio*</label>
                                </div>
                                <div class="col-md-3">
                                    <input v-model="reporte.inicio" max="2030-12-31" @change="valida()" type="date" class="form-control form-control-sm">
                                </div>
                                <div class="col-md-2">
                                    <label>Fecha Final*</label>
                                </div>
                                <div class="col-md-3">
                                    <input v-model="reporte.final" max="2030-12-31" @change="valida()" type="date" class="form-control form-control-sm">
                                </div>
                                <div class="col-md-2">&nbsp;</div>
                                <div class="col-md-2">
                                    <label>Carrera Profesional*</label>
                                </div>
                                <div class="col-md-3">
                                    <select type="text" v-model="reporte.carrera" @change="valida()" class="form-control form-control-sm">
                                        <option v-for="e in escuelas" :key="e.IDEscuela" :value="e.IDEscuela">
                                            {{e.Escuela}}
                                        </option>
                                    </select>
                                </div>
                                <div class="col-md-7">&nbsp;</div>
                                <div class="col-md-3" v-if="validar">
                                    <router-link class="btn btn-success btn-sm" target="_blank" :to="'/reporte_bachiller/'+reporte.inicio+'/'+reporte.final+'/'+reporte.carrera"
                                    data-toggle="tooltip" data-placement="left">Generar Reporte
                                    <i class="far fa-file-pdf" aria-hidden="true"></i>
                                    </router-link>
                                </div>
                                <div class="col-md-3" v-if="!validar">
                                    <button class="btn btn-success btn-sm" disabled>Generar Reporte
                                    <i class="far fa-file-pdf" aria-hidden="true"></i>
                                    </button>
                                </div>
                            </div>
                        </fieldset>
                        <fieldset class="border p-2">
                            <legend class="w-auto t15"><b>Reporte gráfico</b></legend>
                            <div class="form-group row">
                                <div class="col-md-2">
                                    <label>Fecha Inicio*</label>
                                </div>   
                                <div class="col-md-3">
                                    <input v-model="reporte.iniciog" max="2030-12-31" @change="valida2()" type="date" class="form-control form-control-sm">
                                </div>
                                <div class="col-md-2">
                                    <label>Fecha Final*</label>
                                </div>
                                <div class="col-md-3">
                                    <input v-model="reporte.finalg" max="2030-12-31" @change="valida2()" type="date" class="form-control form-control-sm">
                                </div>
                                <div class="col-md-2">
                                    &nbsp;
                                </div>
                                <div class="col-md-2" v-if="!validar2">
                                    <button class="btn btn-success btn-sm" disabled>Generar Gráfico
                                    <i class="fas fa-chart-pie"></i>                                 
                                    </button>
                                </div>
                                 <div class="col-md-2" v-if="validar2">
                                    <button class="btn btn-success btn-sm" @click="getReporte(reporte.iniciog,reporte.finalg)">Generar Gráfico
                                    <i class="fas fa-chart-pie"></i>                                 
                                    </button>
                                </div>
                            </div>
                        </fieldset>
                        <br>
                        <button id="print" class="btn btn-info btn-sm" style="color:white" @click="printDiv('graph')" value="guardar"> Imprimir
                            <i class="far fa-file-pdf" aria-hidden="true"></i>
                        </button>    
                        
                        <div id="graph" class="form-group row" align="center">
                            <div class="col-md-4"></div>
                            <div class="col-md-4">
                                <apexchart width='300' type="donut" :options="options" :series="series"></apexchart>
                                <div style="text-align:left"><i class="nav-icon fa fa-circle text-primary"></i> Ingeniería de Sistemas({{sistemas}})</div>
                                <div style="text-align:left"><i class="nav-icon fa fa-circle text-success"></i> Ingeniería Civil({{civil}})</div> <br>
                            </div>
                            <div class="col-md-4"></div>
							
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
            validar:false,
            validar2:false,
            sistemas:null,
            civil:null,
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
        valida()
        {
            if(this.reporte.inicio == null || 
            this.reporte.final == null || 
            this.reporte.carrera == null )
            {
                return;
            }else{
                this.validar = true;
            }

            if (this.reporte.inicio != null) {
                var inicio = this.reporte.inicio;
                var final = "2030-01-01";
                if (final <= inicio) {
                swal({
                    type: "warning",
                    title: "Ingresar una fecha correcta"
                });
                this.reporte.inicio = null;
                }
            }

            if (this.reporte.final != null) {
                var inicio = this.reporte.final;
                var final = "2030-01-01";
                if (final <= inicio) {
                swal({
                    type: "warning",
                    title: "Ingresar una fecha correcta"
                });
                this.reporte.final = null;
                }
            }
        },
        valida2()
        {
            var c1 = this.reporte.inicio;
            var c2 = this.reporte.final;
            var c3 = this.reporte.carrera;

            if(this.reporte.iniciog == null || 
            this.reporte.finalg == null)
            {
                return;
            }else{
                this.validar2 = true;
            }

            if (this.reporte.iniciog != null) {
                var inicio = this.reporte.iniciog;
                var final = "2030-01-01";
                if (final <= inicio) {
                swal({
                    type: "warning",
                    title: "Ingresar una fecha correcta"
                });
                this.reporte.iniciog = null;
                }
            }

            if (this.reporte.finalg != null) {
                var inicio = this.reporte.finalg;
                var final = "2030-01-01";
                if (final <= inicio) {
                swal({
                    type: "warning",
                    title: "Ingresar una fecha correcta"
                });
                this.reporte.finalg = null;
                }
            }
        },
        printDiv(nombreDiv) {

            var headstr = "<html><head><h1 style='text-align:center; font-weight:bold;'>REPORTE GRÁFICO EXPEDITOS BACHILLER</h1></head><body><div align='center' style='zoom: 1.2;'><br><br>";
            var footstr = "</div></body>";
            var contenido = document.getElementById(nombreDiv).innerHTML;
            var contenidoOriginal = document.body.innerHTML;
            document.body.innerHTML = headstr+contenido+footstr;
            window.print();
            location.reload();
            document.body.innerHTML = contenidoOriginal;
           
            //var contenido= document.getElementById(nombreDiv).innerHTML;
            //var contenidoOriginal= document.body.innerHTML;            
            //document.body.innerHTML = contenido;
            //window.print();
            //document.body.innerHTML = contenidoOriginal;
        },
        getReporte(inicio,final)
        {
            
            this.$Progress.start();
            axios.get("reporte_bachiller/"+inicio+"/"+final)
            .then(data=>
            {
                this.series = data.data.num;
                this.sistemas = data.data.num[0];
                this.civil = data.data.num[1];
                // this.series = [2,5];

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
        validafecha() {
      if (this.expedito.ingreso != null) {
        var inicio = this.expedito.ingreso;
        var final = "2022-01-01";
        if (final <= inicio) {
          swal({
            type: "warning",
            title: "Ingresar una fecha correcta"
          });
          this.expedito.ingreso = null;
        }
      }
      if (this.expedito.comienzo != null) {
        var inicio = this.expedito.comienzo;
        var final = "2026-01-01";
        if (final <= inicio) {
          swal({
            type: "warning",
            title: "Ingresar una fecha correcta"
          });
          this.expedito.comienzo = null;
        }
      }
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
