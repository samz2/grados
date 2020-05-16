<template>
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <button class="btn btn-success" id="mas" @click="ocultar('1')">
                Agregar Docente
                <i class="fa fa-plus"></i>
              </button>
            </div>
          </div>
        </div>

        <div class="card card-default" id="objetivo">
          <div
            class="card-header text-center"
            style="background-color: #007bff55 !important; color:black; font-weight: bold;"
          >
            <h4 class="title">DOCENTES</h4>
          </div>
          <div class="col-md-4">
            <label>* Campos obligatorios</label>
          </div>

          <div class="card-body">
            <fieldset class="border p-2">
              <legend class="w-auto">Datos Personales</legend>
              <div class="form-group row">
                  <div class="col-md-1 text-left">
                  <label>DNI*</label>
                </div>
                <div class="col-md-4">
                  <input
                    v-model="docente.dni"
                    maxlength="8"
                    onkeypress="return soloNumeros(event)"
                    class="form-control"
                  />
                </div>
              </div>
              <div class="form-group row">
                <div class="col-md-1 text-left">
                  <label>Nombres*</label>
                </div>
                <div class="col-md-4">
                  <input
                    v-model="docente.nombres"
                    maxlength="40"
                    class="form-control"
                    onkeypress="return soloLetras(event)"
                    required
                  />
                </div>
                <div class="col-md-1 text-left">
                  <label>Apellidos*</label>
                </div>
                <div class="col-md-4">
                  <input
                    v-model="docente.apellidos"
                    maxlength="40"
                    onkeypress="return soloLetras(event)"
                    class="form-control"
                  />
                </div>
              </div>
            </fieldset>
            <fieldset class="border p-2">
              <legend class="w-auto">Datos Adicionales</legend>
              <div class="form-group row">
                  <div class="col-md-1 text-left">
                  <label>Celular</label>
                </div>
                <div class="col-md-4">
                  <input
                    v-model="docente.celular"
                    maxlength="9"
                    onkeypress="return soloNumeros(event)"
                    class="form-control"
                  />
                </div>
                <div class="col-md-1 text-left">
                  <label>Correo electrónico</label>
                </div>
                <div class="col-md-4">
                  <input
                    v-model="docente.correo"
                    type="email"
                    onkeypress="return soloEmail(event)"
                    maxlength="50"
                    class="form-control"
                  />
                </div>
              </div>
            </fieldset>
            <fieldset class="border p-2">
              <legend class="w-auto">Datos Académicos</legend>
              <div class="form-group row">
                  <div class="col-md-1 text-left">
                    <label>Código Docente*</label>
                  </div>
                  <div class="col-md-4">
                    <input
                      v-model="docente.codigo"
                      maxlength="10"
                      class="form-control"
                      onkeypress="return soloCodigoDocente(event)"
                    />
                  </div>
                  <div class="col-md-1 text-left">
                    <label>Carrera Profesional*</label>
                  </div>
                  <div class="col-md-4">
                    <select v-model="docente.escuela" class="form-control">
                      <option
                        v-for="e in escuelas"
                        :key="e.IDEscuela"
                        :value="e.IDEscuela"
                      >{{e.Escuela}}</option>
                    </select>
                </div>
              </div>
                <div class="form-group row">
                    <div class="col-md-1 text-left">
                    <label>Categoría*</label>
                  </div>
                  <div class="col-md-4">
                    <select class="form-control" v-model="docente.categoria">
                      <option value="PRINCIPAL">PRINCIPAL</option>
                      <option value="ASOCIADO">ASOCIADO</option>
                      <option value="AUXILIAR">AUXILIAR</option>
                    </select>
                  </div>
                  <div class="col-md-1 text-left">
                    <label>Dedicación*</label>
                  </div>
                  <div class="col-md-4">
                    <select class="form-control" v-model="docente.dedicacion">
                      <option value="TC">TIEMPO COMPLETO</option>
                      <option value="DE">DEDICACIÓN EXCLUSIVA</option>
                      <option value="TP">TIEMPO PARCIAL</option>
                    </select>
                  </div>
                  
                </div>
            </fieldset>
            <!-- 
                <div class="row">
                                <div class="col-md-12 text-center"><b>Datos Personales</b></div>
                                
                            </div>
                            <hr>                                                        
                            <div class="row">
                                <div class="col-md-2 text-left">
                                    <label>Nombres*</label>
                                </div>
                                <div class="col-md-10">
                                    <input v-model="docente.nombres" maxlength="40" class="form-control" onKeyPress="return soloLetras(event)" required>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-2 text-left">
                                    <label>Apellidos*</label>
                                </div>
                                <div class="col-md-10">
                                    <input v-model="docente.apellidos" maxlength="40" onKeyPress="return soloLetras(event)" class="form-control">
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
                                    <input v-model="docente.codigo" maxlength="10" class="form-control" onKeyPress="return soloCodigoDocente(event)">
                                </div>
                                <div class="col-md-2 text-left">
                                    <label>Categoría*</label>
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
            -->

            <br />
            <div class="row">
              <div class="col-md-4" style="text-align: center;"></div>
              <div class="col-md-2" id="guardar" style="text-align: center;">
                <button class="btn btn-success" @click="addDocente(1)">
                  Guardar
                  <i class="fa fa-save"></i>
                </button>
              </div>
              <div class="col-md-2" id="editar" style="text-align: center;">
                <button class="btn btn-success" @click="addDocente(2)">
                  Guardar
                  <i class="fa fa-save"></i>
                </button>
              </div>
              <div class="col-md-2" style="text-align: center;">
                <button class="btn btn-danger" @click="cancelar()">
                  Cancelar
                  <i class="fas fa-times"></i>
                </button>
              </div>
              <div class="col-md-4" style="text-align: center;"></div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="row t12" id="docentes">
      <div class="col-md-12">
        <div class="card card-default">
          <div
            class="card-header text-center"
            style="background-color: #007bff55 !important; color:black; font-weight: bold;"
          >
            <h4 class="title">DOCENTES</h4>
          </div>
          <div class="card-body">
            <div class="content table-responsive table-full-width">
              <v-client-table :data="docentes" :columns="columns" :options="options">
                <div slot="Accion" slot-scope="props">
                  <button
                    class="btn btn-info"
                    v-on:click="edit(props.row.DNI,props.row.Codigo,props.row.Nombres,props.row.Apellidos,props.row.Celular,props.row.Correo,props.row.Dedicacion,props.row.Categoria,props.row.IDEscuela)"
                    data-placement="left"
                    title="Editar"
                  >
                    <i class="fas fa-edit" style="color: white" aria-hidden="true"></i>
                  </button>
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
      docente: {
        dni: null,
        nombres: null,
        apellidos: null,
        celular: null,
        correo: null,
        escuela: null,
        codigo: null,
        dedicacion: null,
        categoria: null
      },
      escuelas: [],
      docentes: [
        {
          DNI: null,
          NombreAux: null,
          //Apellidos:null,
          Celular: null,
          Correo: null,
          Escuela: null,
          IDEscuela: null,
          Codigo: null,
          Dedicacion: null,
          Categoria: null
        }
      ],
      //columns: ["DNI","Codigo","Nombres","Apellidos","Celular","Categoria","Dedicacion","Escuela","Acciones"],
      columns: [
        "DNI",
        "Codigo",
        "NombreAux",
        "Celular",
        "Categoria",
        "Dedicacion",
        "Escuela",
        "Accion"
      ],
      options: {
        headings: {
          DNI: "DNI",
          //Apellidos:"Apellidos",
          Celular: "Celular",
          Escuela: "Carrera",
          NombreAux: "Nombres y Apellidos",
          Codigo: "Código",
          Dedicacion: "Dedicación",
          Categoria: "Categoría"
        },
        sortable: [
          "DNI",
          "Codigo",
          "NombreAux",
          "Celular",
          "Categoria",
          "Dedicacion",
          "Escuela"
        ],
        filterable: [
          "DNI",
          "Codigo",
          "NombreAux",
          "Celular",
          "Categoria",
          "Dedicacion",
          "Escuela"
        ]
      }
    };
  },
  created() {
    this.getDatos();
    this.getEscuelas();
  },
  mounted() {
    $("#objetivo").hide();
  },
  methods: {
    getDatos() {
      this.$Progress.start();
      axios
        .get("getDocentes")
        .then(data => {
          this.docentes = data.data.docentes;
          this.$Progress.finish();
        })
        .catch(error => {
          console.log(error);
        });
    },
    getEscuelas() {
      axios
        .get("getEscuelas")
        .then(data => {
          this.escuelas = data.data.escuelas;
        })
        .catch(error => {
          console.log("error: " + error);
        });
    },
    cancelar() {
      this.docente.dni = null;
      this.docente.nombres = null;
      this.docente.apellidos = null;
      this.docente.celular = null;
      this.docente.correo = null;
      this.docente.escuela = null;
      this.docente.codigo = null;
      this.docente.dedicacion = null;
      this.docente.categoria = null;
      $("#objetivo").hide();
      $("#docentes").show();
      $("#menos").hide();
      $("#mas").show();
    },

    addDocente(e) {
      if (
        this.docente.nombres == null ||
        this.docente.apellidos == null ||
        this.docente.escuela == null ||
        this.docente.codigo == null ||
        this.docente.dedicacion == null ||
        this.docente.categoria == null ||
        this.docente.dni == null
      ) {
        swal({
          type: "warning",
          title: "Llenar los campos obligatorios",
          timer: 3000
        });
      } else if (e == 1) {
        this.$Progress.start();
        axios
          .post("addDocente", {
            docente: this.docente
          })
          .then(data => {
            swal({
              type: data.data.type,
              title: data.data.title,
              text: data.data.text,
              showConfirmButton: false,
              timer: 3000
            });
            this.$Progress.finish();
            this.cancelar();
            this.getDatos();
            //this.load();
          })
          .catch(error => {
            console.log(error);
            swal({
              type: "error",
              title: "Ha ocurrido un error",
              text: "Comuníquese con un administrador",
              showConfirmButton: true
            });
          });
      } else if (e == 2) {
        this.$Progress.start();
        axios
          .post("updateDocente", {
            docente: this.docente
          })
          .then(data => {
            swal({
              type: data.data.type,
              title: data.data.title,
              text: data.data.text,
              showConfirmButton: false,
              timer: 3000
            });
            this.$Progress.finish();
            this.cancelar();
            this.getDatos();
            //this.load();
          })
          .catch(error => {
            console.log(error);
            swal({
              type: "error",
              title: "Ha ocurrido un error",
              text: "Comuníquese con un administrador",
              showConfirmButton: true
            });
          });
      }
    },
    //load() {
    //  $("#add").show();
    //  $("#editar").hide();
    //  this.docente.dni = null;
    //  this.docente.nombres = null;
    //  this.docente.apellidos = null;
    //  this.docente.celular = null;
    //  this.docente.correo = null;
    //  this.docente.escuela = null;
    //  this.docente.codigo = null;
    //  this.docente.dedicacion = null;
    //  this.docente.categoria = null;
    //},
    ocultar(id) {
      if (id == "1") {
        $("#objetivo").show();
        $("#docentes").hide();
        $("#nivel").show();
        $("#add").show();
        $("#curso").show();
        $("#guardar").show();
        $("#editar").hide();
        $("#mas").hide();
      } else if (id == "2") {
        $("#objetivo").hide();
        $("#guardar").hide();
        $("#docentes").show();
        $("#mas").hide();
      }
    },
    edit(
      DNI,
      Codigo,
      Nombres,
      Apellidos,
      Celular,
      Correo,
      Dedicacion,
      Categoria,
      IDEscuela
    ) {
      $("#objetivo").show();
      $("#docentes").hide();
      $("#editar").show();
      $("#mas").hide();
      $("#guardar").hide();
      $("#add").hide();
      $("#dni").hide();
      $("#aux").show();
      this.docente.dni = DNI;
      this.docente.nombres = Nombres;
      this.docente.apellidos = Apellidos;
      this.docente.celular = Celular;
      this.docente.correo = Correo;
      this.docente.escuela = IDEscuela;
      this.docente.codigo = Codigo;
      this.docente.dedicacion = Dedicacion;
      this.docente.categoria = Categoria;
    }
  }
};
</script>
