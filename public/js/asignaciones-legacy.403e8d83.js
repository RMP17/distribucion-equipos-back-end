(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["asignaciones"],{ca38:function(t,e,i){"use strict";i.r(e);var n=function(){var t=this,e=t.$createElement,i=t._self._c||e;return i("v-container",{attrs:{fluid:""}},[i("v-layout",{attrs:{row:""}},[i("v-text-field",{staticClass:"pa-0",attrs:{color:"blue darken-4","background-color":"blue lighten-5","append-icon":"search",label:"Buscar...","single-line":"","hide-details":""},model:{value:t.search,callback:function(e){t.search=e},expression:"search"}})],1),i("v-data-table",{attrs:{"disable-initial-sort":"",headers:t.dataTable.headers,items:t.dataTable.estaciones,search:t.search},scopedSlots:t._u([{key:"items",fn:function(e){return[i("td",[t._v(t._s(e.item.nro_estacion))]),i("td",[t._v(t._s(e.item.nro_counter_c))]),i("td",[t._v(t._s(e.item.nro_counter_r))]),i("td",["f"===e.item.tipo_estacion?i("span",[t._v("Fija")]):i("span",[t._v("Móvil")])]),i("td",[t._v(t._s(e.item.direccion))]),i("td",[t._v(t._s(e.item.tecnico?e.item.tecnico.nombre_completo:""))]),i("td",[t._v(t._s(e.item.kit?e.item.kit.id:""))]),i("td",[t._v(t._s(e.item.notario?e.item.notario.nombre_completo:""))]),i("td",[t._v(t._s(e.item.notario?e.item.notario.ci:""))]),i("td",[t._v(t._s(e.item.notario?e.item.notario.extension:""))]),i("td",[t._v(t._s(e.item.notario?e.item.notario.celular:""))]),i("td",[t._v(t._s(e.item.notario?e.item.notario.empresa_telefonica:""))]),i("td",{staticClass:"justify-center"},[i("v-btn",{staticClass:"square",attrs:{color:"info",flat:"",title:"Accesorios"},on:{click:function(i){return t.editEstacion(e.item)}}},[i("v-icon",[t._v("edit")])],1),i("v-btn",{staticClass:"square",attrs:{color:"info",flat:"",title:"Imprimir"},on:{click:function(i){return t.getEquiposByKit(e.item)}}},[i("v-icon",[t._v("print")])],1),i("v-btn",{staticClass:"square",attrs:{color:"accent",flat:"",title:"Imprimir"},on:{click:function(i){return t.getEquiposByKit(e.item)}}},[i("v-icon",[t._v("print")])],1)],1)]}}])},[i("v-alert",{attrs:{value:!0,color:"error",icon:"warning"},scopedSlots:t._u([{key:"no-results",fn:function(){return[t._v('\n            Your search for "'+t._s(t.search)+'" found no results.\n        ')]},proxy:!0}])})],1),i("component-asignacion",{ref:"componentsAsignacion",attrs:{"edit-data":t.selectedEstacion},on:{registerSuccess:t.getEstaciones}}),i("component-print-asignacion",{ref:"componentPrintAsignacion",attrs:{"print-data":t.printEstacion}})],1)},o=[],a=i("c09d"),s=i("bc3a"),r=i.n(s),c=i("7acb"),l=function(){var t=this,e=t.$createElement,i=t._self._c||e;return i("div",[i("v-dialog",{attrs:{scrollable:"",persistent:"","max-width":"600px"},model:{value:t.dialog,callback:function(e){t.dialog=e},expression:"dialog"}},[i("v-card",[i("v-card-title",{staticClass:"grey lighten-2"},[i("v-layout",{attrs:{"align-center":"","justify-space-between":"","fill-height":""}},[i("span",{staticClass:"title"},[t._v("Asignar")]),i("v-btn",{staticClass:"square",attrs:{color:"secondary",flat:""},on:{click:function(e){t.dialog=!t.dialog}}},[i("v-icon",[t._v("close")])],1)],1)],1),i("v-card-text",[i("v-container",[i("v-form",{ref:"form",attrs:{"lazy-validation":""},model:{value:t.valid,callback:function(e){t.valid=e},expression:"valid"}},[i("v-text-field",{attrs:{color:"blue darken-4","background-color":"blue lighten-5",box:"",rules:t.rules.ci,label:"Dirección"},model:{value:t.estacion.direccion,callback:function(e){t.$set(t.estacion,"direccion",e)},expression:"estacion.direccion"}}),i("v-autocomplete",{attrs:{color:"blue darken-4",box:"","background-color":"blue lighten-5",items:t.tecnicos,loading:t.searchTecnico.isLoading,"search-input":t.inputTecnico,"hide-no-data":"","hide-selected":"","item-text":"nombre","item-value":"id",label:"Técnico",placeholder:"Comience a escribir para buscar","return-object":""},on:{"update:searchInput":function(e){t.inputTecnico=e},"update:search-input":function(e){t.inputTecnico=e}},scopedSlots:t._u([{key:"item",fn:function(e){var n=e.item;e.index;return[i("v-layout",{attrs:{"align-center":"","justify-space-between":"","fill-height":""}},[i("v-flex",{attrs:{xs8:""}},[i("span",{staticClass:"v-text-field--full-width"},[t._v(t._s(n.nombre))])]),i("v-flex",{staticClass:"text-xs-right"},[i("span",[t._v(t._s(n.ci))])])],1)]}}]),model:{value:t.searchTecnico.tecnico,callback:function(e){t.$set(t.searchTecnico,"tecnico",e)},expression:"searchTecnico.tecnico"}}),i("v-text-field",{attrs:{color:"blue darken-4","background-color":"blue lighten-5",rules:t.rules.nombre,label:"Número de Kit",box:"",required:""},model:{value:t.estacion.kit_id,callback:function(e){t.$set(t.estacion,"kit_id",e)},expression:"estacion.kit_id"}}),i("v-autocomplete",{attrs:{color:"blue darken-4",box:"","background-color":"blue lighten-5",items:t.notarios,loading:t.searchTecnico.isLoading,"search-input":t.inputNotario,"hide-no-data":"","hide-selected":"","item-text":"nombre","item-value":"id",label:"Notario",placeholder:"Comience a escribir para buscar","return-object":""},on:{"update:searchInput":function(e){t.inputNotario=e},"update:search-input":function(e){t.inputNotario=e}},scopedSlots:t._u([{key:"item",fn:function(e){var n=e.item;e.index;return[i("v-layout",{attrs:{"align-center":"","justify-space-between":"","fill-height":""}},[i("v-flex",{attrs:{xs8:""}},[i("span",{staticClass:"v-text-field--full-width"},[t._v(t._s(n.nombre))])]),i("v-flex",{staticClass:"text-xs-right"},[i("span",[t._v(t._s(n.ci))])])],1)]}}]),model:{value:t.searchNotario.notario,callback:function(e){t.$set(t.searchNotario,"notario",e)},expression:"searchNotario.notario"}})],1)],1)],1),i("v-card-actions",[i("v-spacer"),i("v-btn",{attrs:{color:"blue darken-1",outline:""},on:{click:function(e){t.dialog=!1}}},[t._v("Cerrar")]),i("v-btn",{staticClass:"text",attrs:{color:"info",depressed:""},on:{click:t.submit}},[t._v("Enviar")])],1)],1)],1)],1)},d=[],u=i("fac0"),p={props:{editData:{default:null}},data:function(){return{dialog:!1,valid:!0,rules:{ci:[function(t){return!!t||"Cédula de identidad es requerido"}],extension:[function(t){return!!t||"Extensión requerido"}],nombre:[function(t){return!!t||"Nombre es requerido"}],apellido1:[function(t){return!!t||"Primer Apellido es requerido"}],celular:[function(t){return!!t||"Celular es requerido"}]},searchTecnico:{descriptionLimit:60,entries:[],isLoading:!1,tecnico:null,count:null},inputTecnico:null,searchNotario:{descriptionLimit:60,entries:[],isLoading:!1,notario:null,count:null},inputNotario:null,estacion:new u["a"],selectedEstacion:null}},watch:{inputTecnico:function(t){var e=this;this.tecnicos.length>0||this.searchTecnico.isLoading||(this.searchTecnico.isLoading=!0,fetch(this.$urlApi.resourcesTecnico).then(function(t){return t.json()}).then(function(t){e.searchTecnico.count=t,e.searchTecnico.entries=t}).catch(function(t){console.log(t)}).finally(function(){return e.searchTecnico.isLoading=!1}))},inputNotario:function(t){var e=this;this.notarios.length>0||this.searchNotario.isLoading||(this.searchNotario.isLoading=!0,fetch(this.$urlApi.resourcesNotario).then(function(t){return t.json()}).then(function(t){e.searchNotario.count=t,e.searchNotario.entries=t}).catch(function(t){console.log(t)}).finally(function(){return e.searchNotario.isLoading=!1}))}},computed:{tecnicos:function(){var t=this;return this.searchTecnico.entries.map(function(e){var i=e.nombre.length>t.searchTecnico.descriptionLimit?e.nombre.slice(0,t.searchTecnico.descriptionLimit)+"...":e.nombre;return Object.assign({},e,{nombre:i})})},notarios:function(){var t=this;return this.searchNotario.entries.map(function(e){var i=e.nombre.length>t.searchNotario.descriptionLimit?e.nombre.slice(0,t.searchNotario.descriptionLimit)+"...":e.nombre;return Object.assign({},e,{nombre:i})})}},methods:{submit:function(){this.$refs.form.validate()&&this.update()},update:function(){var t=this,e=this.estacion;this.searchTecnico.tecnico&&(e.tecnico_id=this.searchTecnico.tecnico.id),this.searchNotario.notario&&(e.notario_id=this.searchNotario.notario.id),r.a.put(this.$urlApi.resourcesEstacion+"/"+e.id,e).then(function(e){t.$toastr("success","","TAREA REALIZADA CON ÉXITO"),t.dialog=!1,t.$nextTick(function(){t.estacion=new u["a"],t.searchNotario.notario=null,t.valid=!0}),t.$emit("registerSuccess")}).catch(function(e){t.$notifyErrors(e)})},openDialog:function(){Object.assign(this.estacion,this.editData),this.dialog=!0}}},h=p,_=i("2877"),v=Object(_["a"])(h,l,d,!1,null,null,null),m=v.exports,f=function(){var t=this,e=t.$createElement,i=t._self._c||e;return t.printData&&t.printData.equipos?i("div",{staticClass:"section-to-print"},[i("div",{ref:"printArea"},[i("div",{staticClass:"title text-xs-center pb-3"},[t._v("ACTA DE RECEPCIÓN - UNIDAD DE EMPADRONAMIENTO")]),i("v-layout",{attrs:{"align-center":"","justify-space-between":"",row:"","fill-height":"","pb-3":""}},[i("span",[t._v("Tipo de estación: "),i("span",{staticClass:"font-weight-bold"},[t._v(t._s("f"===t.printData.tipo_estacion?"Fija":"Móvil"))])]),i("span",[t._v("Estación: "),i("span",{staticClass:"font-weight-bold"},[t._v(t._s(t.printData.nro_estacion))])]),i("span",[t._v("Nº Counter: "),i("span",{staticClass:"font-weight-bold"},[t._v(t._s(t.printData.nro_counter_r))])])]),i("table",{staticClass:"print-table",staticStyle:{"min-width":"100%","border-collapse":"collapse"}},[t._m(0),i("tbody",[t._l(t.printData.equipos,function(e){return i("tr",["e"===e.tipo?[i("td",{staticClass:"caption"},[t._v("\n                        "+t._s(e.descripcion)+"\n                        "),t._l(e.accesorios,function(e){return i("span",[t._v("+"+t._s(e.tipo_accesorio))])})],2),i("td",{staticClass:"text-xs-center caption",domProps:{textContent:t._s(e.modelo)}}),i("td",{staticClass:"text-xs-center caption",domProps:{textContent:t._s(e.nro_serie)}}),i("td")]:t._e()],2)}),t._m(1),t._l(t.printData.equipos,function(e){return i("tr",["o"===e.tipo?[i("td",{staticClass:"caption"},[t._v("\n                        "+t._s(e.descripcion)+"\n                        "),t._l(e.accesorios,function(e){return i("span",[t._v("+"+t._s(e.tipo_accesorio))])})],2),i("td",{staticClass:"text-xs-center caption",domProps:{textContent:t._s(e.modelo)}}),i("td",{staticClass:"text-xs-center caption",domProps:{textContent:t._s(e.nro_serie)}}),i("td")]:t._e()],2)})],2)]),i("table",{staticClass:"print-table mt-3",staticStyle:{"min-width":"100%","border-collapse":"collapse"}},[t._m(2),i("tbody",[t._l(t.printData.equipos,function(e){return i("tr",["e"===e.tipo?[i("td",{staticClass:"caption"},[t._v("\n                        "+t._s(e.descripcion)+"\n                        "),t._l(e.accesorios,function(e){return i("span",[t._v("+"+t._s(e.tipo_accesorio))])})],2),i("td"),i("td"),i("td")]:t._e()],2)}),t._m(3),t._l(t.printData.equipos,function(e){return i("tr",["o"===e.tipo?[i("td",{staticClass:"caption"},[t._v("\n                        "+t._s(e.descripcion)+"\n                        "),t._l(e.accesorios,function(e){return i("span",[t._v("+"+t._s(e.tipo_accesorio))])})],2),i("td"),i("td"),i("td")]:t._e()],2)})],2)]),i("table",{staticClass:"print-table mt-3",staticStyle:{"min-width":"100%","border-collapse":"collapse"}},[t._m(4),i("tbody",t._l(t.printData.equipos,function(e){return i("tr",["e"===e.tipo?[i("td",{staticClass:"caption"},[t._v("\n                        "+t._s(e.descripcion)+"\n                        "),t._l(e.accesorios,function(e){return i("span",[t._v("+"+t._s(e.tipo_accesorio))])})],2),i("td"),i("td"),i("td")]:t._e()],2)}),0)]),t._m(5),i("table",{staticClass:"print-table mt-3 font-weight-bold",staticStyle:{"min-width":"100%","border-collapse":"collapse"}},[i("tr",[i("td",{staticStyle:{background:"blanchedalmond"},attrs:{colspan:"2",width:"70%"}},[t._v("NOTARIO : "+t._s(t.printData.notario?t.printData.notario.nombre:""))]),t._m(6)]),i("tr",{staticStyle:{background:"blanchedalmond"}},[i("td",[t._v("C.I. : "+t._s(t.printData.notario?t.printData.notario.ci:""))]),i("td",{attrs:{width:"35%"}},[t._v("FECHA :")])]),i("tr",[i("td",{staticStyle:{background:"blanchedalmond"},attrs:{colspan:"2"}},[t._v("RECIBIDO POR : "+t._s(t.printData.tecnico?t.printData.tecnico.nombre:""))]),t._m(7)]),i("tr")]),t._m(8)],1)]):t._e()},b=[function(){var t=this,e=t.$createElement,i=t._self._c||e;return i("thead",{staticStyle:{background:"blanchedalmond"}},[i("th",{attrs:{width:"35%"}},[t._v("ESTADO FÍSICO DE LOS EQUIPOS")]),i("th",[t._v("MODELO")]),i("th",[t._v("NÚMERO SERIAL")]),i("th",[t._v("OBSERVACIONES")])])},function(){var t=this,e=t.$createElement,i=t._self._c||e;return i("tr",{staticStyle:{background:"blanchedalmond"}},[i("td",{attrs:{colspan:"4"}},[t._v("OTROS")])])},function(){var t=this,e=t.$createElement,i=t._self._c||e;return i("thead",{staticStyle:{background:"blanchedalmond"}},[i("tr",[i("th",{attrs:{rowspan:"2",width:"35%"}},[t._v("ESTADO FÍSICO DE LOS EQUIPOS")]),i("th",{attrs:{colspan:"2"}},[t._v("CONDICIÓN")]),i("th",{attrs:{rowspan:"2",width:"35%"}},[t._v("OBSERVACIONES")])]),i("tr",[i("th",{attrs:{width:"15%"}},[t._v("buena")]),i("th",{attrs:{width:"15%"}},[t._v("mala")])])])},function(){var t=this,e=t.$createElement,i=t._self._c||e;return i("tr",{staticStyle:{background:"blanchedalmond"}},[i("td",{attrs:{colspan:"4"}},[t._v("OTROS")])])},function(){var t=this,e=t.$createElement,i=t._self._c||e;return i("thead",{staticStyle:{background:"blanchedalmond"}},[i("tr",[i("th",{attrs:{rowspan:"2",width:"35%"}},[t._v("Resultado Tester")]),i("th",{attrs:{colspan:"2"}},[t._v("FUNCIÓN")]),i("th",{attrs:{rowspan:"2",width:"35%"}},[t._v("OBSERVACIONES")])]),i("tr",[i("th",{attrs:{width:"15%"}},[t._v("CORRECTA")]),i("th",{attrs:{width:"15%"}},[t._v("INCORECTA")])])])},function(){var t=this,e=t.$createElement,i=t._self._c||e;return i("table",{staticClass:"print-table mt-3",staticStyle:{"min-width":"100%","border-collapse":"collapse"}},[i("thead",{staticStyle:{background:"blanchedalmond"}},[i("tr",[i("th",{attrs:{rowspan:"2",width:"35%"}},[t._v("PRUEBAS")]),i("th",{attrs:{colspan:"2"}},[t._v("RESULTADO")]),i("th",{attrs:{rowspan:"2",width:"35%"}},[t._v("OBSERVACIONES")])]),i("tr",[i("th",{attrs:{width:"15%"}},[t._v("SI")]),i("th",{attrs:{width:"15%"}},[t._v("NO")])])]),i("tbody",[i("tr",[i("td",[t._v("¿Obtención de respaldo de Datos?")]),i("td"),i("td"),i("td")]),i("tr",[i("td",[t._v("¿Obtención de respaldo de Logs?")]),i("td"),i("td"),i("td")]),i("tr",[i("td",[t._v("¿Obtención de reporte Gral. Estadístico de Nuevos Registros?")]),i("td"),i("td"),i("td")]),i("tr",[i("td",[t._v("¿Obtención de reporte Gral. Estadístico de Cambio de Domicilio?")]),i("td"),i("td"),i("td")]),i("tr",[i("td",[t._v("¿Impresión de Checkconfig?")]),i("td"),i("td"),i("td")])])])},function(){var t=this,e=t.$createElement,i=t._self._c||e;return i("th",{attrs:{rowspan:"2"}},[i("br"),i("br"),t._v("FIRMA NOTARIO")])},function(){var t=this,e=t.$createElement,i=t._self._c||e;return i("th",{attrs:{rowspan:"2"}},[i("br"),i("br"),t._v("FIRMA RESPONSABLE TICs")])},function(){var t=this,e=t.$createElement,i=t._self._c||e;return i("span",{staticClass:"caption"},[i("span",{staticClass:"font-weight-bold"},[t._v("NOTA:")]),t._v("\n        El Formulario 002 debidamente llenado y firmado por el personal que realizo  deberá estar acompañado por la impresion resultante de las pruebas de Tester y la impresión resultante de el momento de su entrega al personal responsable de la Revsión de equipos de Estaciones de Registro Biométrico\n    ")])}],g={props:{printData:{default:null}},data:function(){return{}},watch:{},computed:{},methods:{printAsignacion:function(){this.printData&&this.printData.kit?this.$printCustom(this.$refs.printArea):this.$notifyErrorsLocal(["No tiene un kit asignado"])}}},C=g,E=Object(_["a"])(C,f,b,!1,null,null,null),x=E.exports,w={components:{ComponentAccesorio:c["a"],ComponentEquipo:a["a"],ComponentAsignacion:m,ComponentPrintAsignacion:x},mounted:function(){var t=this;this.$nextTick(function(){t.getEstaciones()})},data:function(){return{dataTable:{headers:[{text:"Nro Estación",value:"nro_estacion"},{text:"Nro Counter C",value:"nro_counter_c"},{text:"Nro Counter R",value:"nro_counter_r"},{text:"Tipo de estación",value:"tipo_estacion"},{text:"Dirección",value:"direccion"},{text:"Tecnico",value:"tecnico.nombre_completo"},{text:"Nro Kit",value:"kit.id"},{text:"Notario",value:"notario.nombre_completo"},{text:"C.I.",value:"notario.ci"},{text:"Ext.",value:"notario.extension"},{text:"Celular",value:"notario.extension"},{text:"Emp. Tel.",value:"notario.empresa_telefonica"},{text:"",sortable:!1,value:""}],estaciones:[]},search:"",selectedEstacion:null,printEstacion:null}},computed:{},methods:{getEstaciones:function(){var t=this;r.a.get(this.$urlApi.resourcesEstacion).then(function(e){t.dataTable.estaciones=e.data}).catch(function(t){console.log("error servidor")})},editEstacion:function(t){var e=this;this.selectedEstacion=t,this.$nextTick(function(){e.$refs.componentsAsignacion.openDialog()})},getEquiposByKit:function(t){var e=this;r.a.get(this.$urlApi.getEquiposByKit+t.kit_id).then(function(i){e.printEstacion=t,e.printEstacion.equipos=i.data}).catch(function(t){console.log("error servidor")}).then(function(t){e.$refs.componentPrintAsignacion.printAsignacion()})}}},k=w,N=Object(_["a"])(k,n,o,!1,null,null,null);e["default"]=N.exports}}]);
//# sourceMappingURL=asignaciones-legacy.403e8d83.js.map