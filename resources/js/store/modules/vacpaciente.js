import Axios from "axios"

export default {

    state: {
        reg_vacinas: [],
    },

    mutations:{
       PAC_VACINA(state, nova_vacina){
        console.log(nova_vacina);
        state.reg_vacinas[0].push(nova_vacina);  
       },
       SHOW_PAC_VACINAS(state, show_vacinas){
           state.reg_vacinas = show_vacinas;
       }
    },

    actions:{
        storePacVacina(context, parametros){
            return Axios.post('/covid-19/public/paciente/vacina/registrar', parametros)
                        .then(response => context.commit('PAC_VACINA', response.data))
        },
        showPacVacinado(context,id){
            return Axios.get('/covid-19/public/paciente/vacinado/'+id)
                        .then(response => context.commit('SHOW_PAC_VACINAS', response.data));
        },
    },

    getters:{
       
    }
}