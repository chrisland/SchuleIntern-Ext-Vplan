"use strict";self.webpackHotUpdateextensions(179,{5761:(t,n,r)=>{r.d(n,{Z:()=>e});var o=r(5586),s=r(4912),i=r(4559).default;const e={components:{Error:o.Z,Spinner:s.Z},data:function(){return{apiURL:globals.apiURL,error:!1,loading:!1,list:!1,indexList:!1,sort:{column:!1,order:!0},searchColumns:["klasse","stunde","user_neu","user_alt","fach_alt","fach_neu","raum","info"],searchString:""}},created:function(){this.loadList()},computed:{vlist:function(){var t=this;if(this.indexList>=0&&this.list[this.indexList]&&this.list[this.indexList].data){var n=this.list[this.indexList].data;if(""!=this.searchString){console.log(this.searchString),console.log(n);var r=this.searchString.toLowerCase().split(" "),o=[],s=[];this.searchColumns.forEach((function(t){console.log(t),(o=n.filter((function(n){return r.every((function(r){return n[t].toLowerCase().includes(r)}))}))).length>0&&(console.log(o),s=Object.assign(s,o))})),n=s}return this.sort.column&&n.length>0&&n[0][this.sort.column]?this.sort.order?n.sort((function(n,r){return n[t.sort.column].localeCompare(r[t.sort.column])})):n.sort((function(n,r){return r[t.sort.column].localeCompare(n[t.sort.column])})):n}return[]}},mounted:function(){},methods:{handlerSort:function(t){t&&(this.sort.column=t,this.sort.order?this.sort.order=!1:this.sort.order=!0)},handlerDate:function(t,n){this.indexList=n},loadList:function(){this.loading=!0;var t=this;i.get(this.apiURL+"/getList").then((function(n){n.data?n.data.error?t.error=""+n.data.msg:(t.list=n.data,t.indexList=0):t.error="Fehler beim Laden. 01"})).catch((function(){t.error="Fehler beim Laden. 02"})).finally((function(){t.loading=!1}))}}}}},(function(t){t.h=()=>"0bb55ff0334acea81880"}));