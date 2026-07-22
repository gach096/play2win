<script>

	"use strict";
	function desplegarById(desplegar){
		var elemDesple=document.getElementById(desplegar);
		if(elemDesple.style.display==="none"){
			elemDesple.style.display="block";
		}else{
			elemDesple.style.display="none";
		}
	}

	function buscar(query,elemId,nombreElemQuery){
		var busqueda=document.getElementById(elemId).value;
		if(busqueda!=""){
			window.location.href="catalogo"+query+'&'+nombreElemQuery+'='+busqueda;
		}else{
			window.location.href="catalogo"+query;
		}
	}

</script>