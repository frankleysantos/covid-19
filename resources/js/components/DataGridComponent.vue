<template>
<div>
<b-button variant="danger" @click="download">XLSX</b-button>
</div>
</template>

<script>

export default {
  data() {
    return {
      json: {
        data: [
          { name: "Tom", phone: "+86 01012", email: "000@gmail.com" },
          { name: "Jack", phone: "+86 01012", email: "000@gmail.com" },
          { name: "Alice", phone: "+86 01012", email: "000@gmail.com" }
        ],
        head: ['name', 'phone', 'email'],
        fileName: "download.xlsx"
      }
    };
  },
  methods: {
    download() {
      const { data, head, fileName } = this.json;
      jsontoexcel.getXlsx(data, head, fileName);
    }
  }
}
</script>
