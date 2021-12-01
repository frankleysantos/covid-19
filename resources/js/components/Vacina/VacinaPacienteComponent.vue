<template>
<div>
<vue-snotify></vue-snotify>
<b-card-group deck>
    <b-card
      header="Dados do Paciente"
      header-tag="header"
      footer=" "
      footer-tag="footer"
      :title="paciente.nome"
    >
      <b-card-text>CPF: {{paciente.cpf}}</b-card-text>
      <b-card-text>Telefone: {{paciente.telefone}}</b-card-text>
    </b-card>

    <b-card header-tag="header" footer-tag="footer">
      <template #header>
        <h6 class="mb-0">Vacinas</h6>
      </template>
      <!-- formulario de registro de vacina -->
        <b-form @submit.prevent="onSubmitVacina">
            <b-row class="">
                <b-col>
                    <b-form-input
                        class="d-none"
                        v-model="vacina_pac.paciente_id"
                        type="number"
                    ></b-form-input>
                    <b-input-group>
                        <b-form-select v-model="vacina_pac.vacina_id" class="mb-3" :state="comp_erro_vacina">
                            <b-form-select-option :value="null" disabled>Selecione a Vacina..</b-form-select-option>
                            <b-form-select-option :disabled="verifica(item.id)"  :value="item.id" v-for="item in vacina" :key="item.id">{{item.nome}}</b-form-select-option>
                        </b-form-select>
                        <b-input-group-append v-if="doses.tomadas < doses.qnt || doses.tomadas == 0 && doses.qnt == 0">
                            <b-button type="submit" variant="primary">Salvar</b-button>
                        </b-input-group-append>
                    </b-input-group>
                    <b-form-invalid-feedback :state="comp_erro_vacina">
                        Selecione uma Vacina para Registrar
                    </b-form-invalid-feedback>
                    <!-- <div class="mt-2">Selected: <strong>{{ vacina_pac.vacina_id }}</strong></div> -->
                </b-col>
            </b-row>
        </b-form>
    
      <template #footer>
        
      </template>
    </b-card>
</b-card-group>

<!-- historico de vacinas -->
<b-card
      header="Cartão de Vacina"
      header-tag="header"
      footer=" "
      footer-tag="footer"
      class="mt-2"
    >
    <!-- {{comp_doses_tomadas[0]}} -->
    <b-table striped hover :items="comp_doses_tomadas[0]" :fields="fields">
        <template #cell(dt_vacina)="data">
            {{ moment(data.item.dt_vacina).format('DD/MM/YYYY')}}
        </template>

        <template #cell(prox_vacina)="data">
            <div v-if="doses.tomadas < doses.qnt || doses.tomadas == 0 && doses.qnt == 0">
                {{ moment(data.item.dt_vacina).add(data.item.dias, 'days').format('DD/MM/YYYY')}}
            </div>
            <div v-else><b-icon icon="calendar-minus" aria-hidden="true"></b-icon>Concluído</div>
        </template>
    </b-table>
</b-card>
</div>
</template>

<script>

export default {
created(){
    this.onDosesTomadas();  
},
mounted () {
    this.vacina_pac.paciente_id = this.paciente.id;
    this.vacina_pac.paciente = this.paciente.nome;
    if(this.vacinado[0]){
        this.vacina_pac.vacina_id = this.vacinado[0].vacina_id;
    }
    
},
data() {
    return {
        count: 0,
        doses: {
            tomadas: 0,
            qnt: 0
        },
        vacina_pac: {
            vacina_id: null,
            paciente_id: null,
            paciente: null,            
        },
        fields: [
                {
                    key: 'nome',
                    label: 'Nome',
                    sortable: true
                },
                {
                    key: 'vacina',
                    label: 'Vacina',
                    sortable: true
                },
                {
                    key: 'dt_vacina',
                    label: 'Data Vacina',
                    sortable: true
                },
                {
                    key: 'prox_vacina',
                    label: 'Prox. Vacina',
                    sortable: true
                }
        ],
    }
},
methods: {
    onSubmitVacina: function() {
        // alert('teste');
        this.$snotify.confirm('Deseja registrar vacina para este paciente?', 'Paciente / Vacina', {
              timeout: 5000,
              showProgressBar: true,
              closeOnClick: false,
              pauseOnHover: true,
              icon: '/covid-19/public/assets/img/vacina.png',
              buttons: [
                {text: 'Sim', action: (toast) => {
                  if(!this.comp_erro_vacina){
                    return true;
                  }     
                  return this.$store.dispatch('storePacVacina', this.vacina_pac)
                              .then(() => {
                                  this.doses.tomadas = this.$store.state.vacpaciente.reg_vacinas[1].qnt_tomadas;
                                  this.doses.tomadas = this.doses.tomadas+1;
                              })
                              .finally((e)=>{
                                if(this.$store.state.vacpaciente.reg_vacinas[2]){
                                    this.doses.qnt = this.$store.state.vacpaciente.reg_vacinas[2].dose;
                                }else{
                                    this.onDosesTomadas();
                                }
                                

                                // console.log(this.doses.qnt)
                                this.$snotify.remove(toast.id); 
                              })
                }},
                {text: 'Não', action: (toast) => {this.$snotify.remove(toast.id); }, bold: true},
              ]
        });
    },
    onDosesTomadas: function(){
            let pac_id = this.paciente.id
            return this.$store.dispatch('showPacVacinado', pac_id)
                            .then(() => {
                                this.doses.tomadas = this.$store.state.vacpaciente.reg_vacinas[1].qnt_tomadas
                            })
                            .finally(() =>{
                                if(this.$store.state.vacpaciente.reg_vacinas[2])
                                    this.doses.qnt = this.$store.state.vacpaciente.reg_vacinas[2].dose;
                            })
    },
    verifica: function(id){
        if(id != this.vacina_pac.vacina_id && this.vacinado[0]){
            return true
        }
    }
},
props: ['paciente', 'vacina', 'vacinado'],
computed: {
    comp_erro_vacina() {
        return this.vacina_pac.vacina_id != null;
    },
    comp_doses_tomadas(){
        return this.$store.state.vacpaciente.reg_vacinas;
    },
    desabilita(){
        return true;
        // return this.comp_doses_tomadas[1].qnt_tomadas == 1;
    }
},

}
</script>

<style>

</style>