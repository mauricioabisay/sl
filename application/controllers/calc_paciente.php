<?php
include ('clase.php');
	/**
	 * 
	 */
	class Calc_paciente extends clase{
		
		public $metricas;
		public $variables;
		public $mujer;
		public $edad;
		public $anios;
		public $meses;
		public $categoria;
		
		function __construct($metricas,$edad,$mujer){
			parent::__construct();
			$this->metricas = $metricas;
			$this->edad = $edad;
			$this->mujer = $mujer;
			$this->anios = intval($edad);
			$this->meses = ($edad-$this->anios)*12;
		}
		
		function set_variables($variables){
			$this->variables = $variables;
		}
		
		function calculo_infante(){
			mysql_connect($this->host,$this->usr,$this->pass);
			mysql_select_db($this->db);
			$sql = 'select * from ';
			if($this->mujer){
				$sql.='tabla_req_nutricios_ninas ';
			}else{
				$sql.='tabla_req_nutricios_ninos ';
			}
			if($this->anios<=0){
				$sql.= 'where anios = '.$this->anios.' and meses = '.$this->meses.' ';	
			}else{
				$sql.= 'where anios = '.$this->anios.'';
			}
			
			$res = mysql_query($sql);
			$tabla = mysql_fetch_object($res);
			return $tabla;
		}
		
		function harris(){
			foreach($this->variables as $variable){
				if($variable->formula == 'harris'){
					if($variable->tipo == 'factor'){
						$harris['fa'] = $variable->factor;
					}
				}
			}
			$harris['geb'] = $this->harris_gasto_energetico_basal()*$harris['fa'];
			if($this->mujer){
				$harris['geb_formula'] = '(655.1 + (9.56xPESO) + (1.85xESTATURA) - (4.68xEDAD))xFACTOR AMBULATORIO';
				$harris['geb_sustitucion'] = '(655.1 + (9.56x'.$this->metricas->peso.') + (1.85x'.($this->metricas->estatura*100).') - (4.68x'.$this->anios.'))x'.$harris['fa'];	
			}else{
				$harris['geb_formula'] = '(66.5 + (13.75xPESO) + (5.08xESTATURA) - (6.78xEDAD))xFACTOR AMBULATORIO';
				$harris['geb_sustitucion'] = '(66.5 + (13.75x'.$this->metricas->peso.') + (5.08x'.($this->metricas->estatura*100).') - (6.78x'.$this->anios.'))x'.$harris['fa'];
			}
			$harris['eta'] = $harris['geb']*.10;
			$harris['eta_formula'] = '10.00% del GEB';
			$harris['eta_sustitucion'] = ''.$harris['geb'].'x0.10';
			$harris['ecs'] = 0;
			foreach($this->variables as $variable){
				if($variable->formula == 'harris'){
					if($variable->tipo == 'actividad'){
						$harris['eaf'] = ($variable->factor/100)*$harris['geb'];
						$harris['eaf_formula'] = ''.($variable->factor).'% del GEB';
						$harris['eaf_sustitucion'] = ''.$harris['geb'].'x'.($variable->factor/100).'';
					}elseif($variable->tipo == 'condicion'){
						$harris['ecs'] += $variable->factor*$harris['geb'];
					}
				}
			}
			$harris['total'] = (($harris['geb']*$harris['fa'])+$harris['eta']+$harris['eaf']+$harris['ecs']);
			return $harris;
		}
		
		function harris_gasto_energetico_basal(){
			if($this->mujer){
				return 655.1 + (9.56*$this->metricas->peso) + (1.85*($this->metricas->estatura*100)) - (4.68*$this->anios);
			}else{
				return 66.5 + (13.75*$this->metricas->peso) + (5.08*($this->metricas->estatura*100)) - (6.78*$this->anios);	
			}
		}
		
		function shanblogue(){
			$shanblogue['geb'] = $this->shanblogue_gasto_energetico_basal();
			if($this->mujer){
				if($this->anios<=30){
					$shanblogue['geb_formula'] = '(15.3xPESO) + 679';
					$shanblogue['geb_sustitucion'] = '(15.3x'.$this->metricas->peso.') + 679';
				}else if($this->anios<=60){
					$shanblogue['geb_formula'] =  '(11.6xPESO) + 879';
					$shanblogue['geb_sustitucion'] =  '(11.6x'.$this->metricas->peso.') + 879';
				}else if(60<$this->anios){
					$shanblogue['geb_formula'] =  '(13.5xPESO) + 487';
					$shanblogue['geb_sustitucion'] =  '(13.5x'.$this->metricas->peso.') + 487';
				}
			}else{
				if($this->anios<=30){
					$shanblogue['geb_formula'] =  '(14.7xPESO) + 496';
					$shanblogue['geb_sustitucion'] =  '(14.7x'.$this->metricas->peso.') + 496';
				}else if($this->anios<=60){
					$shanblogue['geb_formula'] =  '(8.7xPESO) + 829';
					$shanblogue['geb_sustitucion'] =  '(8.7x'.$this->metricas->peso.') + 829';
				}else if(60<$this->anios){
					$shanblogue['geb_formula'] =  '(13.1xPESO) + 596';
					$shanblogue['geb_sustitucion'] =  '(13.1x'.$this->metricas->peso.') + 596';
				}
			}
			$shanblogue['ecs'] = 0;
			foreach($this->variables as $variable){
				if($variable->formula == 'shanblogue'){
					if($variable->tipo == 'actividad'){
						$shanblogue['eaf'] = ($variable->factor/100)*$shanblogue['geb'];
						$shanblogue['eaf_formula'] = ''.$variable->factor.'% del GEB';
						$shanblogue['eaf_sustitucion'] = ''.$shanblogue['geb'].'x'.($variable->factor/100).'';
					}else{
						$shanblogue['ecs'] += $variable->factor*$shanblogue['geb'];
					}
				}
			}
			$shanblogue['total'] = $shanblogue['geb']+$shanblogue['eaf']+$shanblogue['ecs'];
			return $shanblogue;
		}
		
		function shanblogue_gasto_energetico_basal(){
			if($this->mujer){
				if($this->anios<=30){
					return 15.3*$this->metricas->peso+679;
				}else if($this->anios<=60){
					return 11.6*$this->metricas->peso+879;
				}else if(60<$this->anios){
					return 13.5*$this->metricas->peso+487;
				}
			}else{
				if($this->anios<=30){
					return 14.7*$this->metricas->peso+496;
				}else if($this->anios<=60){
					return 8.7*$this->metricas->peso+829;
				}else if(60<$this->anios){
					return 13.1*$this->metricas->peso+596;
				}
			}
		}
		
		function mifflin(){
			if($this->mujer){
				$mifflin['total'] = 10*$this->metricas->peso + 6.25*($this->metricas->estatura*100) - 5*$this->anios - 161;
				$mifflin['formula'] = '(10xPESO) + (6.25xESTATURA) - (5xEDAD) - 161';
				$mifflin['sustitucion'] = '(10x'.$this->metricas->peso.') + (6.25x'.$this->metricas->estatura.') - (5x'.$this->anios.') - 161'; 
			}else{
				$mifflin['total'] = 10*$this->metricas->peso + 6.25*($this->metricas->estatura*100) - 5*$this->anios + 5;
				$mifflin['formula'] = '(10xPESO) + (6.25xESTATURA) - (5xEDAD) + 5';
				$mifflin['sustitucion'] = '(10x'.$this->metricas->peso.') + (6.25x'.$this->metricas->estatura.') - (5x'.$this->anios.') + 5';
			}
			return $mifflin;
		}
		
		function mifflin_gasto_energetico_basal(){
			if($this->mujer){
				return 10*$this->metricas->peso + 6.25*($this->metricas->estatura*100) - 5*$this->anios - 161;
			}else{
				return 10*$this->metricas->peso + 6.25*($this->metricas->estatura*100) - 5*$this->anios + 5;
			}
		}
		
	}
	
?>