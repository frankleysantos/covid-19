require('./bootstrap');

window.Vue = require('vue').default;

import Vue from 'vue';
import store from './store/store';
import VueTheMask from 'vue-the-mask';
Vue.use(VueTheMask);

import Snotify from 'vue-snotify'
Vue.use(Snotify)

import { BootstrapVue, IconsPlugin } from 'bootstrap-vue';
Vue.use(BootstrapVue);
Vue.use(IconsPlugin);

import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'

import { jsontoexcel } from "vue-table-to-excel";
Vue.use(jsontoexcel);

import moment from 'moment';
Vue.prototype.moment = moment

Vue.component('paciente-component', require('./components/Paciente/PacienteComponent.vue').default)

Vue.component('form-paciente-component', require('./components/Paciente/includes/FormPacienteComponent.vue').default)

Vue.component('cadastro-paciente-component', require('./components/Paciente/CadastroPacienteComponent.vue').default)

Vue.component('show-pacientes-component', require('./components/Paciente/includes/PacientesComponent').default);

Vue.component('editar-paciente-component', require('./components/Paciente/EditarPacienteComponent.vue').default)

Vue.component('card-component', require('./components/Paciente/includes/CardComponent.vue').default);
Vue.component('header-component', require('./components/layouts/HeaderComponent.vue').default);

Vue.component('bootstrap-component', require('./components/bootstrapComponent.vue').default)
Vue.component('data-grid-component', require('./components/DataGridComponent.vue').default)

// vacinas 
Vue.component('vacinas-component', require('./components/Vacina/VacinasComponent.vue').default);
Vue.component('paciente-vacinas-component', require('./components/Vacina/VacinaPacienteComponent.vue').default);
Vue.component('relatorio-vacinas-component', require('./components/Relatorio/RelatorioComponent.vue').default);

const app = new Vue({
    store,
    el: '#app',
});
