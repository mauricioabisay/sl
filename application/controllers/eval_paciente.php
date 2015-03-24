<?php
include ('clase.php');
	/**
	 * 
	 */
	class eval_paciente extends clase{
		
		public $metricas;
		public $mujer;
		public $edad;
		public $anios;
		public $meses;
		public $categoria;
		public $peso_pre_gesta;
		public $semana_gesta;
		public $fondo_uterino;
		
		function __construct($metricas,$edad,$mujer,$categoria){
			parent::__construct();
			$this->metricas = $metricas;
			$this->edad = $edad;
			$this->mujer = $mujer;
			$this->categoria = $categoria;
			$this->anios = intval($edad);
			$this->meses = ($edad-$this->anios)*12;
		}
		
/**
 * Evaluacion del indice de cintura cadera
 */
		function evaluacion_cintura_cadera(){
			if($this->metricas->c_cadera<=0){
				return '0';	
			}
			$valor = $this->metricas->c_cintura/$this->metricas->c_cadera;
			
			mysql_connect($this->host,$this->usr,$this->pass);
			mysql_select_db($this->db);
			$sql = 'select * from tabla_evaluacion_antropometrica_criterios_adultos where ';
			$sql.= 'evaluacion="cintura_cadera" ';
			
			if($this->mujer){
				$sql.= 'and sexo="Femenino" ';
				$res = mysql_query($sql);
				while($tabla = mysql_fetch_object($res)){
					if($tabla->valor_inf==NULL){
						if($valor<$tabla->valor_sup){
							return $tabla->diagnostico;
						}
					}
					if($tabla->valor_sup==NULL){
						if($tabla->valor_inf<=$valor){
							return $tabla->diagnostico;
						}
					}
					if(($tabla->valor_inf<=$valor)&&($valor<$tabla->valor_sup)){
						return $tabla->diagnostico; 
					}
				}
				return 'ERROR';
			}else{
				$sql.= 'and sexo="Masculino" ';
				$res = mysql_query($sql);
				while($tabla = mysql_fetch_object($res)){
					if($tabla->valor_inf==NULL){
						if($valor<$tabla->valor_sup){
							return $tabla->diagnostico;
						}
					}
					if($tabla->valor_sup==NULL){
						if($tabla->valor_inf<=$valor){
							return $tabla->diagnostico;
						}
					}
					if(($tabla->valor_inf<=$valor)&&($valor<$tabla->valor_sup)){
						return $tabla->diagnostico; 
					}
				}
				return 'ERROR';
			}
		}
		
		function evaluacion_complexion(){
			if($this->metricas->c_muneca<=0){
				return '0';	
			}
			$valor = ($this->metricas->estatura*100)/$this->metricas->c_muneca;
			mysql_connect($this->host,$this->usr,$this->pass);
			mysql_select_db($this->db);
			$sql = 'select * from tabla_evaluacion_antropometrica_criterios_adultos where ';
			$sql.= 'evaluacion="complexion" ';
			
			if($this->mujer){
				$sql.= 'and sexo="Femenino" ';
				$res = mysql_query($sql);
				while($tabla = mysql_fetch_object($res)){
					if($tabla->valor_inf==NULL){
						if($valor<$tabla->valor_sup){
							return $tabla->diagnostico;
						}
					}
					if($tabla->valor_sup==NULL){
						if($tabla->valor_inf<=$valor){
							return $tabla->diagnostico;
						}
					}
					if(($tabla->valor_inf<=$valor)&&($valor<$tabla->valor_sup)){
						return $tabla->diagnostico; 
					}
				}
				return 'ERROR';
			}else{
				$sql.= 'and sexo="Masculino" ';
				$res = mysql_query($sql);
				while($tabla = mysql_fetch_object($res)){
					if($tabla->valor_inf==NULL){
						if($valor<$tabla->valor_sup){
							return $tabla->diagnostico;
						}
					}
					if($tabla->valor_sup==NULL){
						if($tabla->valor_inf<=$valor){
							return $tabla->diagnostico;
						}
					}
					if(($tabla->valor_inf<=$valor)&&($valor<$tabla->valor_sup)){
						return $tabla->diagnostico; 
					}
				}
				return 'ERROR';
			}
		}
		
		function evaluacion_pliegues(){
			$valor = $this->metricas->p_biciptal + $this->metricas->p_triciptal + $this->metricas->p_subescapular + $this->metricas->p_suprailiaco;
			if($valor<15){
				return FALSE;
			}else{
				$valor = ceil($valor);
				$aux = $valor%5;
				if($aux>=3){
					$valor_aux = $valor+(5-$aux);
				}else{
					$valor_aux = $valor-$aux;
				}
				mysql_connect($this->host,$this->usr,$this->pass);
				mysql_select_db($this->db);
				$sql = 'select * from ';
				if($this->mujer){
					$sql.='tabla_pliegues_mujeres ';
				}else{
					$sql.='tabla_pliegues_hombres ';
				}
				$sql.= 'where sumatoria = '.$valor_aux.'';
				$res = mysql_query($sql);
				$tabla_pliegues = mysql_fetch_array($res,MYSQL_BOTH);
				
				if((17<=$this->anios)&&($this->anios<=29)){
					return $tabla_pliegues['17-29'];
				}else if((30<=$this->anios)&&($this->anios<=39)){
					return $tabla_pliegues['30-39'];
				}else if((40<=$this->anios)&&($this->anios<=49)){
					return $tabla_pliegues['40-49'];
				}else if(50<=$this->anios){
					return $tabla_pliegues['50mas'];
				}else{
					return FALSE;
				}
			}
		}

		function set_embarazo($p){
			$this->peso_pre_gesta = $p->peso_pre_gesta;
			$this->semana_gesta = $p->semana_gesta; 
			$this->fondo_uterino = isset($p->fondo_uterino)?$p->fondo_uterino:$p->semana_gesta;
		}
		
		function evaluacion_imc_embarazo(){
			$valor_imc = $this->peso_pre_gesta/($this->metricas->estatura*$this->metricas->estatura);
			$fondo = $this->fondo_uterino;
			$semana_alfehld = ($fondo + 4);
			$semana_mcdonald = ((20<=$fondo)&&($fondo<=31))?$fondo:-1;
			$embarazo['valor_imc'] = $valor_imc;
			if(30<=$valor_imc){
				$embarazo['imc'] = 'Obesidad';
				$embarazo['peso_ganancia'] = '5-9';
				$embarazo['peso_esperado'] = $this->peso_pre_gesta+(0.183*$this->semana_gesta);
				$embarazo['peso_esperado_alfehld'] = $this->peso_pre_gesta+(0.183*$semana_alfehld);
				$embarazo['peso_esperado_mcdonald'] = ($semana_mcdonald>0)?$this->peso_pre_gesta+(0.183*$semana_mcdonald):'N/A';
				return $embarazo; 
			}else if((25<=$valor_imc)&&($valor_imc<30)){
				$embarazo['imc'] = 'Sobrepeso';
				$embarazo['peso_ganancia'] = '7-11';
				$embarazo['peso_esperado'] = $this->peso_pre_gesta+(0.237*$this->semana_gesta);
				$embarazo['peso_esperado_alfehld'] = $this->peso_pre_gesta+(0.237*$semana_alfehld);
				$embarazo['peso_esperado_mcdonald'] = ($semana_mcdonald>0)?$this->peso_pre_gesta+(0.237*$semana_mcdonald):'N/A';
				return $embarazo;
			}else if((18.5<=$valor_imc)&&($valor_imc<25)){
				$embarazo['imc'] = 'Normal';
				$embarazo['peso_ganancia'] = '11-16';
				$embarazo['peso_esperado'] = $this->peso_pre_gesta+(0.267*$this->semana_gesta);
				$embarazo['peso_esperado_alfehld'] = $this->peso_pre_gesta+(0.267*$semana_alfehld);
				$embarazo['peso_esperado_mcdonald'] = ($semana_mcdonald>0)?$this->peso_pre_gesta+(0.267*$semana_mcdonald):'N/A';
				return $embarazo;
			}else if($valor_imc<18.5){
				$embarazo['imc'] = 'Bajo Peso';
				$embarazo['peso_ganancia'] = '12-18';
				$embarazo['peso_esperado'] = $this->peso_pre_gesta+(0.322*$this->semana_gesta);
				$embarazo['peso_esperado_alfehld'] = $this->peso_pre_gesta+(0.322*$semana_alfehld);
				$embarazo['peso_esperado_mcdonald'] = ($semana_mcdonald>0)?$this->peso_pre_gesta+(0.322*$semana_mcdonald):'N/A';
				return $embarazo;
			}else{
				$embarazo['valor_imc'] = 'ERROR';
				$embarazo['imc'] = 'ERROR';
				$embarazo['peso_ganancia'] = 'ERROR';
				$embarazo['peso_esperado'] = 'ERROR';
				$embarazo['peso_esperado_alfehld'] = 'ERROR';
				$embarazo['peso_esperado_mcdonald'] = 'ERROR';
				return $embarazo;
			}	
		}

		function evaluacion_imc(){
			$valor_imc = $this->metricas->peso/($this->metricas->estatura*$this->metricas->estatura);
			switch ($this->categoria) {
				case 'infante':{
					mysql_connect($this->host,$this->usr,$this->pass);
					mysql_select_db($this->db);
					$sql = 'select * from ';
					if($this->mujer){
						$sql.='tabla_bmi_ninas ';
					}else{
						$sql.='tabla_bmi_ninos ';
					}
					$sql.= 'where anios = '.$this->anios.' and meses = '.$this->meses.' ';
					$res = mysql_query($sql);
					$tabla_bmi = mysql_fetch_object($res);
					
					$sql2 = 'select * from tabla_evaluacion_antropometrica_criterios_ninos where evaluacion="imc"';
					$res2 = mysql_query($sql2);
					
					while($tabla = mysql_fetch_object($res2)){
						$aux_inf = ($tabla->valor_inf==NULL)?FALSE:"percil".intval($tabla->valor_inf)."";
						$aux_sup = ($tabla->valor_sup==NULL)?FALSE:"percil".intval($tabla->valor_sup)."";
						if(!$aux_sup){
							if($tabla_bmi->$aux_inf<=$valor_imc){
								return $tabla->diagnostico;
							}
						}
						if(!$aux_inf){
							if($valor_imc<$tabla_bmi->$aux_sup){
								return $tabla->diagnostico;
							}
						}
						if(($aux_inf)&&($aux_sup)){
							if(($tabla_bmi->$aux_inf<=$valor_imc)&&($valor_imc<$tabla_bmi->$aux_sup)){
								return $tabla->diagnostico;
							}	
						}
					}
					return 'ERROR';
					break;					
				}
				case 'adulto':{
					$sql2 = 'select * from tabla_evaluacion_antropometrica_criterios_adultos where evaluacion="imc"';
					$res2 = mysql_query($sql2);
					while($tabla = mysql_fetch_object($res2)){
					if($tabla->valor_inf==NULL){
						if($valor_imc<$tabla->valor_sup){
							return $tabla->diagnostico;
						}
					}
					if($tabla->valor_sup==NULL){
						if($tabla->valor_inf<=$valor_imc){
							return $tabla->diagnostico;
						}
					}
					if(($tabla->valor_inf<=$valor_imc)&&($valor_imc<$tabla->valor_sup)){
						return $tabla->diagnostico;
					}
				}
				return 'ERROR';
					break;
				}
				case 'embarazo':{
					if(30<=$valor_imc){
						return 'Obesidad'; 
					}else if((25<=$valor_imc)&&($valor_imc<30)){
						return 'Sobrepeso';
					}else if((18.5<=$valor_imc)&&($valor_imc<25)){
						return 'Normal';
					}else if($valor_imc<18.5){
						return 'Bajo Peso';
					}else{
						return 'ERROR';
					}
					break;
				}
				default:{
					break;
				}
			}
		}
		
		function evaluacion_cefalica(){
			$valor = $this->metricas->perim_cefalico;
			mysql_connect($this->host,$this->usr,$this->pass);
			mysql_select_db($this->db);
			$sql = 'select * from ';
			if($this->mujer){
				$sql.='tabla_cabeza_ninas ';
			}else{
				$sql.='tabla_cabeza_ninos ';
			}
			$sql.= 'where anios = '.$this->anios.' and meses = '.$this->meses.' ';
			$res = mysql_query($sql);
			$tabla_cabeza = mysql_fetch_object($res);
			$sql2 = 'select * from tabla_evaluacion_antropometrica_criterios_ninos where evaluacion="cabeza_edad"';
			$res2 = mysql_query($sql2);
			while($tabla = mysql_fetch_object($res2)){
				$aux_inf = ($tabla->valor_inf==NULL)?FALSE:"percil".intval($tabla->valor_inf)."";
				$aux_sup = ($tabla->valor_sup==NULL)?FALSE:"percil".intval($tabla->valor_sup)."";
				if(!$aux_sup){
					if($tabla_cabeza->$aux_inf<=$valor){
						return $tabla->diagnostico;
					}
				}
				if(!$aux_inf){
					if($valor<$tabla_cabeza->$aux_sup){
						return $tabla->diagnostico;
					}
				}
				if(($aux_inf)&&($aux_sup)){
					if(($tabla_cabeza->$aux_inf<=$valor)&&($valor<$tabla_cabeza->$aux_sup)){
						return $tabla->diagnostico;
					}
				}
			}
			return 'ERROR';
		}
		
		function evaluacion_brazo(){
			if(($this->anios==0)&&($this->meses<3)){
				return 'Edad fuera de rango de análisis';
			}
			$valor = $this->metricas->c_brazo;
			mysql_connect($this->host,$this->usr,$this->pass);
			mysql_select_db($this->db);
			$sql = 'select * from ';
			if($this->mujer){
				$sql.='tabla_brazo_ninas ';
			}else{
				$sql.='tabla_brazo_ninos ';
			}
			$sql.= 'where anios = '.$this->anios.' and meses = '.$this->meses.' ';
			$res = mysql_query($sql);
			$tabla_brazo = mysql_fetch_object($res);
			
			$sql2 = 'select * from tabla_evaluacion_antropometrica_criterios_ninos where evaluacion="brazo_edad"';
			$res2 = mysql_query($sql2);
			while($tabla = mysql_fetch_object($res2)){
				$aux_inf = ($tabla->valor_inf==NULL)?FALSE:"percil".intval($tabla->valor_inf)."";
				$aux_sup = ($tabla->valor_sup==NULL)?FALSE:"percil".intval($tabla->valor_sup)."";
				if(!$aux_sup){
					if($tabla_brazo->$aux_inf<$valor){
						return $tabla->diagnostico;
					}
				}
				if(!$aux_inf){
					if($valor<$tabla_brazo->$aux_sup){
						return $tabla->diagnostico;
					}
				}
				if(($aux_inf)&&($aux_sup)){
					if(($tabla_brazo->$aux_inf<=$valor)&&($valor<=$tabla_brazo->$aux_sup)){
						return $tabla->diagnostico;
					}
				}
			}
			return 'ERROR';
		}

		function evaluacion_waterlow(){
			mysql_connect($this->host,$this->usr,$this->pass);
			mysql_select_db($this->db);
		//Evaluacion peso/edad
			$sql = 'select * from ';
			if($this->mujer){
				$sql.='tabla_peso_edad_ninas ';
			}else{
				$sql.='tabla_peso_edad_ninos ';
			}
			$sql.= 'where anios = '.$this->anios.' and meses = '.$this->meses.' ';
			$res = mysql_query($sql);
			$tabla = mysql_fetch_object($res);
			
			$valor_waterlow = $this->metricas->peso/$tabla->media*100;
			$waterlow['sustitucion_peso_edad'] = '('.$this->metricas->peso.'/'.$tabla->media.')x100';
			$sql2 = 'select * from tabla_evaluacion_antropometrica_criterios_ninos where evaluacion="waterlow" and tipo="peso_edad"';
			$res2 = mysql_query($sql2);
			
			while($tabla = mysql_fetch_object($res2)){
				if($tabla->valor_sup==NULL){
					if($tabla->valor_inf<=$valor_waterlow){
						$waterlow['peso_edad'] = $tabla->diagnostico;
					}
				}
				if($tabla->valor_inf==NULL){
					if($valor_waterlow<$tabla->valor_sup){
						$waterlow['peso_edad'] = $tabla->diagnostico;
					}
				}
				if(($tabla->valor_inf!=NULL)&&($tabla->valor_sup!=NULL)){
					if(($tabla->valor_inf<=$valor_waterlow)&&($valor_waterlow<$tabla->valor_sup)){
						$waterlow['peso_edad'] = $tabla->diagnostico;
					}
				}
			}
			
			if(!isset($waterlow['peso_edad'])){
				$waterlow['peso_edad'] = 'ERROR';
			}
			$waterlow['valor_peso_edad'] = $valor_waterlow;
		//Evaluacion peso/talla
		if(($this->metricas->estatura<0.49)||($this->mujer&&$this->metricas->estatura>1.37)||($this->metricas->estatura>1.45)){
			$waterlow['sustitucion_peso_estatura'] = 'Estatura fuera de rango';
			$waterlow['peso_estatura'] = 'Estatura fuera de rango';
			$waterlow['valor_peso_estatura'] = 0;
		}else{
			$estatura_cm = $this->metricas->estatura*100;
			$aux_talla = $estatura_cm - intval($estatura_cm) - 0.5;
			if($aux_talla<0){
				$talla = intval($estatura_cm);
			}else{
				$talla = intval($estatura_cm)+0.5;
			}
			$sql = 'select * from ';
			if($this->mujer){
				$sql.='tabla_peso_est_ninas ';
			}else{
				$sql.='tabla_peso_est_ninos ';
			}
			$sql.= 'where talla = '.($talla).' ';
			$res = mysql_query($sql);
			$tabla = mysql_fetch_object($res);
			
			$valor_waterlow = $this->metricas->peso/$tabla->media*100;
			$waterlow['sustitucion_peso_estatura'] = '('.$this->metricas->peso.'/'.$tabla->media.')x100';
			$sql2 = 'select * from tabla_evaluacion_antropometrica_criterios_ninos where evaluacion="waterlow" and tipo="peso_est"';
			$res2 = mysql_query($sql2);
			
			while($tabla = mysql_fetch_object($res2)){
				if($tabla->valor_sup==NULL){
					if($tabla->valor_inf<=$valor_waterlow){
						$waterlow['peso_estatura'] = $tabla->diagnostico;
					}
				}
				if($tabla->valor_inf==NULL){
					if($valor_waterlow<$tabla->valor_sup){
						$waterlow['peso_estatura'] = $tabla->diagnostico;
					}
				}
				if(($tabla->valor_inf!=NULL)&&($tabla->valor_sup!=NULL)){
					if(($tabla->valor_inf<=$valor_waterlow)&&($valor_waterlow<$tabla->valor_sup)){
						$waterlow['peso_estatura'] = $tabla->diagnostico;
					}
				}
			}
			
			if(!isset($waterlow['peso_estatura'])){
				$waterlow['peso_estatura'] = 'ERROR';
			}
			$waterlow['valor_peso_estatura'] = $valor_waterlow;
		}
		//Evaluacion estatura/edad
			$sql = 'select * from ';
			if($this->mujer){
				$sql.='tabla_est_edad_ninas ';
			}else{
				$sql.='tabla_est_edad_ninos ';
			}
			$sql.= 'where anios = '.$this->anios.' and meses = '.$this->meses.' ';
			$res = mysql_query($sql);
			$tabla = mysql_fetch_object($res);
			
			$valor_waterlow = ($this->metricas->estatura*100)/$tabla->media*100;
			$waterlow['sustitucion_estatura_edad'] = '('.($this->metricas->estatura*100).'/'.$tabla->media.')x100';
			$sql2 = 'select * from tabla_evaluacion_antropometrica_criterios_ninos where evaluacion="waterlow" and tipo="est_edad"';
			$res2 = mysql_query($sql2);
			
			while($tabla = mysql_fetch_object($res2)){
				if($tabla->valor_sup==NULL){
					if($tabla->valor_inf<=$valor_waterlow){
						$waterlow['estatura_edad'] = $tabla->diagnostico;
					}
				}
				if($tabla->valor_inf==NULL){
					if($valor_waterlow<$tabla->valor_sup){
						$waterlow['estatura_edad'] = $tabla->diagnostico;
					}
				}
				if(($tabla->valor_inf!=NULL)&&($tabla->valor_sup!=NULL)){
					if(($tabla->valor_inf<=$valor_waterlow)&&($valor_waterlow<$tabla->valor_sup)){
						$waterlow['estatura_edad'] = $tabla->diagnostico;
					}
				}
			}
			
			if(!isset($waterlow['estatura_edad'])){
				$waterlow['estatura_edad'] = 'ERROR';
			}
			$waterlow['valor_estatura_edad'] = $valor_waterlow;
			
			return $waterlow;
		}

		function evaluacion_puntuacion_z(){
			mysql_connect($this->host,$this->usr,$this->pass);
			mysql_select_db($this->db);
		//Evaluacion peso/edad
			$sql = 'select * from ';
			if($this->mujer){
				$sql.='tabla_peso_edad_ninas ';
			}else{
				$sql.='tabla_peso_edad_ninos ';
			}
			$sql.= 'where anios = '.$this->anios.' and meses = '.$this->meses.' ';
			$res = mysql_query($sql);
			$tabla = mysql_fetch_object($res);
			
			$valor_z = ($this->metricas->peso-$tabla->media)/$tabla->desviacion_std;
			$z['sustitucion_peso_edad'] = '('.$this->metricas->peso.'-'.$tabla->media.')/'.$tabla->desviacion_std;
			$sql2 = 'select * from tabla_evaluacion_antropometrica_criterios_ninos where evaluacion="puntuacion_z" and tipo="peso_edad"';
			$res2 = mysql_query($sql2);
			
			while($tabla = mysql_fetch_object($res2)){
				if($tabla->valor_sup==NULL){
					if($tabla->valor_inf<=$valor_z){
						$z['peso_edad'] = $tabla->diagnostico;
					}
				}
				if($tabla->valor_inf==NULL){
					if($valor_z<$tabla->valor_sup){
						$z['peso_edad'] = $tabla->diagnostico;
					}
				}
				if(($tabla->valor_inf!=NULL)&&($tabla->valor_sup!=NULL)){
					if(($tabla->valor_inf<=$valor_z)&&($valor_z<$tabla->valor_sup)){
						$z['peso_edad'] = $tabla->diagnostico;
					}
				}
			}
			
			if(!isset($z['peso_edad'])){
				$z['peso_edad'] = 'ERROR';
			}
			$z['valor_peso_edad'] = $valor_z;
		//Evaluacion peso/talla
		if(($this->metricas->estatura<0.49)||($this->mujer&&$this->metricas->estatura>1.37)||($this->metricas->estatura>1.45)){
			$z['sustitucion_peso_estatura'] = 'Estatura fuera de rango';
			$z['peso_estatura'] = 'Estatura fuera de rango';
			$z['valor_peso_estatura'] = 0;
		}else{
			$estatura_cm = $this->metricas->estatura*100;
			$aux_talla = $estatura_cm - intval($estatura_cm) - 0.5;
			if($aux_talla<0){
				$talla = intval($estatura_cm);
			}else{
				$talla = intval($estatura_cm)+0.5;
			}
			$sql = 'select * from ';
			if($this->mujer){
				$sql.='tabla_peso_est_ninas ';
			}else{
				$sql.='tabla_peso_est_ninos ';
			}
			$sql.= 'where talla = '.($talla).' ';
			$res = mysql_query($sql);
			$tabla = mysql_fetch_object($res);
			
			$valor_z = ($this->metricas->peso-$tabla->media)/$tabla->desviacion_std;
			$z['sustitucion_peso_estatura'] = '('.$this->metricas->peso.'-'.$tabla->media.')/'.$tabla->desviacion_std;
			$sql2 = 'select * from tabla_evaluacion_antropometrica_criterios_ninos where evaluacion="puntuacion_z" and tipo="peso_est"';
			$res2 = mysql_query($sql2);
			
			while($tabla = mysql_fetch_object($res2)){
				if($tabla->valor_sup==NULL){
					if($tabla->valor_inf<=$valor_z){
						$z['peso_estatura'] = $tabla->diagnostico;
					}
				}
				if($tabla->valor_inf==NULL){
					if($valor_z<$tabla->valor_sup){
						$z['peso_estatura'] = $tabla->diagnostico;
					}
				}
				if(($tabla->valor_inf!=NULL)&&($tabla->valor_sup!=NULL)){
					if(($tabla->valor_inf<=$valor_z)&&($valor_z<$tabla->valor_sup)){
						$z['peso_estatura'] = $tabla->diagnostico;
					}
				}
			}
			
			if(!isset($z['peso_estatura'])){
				$z['peso_estatura'] = 'ERROR';
			}
			$z['valor_peso_estatura'] = $valor_z;
		}
		//Evaluacion estatura/edad
			$sql = 'select * from ';
			if($this->mujer){
				$sql.='tabla_est_edad_ninas ';
			}else{
				$sql.='tabla_est_edad_ninos ';
			}
			$sql.= 'where anios = '.$this->anios.' and meses = '.$this->meses.' ';
			$res = mysql_query($sql);
			$tabla = mysql_fetch_object($res);
			
			$valor_z = (($this->metricas->estatura*100)-$tabla->media)/$tabla->desviacion_std;
			$z['sustitucion_estatura_edad'] = '('.($this->metricas->estatura*100).'-'.$tabla->media.')/'.$tabla->desviacion_std;
			$sql2 = 'select * from tabla_evaluacion_antropometrica_criterios_ninos where evaluacion="puntuacion_z" and tipo="est_edad"';
			$res2 = mysql_query($sql2);
			
			while($tabla = mysql_fetch_object($res2)){
				if($tabla->valor_sup==NULL){
					if($tabla->valor_inf<=$valor_z){
						$z['estatura_edad'] = $tabla->diagnostico;
					}
				}
				if($tabla->valor_inf==NULL){
					if($valor_z<$tabla->valor_sup){
						$z['estatura_edad'] = $tabla->diagnostico;
					}
				}
				if(($tabla->valor_inf!=NULL)&&($tabla->valor_sup!=NULL)){
					if(($tabla->valor_inf<=$valor_z)&&($valor_z<$tabla->valor_sup)){
						$z['estatura_edad'] = $tabla->diagnostico;
					}
				}
			}
			
			if(!isset($z['estatura_edad'])){
				$z['estatura_edad'] = 'ERROR';
			}
			$z['valor_estatura_edad'] = $valor_z;
			
			return $z;
		}
//Funciones para obtener indices ideales
		function ideal_complexion(){
			if($this->metricas->c_muneca<=0){
				return '0';	
			}
			$valor = ($this->metricas->estatura*100)/$this->metricas->c_muneca;
			mysql_connect($this->host,$this->usr,$this->pass);
			mysql_select_db($this->db);
			$sql = 'select * from tabla_evaluacion_antropometrica_criterios_adultos where ';
			$sql.= 'evaluacion="complexion" ';
			$sql2 = 'select * from tabla_evaluacion_antropometrica_ideal_complexion where ';
			$sql2.= 'estatura_inf<='.($this->metricas->estatura*100).' ';
			$sql2.= 'and estatura_sup>'.($this->metricas->estatura*100).' ';
			if($this->mujer){
				$sql.= 'and sexo="Femenino" ';
				$sql2.= 'and sexo="Femenino" ';
				$res = mysql_query($sql);
				while($tabla = mysql_fetch_object($res)){
					if($tabla->valor_inf==NULL){
						if($valor<$tabla->valor_sup){
							$aux_diagnostico = $tabla->diagnostico;
						}
					}
					if($tabla->valor_sup==NULL){
						if($tabla->valor_inf<=$valor){
							$aux_diagnostico = $tabla->diagnostico;
						}
					}
					if(($tabla->valor_inf<=$valor)&&($valor<$tabla->valor_sup)){
						$aux_diagnostico = $tabla->diagnostico; 
					}
				}
			}else{
				$sql.= 'and sexo="Masculino" ';
				$sql2.= 'and sexo="Masculino" ';
				$res = mysql_query($sql);
				while($tabla = mysql_fetch_object($res)){
					if($tabla->valor_inf==NULL){
						if($valor<$tabla->valor_sup){
							$aux_diagnostico = $tabla->diagnostico;
						}
					}
					if($tabla->valor_sup==NULL){
						if($tabla->valor_inf<=$valor){
							$aux_diagnostico = $tabla->diagnostico;
						}
					}
					if(($tabla->valor_inf<=$valor)&&($valor<$tabla->valor_sup)){
						$aux_diagnostico = $tabla->diagnostico; 
					}
				}
			}
			$res2 = mysql_query($sql2);
			if(isset($aux_diagnostico)&&$res2){
				$tabla = mysql_fetch_object($res2);
				switch($aux_diagnostico){
					case 'Peque&ntilde;a':{return $tabla->pequenia;}
					case 'Mediana':{return $tabla->mediana;}
					case 'Grande':{return $tabla->grande;}
					default:{return $aux_diagnostico;}
				}	
			}else{
				return 'ERROR';
			}
		}

		function ideal_porcentaje_grasa(){
			mysql_connect($this->host,$this->usr,$this->pass);
			mysql_select_db($this->db);
			$sql = 'select * from tabla_evaluacion_antropometrica_ideal_porcentaje_grasa ';
			if($this->mujer){
				$sql.='where sexo="Femenino" ';
			}else{
				$sql.='where sexo="Masculino" ';
			}
			$sql.='and edad_inf<='.$this->anios.' and '.$this->anios.'<=edad_sup ';
			$res = mysql_query($sql);
			if($res){
				$tabla = mysql_fetch_object($res);
				return ''.$tabla->porcentaje_inf.'%-'.$tabla->porcentaje_sup.'%';
			}else{
				return 'Error, valor fuera de los par&acute;metros.';
			}
		}

		function ideal_cintura_cadera(){
			if($this->metricas->c_cadera<=0){
				return '0';	
			}
			$valor = $this->metricas->c_cintura/$this->metricas->c_cadera;
			if($this->mujer){
				return '0.71-0.84';
			}else{	
				return '0.78-0.93';
			}
		}
		
		function ideal_imc_embarazo(){
			return '18.5-24.9';	
		}

		function ideal_imc(){
			$valor_imc = $this->metricas->peso/($this->metricas->estatura*$this->metricas->estatura);
			switch ($this->categoria) {
				case 'infante':{
					mysql_connect($this->host,$this->usr,$this->pass);
					mysql_select_db($this->db);
					$sql = 'select * from ';
					if($this->mujer){
						$sql.='tabla_bmi_ninas ';
					}else{
						$sql.='tabla_bmi_ninos ';
					}
					$sql.= 'where anios = '.$this->anios.' and meses = '.$this->meses.' ';
					$res = mysql_query($sql);
					$tabla_bmi = mysql_fetch_object($res);
					return ''.$tabla_bmi->percil5.'-'.$tabla_bmi->percil85.'';
					break;					
				}
				case 'adulto':{
					return '18.5-24.9';
					break;
				}
				case 'embarazo':{
					return '18.5-24.9';
					break;
				}
				default:{
					return 'ERROR';
					break;
				}
			}
		}
		
		function ideal_cefalica(){
			$valor = $this->metricas->perim_cefalico;
			mysql_connect($this->host,$this->usr,$this->pass);
			mysql_select_db($this->db);
			$sql = 'select * from ';
			if($this->mujer){
				$sql.='tabla_cabeza_ninas ';
			}else{
				$sql.='tabla_cabeza_ninos ';
			}
			$sql.= 'where anios = '.$this->anios.' and meses = '.$this->meses.' ';
			$res = mysql_query($sql);
			$tabla_cabeza = mysql_fetch_object($res);
			return ''.$tabla_cabeza->percil5.'-'.$tabla_cabeza->percil95.'';
		}
		
		function ideal_brazo(){
			if(($this->anios==0)&&($this->meses<3)){
				return 'Edad fuera de rango de análisis';
			}
			$valor = $this->metricas->c_brazo;
			mysql_connect($this->host,$this->usr,$this->pass);
			mysql_select_db($this->db);
			$sql = 'select * from ';
			if($this->mujer){
				$sql.='tabla_brazo_ninas ';
			}else{
				$sql.='tabla_brazo_ninos ';
			}
			$sql.= 'where anios = '.$this->anios.' and meses = '.$this->meses.' ';
			$res = mysql_query($sql);
			$tabla_brazo = mysql_fetch_object($res);
			return ''.$tabla_brazo->percil5.'-'.$tabla_brazo->percil95.'';
		}

		function ideal_waterlow(){
			mysql_connect($this->host,$this->usr,$this->pass);
			mysql_select_db($this->db);
		//Evaluacion peso/edad
			$sql = 'select * from ';
			if($this->mujer){
				$sql.='tabla_peso_edad_ninas ';
			}else{
				$sql.='tabla_peso_edad_ninos ';
			}
			$sql.= 'where anios = '.$this->anios.' and meses = '.$this->meses.' ';
			$res = mysql_query($sql);
			$tabla = mysql_fetch_object($res);
			
			$waterlow['peso_edad'] = $tabla->media;
		//Evaluacion peso/talla
			$estatura_cm = $this->metricas->estatura*100;
			$aux_talla = $estatura_cm - intval($estatura_cm) - 0.5;
			if($aux_talla<0){
				$talla = intval($estatura_cm);
			}else{
				$talla = intval($estatura_cm)+0.5;
			}
			if($this->metricas->estatura<0.49){
				$talla = 49;
			}else if($this->mujer&&$this->metricas->estatura>1.37){
				$talla = 13.7;
			}else if($this->metricas->estatura>1.45){
				$talla = 145;
			}
			$sql = 'select * from ';
			if($this->mujer){
				$sql.='tabla_peso_est_ninas ';
			}else{
				$sql.='tabla_peso_est_ninos ';
			}
			$sql.= 'where talla = '.($talla).' ';
			$res = mysql_query($sql);
			$tabla = mysql_fetch_object($res);
			
			$waterlow['peso_estatura'] = $tabla->media;
		//Evaluacion estatura/edad
			$sql = 'select * from ';
			if($this->mujer){
				$sql.='tabla_est_edad_ninas ';
			}else{
				$sql.='tabla_est_edad_ninos ';
			}
			$sql.= 'where anios = '.$this->anios.' and meses = '.$this->meses.' ';
			$res = mysql_query($sql);
			$tabla = mysql_fetch_object($res);
			
			$waterlow['estatura_edad'] = $tabla->media;
			
			return $waterlow;
		}

		function ideal_puntuacion_z(){
			mysql_connect($this->host,$this->usr,$this->pass);
			mysql_select_db($this->db);
		//Evaluacion peso/edad
			$sql = 'select * from ';
			if($this->mujer){
				$sql.='tabla_peso_edad_ninas ';
			}else{
				$sql.='tabla_peso_edad_ninos ';
			}
			$sql.= 'where anios = '.$this->anios.' and meses = '.$this->meses.' ';
			$res = mysql_query($sql);
			$tabla = mysql_fetch_object($res);
			
			$z['peso_edad'] = ''.$tabla->media-$tabla->desviacion_std.'-'.$tabla->media+$tabla->desviacion_std.'';
		//Evaluacion peso/talla
			$estatura_cm = $this->metricas->estatura*100;
			$aux_talla = $estatura_cm - intval($estatura_cm) - 0.5;
			if($aux_talla<0){
				$talla = intval($estatura_cm);
			}else{
				$talla = intval($estatura_cm)+0.5;
			}
			if($this->metricas->estatura<0.49){
				$talla = 49;
			}else if($this->mujer&&$this->metricas->estatura>1.37){
				$talla = 137;
			}else if($this->metricas->estatura>1.45){
				$talla = 145;
			}
			$sql = 'select * from ';
			if($this->mujer){
				$sql.='tabla_peso_est_ninas ';
			}else{
				$sql.='tabla_peso_est_ninos ';
			}
			$sql.= 'where talla = '.($talla).' ';
			$res = mysql_query($sql);
			$tabla = mysql_fetch_object($res);
			
			$z['peso_estatura'] = ''.$tabla->media-$tabla->desviacion_std.'-'.$tabla->media+$tabla->desviacion_std.'';
		//Evaluacion estatura/edad
			$sql = 'select * from ';
			if($this->mujer){
				$sql.='tabla_est_edad_ninas ';
			}else{
				$sql.='tabla_est_edad_ninos ';
			}
			$sql.= 'where anios = '.$this->anios.' and meses = '.$this->meses.' ';
			$res = mysql_query($sql);
			$tabla = mysql_fetch_object($res);
			
			$z['estatura_edad'] = ''.$tabla->media-$tabla->desviacion_std.'-'.$tabla->media+$tabla->desviacion_std.'';
			
			return $z;
		}
	}
	
?>