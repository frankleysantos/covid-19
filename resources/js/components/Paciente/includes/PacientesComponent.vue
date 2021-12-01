<template>
  <div>   
      <vue-snotify></vue-snotify>  
      <div class="card">
        <div class="card-header">Pacientes Cadastrados</div>

        <div class="card-body">
            <scale-loader :loading="loading"></scale-loader>
            <main>
                <data-table v-bind="parametersTable1"></data-table>
            </main>
        </div>
      </div>
      <!-- {{prop_pacientes}} -->
  </div>
</template>

<script>

import ButtonComponent from "./ButtonsComponent.vue";
import "bootstrap/dist/css/bootstrap.min.css";
import "@andresouzaabreu/vue-data-table/dist/DataTable.css";
import DataTable from "@andresouzaabreu/vue-data-table";
Vue.component("data-table", DataTable);

import ScaleLoader from 'vue-spinner/src/ScaleLoader.vue';

export default {
    // dispararar o metodos showPacientes
    name: "ActionButtons",
    created(){
        
        this.showPacientes();
        // this.rows = this.prop_pacientes
    },
    data(){
        return {
            pacientes: [],
            loading: false,
        }
    },
    computed: {
        prop_pacientes(){
            return this.$store.state.paciente.pacientes;
        },
        parametersTable1() {
        var dados = this.$store.state.paciente.pacientes
        return {
            data: dados,
            // actionMode: "multiple",
            // actionMode: "single",
            lang: 'pt-br',
            // actions: ["view"],
            columns: [
                { 
                    key: "nome",
                    title: "Paciente"
                },
                { 
                    key: "telefone",
                    title: "Telefone"
                },
                {
                    key: "cpf",
                    title: "CPF",
                    // sortable: false
                },
                {
                    title: "Ações",
                    /* custom function sort users by which user has more permissions */
                    
                    component: ButtonComponent,

                }
            ]
        };
        },
    }, 
    methods: {
        showPacientes(){
            this.loading = true;
            return this.$store.dispatch('showPacientes')
                        // .then(()=> this.rows = this.$store.state.paciente.pacientes)
                        .then(() => {
                            return this.$store.state.paciente.pacientes
                            // var newData = this.$store.state.paciente.pacientes.data;
                            // console.log(newData);
                            // $('.yajra-datatable').DataTable({
                            //     data: newData,
                            //     columns: [
                            //         {label: 'nome', data: 'nome'},
                            //         {label: 'cpf', data: 'cpf'},
                            //         {label: 'telefone', data: 'telefone'},
                            //     ]
                            // });
                        })
                        .finally(()=> {
                            // $('#datatable').DataTable();
                            this.loading = false
                        })
                        // .bind(this);
        },
    },
    components: {
        ScaleLoader,
        // VuejsDatatableFactory
    }
}
</script>

<style scoped>
#table {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
}
main {
  padding: 32px;
}
</style>