import Axios from "axios"

export default {

    state: {
        vacinas: [],
        vacina: [],
    },

    mutations:{
       NOVA_VACINA(state, nova_vacina){
        console.log(nova_vacina);
        state.vacinas.push(nova_vacina);  
       },
       SHOW_VACINAS(state, show_vacinas){
           state.vacinas = show_vacinas;
       },
       DEL_VACINA(state, id){
        let index = state.vacinas.findIndex(p => p.id == id)
        state.vacinas.splice(index, 1)
       },
    },

    actions:{
        storeVacina(context, parametros){
            return Axios.post('vacina/store', parametros)
                        .then(response => context.commit('NOVA_VACINA', response.data))
        },
        showVacinas(context){
            return Axios.get('vacina/showVacinas')
                        .then(response => context.commit('SHOW_VACINAS', response.data));
        },
        excluirVacina(context, id){
            return Axios.get('vacina/deletar/'+id)
                        .then(response => context.commit('DEL_VACINA', id));
        }
    },

    getters:{
       
    }
}