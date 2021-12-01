<template>
    <div class="action-buttons">
        <a class="btn btn-outline-success" :href="'paciente/vacina/'+data.id">
            <b-icon icon="file-earmark-spreadsheet" aria-hidden="true"></b-icon>
        </a>
        <a class="btn btn-outline-primary" :href="'paciente/edit/'+data.id"><b-icon icon="pencil-square" aria-hidden="true"></b-icon></a>
        <button class="btn btn-outline-danger" @click="delPaciente(data.id)">
            <b-icon icon="trash" aria-hidden="true"></b-icon>
        </button>
    </div>
</template>
<script>

export default {
    props: ['data'],
};
</script>