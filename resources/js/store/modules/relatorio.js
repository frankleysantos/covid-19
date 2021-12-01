import Axios from "axios"

export default {

    state: {
        relatorio: [],
    },

    mutations:{
       SHOW_VACINADOS(state, show_vacinas){
           state.vacinas = show_vacinas;
       }
    },

    actions:{
        relatorioVacinados(context){
            return Axios.get('relatorio/vacinados')
                        .then(response => context.commit('SHOW_VACINADOS', response.data));
        }
    },

    getters:{
       
    }
}