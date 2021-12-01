<template>
<div>
  <main class="py-4">
      <slot name="header"></slot>
  </main>
</div>
</template>

<script>
export default {
  props: {
    conteudo: String,
  }
}
</script>

<style>

</style>