<template>
  <div>

    <Error v-bind:error="error"></Error>
    <Spinner v-bind:loading="loading"></Spinner>


    <input type="file" @change="uploadFile" ref="file" >
    <button @click="submitFile">Upload</button>


  </div>
</template>

<script>

const axios = require('axios').default;

import Error from './mixins/Error.vue'
import Spinner from './mixins/Spinner.vue'


export default {
  components: {
    Error, Spinner
  },
  data() {
    return {
      selfURL: globals.selfURL,
      error: false,
      loading: false


    };
  },
  created: function () {

  },
  mounted() {

  },
  methods: {

    uploadFile() {
      this.Images = this.$refs.file.files[0];
    },
    submitFile() {

      const formData = new FormData();
      formData.append('file', this.Images);
      this.loading = true;
      var that = this;
      const headers = { 'Content-Type': 'multipart/form-data' };
      axios.post(this.selfURL+'&task=upload', formData, { headers })
      .then((response) => {

        //response.data.files; // binary representation of the file
        //response.status; // HTTP status

        if ( response.data ) {
          if (response.data.error == false) {
            //that.loadList();
            console.log(response.data.msg);
          } else {
            that.error = ''+response.data.msg;
          }
        } else {
          that.error = 'Fehler beim Laden. 01';
        }

      })
      .catch(function(){
        that.error = 'Fehler beim Laden. 02';
      })
      .finally(function () {
        // always executed
        that.loading = false;
      });
    }


  }

};
</script>

<style>

</style>