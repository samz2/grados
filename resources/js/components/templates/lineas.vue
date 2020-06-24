<template>
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <button class="btn btn-success" id="mas" @click="ocultar('1')">
                Agregar Linea de investigación
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
            <h4 class="title">Lineas de Investigación</h4>
          </div>
          <div class="col-md-4">
            <label>* Campos obligatorios</label>
          </div>

          <div class="card-body">
            <fieldset class="border p-2">
              <legend class="w-auto">Datos</legend>
              <div class="form-group row">
                  <div class="col-md-3 text-left">
                    <label>Carrera Profesional*</label>
                  </div>
                  <div class="col-md-4">
                    <select v-model="linea.escuela" class="form-control form-control-sm">
                      <option
                        v-for="e in escuelas"
                        :key="e.IDEscuela"
                        :value="e.IDEscuela"
                      >{{e.Escuela}}</option>
                    </select>
                </div>
              </div>
              <div class="form-group row">
                <div class="col-md-3 text-left">
                  <label>Línea de investigación*</label>
                </div>
                <div class="col-md-8">
                  <input
                    v-model="linea.linea"
                    maxlength="80"
                    class="form-control form-control-sm"
                    onkeypress="return soloLetras(event)"
                    required
                  />
                </div>
              </div>
            </fieldset>
            
            <br>
            <div class="row">
              <div class="col-md-4" style="text-align: center;"></div>
              <div class="col-md-2" id="guardar" style="text-align: center;">
                <button class="btn btn-success" @click="addLinea(1)">
                  Guardar
                  <i class="fa fa-save"></i>
                </button>
              </div>
              <div class="col-md-2" id="editar" style="text-align: center;">
                <button class="btn btn-success" @click="addLinea(2)">
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

    <div class="row" id="docentes">
      <div class="col-md-12">
        <div class="card card-default">
          <div
            class="card-header text-center"
            style="background-color: #007bff55 !important; color:black; font-weight: bold;"
          >
            <h4 class="title">LINEAS DE INVESTIGACIÓN</h4>
          </div>
          <div class="card-body">
            <div class="content table-responsive table-full-width">
              <v-client-table :data="lineas" :columns="columns" :options="options">
                <div slot="Accion" slot-scope="props">
                  <button
                    class="btn btn-info"
                    v-on:click="edit(props.row.IDEscuela,props.row.Linea,props.row.IDLinea)"
                    data-placement="left"
                    title="Editar"  style="color: white"
                  >
                    Editar <i class="fas fa-edit"  aria-hidden="true"></i>
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
      linea: {
        idlinea:null,
        linea: null,
        escuela: null,
      },
      escuelas: [],
      lineas: [
        {
          Escuela: null,
          Linea: null,
          IDLinea: null,
        }
      ],
      //columns: ["DNI","Codigo","Nombres","Apellidos","Celular","Categoria","Dedicacion","Escuela","Acciones"],
      columns: [
        "Escuela",
        "Linea",
        "Accion"
      ],
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
        headings: {
          Escuela: "Carrera Profesional",
          Linea: "Linea de Investigación",
        },
        sortable: [
          "Linea",
          "Escuela"
        ],
        filterable: [
          "Linea",
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
        .get("getLineas")
        .then(data => {
          this.lineas = data.data.lineas;
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
      this.linea.linea = null;
      this.linea.escuela = null;
      $("#objetivo").hide();
      $("#docentes").show();
      $("#menos").hide();
      $("#mas").show();
    },

    addLinea(e) {
      if (
        this.linea.linea == null ||
        this.linea.escuela == null
      ) {
        swal({
          type: "warning",
          title: "Llenar los campos obligatorios",
          timer: 3000
        });
        return;
      } else if (e == 1) {
        this.$Progress.start();
        axios
          .post("addLinea", {
            linea: this.linea
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
              title: "Ocurrió un problema",
              text: "Comuniquese con un administrador",
              showConfirmButton: true
            });
          });
      } else if (e == 2) {
        this.$Progress.start();
        axios
          .post("updateLinea", {
            linea: this.linea
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
              title: "Ocurrió un problema",
              text: "Comuníquese con un administrador",
              showConfirmButton: true
            });
          });
      }
    },
   
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
    edit(IDEscuela,Linea,IDLinea) {
      $("#objetivo").show();
      $("#docentes").hide();
      $("#editar").show();
      $("#mas").hide();
      $("#guardar").hide();
      $("#add").hide();
      $("#dni").hide();
      $("#aux").show();
      this.linea.idlinea  = IDLinea;
      this.linea.escuela  = IDEscuela;
      this.linea.linea    = Linea;
    }
  }
};
</script>
