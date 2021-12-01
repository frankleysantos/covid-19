<template>
  <div style="padding: 3px">
        <p v-if="errors.length">
            <b>Por favor, corrija o(s) seguinte(s) erro(s):</b>
            <ul>
                <li v-for="(error, index) in errors" :key="index">{{ error }}</li>
            </ul>
        </p>
        <form action="#" @submit.prevent="formSubmit" method="POST">
            <div class="form-group row">
                <label for="inputName" class="col-sm-1-12 col-form-label"></label>
                <div class="col-md">
                    <div>
                        <input class="form-control" v-model="nome" placeholder="Nome Completo"/>
                    </div>
                    <span v-show="nome.lenght < 5" >Deve ter no minimo 5 caracteres</span>
                </div>
                
            </div>
            <div class="form-group row">
                <label for="inputName" class="col-sm-1-12 col-form-label"></label>
                <div class="col-md">
                    <input type="text" class="form-control" v-model="cpf" placeholder="CPF" v-mask="['###.###.###-##']">
                    <!-- <the-mask type="text" class="form-control" :mask="['###.###.###-##']"  v-model="cpf" placeholder="CPF"/> -->
                </div>
            </div>
            <div class="form-group row">
                <label for="inputName" class="col-sm-1-12 col-form-label"></label>
                <div class="col-md">
                    <input type="text" class="form-control" v-mask="['(##) ####-####' ,'(##) #####-####']"  v-model="telefone"  placeholder="(00) 0000-0000 ou (00) 00000-0000">
                    <!-- <the-mask type="text" class="form-control" :mask="['(##) ####-####', '(##) #####-####']"  v-model="telefone"  placeholder="(00) 0000-0000 ou (00) 00000-0000"/> -->
                </div>
            </div>
            <div class="form-group row" v-show="nome">
                <div class="col-md d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary">
                        <pulse-loader :loading="loading" 
                            :color="'#fff'" :size="'12px'" class="float-left">
                        </pulse-loader>
                        Salvar
                    </button>
                </div>
            </div>
        </form>
  </div>
</template>

<script>
import PulseLoader from 'vue-spinner/src/PulseLoader.vue';

export default {
    data(){
        return {
            nome: '',
            cpf: '',
            telefone: '',
            loading: false,
            errors: [],
        }
    },
    methods: {
        formSubmit: function(e){
            e.preventDefault();
            const qnt_chars_nome = 5;
            const qnt_chars_cpf = 14;
  
            if (this.nome && this.nome.length > qnt_chars_nome && this.cpf && this.cpf.length == qnt_chars_cpf && this.telefone) {
                this.loading = true;
                this.$store.dispatch('storePaciente', this._data)
                            .then((e) => {
                                // console.log(e);
                                this.nome = '';
                                this.cpf = '';
                                this.telefone = '';
                            })
                            .finally(() => {
                                this.loading = false
                            });
            }

            this.errors = [];

            if (!this.nome) {
                this.errors.push('O nome é obrigatório.');
            }
            
            if(this.nome.length < qnt_chars_nome){
                    this.errors.push('O campo nome deve conter pelo menos 5 caracteres.');
            }
            if (!this.cpf) {
                this.errors.push('O Campo CPF é obrigatório.');
            }
            if(this.cpf.length < qnt_chars_cpf){
                    this.errors.push('Preencha a quantidade necessária do campo CPF.');
            }
            if (!this.telefone) {
                this.errors.push('O Campo telefone obrigatório.');
            }
            
        },
    },
    components: {
        PulseLoader
    },
    props: ['paciente']
}
</script>

<style scoped>
    .float-left{
        float: left;
    }
</style>