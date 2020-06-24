<template>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
            <div class="card card-primary ">
              <div class="card-header bg-teal">
                <h3 class="card-title">Redactar correo</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="form-group">
                  <input class="form-control" v-model="correo.to" placeholder="Para:">
                </div>
                <div class="form-group">
                  <input class="form-control" v-model="correo.subject" placeholder="Asunto:">
                </div>
                <div class="form-group">
                    <textarea id="compose-textarea" v-model="correo.mensaje" class="form-control" style="height: 200px">
                      
                    </textarea>
                </div>
                <div class="form-group">
                  <div class="btn btn-default btn-file">
                    <button data-target="#adjuntos" @click="getDirectorio(id)" title="Adjuntar archivos" class="btn bg-warning altoBoton" data-toggle="modal" data-placement="left" name="attachment" style="color:black; font-weight: bold;">
                      <i class="fas fa-paperclip"></i> Adjuntar archivos
                    </button>
                  </div>
                  <div class="row">
                    <div class="col-md-3" v-for="a in adjuntos" :key="a">{{a}}</div>
                  </div>
                <!-- <div class="form-group">
                  <div class="btn btn-default btn-file">
                    <i class="fas fa-paperclip"></i> adjuntar
                    <input type="file" name="attachment">
                  </div>
                  <p class="help-block">Max. 6MB</p>
                  <p v-for="d in directorio" :key="d" @click="adjuntar(d)">{{d}}</p> 
                </div> -->
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                <div class="float-right">
                  <button type="submit" @click="sendMail()" class="btn btn-primary"><i class="far fa-envelope"></i> Enviar</button>
                </div>
              </div>
              <!-- /.card-footer -->
            </div>
            <!-- /.card -->
          </div>
        </div>  
        <div class="modal fade" id="adjuntos" tabindex="-1" role="dialog" aria-labelledby="adjuntoslabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                  <div class="modal-content">
                  <div class="modal-header text-center" style="background-color: powderblue !important; color:black; font-weight: bold;">
                      <h5 class="modal-titler text-center" id="adjuntoslabel">Archivos</h5>
                      <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                      </button> -->
                  </div>
                  <div class="modal-body">
                    <div class="col-md-12"><label>Nota: Hacer click en el(los) archivo(s) a adjuntar</label></div><br>
                      <div class="col-md-12" v-for="d in directorio" :key="d" >
                        <a href="#" @click="adjuntar(d)">{{d}}</a>  
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
    props : ["id"],           
    data() {
        return {
          correo:
          {
            to:null,
            mensaje:null,
            subject:null,
            attach:null,
          },
            
            directorio:[],
            adjuntos:[]
        }
	},
	created(){
        // this.getDirectorio();
	},
	mounted(){
       
	},
    methods: {
        sendMail(to,mensaje)
        {
            this.$Progress.start();
             axios.post("sendMail",{
                    correo:this.correo,
                    adjuntos:this.adjuntos,
                }).then(data=>{
                    swal({
                        // position: 'top-end',
                        type: "success",
                        // title: data.data.title,
                        text: "Correo enviado con éxito",
                        showConfirmButton: false,
                        timer: 3000
                    });
                    this.$Progress.finish();
                    setTimeout(() => {
                        location.reload();
                    }, 1500);
                    }).catch(error=>{
                    console.log(error);	
                    swal({
                        type: "error",
                        title: 'Ha ocurrido un error',
                        text: "Comuníquese con un administrador",
                        showConfirmButton: true
                    });
                })
        },
        getDirectorio(id)
        {
            this.$Progress.start();
            axios.get("directorio/"+id)
            .then(data=>
            {
                this.directorio = data.data.carpetas;
                // this.directorio = data.data.listar;
                this.$Progress.finish();
                console.log(data.data);
            }
            ).catch(error=>{
                console.log(error);
            })
        },
        adjuntar(d)
        {
          // var adj = d.split('\\').pop();
          var adj = "Archivos/"+this.id+"/"+d;
          this.adjuntos.push(adj);
          // this.correo.attach = d;
          // console.log(this.correo.attach);
        }
    }
}
</script>
