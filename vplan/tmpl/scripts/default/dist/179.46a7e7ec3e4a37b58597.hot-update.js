"use strict";self.webpackHotUpdateextensions(179,{5761:(t,r,o)=>{o.d(r,{Z:()=>i});var n=o(5586),s=o(4912),e=o(4559).default;const i={components:{Error:n.Z,Spinner:s.Z},data:function(){return{apiURL:globals.apiURL,error:!1,loading:!1,list:!1,indexList:!1,sort:{column:"stunde",order:!0},searchColumns:["klasse","stunde","user_neu","user_alt","fach_alt","fach_neu","raum","info"],searchString:""}},created:function(){this.loadList()},computed:{vlist:function(){var t=this;if(this.indexList>=0&&this.list[this.indexList]&&this.list[this.indexList].data){var r=this.list[this.indexList].data;if(""!=this.searchString){var o=this.searchString.toLowerCase().split(" "),n=[],s=[];this.searchColumns.forEach((function(t){(n=r.filter((function(r){return o.every((function(o){return r[t].toLowerCase().includes(o)}))}))).length>0&&(s=Object.assign(s,n))})),r=s}return this.sort.column&&r.length>0&&r[0][this.sort.column]?(console.log(this.sort.order),this.sort.order?r.sort((function(r,o){return r[t.sort.column].localeCompare(o[t.sort.column])})):r.sort((function(r,o){return o[t.sort.column].localeCompare(r[t.sort.column])}))):r}return[]}},mounted:function(){},watch:{sort:{handler:function(t,r){t.order!=r.order&&console.log("watch")},deep:!0}},methods:{handlerSort:function(t){t&&(this.sort.column=t,console.log("hand",this.sort.order),1==this.sort.order?this.sort.order=!1:this.sort.order=!0)},handlerDate:function(t,r){this.indexList=r},loadList:function(){this.loading=!0;var t=this;e.get(this.apiURL+"/getList").then((function(r){r.data?r.data.error?t.error=""+r.data.msg:(t.list=r.data,t.indexList=0):t.error="Fehler beim Laden. 01"})).catch((function(){t.error="Fehler beim Laden. 02"})).finally((function(){t.loading=!1}))}}}}},(function(t){t.h=()=>"05604628d25c2bcd48a6"}));