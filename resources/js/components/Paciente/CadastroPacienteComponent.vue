<template>
  <div class="container">
      <h1>Cadastro de Pacientes</h1>
      <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item">
          <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Cadastro</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Pacientes</a>
        </li>
        <!-- <li class="nav-item">
          <a class="nav-link" id="paciente-vacina-tab" data-toggle="tab" href="#paciente-vacina" role="tab" aria-controls="paciente-vacina" aria-selected="false">Vacinados</a>
        </li> -->
      </ul>

      <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
          <div class="card">
            <div class="card-body">  
                <form-paciente-component></form-paciente-component>
            </div>
          </div>  
        </div>

        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
          <div class="card">
            <div class="card-body">
              <show-pacientes-component></show-pacientes-component>
            </div>
          </div>
        </div>

        <div class="tab-pane fade" id="paciente-vacina" role="tabpanel" aria-labelledby="profile-tab">
          <div class="card">
            <div class="card-body">
              <!-- {{paciente_id}} -->
              <!-- <paciente-vacinas-component v-on:incrementar="adicionarQuantidade"></paciente-vacinas-component> -->
            </div>
          </div>
        </div>

      </div>
      
      
  </div>
</template>

<script>

export default {
data() {
  return {
    paciente_id : 0
  }
},
methods: {
  adicionarQuantidade() {
      this.paciente_id = 1;
      alert(this.paciente_id);
  }
},
}
</script>

<style>

</style>