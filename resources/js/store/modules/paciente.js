import Axios from "axios"

export default {

    state: {
        pacientes: [],
        paciente: []
    },

    mutations:{
       SHOW_PACIENTES(state, show_pacientes){
            state.pacientes = show_pacientes;
       },
       NOVO_PACIENTE(state, novo_paciente){
        state.pacientes.push(novo_paciente);  
       },
       GET_PACIENTE(state, show_paciente){
        state.paciente = show_paciente;
       },
    
       DEL_PACIENTE(state, id){
        let index = state.pacientes.findIndex(p => p.id == id)
        state.pacientes.splice(index, 1)
       },
    },

    actions:{
        storePaciente(context, parametros){
            return Axios.post('paciente/store', parametros)
                        .then(response => context.commit('NOVO_PACIENTE', response.data))
        },
        editPaciente(context,id){
            return Axios.get('paciente/edit/'+id)
                        .then(response => context.commit('GET_PACIENTE',response.data));
        },
        showPacientes(context){
            return Axios.get('paciente/show')
                        .then(response=> context.commit('SHOW_PACIENTES', response.data))
        },
        updatePaciente(context, parametros){
            return Axios.post('/covid-19/public/paciente/update', parametros)
                        .then(response => {})
        },
        deletePaciente(context,id, state){
            return Axios.get('paciente/delete/'+id)
                        .then(() => context.commit('DEL_PACIENTE', id));
        },
    },

    getters:{
       
    }
}