<?php
   	class Alta extends CI_Controller{

	public function __construct() {

	parent::__construct();

	$this->load->library('form_validation');

	$this->load->helper('url');


}
	public function alta_antecedentes()
	{
		
		if ($this->input->post())
		{
			$this->form_validation->set_rules('alcohol','','required');
			if ($this->input->post('alcohol') == 'si')
			{
				$this->form_validation->set_rules('alcohol_valor_frec','','required|is_natural_no_zero');
				$this->form_validation->set_rules('alcohol_tipo_frec','','required');
				$this->form_validation->set_rules('copas','','required');
				$this->form_validation->set_rules('alcohol_tipo','','required');
				$aux = $this->input->post('alcohol_tipo');
				for($i=0; $i < sizeof($aux); $i++){
					if($aux[$i]=='otro')
					$this->form_validation->set_rules('alcohol_otro','','required|min_length[3]|max_length[30]|alpha');
				}
								
				$alcohol_valor_frec = $this->input->post('alcohol_valor_frec');
				$alcohol_tipo_frec = $this->input->post('alcohol_tipo_frec');
				$copas = $this->input->post('copas');
				
				$aux = $this->input->post('alcohol_tipo');
				$alcohol_tipo = "";
				for($i=0; $i < sizeof($aux); $i++){					
					$alcohol_tipo .= ''.$aux[$i].'';
					$alcohol_tipo .= ($i+1==sizeof($aux))?"":",";
				}
				$alcohol_otro = $this->input->post('alcohol_otro');
				
			}
						
			else {
				$alcohol_valor_frec= NULL;
				$alcohol_tipo_frec = NULL;
				$copas = NULL;
				$alcohol_tipo = NULL;
				$alcohol_otro = NULL;
		}
				$this->form_validation->set_rules('fuma','','required');
				if ($this->input->post('fuma') == 'si')
				{
					$this->form_validation->set_rules('fuma_valor','','required|is_natural_no_zero');
					$this->form_validation->set_rules('fuma_tiempo','','required');
					$this->form_validation->set_rules('cigarros','','required|is_natural_no_zero');
					$this->form_validation->set_rules('fuma_tipo_frec','','required');
					
					$fuma_valor = $this->input->post('fuma_valor');
					$fuma_tiempo = $this->input->post('fuma_tiempo');
					$cigarros = $this->input->post('cigarros');
					$fuma_tipo_frec = $this->input->post('fuma_tipo_frec');
				}
				else {
					$fuma_valor = NULL;
					$fuma_tiempo = NULL;
					$cigarros = NULL;
					$fuma_tipo_frec = NULL;
			}
	
				$this->form_validation->set_rules('ejercicio','','required');
				if ($this->input->post('ejercicio') == 'si')
				{
					$this->form_validation->set_rules('ejercicio_valor_frec','','required|is_natural_no_zero');
					$this->form_validation->set_rules('ejercicio_tipo_frec','','required');
					$this->form_validation->set_rules('duracion','','required|is_natural_no_zero');
					$this->form_validation->set_rules('ejercicio_tipo','','required');
					
					$aux = $this->input->post('ejercicio_tipo');
					for($i=0; $i < sizeof($aux); $i++){
						if($aux[$i]=='otro')
							$this->form_validation->set_rules('ejercicio_otro','','required|min_length[3]|max_length[30]|alpha');
					}
					$aux = $this->input->post('ejercicio_tipo');
					$ejercicio_tipo = "";
					for($i=0; $i < sizeof($aux); $i++){					
						$ejercicio_tipo .= ''.$aux[$i].'';
						$ejercicio_tipo .= ($i+1==sizeof($aux))?"":",";
					}
					
					$ejercicio_valor_frec = $this->input->post('ejercicio_valor_frec');
					$ejercicio_tipo_frec = $this->input->post('ejercicio_tipo_frec');
					$duracion = $this->input->post('duracion');
					$ejercicio_otro = $this->input->post('ejercicio_otro');
				}
				else {
					$ejercicio_tipo = NULL;
					$ejercicio_valor_frec = NULL;
					$ejercicio_tipo_frec = NULL;
					$duracion = NULL;
					$ejercicio_otro = NULL;
				}
				$this->form_validation->set_rules('embarazo','','required');
				if ($this->input->post('embarazo') == 'si')
				{
					$this->form_validation->set_rules('gesta','','required|is_natural_no_zero');
					$this->form_validation->set_rules('semana','','required|is_natural');
					$this->form_validation->set_rules('lactancia','','required');
					
					$gesta = $this->input->post('gesta');
					$semana = $this->input->post('semana');
					$lactancia = $this->input->post('lactancia');
				}
				else {
					$gesta = NULL;
					$semana = NULL;
					$lactancia = NULL;
				}
	}
	
	if ($this->form_validation->run() == FALSE)
	{
		$this->load->view('form_antecedentes');
	}
	else
	{
		
		
		
		$antecedentes['paciente']= $this->input->post('paciente');
		$antecedentes['alcohol']= $this->input->post('alcohol');
		$antecedentes['alcohol_valor_frec']= $alcohol_valor_frec;
		$antecedentes['alcohol_tipo_frec']= $alcohol_tipo_frec;;
		$antecedentes['alcohol_tipo']= $alcohol_tipo;
		$antecedentes['copas']= $copas;
		$antecedentes['fuma']= $this->input->post('fuma');
		$antecedentes['fuma_valor']= $fuma_valor;
		$antecedentes['fuma_tiempo']= $fuma_tiempo;
		$antecedentes['cigarros']= $cigarros;
		$antecedentes['fuma_tipo_frec']= $fuma_tipo_frec;
		$antecedentes['embarazo']= $this->input->post('embarazo');
		$antecedentes['gesta']= $gesta;
		$antecedentes['semana']= $semana;
		$antecedentes['lactancia']= $lactancia;
		$antecedentes['ejercicio']= $this->input->post('ejercicio');
		$antecedentes['ejercicio_tipo_frec']= $ejercicio_tipo_frec;
		$antecedentes['ejercicio_valor_frec']= $ejercicio_valor_frec;
		$antecedentes['duracion']= $duracion;
		$antecedentes['ejercicio_tipo']= $ejercicio_tipo;
		$antecedentes['alcohol_otro']= $alcohol_otro;
		$antecedentes['ejercicio_otro']= $ejercicio_otro;
		
		$this->load->model('modelo_formularios');
		$this->modelo_formularios->alta_antecedentes($antecedentes);
		$this->load->view('form_antecedentes');
	}
	
	

}	
	public function alta_evaluacion_dietetica()
	{
		if ($this->input->post())
		{
			//Validaciones recordatorio 24 horas
			$this->form_validation->set_rules('tiempo[]','','required');
			$this->form_validation->set_rules('alimento[]','','required|min_length[3]|max_length[50]');
			$this->form_validation->set_rules('cantidad[]','','required|min_length[1]|max_length[50]');
			$this->form_validation->set_rules('kcal[]','','required|callback_decimal');
			$this->form_validation->set_rules('contador','Contador','integer');
			
			$tiempo = $this->input->post('tiempo[]');
			$alimento = $this->input->post('alimento[]');
			$cantidad =$this->input->post('cantidad[]');
			$kcal = $this->input->post('kcal[]');
			
			$this->form_validation->set_rules('total','','callback_decimal');
			
			
		
			//Validaciones frecuencia de consumo
			$this->form_validation->set_rules('verduras','','required|is_natural');
			$this->form_validation->set_rules('frutas','','required|is_natural');
			$this->form_validation->set_rules('car_sg','','required|is_natural');
			$this->form_validation->set_rules('car_cg','','required|is_natural');
			$this->form_validation->set_rules('grasa_sp','','required|is_natural');
			$this->form_validation->set_rules('grasa_cp','','required|is_natural');
			$this->form_validation->set_rules('leche','','required|is_natural');
			$this->form_validation->set_rules('azucar','','required|is_natural');
			$this->form_validation->set_rules('leguminosas','','required|is_natural');
			$this->form_validation->set_rules('origen_animal','','required|is_natural');
			
			
			//Validaciones histórico de peso
			$this->form_validation->set_rules('peso_max','','required|callback_decimal');
			$this->form_validation->set_rules('peso_max_mes','','required');
			$this->form_validation->set_rules('peso_max_a','','required|numeric|exact_length[4]');
			$this->form_validation->set_rules('peso_min','','required|callback_decimal');
			$this->form_validation->set_rules('peso_min_mes','','required');
			$this->form_validation->set_rules('peso_min_a','','required|numeric|exact_length[4]');
			$this->form_validation->set_rules('desc_hist','','min_length[3]');
			$this->form_validation->set_rules('medicamentos','','required');
			$this->form_validation->set_rules('tratamiento','','required');
			
			$peso_max_mes = $this->input->post('peso_max_mes');
			$peso_max_a = $this->input->post('peso_max_a');
			$fecha_peso_max = $peso_max_a.'-'.$peso_max_mes.'-'.'01';
			
			$peso_min_mes = $this->input->post('peso_min_mes');
			$peso_min_a = $this->input->post('peso_min_a');
			$fecha_peso_min = $peso_min_a.'-'.$peso_min_mes.'-'.'01';
					
			if ($this->input->post('medicamentos') == 'si')
			{
				$this->form_validation->set_rules('med','','required|min_length[3]');
				
				$medicamentos = $this->input->post('med');
			}
			else {
				$medicamentos = NULL;
		}
		
			//Validaciones tratamientos
			if ($this->input->post('tratamiento') == 'si')
			{
				$this->form_validation->set_rules('tratamiento1_mes','','required');
				$this->form_validation->set_rules('tratamiento1_a','','required|numeric|exact_length[4]');
				$this->form_validation->set_rules('tratamiento1_res','','required|min_length[3]');
				
				
				$this->form_validation->set_rules('tratamiento2_mes','','');
				
				if ($this->input->post('tratamiento2_mes') != "")
				{
					$this->form_validation->set_rules('tratamiento2_a','','required|numeric|exact_length[4]');
					$this->form_validation->set_rules('tratamiento2_res','','required|min_length[3]');
					
					
				}
				
				$this->form_validation->set_rules('tratamiento3_mes','','');
				if ($this->input->post('tratamiento3_mes') != "")
				{
					$this->form_validation->set_rules('tratamiento3_a','','required|numeric|exact_length[4]');
					$this->form_validation->set_rules('tratamiento3_res','','required|min_length[3]');
				}
				$tratamiento1_mes = $this->input->post('tratamiento1_mes');
				$tratamiento1_a = $this->input->post('tratamiento1_a');
				$fecha_tratamiento1 = $tratamiento1_a.'-'.$tratamiento1_mes.'-'.'01';
				$tratamiento1 = $this->input->post('tratamiento1_res');	
				$tratamiento2_mes = $this->input->post('tratamiento2_mes');
				$tratamiento2_a = $this->input->post('tratamiento2_a');
				$fecha_tratamiento2 = $tratamiento2_a.'-'.$tratamiento2_mes.'-'.'01';
				$tratamiento2 = $this->input->post('tratamiento2_res');	
				$tratamiento3_mes = $this->input->post('tratamiento3_mes');
				$tratamiento3_a = $this->input->post('tratamiento3_a');
				$fecha_tratamiento3 = $tratamiento3_a.'-'.$tratamiento3_mes.'-'.'01';
				$tratamiento3 = $this->input->post('tratamiento3_res');
				}
			else{
				$tratamiento1 = NULL;
				$fecha_tratamiento1 =NULL;
				$tratamiento2 = NULL;
				$fecha_tratamiento2 =NULL;
				$tratamiento3 = NULL;
				$fecha_tratamiento3 =NULL;
			}					
				
			
			
				
			//Validaciones hábitos alimenticios
			$this->form_validation->set_rules('desayuno','','required');
			if ($this->input->post('desayuno') == 'si')
			{
				$this->form_validation->set_rules('lugar_desayuno','','required|min_length[4|max_length[30]');
				$this->form_validation->set_rules('horas_desayuno','','required');
				$this->form_validation->set_rules('minutos_desayuno','','required');
				$this->form_validation->set_rules('tiempo_desayuno','','required');
				$this->form_validation->set_rules('cocinero_desayuno','','required|min_length[3]|max_length[30]');
			
				
				$lugar_desayuno = $this->input->post('lugar_desayuno');
				$horas_desayuno = $this->input->post('horas_desayuno');
				$minutos_desayuno = $this->input->post('minutos_desayuno');
				$tiempo_desayuno = $this->input->post('tiempo_desayuno');
				if ($tiempo_desayuno == 'pm')
					$horas_desayuno = $horas_desayuno + 12;
				$hora_des = $horas_desayuno.':'.$minutos_desayuno.':'.'00';
				$cocinero_desayuno = $this->input->post('cocinero_desayuno');
			}
			else{
				$lugar_desayuno = NULL;
				$hora_des = NULL;
				$cocinero_desayuno = NULL;
			}
			
			$this->form_validation->set_rules('colacion1','','required');
			if ($this->input->post('colacion1') == 'si')
			{
				$this->form_validation->set_rules('lugar_colacion1','','required|min_length[4|max_length[30]');
				$this->form_validation->set_rules('horas_colacion1','','required');
				$this->form_validation->set_rules('minutos_colacion1','','required');
				$this->form_validation->set_rules('tiempo_colacion1','','required');
				$this->form_validation->set_rules('cocinero_colacion1','','required|min_length[3]|max_length[30]');
				
				
				$lugar_colacion1 = $this->input->post('lugar_colacion1');
				$horas_colacion1 = $this->input->post('horas_colacion1');
				$minutos_colacion1 = $this->input->post('minutos_colacion1');
				$tiempo_colacion1 = $this->input->post('tiempo_colacion1');
				if ($tiempo_colacion1 == 'pm')
					$horas_colacion1 = $horas_colacion1 + 12;
				$hora_co1 = $horas_colacion1.':'.$minutos_colacion1.':'.'00';
				$cocinero_colacion1 = $this->input->post('cocinero_colacion1');
			}
			else{
				$lugar_colacion1 = NULL;
				$hora_co1 = NULL;
				$cocinero_colacion1 = NULL;
			}
			
			$this->form_validation->set_rules('comida','','required');
			if ($this->input->post('comida') == 'si')
			{
				$this->form_validation->set_rules('lugar_comida','','required|min_length[4|max_length[30]');
				$this->form_validation->set_rules('horas_comida','','required');
				$this->form_validation->set_rules('minutos_comida','','required');
				$this->form_validation->set_rules('tiempo_comida','','required');
				$this->form_validation->set_rules('cocinero_comida','','required|min_length[3]|max_length[30]');
				
				
				$lugar_comida = $this->input->post('lugar_comida');
				$horas_comida = $this->input->post('horas_comida');
				$minutos_comida = $this->input->post('minutos_comida');
				$tiempo_comida = $this->input->post('tiempo_comida');
				if ($tiempo_comida == 'pm')
					$horas_comida = $horas_comida + 12;
				$hora_com = $horas_comida.':'.$minutos_comida.':'.'00';
				$cocinero_comida = $this->input->post('cocinero_comida');
			}
			else{
				$lugar_comida = NULL;
				$hora_com = NULL;
				$cocinero_comida = NULL;
			}
			
			$this->form_validation->set_rules('colacion2','','required');
			if ($this->input->post('colacion2') == 'si')
			{
				$this->form_validation->set_rules('lugar_colacion2','','required|min_length[4|max_length[30]');
				$this->form_validation->set_rules('horas_colacion2','','required');
				$this->form_validation->set_rules('minutos_colacion2','','required');
				$this->form_validation->set_rules('tiempo_colacion2','','required');
				$this->form_validation->set_rules('cocinero_colacion2','','required|min_length[3]|max_length[30]');
				
				
				$lugar_colacion2 = $this->input->post('lugar_colacion2');
				$horas_colacion2 = $this->input->post('horas_colacion2');
				$minutos_colacion2 = $this->input->post('minutos_colacion2');
				$tiempo_colacion2 = $this->input->post('tiempo_colacion2');
				if ($tiempo_colacion2 == 'pm')
					$horas_colacion2 = $horas_colacion2 + 12;
				$hora_co2 = $horas_colacion2.':'.$minutos_colacion2.':'.'00';
				$cocinero_colacion2 = $this->input->post('cocinero_colacion2');
			}
			else{
				$lugar_colacion2 = NULL;
				$hora_co2 = NULL;
				$cocinero_colacion2 = NULL;
			}
			
			$this->form_validation->set_rules('cena','','required');
			if ($this->input->post('cena') == 'si')
			{
				$this->form_validation->set_rules('lugar_cena','','required|min_length[4|max_length[30]');
				$this->form_validation->set_rules('horas_cena','','required');
				$this->form_validation->set_rules('minutos_cena','','required');
				$this->form_validation->set_rules('tiempo_cena','','required');
				$this->form_validation->set_rules('cocinero_cena','','required|min_length[3]|max_length[30]');
				
				
				$lugar_desayuno = $this->input->post('lugar_cena');
				$horas_cena = $this->input->post('horas_cena');
				$minutos_cena = $this->input->post('minutos_cena');
				$tiempo_cena = $this->input->post('tiempo_cena');
				if ($tiempo_cena== 'pm')
					$horas_cena= $horas_cena + 12;
				$hora_cen = $horas_cena.':'.$minutos_cena.':'.'00';
				$cocinero_cena = $this->input->post('cocinero_cena');
			}
			else{
				$lugar_cena = NULL;
				$hora_cen = NULL;
				$cocinero_cena= NULL;
			}
		
			//Validaciones preguntas generales
			$this->form_validation->set_rules('evolucion','','required');
			$this->form_validation->set_rules('desgaste','','required|is_natural');
			$this->form_validation->set_rules('motivacion','','required|is_natural');
			$this->form_validation->set_rules('razon_motivacion','','required|min_length[3]');
			$this->form_validation->set_rules('capacidad','','required|is_natural');
		}
		$num = $this->input->post('contador') + 1; 
		$evaluacion = 100;
		if ($this->form_validation->run() == FALSE)
		{
			$datos['tiempo'] = $this->input->post('tiempo');
			$datos['alimento'] = $this->input->post('alimento');
			$datos['cantidad'] = $this->input->post('cantidad');
			$datos['calorias'] = $this->input->post('calorias');
			
		
		}
		else
		{
				$recordatorio['tiempo'] = $tiempo;
				$recordatorio['alimento'] = $alimento;
				$recordatorio['cantidad'] = $cantidad;
				$recordatorio['kcal'] = $kcal;
	
	
				
				$frecuencia['eval_dietetica']=$evaluacion;
				$frecuencia['verduras']	= $this->input->post('verduras');
				$frecuencia['frutas']	= $this->input->post('frutas');
				$frecuencia['car_sg']	= $this->input->post('car_sg');
				$frecuencia['car_cg']	= $this->input->post('car_cg');
				$frecuencia['grasa_sp']	= $this->input->post('grasa_sp');
				$frecuencia['grasa_cp']	= $this->input->post('grasa_cp');
				$frecuencia['leche']	= $this->input->post('leche');
				$frecuencia['azucar']	= $this->input->post('azucar');
				$frecuencia['leguminosas']	= $this->input->post('leguminosas');
				$frecuencia['origen_animal']	= $this->input->post('origen_animal');
	
				$paciente = '155';
				$historico['paciente']= $paciente;
				$historico['peso_max_fecha']= $fecha_peso_max;
				$historico['peso_min_fecha']=$fecha_peso_min;
				$historico['peso_max'] = $this->input->post('peso_max');
				$historico['peso_min'] = $this->input->post('peso_min');
				$historico['desc_hist'] = $this->input->post('desc_hist');
				$historico['medicamento'] = $this->input->post('medicamentos');
				$historico['medicamentos'] = $medicamentos;
	
				
				
				$hist_peso ='3';
				$tratamiento_1['hist_peso']= $hist_peso;
				$tratamiento_1['fecha']= $fecha_tratamiento1;
				$tratamiento_1['resultado']= $tratamiento1;
				
				$tratamiento_2['hist_peso']= $hist_peso;
				$tratamiento_2['fecha']= $fecha_tratamiento2;
				$tratamiento_2['resultado']= $tratamiento2;
					
				$tratamiento_3['hist_peso']= $hist_peso;
				$tratamiento_3['fecha']= $fecha_tratamiento3;
				$tratamiento_3['resultado']= $tratamiento3;
						
					
				
				
				$habitos_1['tiempo']= 'des';				
				$habitos_1['existe']=$this->input->post('desayuno');
				$habitos_1['lugar']=$lugar_desayuno;
				$habitos_1['hora']=$hora_des;
				$habitos_1['cocinero']=$cocinero_desayuno;
				
				$habitos_2['tiempo']= 'co1';
				$habitos_2['existe']=$this->input->post('colacion1');
				$habitos_2['lugar']=$lugar_colacion1;
				$habitos_2['hora']=$hora_co1;
				$habitos_2['cocinero']=$cocinero_colacion1;
				
				$habitos_3['tiempo']= 'com';
				$habitos_3['existe']=$this->input->post('comida');
				$habitos_3['lugar']=$lugar_comida;
				$habitos_3['hora']=$hora_com;
				$habitos_3['cocinero']=$cocinero_comida;
				
				$habitos_4['tiempo']= 'co2';
				$habitos_4['existe']=$this->input->post('colacion2');
				$habitos_4['lugar']=$lugar_colacion2;
				$habitos_4['hora']=$hora_co2;
				$habitos_4['cocinero']=$cocinero_colacion2;
				
				$habitos_5['tiempo']= 'cen';
				$habitos_5['existe']=$this->input->post('cena');
				$habitos_5['lugar']=$lugar_cena;
				$habitos_5['hora']=$hora_cen;
				$habitos_5['cocinero']=$cocinero_cena;
				
				$habitos_1['eval_dietetica']=$evaluacion;
				$habitos_2['eval_dietetica']=$evaluacion;
				$habitos_3['eval_dietetica']=$evaluacion;
				$habitos_4['eval_dietetica']=$evaluacion;
				$habitos_5['eval_dietetica']=$evaluacion;
				
				$preguntas['evolucion']=$this->input->post('evolucion');
				$preguntas['desgaste']=$this->input->post('desgaste');
				$preguntas['motivacion']=$this->input->post('motivacion');
				$preguntas['capacidad']=$this->input->post('capacidad');
				$preguntas['paciente']='200';
				
				
				
				$this->load->model('modelo_formularios');
				$this->modelo_formularios->alta_evaluacion_historico($recordatorio,$frecuencia,$historico,$tratamiento_1,$tratamiento_2,$tratamiento_3,$habitos_1,$habitos_2,$habitos_3,$habitos_4,$habitos_5,$preguntas);
				
				
				
		}
			
		$this->load->view('form_evaluacion');
		
	}

	public function alta_laboratorios()
	{
		$this->form_validation->set_rules('sintomas','','required');
		$this->form_validation->set_rules('laboratorios','','required');
		$this->form_validation->set_rules('laboratorios_otros','','min_length[3]|max_length[255]');
		if ($this->input->post('sintomas') == 'si')
		{
			$this->form_validation->set_rules('cuantos_sintomas','','required');
		}
		
		
		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('form_laboratorios');
		}
		else
		{
			//Problema para cambiar formato a fechas	
			$fecha_solicitud=$this->input->post('fecha');
			$fecha_laboratorio =$this->input->post('calendario2');
			$fecha_recepcion = $this->input->post('calendario1');
			
			$lab['fecha_solicitud'] = $fecha_solicitud;
			$lab['fecha_laboratorio'] = $fecha_laboratorio;
			$lab['fecha_recepcion'] = $fecha_recepcion;
			
			$lab['bh'] = $this->input->post('bh');
			$lab['qs_trigliceridos'] = $this->input->post('qs_trigliceridos');
			$lab['p_lipidos'] = $this->input->post('p_lipidos');
			$lab['p_hepatico'] = $this->input->post('p_hepatico');
			$lab['p_tiroideo'] = $this->input->post('p_tiroideo');
			$lab['p_tiroideo_anticuerpos'] = $this->input->post('p_tiroideo_anticuerpos');
			$lab['tsh'] = $this->input->post('tsh');
			$lab['insulina'] = $this->input->post('insulina');
			$lab['cortisol'] = $this->input->post('cortisol');
			$lab['ant_prostatico'] = $this->input->post('ant_prostatico');
			$lab['ego'] = $this->input->post('ego');
			$lab['fact_reumatoide'] = $this->input->post('fact_reumatoide');
			$lab['glucosa_basal'] = $this->input->post('glucosa_basal');
			$lab['insulina_basal'] = $this->input->post('insulina_basal');
			$lab['h_crecimiento'] = $this->input->post('h_crecimiento');
			$lab['otros'] = $this->input->post('otros');
			
			$this->load->model('modelo_formularios');
			$this->modelo_formularios->alta_laboratorios($lab);
			$this->load->view('form_laboratorios');
		}
	}
	
	
	
		
	public function index(){
	$this->load->view('form_evaluacion');
}

}
?>