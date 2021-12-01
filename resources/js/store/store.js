import Vue from 'vue'
import Vuex from 'vuex'

import paciente from './modules/paciente'
import vacina from './modules/vacina'
import relatorio from './modules/relatorio'
import vacpaciente from './modules/vacpaciente'

Vue.use(Vuex);

const store = new Vuex.Store({
    modules:{
        relatorio,
        paciente,
        vacina,
        vacpaciente
    }
})

export default store