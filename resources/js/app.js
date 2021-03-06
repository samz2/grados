/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
import VueRouter from 'vue-router';
import VueProgressBar from 'vue-progressbar';
import swal from 'sweetalert2';
import { ServerTable, ClientTable, Event } from 'vue-tables-2';
import vSelect from 'vue-select';
import VueApexCharts from 'vue-apexcharts';

const options = {
  color: '#bffaf3',
  failedColor: '#874b4b',
  thickness: '5px',
  transition: {
    speed: '0.2s',
    opacity: '0.6s',
    termination: 300
  },
  autoRevert: true,
  location: 'left',
  inverse: false
}
window.Vue = require('vue');
window.swal = swal;
Vue.use(ClientTable);
Vue.use(VueProgressBar, options);
Vue.use(VueRouter);

const routes = [
    { path: '/home', component: require('./components/admin/home.vue').default },
    { path: '/egresados', component: require('./components/admin/egresados.vue').default },
    { path: '/gestion-proyecto', component: require('./components/admin/gestionp.vue').default },
    { path: '/docentes', component: require('./components/admin/docentes.vue').default },
    { path: '/expeditobachiller', component: require('./components/admin/expeditob.vue').default },
    { path: '/expeditotitulo', component: require('./components/admin/expeditot.vue').default },
    { path: '/tramite', component: require('./components/admin/tramite.vue').default },
    { path: '/estados', component: require('./components/admin/estado.vue').default },
    { path: '/carreras', component: require('./components/admin/carreras.vue').default },
    { path: '/comisiones', component: require('./components/admin/comisiones.vue').default },
    { path: '/decano', component: require('./components/admin/decano.vue').default },
    { path: '/modalidad', component: require('./components/admin/modalidad.vue').default },
    { path: '/calificacion', component: require('./components/admin/calificacion.vue').default },
    { path: '/reporte-bachiller', component: require('./components/admin/reporteb.vue').default },
    { path: '/reporte-titulo', component: require('./components/admin/reportet.vue').default },
    { path: '/sesion', component: require('./components/admin/sesiones.vue').default },
    { path: '/lineas-de-investigacion', component: require('./components/admin/linea.vue').default },
    { path: '/proyecto-de-tesis', component: require('./components/admin/proyecto.vue').default },
  ];


const router = new VueRouter({
    mode: "history",
    routes, // short for `routes: routes`
  });
/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('egresadosT', require('./components/templates/egresados.vue').default);
Vue.component('error', require('./components/templates/error.vue').default);
Vue.component('gestionproyecto', require('./components/templates/gestionproyectos.vue').default);
Vue.component('docente', require('./components/templates/docente.vue').default);
Vue.component('expeditob', require('./components/templates/expeditob.vue').default);
Vue.component('expeditot', require('./components/templates/expeditot.vue').default);
Vue.component('tramite', require('./components/templates/tramite.vue').default);
Vue.component('estado', require('./components/templates/estados.vue').default);
Vue.component('carrera', require('./components/templates/carrera.vue').default);
Vue.component('comision', require('./components/templates/comision.vue').default);
Vue.component('decanos', require('./components/templates/decanos.vue').default);
Vue.component('modalidades', require('./components/templates/modalidades.vue').default);
Vue.component('calificaciones', require('./components/templates/calificaciones.vue').default);
Vue.component('lineas', require('./components/templates/lineas.vue').default);
Vue.component('sesiones', require('./components/templates/sesion.vue').default);
Vue.component('proyectos', require('./components/templates/proyectos.vue').default);
Vue.component('reportesb', require('./components/templates/reportesb.vue').default);
Vue.component('reportest', require('./components/templates/reportest.vue').default);
Vue.component('grafica', require('./components/grafica.vue').default);
Vue.component('v-select', vSelect);
Vue.component('apexchart', VueApexCharts);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
// var component = require('./components/grafica.vue');
const app = new Vue({
    el: '#app',
    // components:
    // {
    //   component
    // },
    router
});

// const app = new Vue({
//     router
// }).$mount('#app');