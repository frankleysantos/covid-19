<template>
<div>
relatórios
{{compRelatorioVacinados}}
</div>
</template>

<script>
export default {
methods: {
    relatorio: function() {
        this.$store.dispatch('relatorioVacinados')
    }
},
computed: {
    compRelatorioVacinados() {
        return this.$store.state.relatorio.relatorio; 
    }
},
}
</script>

<style>

</style>