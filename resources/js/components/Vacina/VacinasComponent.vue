<template>
<div>
    <vue-snotify></vue-snotify>
    <b-form @submit.prevent="onSubmit">
      <b-row class="form-group">
      <b-col>
          <b-form-input
            v-model="vacina.nome"
            type="text"
            placeholder="Vacina"
            :state="comp_erro_nome"
          ></b-form-input>
          <b-form-invalid-feedback :state="comp_erro_nome">
            Vacina deve ser maior que 3 caracteres
          </b-form-invalid-feedback>
      </b-col>

      <b-col>
          <b-form-input
            v-model="vacina.dose"
            type="number"
            placeholder="Dose"
            :state="comp_erro_dose"
          ></b-form-input>
          <b-form-invalid-feedback :state="comp_erro_dose">
          Insira a quantidade minima de doses    
          </b-form-invalid-feedback>
      </b-col>

      <b-col>
        <b-input-group>
          <b-form-input
            v-model="vacina.dias"
            type="number"
            placeholder="Dias"
            :state="comp_erro_dias"
          ></b-form-input>
          <b-input-group-append>
            <b-button type="submit" variant="primary">Salvar</b-button>
          </b-input-group-append>
        </b-input-group>
        <b-form-invalid-feedback :state="comp_erro_dias">
          Insira o intervalo de dias    
        </b-form-invalid-feedback>
      </b-col>
      </b-row>
    </b-form>

    <!-- bootstrap-vue table -->
    <!-- {{prop_vacinas}} -->

  <b-row  align-h="end">
    <b-col md="3">
      <b-form-group
            label="Por página"
            label-for="per-page-select"
            label-cols="4"
            label-size="sm"
            label-align-sm="right"
          >
            <b-form-select
              id="per-page-select"
              v-model="perPage"
              :options="pageOptions"
              size="sm"
            ></b-form-select>
      </b-form-group>
    </b-col>
  </b-row> 
  <b-table striped hover :items="vacinas" :fields="fields" :current-page="currentPage"
    :per-page="perPage">
    <template #cell(acoes)="data">
            <button class="btn btn-info" @click="delVacina(data.item.id)">Delete</button>
    </template>
  </b-table>
  <b-row  align-h="end">
    <b-col md="4">
      <b-pagination
            v-model="currentPage"
            :total-rows="totalRows"
            :per-page="perPage"
            align="fill"
            size="sm"
            class="my-0"
          ></b-pagination>
    </b-col>
  </b-row>
</div>
</template>

<script>

export default {
    created(){
        this.showVacinas();
    },
    data(){
        return {
            vacina: {
                nome: '',
                dias:'',
                dose:'',
            },
            vacinas: [],
            fields: [
                {
                    key: 'nome',
                    label: 'Nome',
                    sortable: true
                },
                {
                    key: 'dias',
                    label: 'Dias',
                    sortable: false
                },
                {
                    key: 'dose',
                    label: 'Doses',
                    sortable: true,
                },
                {
                    key: 'acoes',
                    label: 'Ações',
                    sortable: true
                }
            ],
            totalRows: 1,
            currentPage: 1,
            perPage: 5,
            pageOptions: [5, 10, 20, { value: 100, text: "Mostrar Todos" }],
    }
    },
    methods: {
        onSubmit: function(){
            this.$snotify.confirm('Deseja cadastrar nova Vacina?', 'Vacina', {
              timeout: 5000,
              showProgressBar: true,
              closeOnClick: false,
              pauseOnHover: true,
              icon: 'assets/img/vacina.png',
              buttons: [
                {text: 'Sim', action: (toast) => {
                  if(!this.comp_erro_nome || !this.comp_erro_dose || !this.comp_erro_dias){
                    return true;
                  }     

                  this.$store.dispatch('storeVacina', this.vacina)
                              .finally(()=>{
                                this.vacina.nome = this.vacina.dias = this.vacina.dose = '';
                              })
                  this.$snotify.remove(toast.id); 
                }},
                {text: 'Não', action: (toast) => {this.$snotify.remove(toast.id); }, bold: true},
              ]
            });
        },
        showVacinas: function(){
            return this.$store.dispatch('showVacinas')
                                .then((e) => {
                                    this.vacinas = this.$store.state.vacina.vacinas;
                                    this.totalRows = this.vacinas.length;
                                });
        },
        delVacina: function($id){
          alert($id);
                return this.$store.dispatch('excluirVacina', $id)
                                .then((e) => {
                                    
                                });
        }
    },
    computed: {
        prop_vacinas(){
            return this.$store.state.vacina.vacinas;
        },
        comp_erro_nome() {
          return this.vacina.nome.length > 4;
        },
        comp_erro_dias() {
          return this.vacina.dias.length != '';
        },
        comp_erro_dose() {
          return this.vacina.dose > 0;
        }
    }
}
</script>

<style>

</style>