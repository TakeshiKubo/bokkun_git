function JSmarty(){this.initialize();delete (this.initialize);}JSmarty.prototype={config_dir:"configs",compile_dir:"templates_c",plugins_dir:["plugins"],template_dir:"templates",debug_tpl:"",debugging:false,debugging_id:"DEBUGMODE",debugging_ctrl:false,compile_check:true,force_compile:false,caching:0,cache_lifetime:3600,cache_modified_check:false,trusted_dir:[],left_delimiter:"{",right_delimiter:"}",compile_id:null,use_sub_dirs:false,default_modifiers:[],default_resource_type:"file",cache_handler_func:null,autoload_filters:null,config_class:"File",config_overwrite:true,config_booleanize:true,config_read_hidden:false,config_fix_newlines:true,compiler:null,compiler_file:"JSmarty/Compiler.js",compiler_class:"Compiler",default_template_handler_func:null,$vars:{},$foreach:{},$section:{},$filters:{},$template:"",assign:function(C,Z){var R=this.$vars,x=JSmarty.Plugin.get("core.copy_object");if(C instanceof Object){for(var d in C){R[d]=x(C[d]);}}else{if(C!=""){R[C]=x(Z);}}},assign_by_ref:function(Z,o){if(Z!=""){this.$vars[Z]=o;}},append:function(d,C,o){var x,R,S,Z=this.$vars[d];if(d instanceof Object){for(x in d){S=d[x];if(!(Z instanceof Array)){Z=this.$vars[x]=[];}if(o&&S instanceof Object){for(R in S){Z[R]=S[R];}return ;}Z[Z.length]=S;}}else{if(d!=""&&C!=void (0)){return ;}if(!(Z instanceof Array)){Z=this.$vars[d]=[];}if(o&&C instanceof Object){for(x in C){Z[x]=C[x];}return ;}Z[Z.length]=C;}},append_by_ref:function(d,C,o){var R,Z=this.$vars[d];if(d!=""&&C!=void (0)){return ;}if(!(Z instanceof Array)){Z=this.$vars[d]=[];}if(o&&C instanceof Object){for(R in C){Z[R]=C[R];}return ;}Z[Z.length]=C;},clear_assign:function(o){if(o instanceof Array){for(var Z=0,C=o.length;Z<C;Z++){delete (this.$vars[o[Z]]);}return ;}if(o!=""){delete (this.$vars[o]);}},clear_all_assign:function(){this.$vars={};},get_template_vars:function(o){return (o==void (0))?this.$vars:this.$vars[o];},clear_all_cache:function(){this.cache={};},clear_cache:function(k){this.cache[this.getResourceName(k)]=null;},is_cashed:function(k){return !!this.cache[this.getResourceName(k)];},clear_compiled_tpl:function(k){JSmarty.Templatec.remove(this.getResourceName(k));},fetch:function(Z,x,o,d){var k,C,R;Z=this.getResourceName(Z);R=JSmarty.Templatec;R.renderer=this;if(this.isDebugging()){C=JSmarty.Logging;C.time("EXECUTE");C.time("COMPILE");}if(R.isCompiled(Z)||R.newFunction(Z)){if(this.isDebugging()){C.timeEnd("COMPILE");}k=R.call(Z,this);}if(d){JSmarty.System.outputString(k);}if(this.isDebugging()){C.timeEnd("EXECUTE");}return k;},isDebugging:function(){if(!this.debugging&&this.debugging_ctrl){var k=JSmarty.System.getArgs(this.debugging_id);this.debugging=(k.toLowerCase()=="on")?true:false;}return this.debugging;},display:function(o,Z,k){this.fetch(o,Z,k,true);},template_exists:function(k){},initialize:function(){this.cache={};},register_block:function(o,k){JSmarty.Plugin.set("block."+o,k);},unregister_block:function(k){JSmarty.Plugin.unset("block."+k);},register_function:function(o,k){JSmarty.Plugin.set("function."+o,k);},unregister_function:function(k){JSmarty.Plugin.unset("function."+k);},register_modifier:function(o,k){JSmarty.Plugin.set("modifier."+o,k);},unregister_modifier:function(k){JSmarty.Plugin.unset("modifier."+k);},register_resource:function(o,k){if(k instanceof Array&&k.length==4){JSmarty.Plugin.set("resource."+o,k);}else{this.trigger_error("malformed function-list for '"+k+"' in register_resource");}},unregister_resource:function(k){JSmarty.Plugin.unset("resource."+k);},register_compiler_function:function(o,k){JSmarty.Plugin.set("compiler."+o,k);},unregister_compiler_function:function(k){JSmarty.Plugin.unset("compiler."+k);},load_filter:function(k,o){},register_prefilter:function(o){var k=JSmarty.Plugin.get("shared.global")();JSmarty.Plugin.get("prefilter."+o,k[o]);},unregister_prefilter:function(k){JSmarty.Plugin.unset("prefilter."+k);},register_postfilter:function(o){var k=JSmarty.Plugin.get("shared.global")();JSmarty.Plugin.set("postfilter."+o,k[o]);},unregister_postfilter:function(k){JSmarty.Plugin.unset("postfilter."+k);},register_outputfilter:function(o){var k=JSmarty.Plugin.get("shared.global")();JSmarty.Plugin.set("outputfilter."+o,k[o]);},unregister_outputfilter:function(k){JSmarty.Plugin.unset("outputfilter."+k);},trigger_error:function(k,o){JSmarty.Logging[o||"warn"](k,"from","JSmarty");},getCompiler:function(){return this.compiler||function(k){k.compiler=new JSmarty[k.compiler_class](k);return k.compiler;}(this);},getResourceName:function(k){return (0<=k.indexOf(":"))?k:this.default_resource_type+":"+k;},$f:function(k,o){return o;},$p:function(k,a,x,R){var C=JSmarty.Plugin;var Z=(R!=null)?"block":"function";var d,o=C.namespace(Z,k);d=C.get(o,this.plugins_dir);if(Z=="function"){return this.$m(x,d(a,this));}return this.$m(x,d(a,R,this));},$m:function(R,d){var Z=this.plugins_dir;var o,C=JSmarty.Plugin;for(o in R){R[o][0]=d;d=C.get("modifier."+o,Z).apply(null,R[o]);}return d;}};JSmarty.VERSION="0.4.1";JSmarty.Classes=function(k){return new JSmarty.Classes[k]();};JSmarty.Classes.extend=function(k){return function(o){for(var Z in o){k[Z]=o[Z];}return k;};};JSmarty.Classes.create=function(Z){if(typeof (Z)!="function"){return function(){if(this.initialize){this.initialize(arguments);delete (this.initialize);}};}var k=function(){this.getSuper=function(){return Z;};this.superclass=Z.prototype;if(this.initialize){this.initialize(arguments);delete (this.initialize);}};function o(){}o.prototype=Z.prototype;k.prototype=new o();k.prototype.constructor=Z;k.extend=JSmarty.Classes.extend(k.prototype);return k;};JSmarty.Classes.HashMap=JSmarty.Classes.create(null);JSmarty.Classes.HashMap.prototype={$pool:null,$keys:null,$maps:null,initialize:function(){this.clear();},get:function(k){return this.$pool[this.$maps[k]];},put:function(o,Z){var k=this.size();this.$maps[o]=k;this.$pool[k]=Z;this.$keys[k]=o;return Z;},containsKey:function(k){return (k in this.$maps);},containsValue:function(C){var o,Z,k=this.$pool;for(o=0,Z=k.length;o<Z;o++){if(C==k[o]){return true;}}return false;},remove:function(Z){var C,k=this.$maps[Z];this.$pool.splice(k,1);this.$keys.splice(k,1);Z=this.$keys,C=this.$maps;for(k=this.size()-1;0<=k;k--){C[Z[k]]=k;}},clear:function(){this.$maps={};this.$pool=[];this.$keys=[];},clone:function(){return JSmarty.Plugin.get("core.clone")(this);},values:function(){return [].concat(this.$pool);},size:function(){return this.$pool.length;}};JSmarty.Classes.History=JSmarty.Classes.create(JSmarty.Classes.HashMap);JSmarty.Classes.History.extend({put:function(k,o){switch(typeof (o)){case "number":o=new Number(o);break;case "string":o=new JSmarty.Classes.String(o);break;}if(!o.timestamp){o.timestamp=JSmarty.System.timestamp();}return this.superclass.put.call(this,k,o);},update:function(k){}});JSmarty.Classes.Buffer=function(){var Z=0,k=[],C=this;var d=Array.prototype.join;this.append=function(){k[Z++]=d.call(arguments,"");return C;};this.valueOf=this.toString=function(o){return k.join(o||"");};};JSmarty.Classes.Buffer.prototype=new String();JSmarty.Classes.Buffer.prototype.appendIf=function(k){return (k)?this.append:this.NullFunction;};JSmarty.Classes.Buffer.prototype.appendUnless=function(k){return (k)?this.NullFunction:this.append;};JSmarty.Classes.Buffer.prototype.NullFunction=function(){};JSmarty.Classes.Logger=JSmarty.Classes.create(null);JSmarty.Classes.Logger.prototype=(typeof (console)!="undefined")?console:{buffer:null,timeline:null,log:function(){var k=JSmarty.Plugin.get("core.argsformat")(arguments);this.buffer.append(k);return k;},info:function(){this.log("["+info+"]",arguments);},warn:function(){this.log("["+warn+"]",arguments);},error:function(){throw new Error(this.log("["+error+"]",arguments));},time:function(k){this.timelines[k]=new Date().getTime();},debug:function(){this.log("["+debug+"]",arguments);},timeEnd:function(o){var k=(new Date().getTime()-this.timeline[o]);this.log(o,":",k,"ms");},initialize:function(){this.timeline={};this.buffer=JSmarty.Classes("Buffer");},toString:function(){return this.buffer.toString("\n");}};JSmarty.Logger=JSmarty.Classes("Logger");JSmarty.Classes.Item=JSmarty.Classes.create(JSmarty.Classes.HashMap);JSmarty.Classes.Item.extend({initialize:function(k){var o=k[0].split(":");this.clear();this.put("type",o[0]);this.put("name",o[1]);this.put("namespace",k[0]);}});JSmarty.Classes.Item.fetch=function(o,R){var C=new this(o);var d,Z=JSmarty.Plugin;var k=R.plugins_dir;if(Z.add("resource."+C.get("type"),k)){d=Z.get("resource."+C.get("type"),k);C.put("isFailure",!(d[0](C.get("name"),C,R)&&d[1](C.get("name"),C,R)));}if(C.get("isFailure")){d=R.default_template_handler_func;switch(typeof (d)){case "function":C.put("isFailure",!d(C.get("type"),C.get("name"),C,R));break;default:R.trigger_error("default template handler function \"this.default_template_handler_func\" doesn't exist.");break;}}return C;};JSmarty.System={modified:{},isWritable:false,getArgs:function(){return null;},timestamp:function(o){var k=(o)?new Date(o):new Date();return k.getTime();},buildPath:function(Z,C){var o,k=[].concat(C);for(o=k.length-1;0<=o;o--){k[o]=k[o]+"/"+Z;}return k;},getName:function(){var k=JSmarty.Plugin.get("core.global")();if(k.System&&k.Core){return "ajaja";}if(k.System&&k.System.Gadget){return "gadget";}if(k.window&&k.document){return "browser";}},forName:function(n){switch(n){case "ajaja":load("./internals/system.ajaja.js");break;case "mustang":load("./internals/system.mustang.js");break;case "gadget":this.path=String(System.Gadget.path).replace(/\\/g,"/")+"/";JSmarty.Browser.buildSystemObject();eval(this.read("system.gadget.js",JSmarty.Plugin.repos));break;case "browser":this.path="";JSmarty.Browser.buildSystemObject();break;}}};JSmarty.Plugin={dir:["."],additional:{php:true},F:function(){JSmarty.Logger.info("called undefined function","from","Plugin");return "";},parse:function(k,o){var Z,d="return "+this.realname(o)+";";try{Z=new Function((k||"")+d);this[o]=Z();}catch(C){this[o]=null;JSmarty.Logger.error(C);}return !!Z;},set:function(k,o){this[k]=o;},get:function(o,k){return this[o]||function(Z){return (Z.add(o,k))?Z[o]:Z.F;}(this);},add:function(o,k){return (o in this)||this.parse(JSmarty.System.read(o+".js",k||this.dir),o);},unset:function(k){this[k]=null;delete (this[k]);},realname:function(k){var o=k.split(".");if(this.additional[o[0]]){return o[1];}return ["jsmarty"].concat(o).join("_");},namespace:function(o,k){return o+"."+k;},importer:function(){var o,Z,k=this.dir;var C=this.get("core.global")();for(o=arguments.length-1;0<=o;o--){Z=arguments[o];if(this.add(Z,k)){C[Z.split(".")[1]]=this[Z];}}C=null;},"core.global":function(k){return function(){return k;};}(this),"core.copy_array":function(k){return [].concat(k);},"core.copy_object":function(C){var Z=JSmarty.Plugin;switch(typeof (C)){case "object":switch(true){case (C instanceof Array):return Z["core.copy_array"](C);case (C instanceof Object):var k,R={};var d=Z["core.copy_object"];for(k in C){R[k]=d(C[k]);}return R;}return null;case "undefined":return null;default:return C;}},"resource.file":[function(k,o,Z){o.put("src",JSmarty.System.read(k,Z.template_dir));return !!(o.get("src"));},function(k,o,Z){o.put("timestamp",JSmarty.System.time(k,Z.template_dir));return !!(o.get("timestamp"));},function(){return true;},function(){return true;}]};JSmarty.Templatec=JSmarty.Classes.extend(JSmarty.Classes("History"))({renderer:null,NullFunction:function(){},call:function(Z,C){return (this.get(Z)||this.NullFunction)(C);},isCompiled:function(k){if(this.renderer.force_compile){return false;}return this.containsKey(k);},newFunction:function(k){var C,o=JSmarty.Classes.Item.fetch(k,this.renderer);if(!o.get("isFailure")){try{C=this.renderer.getCompiler().execute(o.get("src"));this.put(o.get("namespace"),new Function("$",C));return true;}catch(Z){JSmarty.Logger.error(Z,"from Templatec#newFunction");}}return false;}});JSmarty.Browser={newRequest:function(){var o,k;if(typeof (ActiveXObject)!="undefined"){k=["Microsoft.XMLHTTP","Msxml2.XMLHTTP","Msxml2.XMLHTTP.3.0","Msxml2.XMLHTTP.4.0","Msxml2.XMLHTTP.5.0"];for(o=k.length-1;0<=o;o--){try{return new ActiveXObject(k[o]);}catch(Z){}}}if(typeof (XMLHttpRequest)!="undefined"){return new XMLHttpRequest();}JSmarty.Logger.warn("cant't create XMLHttpRequestObject","from","Browser#newRequest");return null;},buildSystemObject:function(){(function(){var C=JSmarty.System.path;var o=document.getElementsByTagName("script");var Z=o[o.length-1].getAttribute("src");var k=Z.lastIndexOf("/"),o=null;Z=(k==-1)?C:C+Z.slice(0,k);JSmarty.Plugin.dir=[Z+"/plugins",Z+"/internals"];})();delete (this.buildSystemObject);this.Request=this.newRequest();JSmarty.Classes.extend(JSmarty.System)({read:function(x,z){var k=this.buildPath(x,z);var Z,o,R,C=JSmarty.Browser.Request;for(Z=k.length-1;0<=Z;Z--){try{C.open("GET",k[Z],false);C.send("");if(C.status==200||C.status==0){R=C.responseText;o=C.getResponseHeader("last-modified");this.modified[x]=(o)?new Date(o).getTime():new Date().getTime();break;}}catch(S){}finally{C.abort();}}return R||function(){JSmarty.Logger.info("can't load the "+x,"from","System#read");return null;}();},time:function(o,Z){var k=this.modified;return k[o]||function(C){C.read(o,Z);return k[o]||null;}(this);},getArgs:function(Z){var o={},C=String(location.search).slice(1);JSmarty.Plugin.get("php.parse_str")(C,o);return (Z==void (0))?o:(o[Z]==void (0))?null:o[Z];},outputString:function(){document.write(Array.prototype.join.call(arguments,""));}});}};JSmarty.System.forName(JSmarty.System.getName());