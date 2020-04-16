<template>
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <button class="btn btn-success" id="mas" @click="ocultar('1')">
                Agregar Egresado
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
                <h4 class="title">EGRESADOS</h4>
              </div>
              <div class="col-md-4">
                <label>
                * Campos obligatorios
                </label>
              </div>

              <div class="card-body">
                <fieldset class="border p-2">
                  <legend class="w-auto">Datos Personales</legend>
                  <div class="form-group row">
                    
                      <div class="col-md-1 text-left">
                        <label>DNI*</label>
                      </div>
                      <div class="col-md-3">
                        <input
                          v-model="egresado.dni"
                          maxlength="8"
                          onkeypress="return soloNumeros(event)"
                          class="form-control"
                        />
                      </div>
                      <div class="col-md-1 text-left">
                        <label>Código estudiantil*</label>
                      </div>
                      <div class="col-md-3">
                        <input
                          v-model="egresado.codigo"
                          maxlength="10"
                          onkeypress="return soloNumeros(event)"
                          class="form-control"
                        />
                      </div>
                      <div class="col-md-1 text-left">
                        <label>Género*</label>
                      </div>
                      <div class="col-md-3">
                        <select class="form-control" v-model="egresado.genero">   
                          <!-- <option :value="null" disabled>Seleccionar una opción</option>-->
                          <option value="M">Masculino</option>
                          <option value="F">Femenino</option>
                        </select>
                      </div>
                  </div>
                  <div class="form-group row">
                    
                      <div class="col-md-1 text-left">
                        <label>Nombres*</label>
                      </div>
                      <div class="col-md-3">
                        <input
                          v-model="egresado.nombre"
                          maxlength="41"
                          class="form-control"
                          onkeypress="return soloLetras(event)"
                        />
                      </div>
                      <div class="col-md-1 text-left">
                        <label>Apellido paterno*</label>
                      </div>
                      <div class="col-md-3">
                        <input
                          v-model="egresado.paterno"
                          maxlength="41"
                          onkeypress="return soloLetras(event)"
                          class="form-control"
                        />
                      </div>
                      <div class="col-md-1 text-left">
                        <label>Apellido materno*</label>
                      </div>
                      <div class="col-md-3">
                        <input
                          v-model="egresado.materno"
                          maxlength="41"
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
                      <div class="col-md-3">
                        <input
                          v-model="egresado.celular"
                          maxlength="9"
                          onkeypress="return soloNumeros(event)"
                          class="form-control"
                        />
                      </div>
                      <div class="col-md-1 text-left">
                        <label>Correo electrónico</label>
                      </div>
                      <div class="col-md-5">
                        <input
                          v-model="egresado.correo"
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
                      <label>Año ingreso*</label>
                    </div>
                    <div class="col-md-3">
                      <select
                        class="form-control"
                        v-model="egresado.ingreso"
                        @change="validaFecha()"
                      >
                        <option v-for="a in anios" :key="a" :value="a">{{a}}</option>
                      </select>
                    </div>
                    <div class="col-md-1 text-left">
                      <label>Año egreso*</label>
                    </div>
                    <div class="col-md-3">
                      <select
                        class="form-control"
                        v-model="egresado.egreso"
                        @change="validaFecha()"
                      >
                        <option v-for="a in anios" :key="a" :value="a">{{a}}</option>
                      </select>
                    </div>
                  </div>
                  <div class="form-group row">
                    <div class="col-md-1 text-left">
                      <label>Carrera Profesional*</label>
                    </div>
                    <div class="col-md-7">
                      <select v-model="egresado.escuela" class="form-control">
                        <option
                          v-for="e in escuelas"
                          :key="e.IDEscuela"
                          :value="e.IDEscuela"
                        >{{e.Escuela}}</option>
                      </select>
                    </div>
                  </div>
                </fieldset>

                <br />
                <div class="row">
                  <div class="col-md-4" style="text-align: center;"></div>
                  <div class="col-md-2" id="guardar" style="text-align: center;">
                    <button class="btn btn-success" @click="addEgresado(1)">
                      Guardar
                      <i class="fa fa-save"></i>
                    </button>
                  </div>
                  <div class="col-md-2" id="editar" style="text-align: center;">
                    <button class="btn btn-success" @click="addEgresado(2)">
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

    <div class="row t12" id="egresados">
      <div class="col-md-12">
        <div class="card card-default">
          <div
            class="card-header text-center"
            style="background-color: #007bff55 !important; color:black; font-weight: bold;"
          >
            <h4 class="title">EXPEDITOS BACHILLER</h4>
          </div>
          <div class="card-body">
            <div class="content table-responsive table-full-width">
                  <v-client-table :data="egresados" :columns="columns" :options="options">
                    <div slot="Acciones" slot-scope="props">
                      <button
                        class="btn btn-danger"
                        data-toggle="tooltip"
                        style="padding: 2px 4px; font-size: 11px;"
                        v-on:click="deleteEgresado(props.row.IDEgresado)"
                        data-placement="left"
                        title="Eliminar"
                      >
                        <i class="fa fa-trash" aria-hidden="true"></i>
                      </button>
                      <button                        
                        class="btn btn-info"
                        style="padding: 2px 4px; font-size: 11px;"
                        v-on:click="edit(props.row.IDEgresado,props.row.Codigo,props.row.DNI,props.row.Paterno,props.row.Materno,props.row.Celular,props.row.Ingreso,props.row.Egreso,props.row.Nombre,props.row.Genero,props.row.Correo,props.row.IDEscuela)"
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
      egresado: {
        IDEgresado: null,
        codigo: null,
        dni: null,
        nombre: null,
        paterno: null,
        materno: null,
        celular: null,
        genero: null,
        ingreso: null,
        egreso: null,
        escuela: null,
        correo: null
      },
      anios: [],
      egresados: [
        {
          IDEgresado: null,
          IDEscuela: null,
          Codigo: null,
          DNI: null,
          //Paterno:null,
          Materno: null,
          Celular: null,
          Ingreso: null,
          Egreso: null,
          Genero: null,
          NombreAux: null,
          Correo: null,
          Escuela: null
        }
      ],
      //columns: ["Escuela","DNI","NombreAux","Ingreso","Egreso","Acciones"],
      columns: [
        "Escuela",
        "DNI",
        "NombreAux",
        "Celular",
        "Correo",
        "Ingreso",
        "Egreso",
        "Acciones"
      ],
      options: {
        headings: {
          Codigo: "Código",
          DNI: "DNI",
          //Paterno:"Apellidos",
          Celular: "Celular",
          Ingreso: "Ingreso",
          Egreso: "Egreso",
          NombreAux: "Nombres y Apellidos",
          Correo: "Correo",
          Escuela: "Carrera Profesional"
        },
        //sortable    : ["Escuela","DNI","NombreAux","Ingreso","Egreso"],
        //filterable  : ["Escuela","DNI","NombreAux","Ingreso","Egreso"]
        sortable: [
          "Escuela",
          "DNI",
          "NombreAux",
          "Celular",
          "Correo",
          "Ingreso",
          "Egreso"
        ],
        filterable: [
          "Escuela",
          "DNI",
          "NombreAux",
          "Celular",
          "Correo",
          "Ingreso",
          "Egreso"
        ]
      },
      escuelas: []
    };
  },
  created() {
    this.Fecha();
    this.getDatos();
    this.getEscuelas();
  },
  mounted() {
    //$('#editar').hide();
    $("#objetivo").hide();
  },
  methods: {
    Fecha() {
      axios
        .get("getAnios")
        .then(data => {
          this.anios = data.data.anios;
          this.$Progress.finish();
        })
        .catch(error => {
          console.log(error);
        });
    },
    cancelar() {
      this.egresado.dni=null;
      this.egresado.codigo=null;
      this.egresado.nombre=null;
      this.egresado.paterno=null;
      this.egresado.materno=null;
      this.egresado.genero=null;
      this.egresado.celular=null;
      this.egresado.correo=null;
      this.egresado.ingreso=null;
      this.egresado.egreso=null;
      this.egresado.escuela=null;
      $("#objetivo").hide();
      $("#egresados").show();
      $("#menos").hide();
      $("#mas").show();
    },
    validaFecha() {
      if (this.egresado.ingreso != null && this.egresado.egreso != null) {
        var inicio = parseInt(this.egresado.ingreso);
        var final = parseInt(this.egresado.egreso);
        if (final <= inicio) {
          swal({
            // position: 'top-en]d',
            type: "warning",
            title: "Año de egreso debe ser mayor al año de Ingreso"
          });
          this.egresado.ingreso = null;
          this.egresado.egreso = null;
        }
      }
    },
    getDatos() {
      this.$Progress.start();
      axios
        .get("getEgresados")
        .then(data => {
          this.egresados = data.data.egresados;
          this.$Progress.finish();
          console.log(data.data);
        })
        .catch(error => {
          console.log(error);
        });
    },

    addEgresado(e) {
      if (
        this.egresado.nombre == null ||
        this.egresado.paterno == null ||
        this.egresado.materno == null ||
        this.egresado.codigo == null ||
        this.egresado.dni == null ||
        this.egresado.escuela == null ||
        this.egresado.genero == null ||
        this.egresado.ingreso == null ||
        this.egresado.egreso == null
      ) {
        swal({
          type: "warning",
          title: "Llenar los campos obligatorios",
          timer: 3000
        });
      } else if (e == 1) {
        this.$Progress.start();
        axios
          .post("addEgresado", {
            egresado: this.egresado
          })
          .then(data => {
            swal({
              // position: 'top-end',
              type: data.data.val,
              title: data.data.title,
              text: data.data.msj,
              showConfirmButton: false,
              timer: 2000
            });
            this.$Progress.finish();
            this.cancelar();
            this.getDatos();
            //this.load(); descomentar en casa hay problema
            //$("#exampleModal").modal("hide");
            // setTimeout(() => {
            //     location.reload();
            // }, 1500);
          })
          .catch(error => {
            console.log(error);
            swal({
              type: "error",
              title: "Ocurrió un problema",
              text: "Comuniquese con un administrador",
              showConfirmButton: true
            });
          });
      } else if (e == 2) {
        this.$Progress.start();
        axios
          .post("updateEgresado", {
            egresado: this.egresado
          })
          .then(data => {
            swal({
              // position: 'top-end',
              type: data.data.val,
              title: data.data.title,
              text: data.data.msj,
              showConfirmButton: false,
              timer: 2000
            });
            this.$Progress.finish();
            this.cancelar();
            this.getDatos();
            //this.load(); descomentar en caso de pro
            //$("#exampleModal").modal("hide");
          })
          .catch(error => {
            console.log(error);
            swal({
              type: "error",
              title: "Ocurrió un problema",
              text: "Comuniquese con un administrador",
              showConfirmButton: true
            });
          });
      }
    },
    ocultar(id) {
      if (id == "1") {
        $("#objetivo").show();
        $("#egresados").hide();
        $("#nivel").show();
        $("#add").show();
        $("#curso").show();
        $("#guardar").show();
        $("#editar").hide();
        $("#mas").hide();
      } else if (id == "2") {
        $("#objetivo").hide();
        $("#guardar").hide();
        $("#egresados").show();
        $("#mas").hide();
      }
    },
    deleteEgresado(id) {
      this.$Progress.start();
      swal({
        title: "¿Deseas eliminar este Egresado?",
        text: "No será posible revertir esta acción",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Sí",
        cancelButtonText: "Cancelar"
      }).then(result => {
        if (result.value) {
          axios
            .get(`/deleteEgresado/${id}`)
            .then(data => {
              if (data.data == "OK") {
                swal("Egresado eliminado con éxito", "", "success");
                this.$Progress.finish();
                this.getDatos();
              }
            })
            .catch(error => {
              console.log("Ocurrió un problema " + error);
              this.$Progress.fail();
            });
        }
      });
    },
    edit(id, cod, dni, p, m, c, i, e, n, g, co, es) {
      $("#objetivo").show();
      $("#egresados").hide();
      $("#editar").show();
      $("#mas").hide();
      $("#guardar").hide();
      //$("#add").hide();
      this.egresado.IDEgresado = id;
      this.egresado.codigo = cod;
      this.egresado.dni = dni;
      this.egresado.nombre = n;
      this.egresado.paterno = p;
      this.egresado.materno = m;
      this.egresado.celular = c;
      this.egresado.genero = g;
      this.egresado.ingreso = i;
      this.egresado.egreso = e;
      this.egresado.correo = co;
      this.egresado.escuela = es;
    },
    load() {
      $("#editar").hide();
      $("#add").show();
      this.egresado.IDEgresado = null;
      this.egresado.codigo = null;
      this.egresado.dni = null;
      this.egresado.nombre = null;
      this.egresado.paterno = null;
      this.egresado.materno = null;
      this.egresado.celular = null;
      this.egresado.fecha = null;
      this.egresado.ingreso = null;
      this.egresado.egreso = null;
      this.egresado.escuela = null;
      this.egresado.correo = null;
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
    }
  }
};
</script>
