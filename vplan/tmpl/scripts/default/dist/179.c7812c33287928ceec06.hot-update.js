"use strict";self.webpackHotUpdateextensions(179,{5761:(t,e,a)=>{a.d(e,{Z:()=>s});var r=a(1398),n=a(5586),i=a(4912),o=a(4167),d=a(4559).default;const s={components:{Error:n.Z,Spinner:i.Z,User:r.Z,Item:o.Z},data:function(){return{apiURL:globals.apiURL,selfURL:globals.selfURL,error:!1,loading:!1,list:!1,images:null}},created:function(){this.loadList()},mounted:function(){},methods:{uploadFile:function(){this.Images=this.$refs.file.files[0]},submitFile:function(){var t=new FormData;t.append("file",this.Images),this.loading=!0;var e=this;d.post(this.selfURL+"&task=upload",t,{headers:{"Content-Type":"multipart/form-data"}}).then((function(t){t.data?0==t.data.error?console.log(t.data.msg):e.error=""+t.data.msg:e.error="Fehler beim Laden. 01"})).catch((function(){e.error="Fehler beim Laden. 02"})).finally((function(){e.loading=!1}))},handlerCloseSlot:function(t){var e=new FormData;e.append("id",t.id),this.loading=!0;var a=this;d.post(this.apiURL+"/closeSlotAdmin",e,{headers:{"Content-Type":"multipart/form-data"}}).then((function(t){t.data?0==t.data.error?a.loadList():a.error=""+t.data.msg:a.error="Fehler beim Laden. 01"})).catch((function(){a.error="Fehler beim Laden. 02"})).finally((function(){a.loading=!1}))},handlerClose:function(t){var e=new FormData;e.append("id",t.id),this.loading=!0;var a=this;d.post(this.apiURL+"/closeAdmin",e,{headers:{"Content-Type":"multipart/form-data"}}).then((function(t){t.data?0==t.data.error?a.loadList():a.error=""+t.data.msg:a.error="Fehler beim Laden. 01"})).catch((function(){a.error="Fehler beim Laden. 02"})).finally((function(){a.loading=!1}))},loadList:function(){this.loading=!0;var t=this;d.get(this.apiURL+"/getList").then((function(e){e.data?e.data.error?t.error=""+e.data.msg:t.list=e.data:t.error="Fehler beim Laden. 01"})).catch((function(){t.error="Fehler beim Laden. 02"})).finally((function(){t.loading=!1}))},handlerFreigeben:function(t){var e=new FormData;e.append("id",t.id),this.loading=!0;var a=this;d.post(this.apiURL+"/openAdmin",e,{headers:{"Content-Type":"multipart/form-data"}}).then((function(t){t.data?0==t.data.error?a.loadList():a.error=""+t.data.msg:a.error="Fehler beim Laden. 01"})).catch((function(){a.error="Fehler beim Laden. 02"})).finally((function(){a.loading=!1}))}}}},8062:(t,e,a)=>{a.r(e),a.d(e,{render:()=>r,staticRenderFns:()=>n});var r=function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("div",[a("Error",{attrs:{error:t.error}}),t._v(" "),a("Spinner",{attrs:{loading:t.loading}}),t._v(" "),a("table",{staticClass:"si-table"},[t._m(0),t._v(" "),a("tbody",[t._l(t.list,(function(e,r){return t.list&&t.list.length>=1?a("tr",{key:r},[a("td",[t._v(t._s(e.date)+"}")]),t._v(" "),a("td",[t._v(t._s(e.klasse)+"}")]),t._v(" "),a("td",[t._v(t._s(e.stunde)+"}")])]):t._e()})),t._v(" "),0==t.list.length?a("tr",[a("td",{attrs:{colspan:"7"}},[t._v(" - keine Inhalte vorhanden -")])]):t._e()],2)])],1)},n=[function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("thead",[a("tr",[a("td",[t._v("Datum")]),t._v(" "),a("td",[t._v("Klasse(n)")]),t._v(" "),a("td",[t._v("Stunde")]),t._v(" "),a("td",[t._v("Vertreter")]),t._v(" "),a("td",[t._v("Fach")]),t._v(" "),a("td",[t._v("Raum")]),t._v(" "),a("td",[t._v("(Fach)")]),t._v(" "),a("td",[t._v("(Lehrer)")]),t._v(" "),a("td",[t._v("Info")])])])}];r._withStripped=!0}},(function(t){t.h=()=>"5177727e124f5bd04908"}));