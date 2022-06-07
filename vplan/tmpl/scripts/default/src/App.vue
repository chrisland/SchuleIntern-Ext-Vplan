<template>
  <div>

    <Error v-bind:error="error"></Error>
    <Spinner v-bind:loading="loading"></Spinner>


    <input type="search"  v-model="searchString" placeholder="Suche..."  />


    <div class="si-btn-multiple">

      <button v-if="list && list.length >= 1" v-bind:key="index" v-for="(item, index) in  list"
              class="si-btn margin-r-s" :class="{'si-btn-active' : index == indexList}" v-on:click="handlerDate(item, index)">
        <span v-if="index == 0">Heute - </span>
        <span v-if="index == 1">Morgen - </span>
        {{item.date}}</button>

    </div>


    <table class="si-table" >
      <thead>
        <tr>
          <th v-on:click="handlerSort('klasse')" class="curser-sort">Klasse(n)</th>
          <th v-on:click="handlerSort('stunde')" class="curser-sort">Stunde</th>
          <th v-on:click="handlerSort('user_neu')" class="curser-sort">Vertreter</th>
          <th v-on:click="handlerSort('fach_neu')" class="curser-sort">Fach</th>
          <th v-on:click="handlerSort('raum')" class="curser-sort">Raum</th>
          <th v-on:click="handlerSort('fach_alt')" class="curser-sort">(Fach)</th>
          <th v-on:click="handlerSort('user_alt')" class="curser-sort">(Lehrer)</th>
          <th v-on:click="handlerSort('info')" class="curser-sort">Info</th>
        </tr>
      </thead>
      <tbody>
        <tr v-if="vlist && vlist.length >= 1" v-bind:key="index" v-for="(item, index) in  vlist"
          class="">
          <td>{{item.klasse}}</td>
          <td>{{item.stunde}}</td>
          <td>{{item.user_neu}}</td>
          <td>{{item.fach_neu}}({{item.fach_alt}})</td>
          <td>{{item.raum}}</td>
          <td><span class="text-grey">{{item.fach_alt}}</span></td>
          <td><span class="text-grey">{{item.user_alt}}</span></td>
          <td>{{item.info}}</td>
        </tr>
        <tr v-if="vlist.length == 0">
          <td colspan="8"> - keine Inhalte vorhanden -</td>
        </tr>

      </tbody>
    </table>

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
      apiURL: globals.apiURL,
      error: false,
      loading: false,

      list: false, // from AJAX

      indexList: false,

      sort: {
        column: 'stunde',
        order: true
      },
      searchColumns: ['klasse', 'stunde', 'user_neu', 'user_alt', 'fach_alt','fach_neu','raum','info'],
      searchString: '',


      renderComponent: true

    };
  },
  created: function () {

    this.loadList();

  },
  computed: {
    vlist: function () {
      if (this.indexList >= 0 && this.list[this.indexList] && this.list[this.indexList].data) {

        let data = this.list[this.indexList].data;
        if (data.length > 0) {

          // SUCHE
          if (this.searchString != '') {
            let split = this.searchString.toLowerCase().split(' ');
            var search_temp = [];
            var search_result = [];
            this.searchColumns.forEach(function (col) {
              search_temp = data.filter((item) => {
                return split.every(v => item[col].toLowerCase().includes(v));
              });
              if (search_temp.length > 0) {
                search_result = Object.assign(search_result, search_temp);
              }
            });
            data = search_result;
          }

          // SORTIERUNG
          if (this.sort.column ) {
            if (this.sort.order) {
              return data.sort((a, b) => a[this.sort.column].localeCompare(b[this.sort.column]))
            } else {
              return data.sort((a, b) => b[this.sort.column].localeCompare(a[this.sort.column]))
            }
          }

          return data;

        }

      }
      return [];
    }


  },
  mounted() {

  },
  /*
  watch: {

    sort: {
      handler: function (val, oldVal) {

        console.log(val.order , oldVal.order);
        if (val.order != oldVal.order) {
          console.log('watch');
        }
      },
      deep: true
    }
  },
  */

  methods: {

    /*
    forceRerender() {
      // Removing my-component from the DOM
      this.renderComponent = false;

      this.$nextTick(() => {
        // Adding the component back in
        this.renderComponent = true;
      });
    },
    */

    handlerSort: function (column) {
      if (column) {
        this.sort.column = column;
        console.log('hand', this.sort.order);
        if (this.sort.order == true) {
          this.sort.order = false;
        } else {
          this.sort.order = true;
        }
        //this.forceRerender();
      }
    },

    handlerDate: function (item, index) {
      //console.log(index, item);
      this.indexList = index;

    },

    loadList: function () {

      this.loading = true;
      var that = this;
      axios.get( this.apiURL+'/getList')
      .then(function(response){
        if ( response.data ) {
          if (response.data.error) {
            that.error = ''+response.data.msg;
          } else {
            that.list = response.data;
            that.indexList = 0;
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