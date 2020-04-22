
<template>
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <button class="btn btn-success" id="mas" @click="ocultar('1')">
                Agregar Expedito Bachiller
                <i class="fa fa-plus"></i>
              </button>
            </div>
          </div>
        </div>
        <div class="card card-default" id="objetivo">
          <div
            class="card-header text-center"
            style="background-color: powderblue !important; color:black; font-weight: bold;"
          >
            <h4 class="title">Expedito Bachiller</h4>
          </div>
          <div class="col-md-5">
            <label>* Campos obligatorios</label>
          </div>

          <div class="col-md-5" id="labelInicio">
            <label>Nota: Primero realizar la búsqueda del egresado</label>
          </div>

          <div class="card-body">
            <fieldset class="border p-2">
              <legend class="w-auto">
                Datos Egresado
                <button
                  data-target="#exampleModal"
                  id="buscar"
                  class="btn btn-primary"
                  data-toggle="modal"
                  style="color:white;"
                  @click="borrar()"
                  data-placement="left"
                >
                  Buscar Egresado
                  <i class="fas fa-search"></i>
                </button>
              </legend>
              <div class="form-group row">
                <div class="col-md-2">
                  <label>Número DNI:</label>
                </div>
                <div class="col-md-2">
                  <input
                    type="text"
                    v-model="expedito.dni"
                    id="dni"
                    readonly
                    class="form-control form-control-sm"
                  />
                </div>
                <div class="col-md-3 text-left">
                  <label>Código Universitario:</label>
                </div>
                <div class="col-md-2">
                  <input
                    type="text"
                    v-model="expedito.codigo"
                    id="codigo"
                    readonly
                    class="form-control form-control-sm"
                  />
                </div>
              </div>
              <div class="form-group row">
                <div class="col-md-2 text-left">
                  <label>Nombre Completo:</label>
                </div>
                <div class="col-md-7">
                  <input
                    type="text"
                    v-model="expedito.alumno"
                    id="nombre"
                    readonly
                    class="form-control form-control-sm"
                  />
                </div>
              </div>
              <div class="form-group row">
                <div class="col-md-2">
                  <label for="carrera">Carrera Profesional:</label>
                </div>
                <div class="col-md-7">
                  <input
                    type="text"
                    v-model="expedito.carrera"
                    id="carrera"
                    readonly
                    class="form-control form-control-sm"
                  />
                </div>
              </div>
            </fieldset>
            <fieldset class="border p-2">
              <legend class="w-auto">Datos del Libro de Actas</legend>
              <div class="form-group row">
                <div class="col-md-2">
                  <label for="tomo">Número Tomo* :</label>
                </div>
                <div class="col-md-2">
                  <input
                    type="text"
                    id="tomo"
                    v-model="expedito.tomo"
                    onkeypress="return soloNumeros(event)"
                    maxlength="3"
                    class="form-control form-control-sm"
                  />
                </div>
                <div class="col-md-2">
                  <label for="folio">Número Folio* :</label>
                </div>
                <div class="col-md-2">
                  <input
                    type="text"
                    id="folio"
                    v-model="expedito.folio"
                    onkeypress="return soloNumeros(event)"
                    maxlength="3"
                    class="form-control form-control-sm"
                  />
                </div>
                <div class="col-md-2">
                  <label for="asiento">Número Asiento* :</label>
                </div>
                <div class="col-md-2">
                  <input
                    type="text"
                    id="asiento"
                    v-model="expedito.asiento"
                    onkeypress="return soloNumeros(event)"
                    maxlength="3"
                    class="form-control form-control-sm"
                  />
                </div>
              </div>
            </fieldset>
            <fieldset class="border p-2">
              <legend class="w-auto">Sesión</legend>
              <div class="form-group row">
                <div class="col-md-2">
                  <label for="sesion">Número Sesión* :</label>
                </div>
                <div class="col-md-2">
                  <select
                    id="sesion"
                    v-model="expedito.sesion"
                    @change="getSession(expedito.sesion)"
                    class="form-control form-control-sm"
                  >
                    <option
                      v-for="s in sesiones"
                      :key="s.NumSesion"
                      :value="s.NumSesion"
                    >{{s.NumSesion}}</option>
                  </select>
                </div>
                <div class="col-md-1">
                  <label for="fecha">Fecha:</label>
                </div>
                <div class="col-md-3">
                  <input
                    type="date"
                    id="fecha"
                    max="2030-12-31"
                    v-model="expedito.sfecha"
                    readonly
                    class="form-control form-control-sm"
                  />
                </div>
                <div class="col-md-1">
                  <label for="Tipo">Tipo:</label>
                </div>
                <div class="col-md-3">
                  <input
                    type="text"
                    id="tipo"
                    v-model="expedito.stipo"
                    readonly
                    maxlength="3"
                    class="form-control form-control-sm"
                  />
                </div>
              </div>
            </fieldset>
            <fieldset class="border p-2" id="archivos">
              <legend class="w-auto">Archivos</legend>
              <div class="form-group row">
                <div class="col-md-3">
                  <label>Constancia de Matrícula* :</label>
                </div>
                <div class="col-md-5">
                    <label for="matricula" class="subir">
                        <i class="fas fa-cloud-upload-alt"></i> Subir archivo
                    </label>
                    <input id="matricula" @change="validarMatricula" onchange='cambiarMatriculaBachiller()' type="file" accept="application/pdf" style='display: none;'/>
                    <span id="info">Ningún archivo seleccionado</span>
                </div>  
                <div class="col-md-4">
                  <label>( Formato PDF - Tamaño Max. 1MB )</label>
                </div>
              </div>
              <div class="form-group row">
                <div class="col-md-3">
                  <label>Constancia de Egresado* :</label>
                </div>
                
                <div class="col-md-5">
                    <label for="egresado" class="subir">
                        <i class="fas fa-cloud-upload-alt"></i> Subir archivo
                    </label>
                    <input id="egresado" @change="validarEgresado" onchange='cambiarEgresadoBachiller()' type="file" accept="application/pdf" style='display: none;'/>
                    <span id="info2">Ningún archivo seleccionado</span>
                </div> 
                <div class="col-md-4">
                  <label>( Formato PDF - Tamaño Max. 1MB )</label>
                </div>
              </div>
              <div class="form-group row">
                <div class="col-md-3">
                  <label>Foto del Solicitante* :</label>
                </div>
                <div class="col-md-5">
                    <label for="foto" class="subir">
                        <i class="fas fa-cloud-upload-alt"></i> Subir archivo
                    </label>
                    <input id="foto" @change="validarFoto" onchange='cambiarFotoBachiller()' type="file" accept="image/jpeg" style='display: none;'/>
                    <span id="info3">Ningún archivo seleccionado</span>
                </div> 
                <div class="col-md-4">
                  <label>( Formato JPG - Tamaño Max. 1MB )</label>
                </div>
              </div>
            </fieldset>
            <fieldset class="border p-2">
              <legend class="w-auto">Datos del trámite</legend>
              <div class="form-group row">
                <div class="col-md-3">
                  <label for="ingreso">Fecha de ingreso de solicitud* :</label>
                </div>
                <div class="col-md-3">
                  <input
                    type="date"
                    max="2030-12-31"
                    id="ingreso"
                    v-model="expedito.ingreso"
                    @change="validafecha()"
                    onkeypress="return soloNumeros(event)"
                    maxlength="3"
                    class="form-control form-control-sm"
                  />
                </div>
                <div class="col-md-3">
                  <label for="comienzo">Fecha de inicio de trámite:</label>
                </div>
                <div class="col-md-3">
                  <input
                    type="date"
                    max="2030-12-31"
                    id="comienzo"
                    v-model="expedito.comienzo"
                    @change="validafecha()"
                    onkeypress="return soloNumeros(event)"
                    maxlength="3"
                    class="form-control form-control-sm"
                  />
                </div>
              </div>
            </fieldset>
            <br />
            <div class="row">
              <div class="col-md-4" style="text-align: center;"></div>
              <div class="col-md-2" id="guardar" style="text-align: center;">
                <button class="btn btn-success" @click="addExpedito(1)">
                  Guardar
                  <i class="fa fa-save"></i>
                </button>
              </div>
              <div class="col-md-2" id="editar" style="text-align: center;">
                <button class="btn btn-success" @click="editExpedito()">
                  Guardar
                  <i class="fa fa-edit"></i>
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

    <div
      class="modal fade"
      id="exampleModal"
      tabindex="-1"
      role="dialog"
      aria-labelledby="exampleModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div
            class="modal-header text-center"
            style="background-color: powderblue !important; color:black; font-weight: bold;"
          >
            <h5 class="modal-titler" id="exampleModalLabel">Buscar Egresado</h5>
            <button
              type="button"
              class="close"
              data-dismiss="modal"
              @click="borrar()"
              aria-label="Close"
            >
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="form-group row">
              <div class="col-md-12">
                <label>Nota: Ingresar DNI o Código Universitario</label>
              </div>
            </div>
            <div class="form-group row">
              <div class="col-md-2">
                <label for="dni1">DNI:</label>
              </div>
              <div class="col-md-4">
                <input
                  type="text"
                  v-model="alumno.dni"
                  id="dni1"
                  onkeypress="return soloNumeros(event)"
                  class="form-control form-control-sm"
                  maxlength="8"
                />
              </div>
              <div class="col-md-2">
                <label for="codigo1">Código:</label>
              </div>
              <div class="col-md-4">
                <input
                  type="text"
                  v-model="alumno.codigo"
                  onkeypress="return soloNumeros(event)"
                  id="codigo1"
                  class="form-control form-control-sm"
                  maxlength="10"
                />
              </div>
            </div>
            <div class="form-group row">
              <div class="col-md-2">
                <label for="nombre1">Egresado:</label>
              </div>
              <div class="col-md-10">
                <input
                  type="text"
                  v-model="alumnos.Nombres"
                  readonly
                  class="form-control form-control-sm"
                />
              </div>
            </div>
            <div class="form-group row">
              <div class="col-md-4" style="text-align: center;">
                <button
                  class="btn btn-primary"
                  @click="buscar(alumno.dni,alumno.codigo,alumno.apellido)"
                >
                  Buscar
                  <i class="fa fa-search"></i>
                </button>
              </div>
              <div class="col-md-4" style="text-align: center;">
                <button class="btn btn-warning" @click="borrar()">
                  Limpiar
                  <i class="fas fa-broom"></i>
                </button>
              </div>
              <div class="col-md-4" style="text-align: center;">
                <button
                  class="btn btn-success"
                  data-dismiss="modal"
                  type="checkbox"
                  @click="seleccionar(alumnos.DNI,alumnos.Codigo,alumnos.Nombres,alumnos.Carrera)"
                >
                  Seleccionar
                  <i class="fas fa-check"></i>
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- final modal -->
    <div class="row" id="expeditos">
      <div class="col-md-12">
        <div class="card card-default">
          <div
            class="card-header text-center"
            style="background-color: powderblue !important; color:black; font-weight: bold;"
          >
            <h4 class="title">EXPEDITOS BACHILLER</h4>
          </div>
          <div class="card-body">
            <div class="content table-responsive table-full-width t12">
              <v-client-table :data="expeditos" :columns="columns" :options="options">
                <div slot="Acciones" slot-scope="props">
                  <button
                    v-if="props.row.Estado == 'PENDIENTE'"
                    v-on:click="estado(props.row.IDExpedito,1)"
                    class="btn btn-danger"
                    data-toggle="tooltip"
                    data-placement="left"
                    title="Hacer click para cambiar de estado"
                    style="padding: 2px 8px; font-size: 12px;"
                  >Pendiente  </button>
                  <button
                    v-if="props.row.Estado == 'EN PROCESO'"
                    v-on:click="estado(props.row.IDExpedito,2)"
                    class="btn btn-warning"
                    data-toggle="tooltip"
                    data-placement="left"
                    title="Hacer click para cambiar de estado"
                    style="padding: 2px 8px; font-size: 12px;"
                  >En Proceso</button>
                  <button
                    v-if="props.row.Estado == 'FINALIZADO'"
                    class="btn btn-success"
                    data-toggle="tooltip"
                    data-placement="left"
                    title="Estado final"
                    style="padding: 2px 8px; font-size: 12px;"
                  >Finalizado  </button>
                  <button
                    class="btn btn-primary"
                    v-on:click="edit(props.row.IDExpedito,props.row.Tipo,props.row.CodigoAlumno,props.row.Tomo,props.row.Folio,props.row.Asiento,props.row.NumSesion,props.row.FechaIngreso,props.row.FechaComienzo,props.row.IDSesion,props.row.Fecha,props.row.Escuela,props.row.Alumno,props.row.DNI)"
                    data-placement="left"
                    title="Editar"
                    style="padding: 2px 8px; font-size: 12px;"
                  >
                    <i class="fas fa-edit" style="color: white" aria-hidden="true"></i>
                  </button>
                  <router-link
                    v-if="props.row.Estado == 'FINALIZADO'"
                    class="btn btn-info"
                    target="_blank"
                    :to="'/oficio/'+props.row.IDExpedito"
                    data-toggle="tooltip"
                    data-placement="left"
                    title="Ver oficio"
                    style="padding: 2px 8px; font-size: 12px; color:white;"
                  >
                    <i class="far fa-file-pdf" aria-hidden="true"></i>
                  </router-link>
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
      alumnoz: null,
      archivos: {
        matricula: null,
        egresado: null,
        foto: null
      },
      expedito: {
        idexpedito: null,
        codigo: null,
        dni: null,
        alumno: null,
        carrera: null,
        tomo: null,
        folio: null,
        asiento: null,
        sesion: null,
        sfecha: null,
        stipo: null,
        ingreso: null,
        comienzo: null,
        tipo: "BACHILLER"
      },
      alumno: {
        codigo: null,
        dni: null,
        apellido: null
      },
      alumnos: [],
      sesiones: [],
      expeditos: [
        {
          IDExpedito: null,
          Tipo: null,
          CodigoAlumno: null,
          Acta: null,
          NumSesion: null,
          FechaIngresoAux: null,
          FechaComienzoAux: null,
          Estado: null,
          FechaAux: null,
          Alumno: null
        }
      ],
      columns: [
        "Alumno",
        "Acta",
        "NumSesion",
        "FechaAux",
        "FechaIngresoAux",
        "FechaComienzoAux",
        "Acciones"
      ],
      options: {
        headings: {
          CodigoAlumno: "Código Egresado",
          NumSesion: "Sesión",
          FechaIngresoAux: "Ingr. trámite",
          FechaComienzoAux: "Inic. trámite",
          FechaAux: "F. Sesión",
          Alumno: "Nombre Completo",
          Acta: "   T/F/A   "
        },
        sortable: [
          "Alumno",
          "Acta",
          "NumSesion",
          "FechaAux",
          "FechaIngresoAux",
          "FechaComienzoAux"
        ],
        filterable: [
          "Alumno",
          "Acta",
          "NumSesion",
          "FechaAux",
          "FechaIngresoAux",
          "FechaComienzoAux"
        ]
      }
    };
  },
  created() {
    this.getExpeditos();
    this.getSesiones();
  },
  mounted() {
    $("#objetivo").hide();
    $("#menos").hide();
  },
  methods: {
    buscar(d, c, a) {
      if (d == "") d = null;
      if (c == "") c = null;
      if (a == "") a = null;
      axios
        .get("getAlumnos/" + d + "/" + c + "/" + a)
        .then(data => {
          if (data.data.alumnos[0] == null) {
            swal({
              type: "error",
              title: "Ha ocurrido un error",
              text: "No se encontraron registros"
            });
          } else {
            this.alumnos = data.data.alumnos[0];
          }

          this.$Progress.finish();
        })
        .catch(error => {
          console.log(error);
        });
    },
    cancelar() {
      this.expedito.codigo = null;
      this.expedito.dni = null;
      this.expedito.alumno = null;
      this.expedito.carrera = null;
      this.expedito.tomo = null;
      this.expedito.folio = null;
      this.expedito.asiento = null;
      this.expedito.sesion = null;
      this.expedito.sfecha = null;
      this.expedito.stipo = null;
      this.expedito.ingreso = null;
      this.expedito.comienzo = null;
      this.cambiarCancelarBachiller();
      $("#matricula").val("");
      $("#egresado").val("");
      $("#foto").val("");
      $("#objetivo").hide();
      $("#expeditos").show();
      $("#menos").hide();
      $("#mas").show();
    },
    borrar() {
      this.alumno.codigo = null;
      this.alumno.dni = null;
      this.alumno.apellido = null;

      this.alumnos = [];
    },
    seleccionar(d, c, n, ca) {
      this.expedito.codigo = c;
      this.expedito.dni = d;
      this.expedito.alumno = n;
      this.expedito.carrera = ca;
    },
    getSesiones() {
      this.$Progress.start();
      axios
        .get("getSessions")
        .then(data => {
          this.sesiones = data.data.sesiones;
          this.$Progress.finish();
        })
        .catch(error => {
          console.log(error);
        });
    },
    getSession(e) {
      this.$Progress.start();
      axios
        .get("getSession/" + e)
        .then(data => {
          this.expedito.sfecha = data.data.fecha;
          this.expedito.stipo = data.data.tipo;
          this.$Progress.finish();
        })
        .catch(error => {
          console.log(error);
        });
    },
    validarMatricula(e) {
      var size = e.target.files[0].size;
      var type = e.target.files[0].type;
      if (size > 1024001) {
        e.target.value = "";
        swal({
          type: "error",
          title: 'Ha ocurrido un error',
          text: "El tamaño del archivo debe ser menor o igual a 1MB",
          showConfirmButton: true
        });
        document.getElementById('info').innerHTML = 'Ningún archivo seleccionado';
        return;
      }
      if (type.includes("pdf")) {
        var file = new FileReader();
        file.readAsDataURL(e.target.files[0]);
        file.onload = e => {
          this.archivos.matricula = e.target.result;
          console.log(this.archivos.matricula);
        };
      } else {
        e.target.value = "";
        this.archivos.matricula = null;
        swal({
          type: "error",
         title: 'Ha ocurrido un error',
          text:
            "El archivo debe ser PDF, por favor intente subiendo otro archivo",
          showConfirmButton: true
        });
        return;
      }
    },
    validarEgresado(e) {
      var size = e.target.files[0].size;
      var type = e.target.files[0].type;
      if (size > 1024001) {
        e.target.value = "";
        swal({
          type: "error",
          title: 'Ha ocurrido un error',
          text: "El tamaño del archivo debe ser menor o igual a 1MB",
          showConfirmButton: true
        });
        document.getElementById('info2').innerHTML = 'Ningún archivo seleccionado';
        return;
      }
      if (type.includes("pdf")) {
        var file = new FileReader();
        file.readAsDataURL(e.target.files[0]);
        file.onload = e => {
          this.archivos.egresado = e.target.result;
        };
        console.log(this.archivos.matricula);
      } else {
        e.target.value = "";
        swal({
          type: "error",
          title: 'Ha ocurrido un error',
          text:
            "El archivo debe ser PDF, por favor intente subiendo otro archivo",
          showConfirmButton: true
        });
        return;
      }
    },
    validarFoto(e) {
      var size = e.target.files[0].size;
      var type = e.target.files[0].type;
      if (size > 1024001) {
        e.target.value = "";
        swal({
          type: "error",
          title: 'Ha ocurrido un error',
          text: "El tamaño del archivo debe ser menor o igual a 1MB",
          showConfirmButton: true
        });
        document.getElementById('info3').innerHTML = 'Ningún archivo seleccionado';
        return;
      }
      if (type.includes("image")) {
        var file = new FileReader();
        console.log(e.target.files[0]);
        file.readAsDataURL(e.target.files[0]);
        file.onload = e => {
          this.archivos.foto = e.target.result;
          console.log(this.archivos.foto);
        };
      } else {
        e.target.value = "";
        swal({
          type: "error",
          title: 'Ha ocurrido un error',
          text:
            "El archivo debe ser una imagen, por favor intente subiendo otro archivo",
          showConfirmButton: true
        });
        return;
      }
    },
    getExpeditos() {
      this.$Progress.start();
      axios
        .get("getExpeditos")
        .then(data => {
          this.expeditos = data.data.expeditosb;
          this.$Progress.finish();
          console.log(data.data);
        })
        .catch(error => {
          console.log(error);
        });
    },
    cambiarCancelarBachiller(){    
    document.getElementById('info').innerHTML = 'Ningún archivo seleccionado';
    document.getElementById('info2').innerHTML = 'Ningún archivo seleccionado';
    document.getElementById('info3').innerHTML = 'Ningún archivo seleccionado';
    },
    addExpedito(e) {
      if (
        this.expedito.codigo == null ||
        this.expedito.dni == null ||
        this.expedito.alumno == null ||
        this.expedito.carrera == null ||
        this.expedito.tomo == null ||
        this.expedito.folio == null ||
        this.expedito.asiento == null ||
        this.expedito.sesion == null ||
        this.expedito.sfecha == null ||
        this.expedito.stipo == null ||
        this.expedito.ingreso == null ||
        this.archivos.foto == null ||
        this.archivos.egresado == null ||
        this.archivos.matricula == null
      ) {
        swal({
          type: "warning",
          title: "Llenar los campos obligatorios",
          //allowOutsideClick: false,
          timer: 3000
        });
      } else if (e == 1) {
        this.$Progress.start();
        axios
          .post("addExpedito", {
            expedito: this.expedito,
            archivos: this.archivos
          })
          .then(data => {
            swal({
              // position: 'top-end',
              type: data.data.type,
              title: data.data.title,
              text: data.data.text,
              showConfirmButton: false,
              timer: 3000
            });
            this.$Progress.finish();
            // setTimeout(() => {
            //     location.reload();
            // }, 1500);
            this.cancelar();
            this.getExpeditos();
          })
          .catch(error => {
            console.log(error);
            swal({
              type: "error",
              title: 'Ha ocurrido un error',
              text: "Comuníquese con un administrador",
              showConfirmButton: true
            });
          });
      }
    },
    ocultar(id) {
      if (id == "1") {
        $("#objetivo").show();
        $("#buscar").show();
        $("#archivos").show();
        $("#guardar").show();
        $("#expeditos").hide();
        $("#editar").hide();
        $("#menos").show();
        $("#mas").hide();
        $("#labelInicio").show();      
      } else if (id == "2") {
        $("#objetivo").hide();
        $("#archivos").hide();
        $("#editar").hide();
        $("#guardar").hide();
        $("#buscar").hide();
        $("#expeditos").show();
        $("#menos").hide();
        $("#mas").show();
        $("#labelInicio").hide();             
      }
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
    estado(id, tipo) {
      this.$Progress.start();

      if (tipo == 1) {
        swal({
          title: "¿Deseas cambiar el estado de este expedito?",
          text: "El estado cambiará a En Proceso",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#3085d6",
          cancelButtonColor: "#d33",
          confirmButtonText: "Sí",
          cancelButtonText: "Cancelar"
        }).then(result => {
          if (result.value) {
            axios
              .get("/updateExpedito/" + id + "/" + tipo)
              .then(data => {
                if (data.data == "OK") {
                  swal(
                    "¡Buen trabajo!",
                    "El Expedito está ahora En Proceso",
                    "success"
                  );
                  this.$Progress.finish();
                  setTimeout(() => {
                    location.reload();
                  }, 2000);
                }
              })
              .catch(error => {
                console.log("Ocurrió un error " + error);
                this.$Progress.fail();
              });
          }
        });
      } else {
        swal({
          title: "¿Deseas cambiar el estado de este expedito?",
          text: "El estado cambiará a Finalizado",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#3085d6",
          cancelButtonColor: "#d33",
          confirmButtonText: "Sí",
          cancelButtonText: "Cancelar"
        }).then(result => {
          if (result.value) {
            axios
              .get("/updateExpedito/" + id + "/" + tipo)
              .then(data => {
                if (data.data == "OK") {
                  swal(
                    "¡Buen trabajo!",
                    "El Expedito cambió a Finalizado.",
                    "success"
                  );
                  this.$Progress.finish();
                  setTimeout(() => {
                    location.reload();
                  }, 2000);
                }
              })
              .catch(error => {
                console.log("Ocurrió un error " + error);
                this.$Progress.fail();
              });
          }
        });
      }
    },
    edit(
      IDExpedito,
      Tipo,
      CodigoAlumno,
      Tomo,
      Folio,
      Asiento,
      NumSesion,
      FechaIngreso,
      FechaComienzo,
      IDSesion,
      Fecha,
      Escuela,
      Alumno,
      DNI
    ) {
      $("#objetivo").show();
      $("#expeditos").hide();
      $("#archivos").hide();
      $("#buscar").hide();
      $("#labelInicio").hide();
      $("#mas").hide();
      $("#editar").show();
      $("#guardar").hide();
      this.expedito.idexpedito = IDExpedito;
      this.expedito.codigo = CodigoAlumno;
      this.expedito.dni = DNI;
      this.expedito.alumno = Alumno;
      this.expedito.carrera = Escuela;
      this.expedito.tomo = Tomo;
      this.expedito.folio = Folio;
      this.expedito.asiento = Asiento;
      this.expedito.sesion = NumSesion;
      this.expedito.sfecha = Fecha;
      this.expedito.stipo = Tipo;
      this.expedito.ingreso = FechaIngreso;
      this.expedito.comienzo = FechaComienzo;
    },
    editExpedito() {
      if (
        this.expedito.codigo == null ||
        this.expedito.dni == null ||
        this.expedito.alumno == null ||
        this.expedito.carrera == null ||
        this.expedito.tomo == null ||
        this.expedito.folio == null ||
        this.expedito.asiento == null ||
        this.expedito.sesion == null ||
        this.expedito.sfecha == null ||
        this.expedito.stipo == null ||
        this.expedito.ingreso == null
      ) {
        swal({
          type: "warning",
          title: "Llenar los campos obligatorios",
          timer: 3000
        });
        return;
      } else {
        this.$Progress.start();
        axios
          .post("updateExpedito", {
            expedito: this.expedito
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
            // setTimeout(() => {
            //     location.reload();
            // }, 1500);
            this.cancelar();
            this.getExpeditos();
          })
          .catch(error => {
            console.log(error);
            swal({
              type: "error",
              title: 'Ha ocurrido un error',
              text: "Comuníquese con un administrador",
              showConfirmButton: true
            });
          });
      }
    }
  }
};
</script>
