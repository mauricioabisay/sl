function harris_geb(){
	geb = parseFloat($('#harris_geb_normal').text());
	factor_act = parseFloat($('#harris_factor_actividad option:selected').attr('label'));
	gebfa = geb*factor_act;
	eta = gebfa*.10;
	$('#harris_geb').text(gebfa.toFixed(2));
	$('#harris_eta').text(eta.toFixed(2));
	harris_actividad_fisica_default();
	harris_actividad_fisica_custom();
	suma_inf = 0;
	suma_sup = 0;
	suma = 0;
	$('input:checkbox[name="harris_condiciones_especiales[]"]:checked').each(function(){
		rango = $(this).attr('title');
		rangos = rango.split('-');
		rango_inf = rangos[0];
		rango_sup = rangos[1];
		
		suma_inf = rangos[0]*gebfa+suma_inf;
		suma_sup = rangos[1]*gebfa+suma_sup;
		
		factor = parseFloat($(this).val());
		suma = suma + gebfa*factor;
	});
	$('#estimado_harris_condiciones_especiales_inf').text(suma_inf.toFixed(2));
	$('#estimado_harris_condiciones_especiales_sup').text(suma_sup.toFixed(2));
	$('#harris_ecs').text(suma.toFixed(2));
	harris_subtotal();
	harris_subtotal_custom();
}

function harris_actividad_fisica_default(){
	geb = parseFloat($('#harris_geb').text());
	rango = $('#harris_actividad_fisica option:selected').attr('label');
	rangos = rango.split('-');
	rango_inf = parseFloat(rangos[0]);
	rango_sup = parseFloat(rangos[1]);
	
	suma_inf = geb*rango_inf;
	suma_sup = geb*rango_sup;
	$('#estimado_harris_actividad_fisica_inf').text(suma_inf.toFixed(2));
	$('#estimado_harris_actividad_fisica_sup').text(suma_sup.toFixed(2));
	harris_subtotal();
}

function harris_actividad_fisica_custom(){
	factor = parseFloat($('#heaf').val());
	geb = parseFloat($('#harris_geb').text());
	suma = factor/100*geb;
	
	$('#harris_eaf').text(suma.toFixed(2));
	harris_subtotal_custom();
}

function harris_condiciones_especiales(yo){
	rango = $('#'+yo).attr('title');
	rangos = rango.split('-');
	rango_inf = rangos[0];
	rango_sup = rangos[1];
	
	geb = parseFloat($('#harris_geb').text());
	suma_inf = parseFloat($('#estimado_harris_condiciones_especiales_inf').text());
	suma_sup = parseFloat($('#estimado_harris_condiciones_especiales_sup').text());
	
	if($('#'+yo+'_ch').is(':checked')){
		suma_inf = rangos[0]*geb+suma_inf;
		suma_sup = rangos[1]*geb+suma_sup;
		$('#'+yo).css('display','inline');
	}else if((suma_inf>0)&&(suma_sup>0)){
		suma_inf = suma_inf-rangos[0]*geb;
		suma_sup = suma_sup-rangos[1]*geb;
		$('#'+yo).css('display','none');
	}
	
	$('#estimado_harris_condiciones_especiales_inf').text(suma_inf.toFixed(2));
	$('#estimado_harris_condiciones_especiales_sup').text(suma_sup.toFixed(2));
	harris_subtotal();
}

function harris_condiciones_especiales_custom(yo){
	factor = parseFloat($('#'+yo).val());
	geb = parseFloat($('#harris_geb').text());
	suma = parseFloat($('#harris_ecs').text());
	
	if($('#'+yo+'_ch').is(':checked')){
		suma = suma + geb*factor;
	}else if(suma>0){
		suma = suma - geb*factor;
	}
	
	$('#harris_ecs').text(suma.toFixed(2));
	harris_subtotal_custom();
}

function harris_subtotal(){
	geb = parseFloat($('#harris_geb').text());
	eta = parseFloat($('#harris_eta').text());
	
	eaf_inf = parseFloat($('#estimado_harris_actividad_fisica_inf').text());
	eaf_sup = parseFloat($('#estimado_harris_actividad_fisica_sup').text());
	
	ecs_inf = parseFloat($('#estimado_harris_condiciones_especiales_inf').text());
	ecs_sup = parseFloat($('#estimado_harris_condiciones_especiales_sup').text());
	
	get_inf = (geb+eta+eaf_inf+ecs_inf);
	get_sup = (geb+eta+eaf_sup+ecs_sup);
	
	$('#estimado_harris_total_inf').text(get_inf.toFixed(2));
	$('#estimado_harris_total_sup').text(get_sup.toFixed(2));
}

function harris_subtotal_custom(){
	geb = parseFloat($('#harris_geb').text());
	eta = parseFloat($('#harris_eta').text());
	eaf = parseFloat($('#harris_eaf').text());
	ecs = parseFloat($('#harris_ecs').text());
	
	get = (geb+eta+eaf+ecs);
	
	$('#harris_total').text(get.toFixed(2));
	$('#harris_resumen_total').text(get.toFixed(2));
}

function shanblogue_actividad_fisica_default(){
	geb = $('#shanblogue_geb').text();
	rango = $('#shanblogue_actividad_fisica option:selected').attr('label');
	rangos = rango.split('-');
	rango_inf = rangos[0];
	rango_sup = rangos[1];
	
	suma_inf = geb*rango_inf;
	suma_sup = geb*rango_sup;
	
	$('#estimado_shanblogue_actividad_fisica_inf').text(suma_inf.toFixed(2));
	$('#estimado_shanblogue_actividad_fisica_sup').text(suma_sup.toFixed(2));
	shanblogue_subtotal();
}

function shanblogue_actividad_fisica_custom(){
	factor = parseFloat($('#seaf').val());
	geb = parseFloat($('#shanblogue_geb').text());
	suma = factor/100*geb;
	
	$('#shanblogue_eaf').text(suma.toFixed(2));
	shanblogue_subtotal_custom();
}

function shanblogue_condiciones_especiales(yo){
	rango = $('#'+yo).attr('title');
	rangos = rango.split('-');
	rango_inf = rangos[0];
	rango_sup = rangos[1];
	
	geb = $('#shanblogue_geb').text();
	suma_inf = parseFloat($('#estimado_shanblogue_condiciones_especiales_inf').text());
	suma_sup = parseFloat($('#estimado_shanblogue_condiciones_especiales_sup').text());
	
	if($('#'+yo+'_ch').is(':checked')){
		suma_inf = rangos[0]*geb+suma_inf;
		suma_sup = rangos[1]*geb+suma_sup;
		
		suma_ecs = parseFloat($('#shanblogue_ecs').text());
		suma_ecs = suma_ecs+$('#'+yo).val()*geb;
		$('#shanblogue_ecs').text(suma_ecs.toFixed(2));
		$('#'+yo).css('display','inline');
	}else if((suma_inf>0)&&(suma_sup>0)){
		suma_inf = suma_inf-rangos[0]*geb;
		suma_sup = suma_sup-rangos[1]*geb;
		
		suma_ecs = parseFloat($('#shanblogue_ecs').text());
		suma_ecs = suma_ecs-$('#'+yo).val()*geb;
		$('#shanblogue_ecs').text(suma_ecs.toFixed(2));
		$('#'+yo).css('display','none');
	}
	
	$('#estimado_shanblogue_condiciones_especiales_inf').text(suma_inf.toFixed(2));
	$('#estimado_shanblogue_condiciones_especiales_sup').text(suma_sup.toFixed(2));
	shanblogue_subtotal();
	shanblogue_subtotal_custom();
}

function shanblogue_condiciones_especiales_custom(yo){
	factor = parseFloat($('#'+yo).val());
	geb = parseFloat($('#shanblogue_geb').text());
	suma = parseFloat($('#shanblogue_ecs').text());
	
	if($('#'+yo+'_ch').is(':checked')){
		suma = suma + geb*factor;
	}else if(suma>0){
		suma = suma - geb*factor;
	}
	
	$('#shanblogue_ecs').text(suma.toFixed(2));
	shanblogue_subtotal_custom();
}

function shanblogue_subtotal(){
	geb = parseFloat($('#shanblogue_geb').text());
	
	eaf_inf = parseFloat($('#estimado_shanblogue_actividad_fisica_inf').text());
	eaf_sup = parseFloat($('#estimado_shanblogue_actividad_fisica_sup').text());
	
	ecs_inf = parseFloat($('#estimado_shanblogue_condiciones_especiales_inf').text());
	ecs_sup = parseFloat($('#estimado_shanblogue_condiciones_especiales_sup').text());
	
	get_inf = geb+eaf_inf+ecs_inf;
	get_sup = geb+eaf_sup+ecs_sup;
	
	$('#estimado_shanblogue_total_inf').text(get_inf.toFixed(2));
	$('#estimado_shanblogue_total_sup').text(get_sup.toFixed(2));
}

function shanblogue_subtotal_custom(){
	geb = parseFloat($('#shanblogue_geb').text());
	eaf = parseFloat($('#shanblogue_eaf').text());
	ecs = parseFloat($('#shanblogue_ecs').text());
	
	//get = geb+eta+eaf+ecs;
	get = geb+eaf+ecs;
	$('#shanblogue_total').text(get.toFixed(2));
	$('#shanblogue_resumen_total').text(get.toFixed(2));
}