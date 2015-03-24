$(document).ready(
	function() {
		$.datepicker.setDefaults($.datepicker.regional['es']);
		$(".bt_mas_tabla").each(
			function (el){
				$(this).bind("click",addFilaExtra);
			}
		);
		$(".bt_menos_tabla").each(
			function(el){
				$(this).bind("click",delFilaExtra);
			}
		);
		
		$(".bt_mas").each(
			function (el){
				$(this).bind("click",addFieldExtra);
			}
		);
		$(".bt_menos").each(
			function(el){
				$(this).bind("click",delRowExtra);
			}
		);
		$('input[type="date"]').each(
			function(){
				$(this).attr('size','10');
				$(this).datepicker({changeMonth: true,changeYear: true,yearRange: "1950:nn",dateFormat:"dd-mm-yy"});
			}
		);
		$('.date_fecha').each(
			function(){
				$(this).attr('size','10');
				$(this).datepicker({changeMonth: true,changeYear: true,yearRange: "1950:nn",dateFormat:"dd-mm-yy"});	
			}
		);
	}
);

function calcularEdad(yo){
	var cadena = yo;
	$dia = cadena.substr(0,2);
	$mes = cadena.substr(3,2);
	$anio = cadena.substr(6,4);
	$fecha_nac = new Date($anio,$mes-1,$dia);
	$fecha_act = new Date();
	$edad_time = $fecha_act.getTime() - $fecha_nac.getTime();
	
	$anios = Math.floor($edad_time/(1000*60*60*24*365));
	$edad_time -= $anios*1000*60*60*24*365;
	$meses = Math.floor($edad_time/(1000*60*60*24*30));
	$edad_time -= $meses*1000*60*60*24*30;
	$dias = Math.floor($edad_time/(1000*60*60*24));
	$edad = $anios;
	$edad +=($anios==1)?' año, ':' años, ';
	$edad +=$meses;
	$edad +=($meses==1)?' mes, ':' meses, ';
	$edad +=$dias;
	$edad +=($dias==1)?' día':' días';
	
	return $edad;
}

function addHorario(campo){
	var divName = campo.parent('div').attr('id');
	var elementos = divName.split('_');
	$('#horarios_'+elementos[1]).contents().remove();
	
	for($i=1;$i<=campo.val();$i++){
		$horarioClone = $('#horario_molde').clone(true);
		$horarioClone.css("display","block");
		$horarioClone.attr("id","horario_"+$i);
		$horarioClone.children('#horario_nombre').append(" "+$i+":");
		$('#horarios_'+elementos[1]).append($horarioClone);
	}
}

function addHorarioModificar(campo,liga,idMedicamento){
	var divName = campo.parent('div').attr('id');
	var elementos = divName.split('_');
	$('#horarios_'+elementos[1]).contents().remove();
	for($i=1;$i<=campo.val();$i++){
		$.post(liga+"/medicamento/listado_frecuencias/",{medicamento:idMedicamento},function(data){$('#horarios_'+elementos[1]).html(data);});
	}
}

function addDesc(yo){
	$abuelo = $(yo).parent().parent();
	if($(yo).val()=='Alterado')
		$abuelo.children("textarea").css("display","block");
	else
		$abuelo.children("textarea").css("display","none");
}

function addFieldExtra(){
	var divName = $(this).parent('div').attr('id');
	var elementos = divName.split('_');
	var clickID = parseInt($(this).attr('id'));
	var newID = (clickID+1);
	
	$newClone = $(this).parent('div').clone(true);
	$newClone.attr("id",elementos[0]+'_'+newID);
	$newClone.children("input").val('');
	$newClone.children('input[type="date"]').replaceWith('<input type="date" size="10" name="fecha_ini[]" />');
	$newClone.children('input[type="date"]').datepicker({changeMonth: true,changeYear: true,yearRange: "1950:nn",dateFormat:"dd-mm-yy"});
	
	$newClone.children('#osn_'+clickID).attr('name','status_'+newID);
	$newClone.children('#osa_'+clickID).attr('name','status_'+newID);
	$newClone.children('#osn_'+clickID).attr('value','Normal');
	$newClone.children('#osa_'+clickID).attr('value','Alterado');
	
	$newClone.children('#osn_'+clickID).attr('onclick','');
	$newClone.children('#osn_'+clickID).unbind();
	$newClone.children('#osa_'+clickID).attr('onclick','');
	$newClone.children('#osa_'+clickID).unbind();
	
	$newClone.children('#osn_'+clickID).bind('click',function(){$("#especifico_"+newID).css('display','none')});
	$newClone.children('#osa_'+clickID).bind('click',function(){$("#especifico_"+newID).css('display','block')});
	
	$newClone.children('#osn_'+clickID).attr('id','osn_'+newID);
	$newClone.children('#osa_'+clickID).attr('id','osa_'+newID);
	
	$newClone.children('input[name="lun['+clickID+']"]').replaceWith('<input type="checkbox" name="lun['+newID+']" />');
	$newClone.children('input[name="mar['+clickID+']"]').replaceWith('<input type="checkbox" name="mar['+newID+']" />');
	$newClone.children('input[name="mie['+clickID+']"]').replaceWith('<input type="checkbox" name="mie['+newID+']" />');
	$newClone.children('input[name="jue['+clickID+']"]').replaceWith('<input type="checkbox" name="jue['+newID+']" />');
	$newClone.children('input[name="vie['+clickID+']"]').replaceWith('<input type="checkbox" name="vie['+newID+']" />');
	$newClone.children('input[name="sab['+clickID+']"]').replaceWith('<input type="checkbox" name="sab['+newID+']" />');
	$newClone.children('input[name="dom['+clickID+']"]').replaceWith('<input type="checkbox" name="dom['+newID+']" />');
	
	$newClone.children('input[name="lun['+newID+']"]').val('Lun');
	$newClone.children('input[name="mar['+newID+']"]').val('Mar');
	$newClone.children('input[name="mie['+newID+']"]').val('Mie');
	$newClone.children('input[name="jue['+newID+']"]').val('Jue');
	$newClone.children('input[name="vie['+newID+']"]').val('Vie');
	$newClone.children('input[name="sab['+newID+']"]').val('Sab');
	$newClone.children('input[name="dom['+newID+']"]').val('Dom');
	
	$newClone.children('input[name="lun_g['+clickID+']"]').replaceWith('<input type="checkbox" name="lun_g['+newID+']" />');
	$newClone.children('input[name="mar_g['+clickID+']"]').replaceWith('<input type="checkbox" name="mar_g['+newID+']" />');
	$newClone.children('input[name="mie_g['+clickID+']"]').replaceWith('<input type="checkbox" name="mie_g['+newID+']" />');
	$newClone.children('input[name="jue_g['+clickID+']"]').replaceWith('<input type="checkbox" name="jue_g['+newID+']" />');
	$newClone.children('input[name="vie_g['+clickID+']"]').replaceWith('<input type="checkbox" name="vie_g['+newID+']" />');
	$newClone.children('input[name="sab_g['+clickID+']"]').replaceWith('<input type="checkbox" name="sab_g['+newID+']" />');
	$newClone.children('input[name="dom_g['+clickID+']"]').replaceWith('<input type="checkbox" name="dom_g['+newID+']" />');
	
	$newClone.children('input[name="lun_g['+newID+']"]').val('Lun');
	$newClone.children('input[name="mar_g['+newID+']"]').val('Mar');
	$newClone.children('input[name="mie_g['+newID+']"]').val('Mie');
	$newClone.children('input[name="jue_g['+newID+']"]').val('Jue');
	$newClone.children('input[name="vie_g['+newID+']"]').val('Vie');
	$newClone.children('input[name="sab_g['+newID+']"]').val('Sab');
	$newClone.children('input[name="dom_g['+newID+']"]').val('Dom');
	
	$newClone.children('#especifico_'+clickID).css("display","none");
	$newClone.children('#especifico_'+clickID).attr("id","especifico_"+newID);
	
//Asigno nuevo id al boton
$newClone.children("#"+clickID).attr("id",newID);
$newClone.children("#"+newID).val('+');
$newClone.children("#horarios_"+clickID).remove();
$newClone.append('<div id="horarios_'+newID+'"></div>');
//Inserto el div clonado y modificado despues del div original
$newClone.insertAfter($(this).parent('div'));

//Cambio el signo "+" por el signo "-" y le quito el evento addfield
$(this).val('-').unbind("click",addFieldExtra);
$(this).bind("click",delRowExtra);			   
}


function delRowExtra() {
// Funcion que destruye el elemento actual una vez echo el click
var clickID = parseInt($(this).attr('id'));
var newID = (clickID+1);
var divName = $(this).parent('div').attr('id');
var elementos = divName.split('_');
$('#'+elementos[0]+'_'+newID).remove();
$(this).val('+').unbind("click",delRowExtra);
$(this).bind("click",addFieldExtra);
}

function addFilaExtra(){
	var divName = $(this).parents('tr:eq(0)').attr('id');
	var elementos = divName.split('_');
	var clickID = parseInt($(this).attr('id'));
	var newID = (clickID+1);
	
	$newClone = $(this).parents('tr:eq(0)').clone(true);
	$newClone.attr("id",elementos[0]+'_'+newID);
	$newClone.find("input").val('');
	$newClone.find('input[type="date"]').replaceWith('<input type="date" size="10" name="fecha_ini[]" />');
	$newClone.find('input[type="date"]').datepicker({changeMonth: true,changeYear: true,yearRange: "1950:nn",dateFormat:"dd-mm-yy"});
	
	$newClone.find('input[name="lun['+clickID+']"]').replaceWith('<input type="checkbox" name="lun['+newID+']" />');
	$newClone.find('input[name="mar['+clickID+']"]').replaceWith('<input type="checkbox" name="mar['+newID+']" />');
	$newClone.find('input[name="mie['+clickID+']"]').replaceWith('<input type="checkbox" name="mie['+newID+']" />');
	$newClone.find('input[name="jue['+clickID+']"]').replaceWith('<input type="checkbox" name="jue['+newID+']" />');
	$newClone.find('input[name="vie['+clickID+']"]').replaceWith('<input type="checkbox" name="vie['+newID+']" />');
	$newClone.find('input[name="sab['+clickID+']"]').replaceWith('<input type="checkbox" name="sab['+newID+']" />');
	$newClone.find('input[name="dom['+clickID+']"]').replaceWith('<input type="checkbox" name="dom['+newID+']" />');
	
	$newClone.find('input[name="lun['+newID+']"]').val('Lun');
	$newClone.find('input[name="mar['+newID+']"]').val('Mar');
	$newClone.find('input[name="mie['+newID+']"]').val('Mie');
	$newClone.find('input[name="jue['+newID+']"]').val('Jue');
	$newClone.find('input[name="vie['+newID+']"]').val('Vie');
	$newClone.find('input[name="sab['+newID+']"]').val('Sab');
	$newClone.find('input[name="dom['+newID+']"]').val('Dom');
	
	$newClone.find('input[name="lun_g['+clickID+']"]').replaceWith('<input type="checkbox" name="lun_g['+newID+']" />');
	$newClone.find('input[name="mar_g['+clickID+']"]').replaceWith('<input type="checkbox" name="mar_g['+newID+']" />');
	$newClone.find('input[name="mie_g['+clickID+']"]').replaceWith('<input type="checkbox" name="mie_g['+newID+']" />');
	$newClone.find('input[name="jue_g['+clickID+']"]').replaceWith('<input type="checkbox" name="jue_g['+newID+']" />');
	$newClone.find('input[name="vie_g['+clickID+']"]').replaceWith('<input type="checkbox" name="vie_g['+newID+']" />');
	$newClone.find('input[name="sab_g['+clickID+']"]').replaceWith('<input type="checkbox" name="sab_g['+newID+']" />');
	$newClone.find('input[name="dom_g['+clickID+']"]').replaceWith('<input type="checkbox" name="dom_g['+newID+']" />');
	
	$newClone.find('input[name="lun_g['+newID+']"]').val('Lun');
	$newClone.find('input[name="mar_g['+newID+']"]').val('Mar');
	$newClone.find('input[name="mie_g['+newID+']"]').val('Mie');
	$newClone.find('input[name="jue_g['+newID+']"]').val('Jue');
	$newClone.find('input[name="vie_g['+newID+']"]').val('Vie');
	$newClone.find('input[name="sab_g['+newID+']"]').val('Sab');
	$newClone.find('input[name="dom_g['+newID+']"]').val('Dom');
	
	$newClone.find('input[name="lun_r['+clickID+']"]').replaceWith('<input type="checkbox" name="lun_r['+newID+']" />');
	$newClone.find('input[name="mar_r['+clickID+']"]').replaceWith('<input type="checkbox" name="mar_r['+newID+']" />');
	$newClone.find('input[name="mie_r['+clickID+']"]').replaceWith('<input type="checkbox" name="mie_r['+newID+']" />');
	$newClone.find('input[name="jue_r['+clickID+']"]').replaceWith('<input type="checkbox" name="jue_r['+newID+']" />');
	$newClone.find('input[name="vie_r['+clickID+']"]').replaceWith('<input type="checkbox" name="vie_r['+newID+']" />');
	$newClone.find('input[name="sab_r['+clickID+']"]').replaceWith('<input type="checkbox" name="sab_r['+newID+']" />');
	$newClone.find('input[name="dom_r['+clickID+']"]').replaceWith('<input type="checkbox" name="dom_r['+newID+']" />');
	
	$newClone.find('input[name="lun_r['+newID+']"]').val('Lun');
	$newClone.find('input[name="mar_r['+newID+']"]').val('Mar');
	$newClone.find('input[name="mie_r['+newID+']"]').val('Mie');
	$newClone.find('input[name="jue_r['+newID+']"]').val('Jue');
	$newClone.find('input[name="vie_r['+newID+']"]').val('Vie');
	$newClone.find('input[name="sab_r['+newID+']"]').val('Sab');
	$newClone.find('input[name="dom_r['+newID+']"]').val('Dom');
	
	$newClone.find('input[name="abuelo_paterno['+clickID+']"]').replaceWith('<input type="checkbox" name="abuelo_paterno['+newID+']" />');
	$newClone.find('input[name="abuelo_materno['+clickID+']"]').replaceWith('<input type="checkbox" name="abuelo_materno['+newID+']" />');
	$newClone.find('input[name="abuela_paterna['+clickID+']"]').replaceWith('<input type="checkbox" name="abuela_paterna['+newID+']" />');
	$newClone.find('input[name="abuela_materna['+clickID+']"]').replaceWith('<input type="checkbox" name="abuela_materna['+newID+']" />');
	$newClone.find('input[name="padre['+clickID+']"]').replaceWith('<input type="checkbox" name="padre['+newID+']" />');
	$newClone.find('input[name="madre['+clickID+']"]').replaceWith('<input type="checkbox" name="madre['+newID+']" />');
	
	$newClone.find('input[name="abuelo_paterno['+newID+']"]').val('Abuelo paterno');
	$newClone.find('input[name="abuelo_materno['+newID+']"]').val('Abuelo materno');
	$newClone.find('input[name="abuela_paterna['+newID+']"]').val('Abuela paterna');
	$newClone.find('input[name="abuela_materna['+newID+']"]').val('Abuela materna');
	$newClone.find('input[name="padre['+newID+']"]').val('Padre');
	$newClone.find('input[name="madre['+newID+']"]').val('Madre');
	
	
	$newClone.find('#otra_hereditaria_'+clickID).append('style="display:none"');
	$newClone.find('#otra_hereditaria_'+clickID).attr('id','otra_hereditaria_'+newID);
	
	$newClone.find('#otra_path_'+clickID).attr("id","otra_path_"+newID);
	
	$newClone.find('#especifico_'+clickID).css("display","none");
	$newClone.find('#especifico_'+clickID).attr("id","especifico_"+newID);
//Asigno nuevo id al boton
$newClone.find("#"+clickID).attr("id",newID);
$newClone.find("#"+newID).val('+');
$newClone.find("#horarios_"+clickID).remove();
$newClone.append('<div id="horarios_'+newID+'"></div>');
//Inserto el div clonado y modificado despues del div original
$newClone.insertAfter($(this).parents('tr:eq(0)'));

//Cambio el signo "+" por el signo "-" y le quito el evento addfield
$(this).val('-').unbind("click",addFilaExtra);
$(this).bind("click",delFilaExtra);			   
}


function delFilaExtra() {
// Funcion que destruye el elemento actual una vez echo el click
var clickID = parseInt($(this).attr('id'));
var newID = (clickID+1);
var divName = $(this).parents('tr:eq(0)').attr('id');
var elementos = divName.split('_');
$('#'+elementos[0]+'_'+newID).remove();
$(this).val('+').unbind("click",delFilaExtra);
$(this).bind("click",addFilaExtra);
}