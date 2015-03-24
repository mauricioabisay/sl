<?php
    /**
     * 
     */
    class Cita extends CI_Controller {
        
        function __construct() {
            parent::__construct();
			$this->load->helper('url');
			$this->load->library('form_validation');
			$this->load->library('session');
			$this->form_validation->set_error_delimiters('<span class="advertencia"><img src="'.base_url().'/assets/img/advertencia.png" width="15px" height="15px"><strong>', '</strong></span>');
        }
		
		function index(){
			$datos['menu'] = 'menu_cita';
			$datos['pagina'] = 'bienvenida';
			$this->load->view('plantilla',$datos);
		}
		
		function index_admin(){
			$datos['menu'] = 'menu_cita_admin';
			$datos['pagina'] = 'bienvenida';
			$this->load->view('plantilla',$datos);
		}

		function listado_citas_fecha(){
			$this->load->model('cita_modelo');
			if($this->input->post()){
				$dia = DateTime::createFromFormat('d/m/Y',$this->input->post('fecha'));
				$resultados = $this->cita_modelo->listado_citas_fecha($dia->format('Y-m-d'));
				if(isset($resultados) && $resultados != FALSE)
				foreach ($resultados as $cita) {
					echo '<tr class="'.$cita->status.'">';
						echo '<td>'.$cita->fecha.'</td>';
						echo '<td>'.$cita->hora.'</td>';
						echo '<td>'.$cita->status.'</td>';
						echo '<td>';
						$aux_tipo = ($cita->tipo=='Primera')?'modificar':'detalle';
						echo '<a href="'.site_url().'/paciente/'.$aux_tipo.'/'.$cita->paciente.'">';
						echo $cita->nombre.' '.$cita->ap.' '.$cita->am;
						echo '</a>';
						echo '</td>';
						echo '<td>'.$cita->tipo.'</td>';
					echo '<td>';
						echo '<strong>Infomarci&oacute;n Contacto</strong>';
						echo '<input id="mostrar_'.$cita->id.'" type="button" value="+" onclick="$(\'#contacto_'.$cita->id.'\').css(\'display\',\'block\');$(this).css(\'display\',\'none\');$(\'#ocultar_'.$cita->id.'\').css(\'display\',\'inline\')" />';
						echo '<input id="ocultar_'.$cita->id.'" type="button" value="-" onclick="$(\'#contacto_'.$cita->id.'\').css(\'display\',\'none\');$(this).css(\'display\',\'none\');$(\'#mostrar_'.$cita->id.'\').css(\'display\',\'inline\')" style="display:none" />';
						echo '<div id="contacto_'.$cita->id.'" style="display: none">';
						if(isset($cita->cel1)){echo '<div class="lineal"><strong>Celular</strong>:'.$cita->cel1.'</div>';}
						if(isset($cita->cel2)){echo '<div class="lineal"><strong>Celular</strong>:'.$cita->cel2.'</div>';}
						if(isset($cita->radio)){echo '<div class="lineal"><strong>Radio</strong>:'.$cita->radio.',<strong>ID</strong>:'.$cita->radio_id.'</div>';}
						if(isset($cita->tel_casa)){echo '<div class="lineal"><strong>Casa</strong>:'.$cita->tel_casa.'</div>';}
						if(isset($cita->tel_oficina)){echo '<div class="lineal"><strong>Oficina</strong>:'.$cita->tel_oficina.'<strong>Ext.</strong>:'.$cita->ext_oficina.'</div>';}
						echo '</div>';
					echo '</td>';
					echo '<td>';
							if($cita->status=='Confirmada'){
								echo '<a href="'.site_url().'/cita/cambiar_status_cita/'.$cita->id.'/Asistencia"><img src="'.base_url().'/assets/img/asistencia.png" width="32" height="32"></a>';
								echo '<a href="'.site_url().'/cita/cambiar_status_cita/'.$cita->id.'/Falta"><img src="'.base_url().'/assets/img/falta.png" width="32" height="32"></a>';
							}
							if($cita->status=='Asistencia')
								echo '<img src="'.base_url().'/assets/img/asistencia.png" width="32" height="32">';
							if($cita->status=='Falta')
								echo '<img src="'.base_url().'/assets/img/falta.png" width="32" height="32">';
							if(($cita->status!='Asistencia')&&($cita->status!='Falta')){
								if(($cita->status!='Confirmada')&&($cita->status!='Cancelada')&&($cita->status!='Transferida'))
									echo '<a href="'.site_url().'/cita/cambiar_status_cita/'.$cita->id.'/Confirmada"><img src="'.base_url().'/assets/img/circulo_verde.png" width="32" height="32"></a>';
								if(($cita->status!='Confirmada')&&($cita->status!='Asignada')&&($cita->status!='Cancelada')&&($cita->status!='Transferida'))
									echo '<a href="'.site_url().'/cita/cambiar_status_cita/'.$cita->id.'/Reservada"><img src="'.base_url().'/assets/img/circulo_amarillo.png" width="32" height="32"></a>';
								if(($cita->status!='Cancelada')&&($cita->status!='Transferida'))
									echo '<a href="'.site_url().'/cita/cambiar_status_cita/'.$cita->id.'/Cancelada"><img src="'.base_url().'/assets/img/circulo_rojo.png" width="32" height="32"></a>';
								if(($cita->status!='Cancelada')&&($cita->status!='Transferida'))
									echo '<a href="'.site_url().'/cita/cambiar_status_cita/'.$cita->id.'/Transferida"><img src="'.base_url().'/assets/img/transferencia.png" width="32" height="32"></a>';
							}
							if($cita->pagada=='No'){
								echo '<a href="'.site_url().'/cita/cambiar_status_cita/'.$cita->id.'/Adeudada"><img src="'.base_url().'/assets/img/deuda.png" width="32" height="32"></a>';
							}
							if($cita->pagada=='Si'){
								echo '<img src="'.base_url().'/assets/img/pago.png" width="32" height="32">';
							}
							//echo '<a href="'.site_url().'/cita/detalle/'.$cita->id.'"><img src="'.base_url().'/assets/img/detalle.png" width="32" height="32" id="detalle"></a>';
							echo '<a href="'.site_url().'/cita/agendar/'.$cita->paciente.'"><img src="'.base_url().'/assets/img/agregar.png" width="32" height="32" id="agendar"></a>';
						echo '</td>';
					echo '</tr>';
				}
			}else{
				$dia = new DateTime();
				$datos['dias_habiles_generales'] = $this->dias_habiles();
				$datos['resultados'] = $this->cita_modelo->listado_citas_fecha($dia->format('Y-m-d'));
				$datos['menu'] = 'menu_cita';
				$datos['pagina'] = 'cita/cita_listado';
				$this->load->view('plantilla',$datos);
			}
		}
		
		function listado_citas_nombre(){
			$this->load->model('cita_modelo');
			if($this->input->post()){
				$nombre = $this->input->post('nombre');
				$dia = new DateTime();
				$datos['dias_habiles_generales'] = $this->dias_habiles();
				$datos['resultados'] = $this->cita_modelo->listado_citas_nombre($nombre);
				$datos['menu'] = 'menu_cita';
				$datos['pagina'] = 'cita/cita_listado';
				$this->load->view('plantilla',$datos);
			}else{
				$dia = new DateTime();
				$datos['dias_habiles_generales'] = $this->dias_habiles();
				$datos['resultados'] = $this->cita_modelo->listado_citas_nombre($this->input->post('nombre'));
				$datos['menu'] = 'menu_cita';
				$datos['pagina'] = 'cita/cita_listado';
				$this->load->view('plantilla',$datos);
			}
		}
		
		function citas_doctor(){
			$usuario = $this->session->userdata('id');
			$this->load->model('cita_modelo');
			if($this->input->post()){
				$dia = DateTime::createFromFormat('d/m/Y',$this->input->post('fecha'));
				$resultados = $this->cita_modelo->listado_citas_doctor($usuario,$dia->format('Y-m-d'));
				if(isset($resultados) && $resultados != FALSE)
				foreach ($resultados as $cita) {
					echo '<tr class="'.$cita->status.'">';
						echo '<td>'.$cita->fecha.'</td>';
						echo '<td>'.$cita->hora.'</td>';
						echo '<td>';
						$aux_tipo = ($cita->tipo=='Primera')?'modificar':'detalle';
						echo '<a href="'.site_url().'/paciente/'.$aux_tipo.'/'.$cita->paciente.'">';
						echo $cita->nombre.' '.$cita->ap.' '.$cita->am;
						echo '</a>';
						echo '</td>';
						echo '<td>'.$cita->status.'</td>';
						echo '<td>'.$cita->tipo.'</td>';
					echo '<td>';
						echo '<strong>Infomarci&oacute;n Contacto</strong>';
						echo '<input id="mostrar_'.$cita->id.'" type="button" value="+" onclick="$(\'#contacto_'.$cita->id.'\').css(\'display\',\'block\');$(this).css(\'display\',\'none\');$(\'#ocultar_'.$cita->id.'\').css(\'display\',\'inline\')" />';
						echo '<input id="ocultar_'.$cita->id.'" type="button" value="-" onclick="$(\'#contacto_'.$cita->id.'\').css(\'display\',\'none\');$(this).css(\'display\',\'none\');$(\'#mostrar_'.$cita->id.'\').css(\'display\',\'inline\')" style="display:none" />';
						echo '<div id="contacto_'.$cita->id.'" style="display: none">';
						if(isset($cita->cel1)){echo '<div class="lineal"><strong>Celular</strong>:'.$cita->cel1.'</div>';}
						if(isset($cita->cel2)){echo '<div class="lineal"><strong>Celular</strong>:'.$cita->cel2.'</div>';}
						if(isset($cita->radio)){echo '<div class="lineal"><strong>Radio</strong>:'.$cita->radio.',<strong>ID</strong>:'.$cita->radio_id.'</div>';}
						if(isset($cita->tel_casa)){echo '<div class="lineal"><strong>Casa</strong>:'.$cita->tel_casa.'</div>';}
						if(isset($cita->tel_oficina)){echo '<div class="lineal"><strong>Oficina</strong>:'.$cita->tel_oficina.'<strong>Ext.</strong>:'.$cita->ext_oficina.'</div>';}
						echo '</div>';
					echo '</td>';
					echo '</tr>';
				}
			}else{
				$dia = new DateTime();
				$datos['dias_habiles_generales'] = $this->dias_habiles_doctor($usuario);
				$datos['resultados'] = $this->cita_modelo->listado_citas_doctor($usuario,$dia->format('Y-m-d'));
				$datos['menu'] = 'menu_principal';
				$datos['pagina'] = 'cita/extras/cita_doctor_listado';
				$this->load->view('plantilla',$datos);
			}
		}
		
		function busqueda_pacientes(){
			if($this->input->post()){
				$this->load->model('paciente_modelo');
				if(! $datos['resultados'] = $this->paciente_modelo->buscar_nombre($this->input->post('nombre')) ){
					$datos['tipo'] = 'advertencia';
					$datos['mensaje'] = 'No se han encontrado Pacientes con los datos de b&uacute;squeda proporcionados';
				}else{
					$datos['tipo'] = 'exito';
					$datos['mensaje'] = 'Coincidencias encontradas para "'.$this->input->post('nombre').'"';
				}
				$datos['menu'] = 'menu_cita';
				$datos['pagina'] = 'cita/paciente_listado';
				$this->load->view('plantilla',$datos);	
			}else{
				$datos['menu'] = 'menu_cita';
				$datos['pagina'] = 'cita/paciente_listado';
				$this->load->view('plantilla',$datos);
			}
		}

		function cambiar_status_cita($id,$status){
			$this->load->model('cita_modelo');
			$cita['status'] = $status;
			if($status=='Adeudada'){
				$actualizar['pagada'] = 'Si';
				$dia = DateTime::createFromFormat('Y-m-d',$this->cita_modelo->modificar($id,$actualizar));
			}else{
				$dia = DateTime::createFromFormat('Y-m-d',$this->cita_modelo->modificar($id,$cita));		
			}
			
			if($status=='Transferida'){
				$this->reagendar($id);
			}else if($status=='Cancelada'){
				$this->lista_espera_cita($id);
			}else{
				$datos['dias_habiles_generales'] = $this->dias_habiles();
				$datos['resultados'] = $this->cita_modelo->listado_citas_fecha($dia->format('Y-m-d'));
				$datos['menu'] = 'menu_cita';
				$datos['pagina'] = 'cita/cita_listado';
				$this->load->view('plantilla',$datos);	
			}
		}

		function agendar($id_paciente){
			$this->load->model('cita_modelo');
			$this->load->model('usuario_modelo');
			if($this->input->post()){
				$this->form_validation->set_rules('paciente','','required');
				$this->form_validation->set_rules('lista_espera','Lista de Espera','required');
//Venimos de un formulario
				if($this->form_validation->run()){
//Datos Validos
//Alta de Cita
					$cita['paciente'] = $preferencia['paciente'] = $this->input->post('paciente');
					$cita['status'] = 'Asignada';
					$cita['doctor'] = $this->input->post('doctor');
					$aux_fecha_cita = DateTime::createFromFormat('Y-m-d H:i:s',$this->input->post('fecha_hora'));
					$cita['hora'] = $aux_fecha_cita->format('H:i:s');
					$cita['fecha'] = $aux_fecha_cita->format('Y-m-d');
					$aux_tipo = $this->cita_modelo->es_nuevo($cita['paciente'])->tipo;
					$cita['tipo'] = ($aux_tipo=='Nuevo')?'Primera':'Recurrente';
					$cita['prioridad'] = $this->input->post('prioridad')?$this->input->post('prioridad'):'Normal';
					$cita['lista_espera'] = $this->input->post('lista_espera');
					$cita['pagada'] = $this->input->post('pagada')?$this->input->post('pagada'):'No';
					
					$duracion_cita = $this->cita_modelo->duracion_cita_doctor($cita['doctor']);					
					$aux_duracion_cita = ($aux_tipo=='Nuevo')?new DateInterval('PT'.$duracion_cita->tiempo_evaluacion_primera.'M'):new DateInterval('PT'.$duracion_cita->tiempo_evaluacion_recurrente.'M');
					$cita['hora_fin'] = $aux_fecha_cita->add($aux_duracion_cita)->format('H:i:s');
//Alta BD Cita
					$paciente['cita'] = $this->cita_modelo->agregar_cita($cita);
					$this->cita_modelo->borrar_preferencia_hora($preferencia['paciente']);
//Alta de Preferencias
					if($this->input->post('lista_espera')=='Si'){
						$aux_hora = $this->input->post('hora');
						
						$aux_h_i = $this->input->post('h_i');
						$aux_m_i = $this->input->post('m_i');
						$aux_ampm_i = $this->input->post('ampm_i');
						
						$aux_h_f = $this->input->post('h_f');
						$aux_m_f = $this->input->post('m_f');
						$aux_ampm_f = $this->input->post('ampm_f');
						
						$aux_lun = $this->input->post('lun');
						$aux_mar = $this->input->post('mar');
						$aux_mie = $this->input->post('mie');
						$aux_jue = $this->input->post('jue');
						$aux_vie = $this->input->post('vie');
						$aux_sab = $this->input->post('sab');
						$aux_dom = $this->input->post('dom');	
//Alta BD de control de preferencias
						//$preferencia['preferencia'] = $this->cita_modelo->agregar_preferencia($preferencia_horario);
						
						for($i=0;$i<sizeof($aux_hora);$i++){
							$preferencia['hora_nombre'] = $aux_hora[$i];
							if($aux_hora[$i]=='E'){
								$preferencia['hora_ini'] = '';
								$preferencia['hora_ini'] .= ($aux_ampm_i[$i]=='pm')&&($aux_h_i[$i]<12)?($aux_h_i[$i]+12):$aux_h_i[$i];
								$preferencia['hora_ini'] .= ':'.$aux_m_i[$i].':00';
								$preferencia['hora_fin'] = '';
								$preferencia['hora_fin'] .= ($aux_ampm_f[$i]=='pm')&&($aux_h_f[$i]<12)?($aux_h_f[$i]+12):$aux_h_f[$i];
								$preferencia['hora_fin'] .= ':'.$aux_m_f[$i].':00';
							}
							$preferencia['dias'] = '';
						
							if(isset($aux_lun[$i])){
								if($preferencia['dias']==''){$preferencia['dias'] .= $aux_lun[$i];}
								else{$preferencia['dias'] .= ','.$aux_lun[$i];}
							}
							if(isset($aux_mar[$i])){
								if($preferencia['dias']==''){$preferencia['dias'] .= $aux_mar[$i];}
								else{$preferencia['dias'] .= ','.$aux_mar[$i];}
							}
							if(isset($aux_mie[$i])){
								if($preferencia['dias']==''){$preferencia['dias'] .= $aux_mie[$i];}
								else{$preferencia['dias'] .= ','.$aux_mie[$i];}
							}
							if(isset($aux_jue[$i])){
								if($preferencia['dias']==''){$preferencia['dias'] .= $aux_jue[$i];}
								else{$preferencia['dias'] .= ','.$aux_jue[$i];}
							}
							if(isset($aux_vie[$i])){
								if($preferencia['dias']==''){$preferencia['dias'] .= $aux_vie[$i];}
								else{$preferencia['dias'] .= ','.$aux_vie[$i];}
							}
							if(isset($aux_sab[$i])){
								if($preferencia['dias']==''){$preferencia['dias'] .= $aux_sab[$i];}
								else{$preferencia['dias'] .= ','.$aux_sab[$i];}
							}
							if(isset($aux_dom[$i])){
								if($preferencia['dias']==''){$preferencia['dias'] .= $aux_dom[$i];}
								else{$preferencia['dias'] .= ','.$aux_dom[$i];}
							}
//Alta de Preferencias Horarias
							$this->cita_modelo->agregar_preferencia_hora($preferencia);
						}
					}
					
					$datos['tipo'] = 'exito';
					$datos['mensaje'] = 'Informaci&oacute;n del Paciente guardada';
					$dia = new DateTime();
					$datos['dias_habiles_generales'] = $this->dias_habiles();
					$datos['resultados'] = $this->cita_modelo->listado_citas_fecha($dia->format('Y-m-d'));
					$datos['menu'] = 'menu_cita';
					$datos['pagina'] = 'cita/cita_listado';
					$this->load->view('plantilla',$datos);
				}else{
//Datos Invalidos
					$datos['menu'] = 'menu_cita';
					$datos['pagina'] = 'cita/cita_agendar';
					$datos['id_paciente'] = $this->input->post('paciente');
					$this->session->set_userdata('tipo_paciente',$this->cita_modelo->tipo_cita($id_paciente));
					
					$datos['doctores'] = $this->usuario_modelo->buscar('and (tipo=1 or tipo=2) ');
					$datos['prioridades'] = $this->cita_modelo->prioridades();
					
					$datos['dias_habiles_generales'] = $this->dias_habiles_generales();
					$this->load->view('plantilla', $datos);
				}
			}else{
//No venimos de un formulario
				$datos['menu'] = 'menu_cita';
				$datos['pagina'] = 'cita/cita_agendar';
				$datos['id_paciente'] = $id_paciente;
				$this->session->set_userdata('tipo_paciente',$this->cita_modelo->tipo_cita($id_paciente));
				
				$datos['doctores'] = $this->usuario_modelo->buscar('and (tipo=1 or tipo=2) ');
				$datos['prioridades'] = $this->cita_modelo->prioridades();
				
				$datos['dias_habiles_generales'] = $this->dias_habiles_generales();
				$this->load->view('plantilla', $datos);				
			}
		}

		function dias_habiles_generales(){
			$this->load->model('cita_modelo');
			$horarios = $this->cita_modelo->dias_generales();
			$lunes = false;
			$martes = false;
			$miercoles = false;
			$jueves = false;
			$viernes = false;
			$sabado = false;
			$domingo = false;
			foreach($horarios as $h){
				if(stristr($h->dias, 'Lun') && !$lunes){
					$lunes = true;
					$dias_habiles[] = 1;
				}
				if(stristr($h->dias, 'Mar') && !$martes){
					$martes = true;
					$dias_habiles[] = 2;
				}
				if(stristr($h->dias, 'Mie') && !$miercoles){
					$miercoles = true;
					$dias_habiles[] = 3;
				}
				if(stristr($h->dias, 'Jue') && !$jueves){
					$jueves = true;
					$dias_habiles[] = 4;
				}
				if(stristr($h->dias, 'Vie') && !$viernes){
					$viernes = true;
					$dias_habiles[] = 5;
				}
				if(stristr($h->dias, 'Sab') && !$sabado){
					$sabado = true;
					$dias_habiles[] = 6;
				}
				if(stristr($h->dias, 'Dom') && !$domingo){
					$domingo = true;
					$dias_habiles[] = 0;
				}
			}
			return $dias_habiles;
		}

		function reagendar($id_cita){
			$this->load->model('cita_modelo');
			$this->load->model('usuario_modelo');
			$cita_cancelada = $this->cita_modelo->buscar_id($id_cita);
			
			$id_paciente = $cita_cancelada->paciente;
			$datos['cita_transferida'] = $id_cita;
			if($this->input->post()){
				$this->form_validation->set_rules('paciente','','required');
				$this->form_validation->set_rules('lista_espera','Lista de Espera','required');
//Venimos de un formulario
				if($this->form_validation->run()){
//Datos Validos
//Alta de Cita
					$cita['paciente'] = $preferencia['paciente'] = $this->input->post('paciente');
					$cita['status'] = 'Asignada';
					$cita['doctor'] = $this->input->post('doctor');
					$aux_fecha_cita = DateTime::createFromFormat('Y-m-d H:i:s',$this->input->post('fecha_hora'));
					$cita['hora'] = $aux_fecha_cita->format('H:i:s');
					$cita['fecha'] = $aux_fecha_cita->format('Y-m-d');
					$aux_tipo = $this->cita_modelo->es_nuevo($cita['paciente'])->tipo;
					$cita['tipo'] = ($aux_tipo=='Nuevo')?'Primera':'Recurrente';
					$cita['prioridad'] = $this->input->post('prioridad');
					$cita['lista_espera'] = $this->input->post('lista_espera');
					$cita['pagada'] = $cita_cancelada->pagada;
					
					$duracion_cita = $this->cita_modelo->duracion_cita_doctor($cita['doctor']);					
					$aux_duracion_cita = ($aux_tipo=='Nuevo')?new DateInterval('PT'.$duracion_cita->tiempo_evaluacion_primera.'M'):new DateInterval('PT'.$duracion_cita->tiempo_evaluacion_recurrente.'M');
					$cita['hora_fin'] = $aux_fecha_cita->add($aux_duracion_cita)->format('H:i:s');
//Alta BD Cita
					$paciente['cita'] = $this->cita_modelo->agregar_cita($cita);
					$this->cita_modelo->borrar_preferencia_hora($preferencia['paciente']);
//Alta de Preferencias
					if($this->input->post('lista_espera')=='Si'){
						$aux_hora = $this->input->post('hora');
						
						$aux_h_i = $this->input->post('h_i');
						$aux_m_i = $this->input->post('m_i');
						$aux_ampm_i = $this->input->post('ampm_i');
						
						$aux_h_f = $this->input->post('h_f');
						$aux_m_f = $this->input->post('m_f');
						$aux_ampm_f = $this->input->post('ampm_f');
						
						$aux_lun = $this->input->post('lun');
						$aux_mar = $this->input->post('mar');
						$aux_mie = $this->input->post('mie');
						$aux_jue = $this->input->post('jue');
						$aux_vie = $this->input->post('vie');
						$aux_sab = $this->input->post('sab');
						$aux_dom = $this->input->post('dom');	
//Alta BD de control de preferencias
						//$preferencia['preferencia'] = $this->cita_modelo->agregar_preferencia($preferencia_horario);
						
						for($i=0;$i<sizeof($aux_hora);$i++){
							$preferencia['hora_nombre'] = $aux_hora[$i];
							if($aux_hora[$i]=='E'){
								$preferencia['hora_ini'] = '';
								$preferencia['hora_ini'] .= ($aux_ampm_i[$i]=='pm')&&($aux_h_i[$i]<12)?($aux_h_i[$i]+12):$aux_h_i[$i];
								$preferencia['hora_ini'] .= ':'.$aux_m_i[$i].':00';
								$preferencia['hora_fin'] = '';
								$preferencia['hora_fin'] .= ($aux_ampm_f[$i]=='pm')&&($aux_h_f[$i]<12)?($aux_h_f[$i]+12):$aux_h_f[$i];
								$preferencia['hora_fin'] .= ':'.$aux_m_f[$i].':00';
							}
							$preferencia['dias'] = '';
						
							if(isset($aux_lun[$i])){
								if($preferencia['dias']==''){$preferencia['dias'] .= $aux_lun[$i];}
								else{$preferencia['dias'] .= ','.$aux_lun[$i];}
							}
							if(isset($aux_mar[$i])){
								if($preferencia['dias']==''){$preferencia['dias'] .= $aux_mar[$i];}
								else{$preferencia['dias'] .= ','.$aux_mar[$i];}
							}
							if(isset($aux_mie[$i])){
								if($preferencia['dias']==''){$preferencia['dias'] .= $aux_mie[$i];}
								else{$preferencia['dias'] .= ','.$aux_mie[$i];}
							}
							if(isset($aux_jue[$i])){
								if($preferencia['dias']==''){$preferencia['dias'] .= $aux_jue[$i];}
								else{$preferencia['dias'] .= ','.$aux_jue[$i];}
							}
							if(isset($aux_vie[$i])){
								if($preferencia['dias']==''){$preferencia['dias'] .= $aux_vie[$i];}
								else{$preferencia['dias'] .= ','.$aux_vie[$i];}
							}
							if(isset($aux_sab[$i])){
								if($preferencia['dias']==''){$preferencia['dias'] .= $aux_sab[$i];}
								else{$preferencia['dias'] .= ','.$aux_sab[$i];}
							}
							if(isset($aux_dom[$i])){
								if($preferencia['dias']==''){$preferencia['dias'] .= $aux_dom[$i];}
								else{$preferencia['dias'] .= ','.$aux_dom[$i];}
							}
//Alta de Preferencias Horarias
							$this->cita_modelo->agregar_preferencia_hora($preferencia);
						}
					}
					
					$datos['tipo'] = 'exito';
					$datos['mensaje'] = 'Cita del Paciente reagendada';
					
					$dia = DateTime::createFromFormat('Y-m-d H:i:s',$cita_cancelada->fecha.' '.$cita_cancelada->hora);
					$datos['resultados'] = $this->cita_modelo->listado_espera_fecha_cancelacion($dia,$id_paciente);
					$datos['menu'] = 'menu_cita';
					$datos['pagina'] = 'cita/cita_listado_espera';
					$datos['cita_transferida'] = $id_cita;
					$this->load->view('plantilla',$datos);
				}else{
//Datos Invalidos
					$datos['menu'] = 'menu_cita';
					$datos['pagina'] = 'cita/cita_agendar';
					$datos['id_paciente'] = $this->input->post('paciente');
					$this->session->set_userdata('tipo_paciente',$this->cita_modelo->tipo_cita($id_paciente));
					
					$datos['doctores'] = $this->usuario_modelo->buscar('and (tipo=1 or tipo=2)');
					$datos['prioridades'] = $this->cita_modelo->prioridades();
					
					$datos['dias_habiles_generales'] = $this->dias_habiles_generales();
					$this->load->view('plantilla', $datos);
				}
			}else{
//No venimos de un formulario
				$datos['menu'] = 'menu_cita';
				$datos['pagina'] = 'cita/cita_agendar';
				$datos['id_paciente'] = $id_paciente;
				$this->session->set_userdata('tipo_paciente',$this->cita_modelo->tipo_cita($id_paciente));
				
				$datos['doctores'] = $this->usuario_modelo->buscar('and (tipo=1 or tipo=2)');
				$datos['prioridades'] = $this->cita_modelo->prioridades();
				
				$datos['dias_habiles_generales'] = $this->dias_habiles_generales();
				$this->load->view('plantilla', $datos);				
			}
		}

		function transferir($id_cita_trans,$id_cita_objetivo){
			$this->load->model('cita_modelo');
			$this->load->model('usuario_modelo');
			$cita_objetivo = $this->cita_modelo->buscar_id($id_cita_objetivo);
			$cita_fuente = $this->cita_modelo->buscar_id($id_cita_trans);
			$id_paciente = $cita_objetivo->paciente;
//Transferencia de hora, fecha y doctor de la Cita a transferir
			$cita['status'] = 'Confirmada';
			
			$cita['tipo'] = $cita_fuente->tipo;
			$cita['prioridad'] = $cita_fuente->prioridad;
			$cita['lista_espera'] = $cita_fuente->lista_espera;
			$cita['pagada'] = $cita_fuente->pagada;
			
			$cita['doctor'] = $cita_objetivo->doctor;
			$cita['fecha'] = $cita_objetivo->fecha;
			$cita['hora'] = $cita_objetivo->hora;
			
			$aux_fecha_cita = DateTime::createFromFormat('H:i:s',$cita_objetivo->hora);
			
			$duracion_cita = $this->cita_modelo->duracion_cita_doctor($cita['doctor']);					
			$aux_duracion_cita = ($cita_fuente->tipo=='Primera')?new DateInterval('PT'.$duracion_cita->tiempo_evaluacion_primera.'M'):new DateInterval('PT'.$duracion_cita->tiempo_evaluacion_recurrente.'M');
			$cita['hora_fin'] = $aux_fecha_cita->add($aux_duracion_cita)->format('H:i:s');
//Actualizacion en la BD de la Cita Objetivo
			$paciente['cita'] = $this->cita_modelo->modificar($id_cita_trans,$cita);
//Preparación para mostrar la agenda en el dia anteriormente seleccionado
			$datos['tipo'] = 'exito';
			$datos['mensaje'] = 'Cancelación y Transferencia completadas exitosamente';
			$dia = DateTime::createFromFormat('Y-m-d H:i:s',$cita_objetivo->fecha.' '.$cita_objetivo->hora);
			$datos['dias_habiles_generales'] = $this->dias_habiles();
			$datos['resultados'] = $this->cita_modelo->listado_citas_fecha($dia->format('Y-m-d'));
			$datos['menu'] = 'menu_cita';
			$datos['pagina'] = 'cita/cita_listado';
			$this->load->view('plantilla',$datos);
		}

		function dias_habiles(){
			$this->load->model('cita_modelo');
			$horarios = $this->cita_modelo->dias_generales();
			$lunes = false;
			$martes = false;
			$miercoles = false;
			$jueves = false;
			$viernes = false;
			$sabado = false;
			$domingo = false;
			foreach($horarios as $h){
				if(stristr($h->dias, 'Lun') && !$lunes){
					$lunes = true;
					$dias_habiles[] = 1;
				}
				if(stristr($h->dias, 'Mar') && !$martes){
					$martes = true;
					$dias_habiles[] = 2;
				}
				if(stristr($h->dias, 'Mie') && !$miercoles){
					$miercoles = true;
					$dias_habiles[] = 3;
				}
				if(stristr($h->dias, 'Jue') && !$jueves){
					$jueves = true;
					$dias_habiles[] = 4;
				}
				if(stristr($h->dias, 'Vie') && !$viernes){
					$viernes = true;
					$dias_habiles[] = 5;
				}
				if(stristr($h->dias, 'Sab') && !$sabado){
					$sabado = true;
					$dias_habiles[] = 6;
				}
				if(stristr($h->dias, 'Dom') && !$domingo){
					$domingo = true;
					$dias_habiles[] = 0;
				}
			}
			return $dias_habiles;
		}
		
		function dia_disponible(){
			$this->load->model('cita_modelo');
			$this->load->model('usuario_modelo');	
			
			$dia = (!empty($_GET['dia']))?DateTime::createFromFormat('d-m-Y',$_GET['dia']):new DateTime();
//Obtener todos los doctores registrados en el sistema
			$doctores = $this->usuario_modelo->buscar('and (tipo=1 or tipo=2)');
			for($i=0;$i<61;$i++){
				$disponible = TRUE;
				foreach($doctores as $doctor){
					$disponible = TRUE;
					
					$dia_name = $dia->format('D');
					switch($dia_name){
						case 'Mon':{$dia_nombre='Lun';break;}
						case 'Tue':{$dia_nombre='Mar';break;}
						case 'Wed':{$dia_nombre='Mie';break;}
						case 'Thu':{$dia_nombre='Jue';break;}
						case 'Fri':{$dia_nombre='Vie';break;}
						case 'Sat':{$dia_nombre='Sab';break;}
						case 'Sun':{$dia_nombre='Dom';break;}
					}
					if($this->cita_modelo->is_dia_doctor($doctor->id, $dia_nombre)){
//El dia a evaluar esta en el horario del doctor actual
						$horas_consulta = $this->cita_modelo->horas_general_doctor_fecha($doctor->id,$dia);
						$citas = $this->cita_modelo->citas_ocupadas_doctor($doctor->id,$dia->format('Y-m-d'));
						$horas_inhabiles = $this->cita_modelo->horas_especiales_doctor($doctor->id,$dia->format('Y-m-d'),$dia_nombre,FALSE);
						$aux_intervalo_general = $aux_intervalo_cita_primera = new DateInterval('PT'.$horas_consulta[0]->tiempo_evaluacion_primera.'M');
						$aux_intervalo_cita_recurrente = new DateInterval('PT'.$horas_consulta[0]->tiempo_evaluacion_recurrente.'M');
						
						foreach($horas_consulta as $hora_consulta){
							$aux_hora_ini = DateTime::createFromFormat('H:i:s',$hora_consulta->hora_ini);
							$aux_hora_fin = DateTime::createFromFormat('H:i:s',$hora_consulta->hora_fin);
							$aux_intervalo = $aux_intervalo_general;
							
							while($aux_hora_ini<$aux_hora_fin){
								$aux_intervalo = $aux_intervalo_general;
								if(isset($citas)&&($citas)){
									foreach($citas as $cita){
										$aux_hora_ini_cita = DateTime::createFromFormat('H:i:s',$cita->hora);
										$aux_hora_fin_cita = DateTime::createFromFormat('H:i:s',$cita->hora);
										$aux_hora_fin_cita = ($cita->tipo=='Primera')?$aux_hora_fin_cita->add($aux_intervalo_cita_primera):$aux_hora_fin_cita->add($aux_intervalo_cita_recurrente);
										
										if(($aux_hora_ini_cita<=$aux_hora_ini)&&($aux_hora_ini<$aux_hora_fin_cita)){
											$aux_intervalo = ($cita->tipo=='Primera')?$aux_intervalo_cita_primera:$aux_intervalo_cita_recurrente;
											$disponible = FALSE;
											break;
										}else{
											$disponible = TRUE;
										}						
									}
								}else{
									$disponible = TRUE;
								}
								if(isset($horas_inhabiles)&&($horas_inhabiles)&&($disponible)){
									foreach($horas_inhabiles as $cita){
										$aux_hora_ini_cita = DateTime::createFromFormat('H:i:s',$cita->hora_ini);
										$aux_hora_fin_cita = DateTime::createFromFormat('H:i:s',$cita->hora_fin);
										
										if(($aux_hora_ini_cita<=$aux_hora_ini)&&($aux_hora_ini<$aux_hora_fin_cita)){
											$aux_intervalo = $aux_intervalo_general;
											$disponible = FALSE;
											break;
										}else{
											$disponible = TRUE;
										}						
									}
								}
								if($disponible){
									break;
								}
								$aux_hora_ini->add($aux_intervalo);
							}
						}
					}else{
//El dia acutal no esta en el horario del doctor actual
						$disponible = FALSE;
					}
					if($disponible){
						break;
					}
				}
				if($disponible){
					//$resultado[] = array('dia'=>$dia->format('d-m-Y'),'class'=>'libre');
				}else{
					//$resultado[] = array('dia'=>$dia->format('d-m-Y'),'class'=>'ocupado');
					$ocupado[] = array('dia'=>$dia->format('d-m-Y'));
				}
				$dia->add(date_interval_create_from_date_string('1 day'));
			}
			echo json_encode($ocupado);
			//$datos['resultados'] = $resultado;
			//$this->load->view('cita_tracker' ,$datos);
		}

		function dias_habiles_doctor($doctor){
			$this->load->model('cita_modelo');
			$datos['horario_general'] = $this->cita_modelo->dias_semana_doctor($doctor);
				foreach($datos['horario_general'] as $hora){
					if(stristr($hora->dias, 'Lun'))
						$aux_dias_habiles[] = 1;
					if(stristr($hora->dias, 'Mar'))
						$aux_dias_habiles[] = 2;
					if(stristr($hora->dias, 'Mie'))
						$aux_dias_habiles[] = 3;
					if(stristr($hora->dias, 'Jue'))
						$aux_dias_habiles[] = 4;
					if(stristr($hora->dias, 'Vie'))
						$aux_dias_habiles[] = 5;
					if(stristr($hora->dias, 'Sab'))
						$aux_dias_habiles[] = 6;
					if(stristr($hora->dias, 'Dom'))
						$aux_dias_habiles[] = 0;
				}
				return $aux_dias_habiles;
		}
		
		function doctor_disponible(){
			$this->load->model('cita_modelo');
			$this->load->model('usuario_modelo');
			$disponible = TRUE;
			$disponible_aux = FALSE;
			$doctores = $this->usuario_modelo->buscar('and (tipo=1 or tipo=2)');
			$horas_habiles_generales = $this->cita_modelo->horas_general_doctor($this->input->post('doctor'));
			$dia = DateTime::createFromFormat('d/m/Y',$this->input->post('fecha'));
			$citas = $this->cita_modelo->citas_doctor($this->input->post('doctor'),$dia->format('Y-m-d'));
			$dia_name = $dia->format('D');
			switch($dia_name){
				case 'Mon':{$dia_nombre='Lun';break;}
				case 'Tue':{$dia_nombre='Mar';break;}
				case 'Wed':{$dia_nombre='Mie';break;}
				case 'Thu':{$dia_nombre='Jue';break;}
				case 'Fri':{$dia_nombre='Vie';break;}
				case 'Sat':{$dia_nombre='Sab';break;}
				case 'Sun':{$dia_nombre='Dom';break;}
			}
			$horas_especiales = $this->cita_modelo->horas_especiales_doctor($this->input->post('doctor'),$dia->format('Y-m-d'),$dia_nombre,$this->input->post('reservada'));
			foreach($horas_habiles_generales as $hora_general){
//Definicion de los diferentes tipos de intervalo en los que aumenta la hora
				$aux_intervalo_general = $aux_intervalo_cita_primera = new DateInterval('PT'.$hora_general->tiempo_evaluacion_primera.'M');
				$aux_intervalo_cita_recurrente = new DateInterval('PT'.$hora_general->tiempo_evaluacion_recurrente.'M');

				if(stristr($hora_general->dias, $dia_nombre)){
					$aux_hora_ini = DateTime::createFromFormat('H:i:s',$hora_general->hora_ini);
					$aux_hora_fin = DateTime::createFromFormat('H:i:s',$hora_general->hora_fin);//$hora_general->hora_fin);
//Inicia el ciclo para aumentar la hora hasta llegar al medio dia, en caso de horas AM
					while($aux_hora_ini<$aux_hora_fin){
//Iniciar los valor por default de entra usaremos el intervalo general y supondremos que la hora esta libre para una cita
						$aux_intervalo = $aux_intervalo_general;
						$flag = TRUE;
						if(isset($horas_especiales)&&($horas_especiales)){
//Recorremos las horas especiales que haya dado de alta el doctor
						foreach($horas_especiales as $hora_especial){
							$aux_hora_especial_ini = DateTime::createFromFormat('H:i:s',$hora_especial->hora_ini);
							$aux_hora_especial_fin = DateTime::createFromFormat('H:i:s',$hora_especial->hora_fin);
//Checar si la hora actual esta entre el intervalo de hora especial y si es una hora en la que no se da consulta
							if(($aux_hora_especial_ini<=$aux_hora_ini)&&($aux_hora_ini<=$aux_hora_especial_fin)&&($hora_especial->hora_consulta!='Si')){
								$flag = FALSE;
								break;
							}else{
								$flag = TRUE;
							}
						}}
						if(isset($citas)&&($citas)){
//Recorremos las citas del doctor
						foreach($citas as $cita){
							$aux_hora_ini_cita = DateTime::createFromFormat('H:i:s',$cita->hora);
							$aux_hora_fin_cita = DateTime::createFromFormat('H:i:s',$cita->hora);
							$aux_hora_fin_cita = ($cita->tipo=='Primera')?$aux_hora_fin_cita->add($aux_intervalo_cita_primera):$aux_hora_fin_cita->add($aux_intervalo_cita_recurrente);
//Checar si la hora actual ya esta ocupada por una cita
							if(($aux_hora_ini_cita<=$aux_hora_ini)&&($aux_hora_ini<$aux_hora_fin_cita)&&($cita->status!='Cancelada')&&($cita->status!='Transferida')){
								$aux_intervalo = ($cita->tipo=='Primera')?$aux_intervalo_cita_primera:$aux_intervalo_cita_recurrente;
								$flag = FALSE;
								break;
							}else{
								$flag = TRUE;
							}
						}}
						if($flag){
							if($disponible){
								$disponible = FALSE;
								$disponible_aux = TRUE;
								$nombre = "";
								foreach($doctores as $d){
									if($d->id==$this->input->post('doctor')){
										$nombre = $d->nombre.' '.$d->ap;
									}
								}
								echo '<tr><th>'.$nombre.'</th></tr>';
							}
						}
						$aux_hora_ini->add($aux_intervalo);
					}
					//break;
				}
			}
		}
		
		function horas_habiles_doctor_am(){
			$this->load->model('cita_modelo');
			$this->load->model('usuario_modelo');
			$disponible = TRUE;
			$disponible_aux = FALSE;
			$doctores = $this->usuario_modelo->buscar('and (tipo=1 or tipo=2)');
			$horas_habiles_generales = $this->cita_modelo->horas_general_doctor($this->input->post('doctor'));
			$dia = DateTime::createFromFormat('d/m/Y',$this->input->post('fecha'));
			$citas = $this->cita_modelo->citas_doctor($this->input->post('doctor'),$dia->format('Y-m-d'));
			$dia_name = $dia->format('D');
			switch($dia_name){
				case 'Mon':{$dia_nombre='Lun';break;}
				case 'Tue':{$dia_nombre='Mar';break;}
				case 'Wed':{$dia_nombre='Mie';break;}
				case 'Thu':{$dia_nombre='Jue';break;}
				case 'Fri':{$dia_nombre='Vie';break;}
				case 'Sat':{$dia_nombre='Sab';break;}
				case 'Sun':{$dia_nombre='Dom';break;}
			}
			$horas_especiales = $this->cita_modelo->horas_especiales_doctor($this->input->post('doctor'),$dia->format('Y-m-d'),$dia_nombre,$this->input->post('reservada'));
			foreach($horas_habiles_generales as $hora_general){
//Definicion de los diferentes tipos de intervalo en los que aumenta la hora
				//$aux_intervalo_general = new DateInterval('PT30M');
				$aux_intervalo_general = $aux_intervalo_cita_primera = new DateInterval('PT'.$hora_general->tiempo_evaluacion_primera.'M');
				$aux_intervalo_cita_recurrente = new DateInterval('PT'.$hora_general->tiempo_evaluacion_recurrente.'M');

				if(stristr($hora_general->dias, $dia_nombre)){
					$aux_hora_ini = DateTime::createFromFormat('H:i:s',$hora_general->hora_ini);
					$aux_hora_fin = DateTime::createFromFormat('H:i:s',$hora_general->hora_fin);
					$medio_dia = DateTime::createFromFormat('H:i:s','12:00:00');
					$aux_hora_fin = ($aux_hora_fin<=$medio_dia)?$aux_hora_fin:$medio_dia;
//Inicia el ciclo para aumentar la hora hasta llegar al medio dia, en caso de horas AM
					while($aux_hora_ini<$aux_hora_fin){
//Iniciar los valor por default de entra usaremos el intervalo general y supondremos que la hora esta libre para una cita
						$aux_intervalo = $aux_intervalo_general;
						$flag = TRUE;
						if(isset($horas_especiales)&&($horas_especiales)){
//Recorremos las horas especiales que haya dado de alta el doctor
						foreach($horas_especiales as $hora_especial){
							$aux_hora_especial_ini = DateTime::createFromFormat('H:i:s',$hora_especial->hora_ini);
							$aux_hora_especial_fin = DateTime::createFromFormat('H:i:s',$hora_especial->hora_fin);
//Checar si la hora actual esta entre el intervalo de hora especial y si es una hora en la que no se da consulta
							if(($aux_hora_especial_ini<=$aux_hora_ini)&&($aux_hora_ini<=$aux_hora_especial_fin)&&($hora_especial->hora_consulta!='Si')){
								$flag = FALSE;
								break;
							}else{
								$flag = TRUE;
							}
						}}
						if(isset($citas)&&($citas)){
//Recorremos las citas del doctor
						foreach($citas as $cita){
							$aux_hora_ini_cita = DateTime::createFromFormat('H:i:s',$cita->hora);
							$aux_hora_fin_cita = DateTime::createFromFormat('H:i:s',$cita->hora);
							$aux_hora_fin_cita = ($cita->tipo=='Primera')?$aux_hora_fin_cita->add($aux_intervalo_cita_primera):$aux_hora_fin_cita->add($aux_intervalo_cita_recurrente);
//Checar si la hora actual ya esta ocupada por una cita
							if(($this->input->post('empalme')=='FALSE')&&($aux_hora_ini_cita<=$aux_hora_ini)&&($aux_hora_ini<$aux_hora_fin_cita)&&($cita->status!='Cancelada')&&($cita->status!='Transferida')){
								$aux_intervalo = ($cita->tipo=='Primera')?$aux_intervalo_cita_primera:$aux_intervalo_cita_recurrente;
								$flag = FALSE;
								break;
							}else{
								$flag = TRUE;
							}
						}}
						if($flag){
							if($disponible){
								$disponible = FALSE;
								$disponible_aux = TRUE;
								$otros = "";
								foreach($doctores as $d){
									if($d->id!=$this->input->post('doctor')){
										$otros .= "$('#select_hora_am_".$d->id."').val('');";
										$otros .= "$('#select_hora_pm_".$d->id."').val('');";
									}
								}
								echo '<select size="8" style="font-size: 105%" id="select_hora_am_'.$this->input->post('doctor').'" name="fecha_hora" '; 
								echo 'onclick="'.$otros.'';
								echo "$('#select_hora_pm_".$this->input->post('doctor')."').val('');";
								echo "$('#doctor').val(".$this->input->post('doctor').");";
								echo '">';
							}
							echo '<option value="'.$dia->format('Y-m-d').' '.$aux_hora_ini->format('H:i:s').'">'.$aux_hora_ini->format('H:i a').'</option>';
						}
						$aux_hora_ini->add($aux_intervalo);
					}
					break;
				}
			}
			if($disponible_aux){
				echo '</select>';
			}
		}

		function horas_habiles_doctor_pm(){
			$this->load->model('cita_modelo');
			$this->load->model('usuario_modelo');
			$disponible = TRUE;
			$disponible_aux = FALSE;
			$doctores = $this->usuario_modelo->buscar('and (tipo=1 or tipo=2)');
			$horas_habiles_generales = $this->cita_modelo->horas_general_doctor($this->input->post('doctor'));
			$dia = DateTime::createFromFormat('d/m/Y',$this->input->post('fecha'));
			$citas = $this->cita_modelo->citas_doctor($this->input->post('doctor'),$dia->format('Y-m-d'));
			$tipo_paciente = $this->session->userdata('tipo_paciente');
			$dia_name = $dia->format('D');
			switch($dia_name){
				case 'Mon':{$dia_nombre='Lun';break;}
				case 'Tue':{$dia_nombre='Mar';break;}
				case 'Wed':{$dia_nombre='Mie';break;}
				case 'Thu':{$dia_nombre='Jue';break;}
				case 'Fri':{$dia_nombre='Vie';break;}
				case 'Sat':{$dia_nombre='Sab';break;}
				case 'Sun':{$dia_nombre='Dom';break;}
			}
			$horas_especiales = $this->cita_modelo->horas_especiales_doctor($this->input->post('doctor'),$dia->format('Y-m-d'),$dia_nombre,$this->input->post('reservada'));
			foreach($horas_habiles_generales as $hora_general){
//Definicion de los diferentes tipos de intervalo en los que aumenta la hora
				//$aux_intervalo_general = new DateInterval('PT30M');
				$aux_intervalo_cita_primera = new DateInterval('PT'.$hora_general->tiempo_evaluacion_primera.'M');
				$aux_intervalo_cita_recurrente = new DateInterval('PT'.$hora_general->tiempo_evaluacion_recurrente.'M');

				$aux_intervalo_general = ($tipo_paciente=='Nuevo')?$aux_intervalo_cita_primera:$aux_intervalo_cita_recurrente;
				if(stristr($hora_general->dias, $dia_nombre)){
					$aux_hora_ini_bd = DateTime::createFromFormat('H:i:s',$hora_general->hora_ini);
					$aux_hora_ini_md = DateTime::createFromFormat('H:i:s','12:00:00');
					$aux_hora_ini = ($aux_hora_ini_md<=$aux_hora_ini_bd)?$aux_hora_ini_bd:$aux_hora_ini_md;
					$aux_hora_fin = DateTime::createFromFormat('H:i:s',$hora_general->hora_fin);
//Inicia el ciclo para aumentar la hora hasta llegar al medio dia, en caso de horas AM
					while($aux_hora_ini<$aux_hora_fin){
//Iniciar los valor por default de entra usaremos el intervalo general y supondremos que la hora esta libre para una cita
						$aux_intervalo = $aux_intervalo_general;
						$flag = TRUE;
						if(isset($horas_especiales)&&($horas_especiales)){
//Recorremos las horas especiales que haya dado de alta el doctor
						foreach($horas_especiales as $hora_especial){
							$aux_hora_especial_ini = DateTime::createFromFormat('H:i:s',$hora_especial->hora_ini);
							$aux_hora_especial_fin = DateTime::createFromFormat('H:i:s',$hora_especial->hora_fin);
//Checar si la hora actual esta entre el intervalo de hora especial y si es una hora en la que no se da consulta
							if(($aux_hora_especial_ini<=$aux_hora_ini)&&($aux_hora_ini<=$aux_hora_especial_fin)&&($hora_especial->hora_consulta!='Si')){
								$flag = FALSE;
								break;
							}else{
								$flag = TRUE;
							}
						}}
						if(isset($citas)&&($citas)){
//Recorremos las citas del doctor
						foreach($citas as $cita){
							$aux_hora_ini_cita = DateTime::createFromFormat('H:i:s',$cita->hora);
							$aux_hora_fin_cita = DateTime::createFromFormat('H:i:s',$cita->hora);
							$aux_hora_fin_cita = ($cita->tipo=='Primera')?$aux_hora_fin_cita->add($aux_intervalo_cita_primera):$aux_hora_fin_cita->add($aux_intervalo_cita_recurrente);
//Checar si la hora actual ya esta ocupada por una cita
							if(($this->input->post('empalme')=='FALSE')
							&&($aux_hora_ini_cita<$aux_hora_ini)
							&&($aux_hora_ini<$aux_hora_fin_cita)
							&&($cita->status!='Cancelada')&&($cita->status!='Transferida')){
								$aux_intervalo = ($cita->tipo=='Primera')?$aux_intervalo_cita_primera:$aux_intervalo_cita_recurrente;
								$flag = FALSE;
								break;
							}else{
								$flag = TRUE;
							}
						}}
						if($flag){
							if($disponible){
								$disponible = FALSE;
								$disponible_aux = TRUE;
								$otros = "";
								foreach($doctores as $d){
									if($d->id!=$this->input->post('doctor')){
										$otros .= "$('#select_hora_am_".$d->id."').val('');";
										$otros .= "$('#select_hora_pm_".$d->id."').val('');";
									}
								}
								echo '<select size="8" style="font-size: 105%" id="select_hora_pm_'.$this->input->post('doctor').'" name="fecha_hora"'; 
								echo 'onclick="'.$otros.'';
								echo "$('#select_hora_am_".$this->input->post('doctor')."').val('');";
								echo "$('#doctor').val(".$this->input->post('doctor').");";
								echo '">';
							}
							echo '<option value="'.$dia->format('Y-m-d').' '.$aux_hora_ini->format('H:i:s').'">'.$aux_hora_ini->format('h:i a').'</option>';
						}
						$aux_hora_ini->add($aux_intervalo);
					}
				}
			}
			if($disponible_aux){
				echo '</select>';
			}
		}
		
		function agregar_cita(){
		}
		
		function busqueda(){
		}
		
		function detalle($id){
		}
		
		function modificar($id){
		}
		
		function borrar($id){
		}
		
		function listado(){
		}
		
		function lista_espera(){
			$this->load->model('cita_modelo');
			if($this->input->post()){
				$dia = DateTime::createFromFormat('d/m/Y',$this->input->post('fecha'));
				$resultados = $this->cita_modelo->listado_espera_fecha($dia,FALSE);
				if(isset($resultados) && $resultados != FALSE)
				foreach ($resultados as $cita) {
					echo '<tr class="'.$cita->status.'">';
						echo '<td>'.$cita->nombre.' '.$cita->ap.' '.$cita->am.'</td>';
						echo '<td>'.$cita->status.'</td>';
						$aux_d = DateTime::createFromFormat('Y-m-d',$cita->fecha);
						echo '<td>'.$aux_d->format('d-m-Y').'</td>';
						echo '<td>'.$cita->hora.'</td>';
						echo '<td>'.$cita->tipo.'</td>';
					echo '</tr>';
				}
			}else{
				$dia = new DateTime();
				$datos['dias_habiles_generales'] = $this->dias_habiles();
				$datos['resultados'] = $this->cita_modelo->listado_espera_fecha($dia,FALSE);
				$datos['menu'] = 'menu_cita';
				$datos['pagina'] = 'cita/lista_espera';
				$this->load->view('plantilla',$datos);
			}
		}
		
		function lista_espera_cita($id_cita){
			$cita_cancelada = $this->cita_modelo->buscar_id($id_cita);
			$dia = DateTime::createFromFormat('Y-m-d H:i:s',$cita_cancelada->fecha.' '.$cita_cancelada->hora);
			$datos['resultados'] = $this->cita_modelo->listado_espera_fecha_cancelacion($dia,$cita_cancelada->paciente);
			$datos['menu'] = 'menu_cita';
			$datos['pagina'] = 'cita/cita_listado_espera';
			$datos['cita_cancelada'] = $id_cita;
			$this->load->view('plantilla',$datos);
		}
		
		function agregar_pre_paciente(){
			$this->load->model('cita_modelo');
			$this->load->model('usuario_modelo');
			$this->session->set_userdata('tipo_paciente','Nuevo');
			if($this->input->post()){
//Inicio procesamiento de formulario
//Inicio reglas
				$this->form_validation->set_rules('nombre','Nombre','required');
				$this->form_validation->set_rules('ap','Apellido Paterno','required');
				$this->form_validation->set_rules('am','Apellido Materno','required');
				$this->form_validation->set_rules('prioridad','Prioridad','required');
				$this->form_validation->set_rules('preferencia','Lista de Espera','required');
				$this->form_validation->set_rules('fecha_hora','Hora de Cita','required');
				$this->form_validation->set_rules('mail1','Correo Electr&oacute;nico','min_length[3]|max_length[50]|valid_email');
				if($this->input->post('tel_casa_d1')){
					$this->form_validation->set_rules('tel_casa_lada','Lada Tel. Casa','required');
					$this->form_validation->set_rules('tel_casa_d1','Tel. Casa','required');
					$this->form_validation->set_rules('tel_casa_d2','Tel. Casa','required');
					$this->form_validation->set_rules('tel_casa_d3','Tel. Casa','required');
					$this->form_validation->set_rules('tel_casa_d4','Tel. Casa','required');
				}
				if($this->input->post('tel_oficina_d1')){
					$this->form_validation->set_rules('tel_oficina_lada','Lada Tel. Oficina','required');
					$this->form_validation->set_rules('tel_oficina_d1','Tel. Oficina','required');
					$this->form_validation->set_rules('tel_oficina_d2','Tel. Oficina','required');
					$this->form_validation->set_rules('tel_oficina_d3','Tel. Oficina','required');
					$this->form_validation->set_rules('tel_oficina_d4','Tel. Oficina','required');
				}
				if($this->input->post('cel1_d3')){
					$this->form_validation->set_rules('cel1_d1','Tel. Celular 1','required');
					$this->form_validation->set_rules('cel1_d2','Tel. Celular 1','required');
					$this->form_validation->set_rules('cel1_d3','Tel. Celular 1','required');
					$this->form_validation->set_rules('cel1_d4','Tel. Celular 1','required');
					$this->form_validation->set_rules('cel1_d5','Tel. Celular 1','required');
				}
				if($this->input->post('cel2_d3')){
					$this->form_validation->set_rules('cel2_d1','Tel. Celular 2','required');
					$this->form_validation->set_rules('cel2_d2','Tel. Celular 2','required');
					$this->form_validation->set_rules('cel2_d3','Tel. Celular 2','required');
					$this->form_validation->set_rules('cel2_d4','Tel. Celular 2','required');
					$this->form_validation->set_rules('cel2_d5','Tel. Celular 2','required');
				}
				if($this->input->post('radio_d1')){
					$this->form_validation->set_rules('radio_d1','N&uacute;. Radio','required');
					$this->form_validation->set_rules('radio_d2','N&uacute;. Radio','required');
					$this->form_validation->set_rules('radio_d3','N&uacute;. Radio','required');
				}
				if($this->input->post('radio_id_d2')){
					$this->form_validation->set_rules('radio_id_d1','ID Radio','required');
					$this->form_validation->set_rules('radio_id_d2','ID Radio','required');
					$this->form_validation->set_rules('radio_id_d3','ID Radio','required');
				}
//Fin declaracion reglas
				if($this->form_validation->run()){
//Datos validos
					if($this->input->post('tel_casa_d1')){
						$tel_casa = $this->input->post('tel_casa_lada').$this->input->post('tel_casa_d1').$this->input->post('tel_casa_d2').$this->input->post('tel_casa_d3').$this->input->post('tel_casa_d4');	
					}
				
					if($this->input->post('tel_oficina_d1')){
						$tel_oficina = $this->input->post('tel_oficina_lada').$this->input->post('tel_oficina_d1').$this->input->post('tel_oficina_d2').$this->input->post('tel_oficina_d3').$this->input->post('tel_oficina_d4');	
					}
				
					if($this->input->post('cel1_d3')){
						$cel1 = $this->input->post('cel1_d1');
						$cel1 .=$this->input->post('cel1_d2');
						$cel1 .=$this->input->post('cel1_d3');
						$cel1 .=$this->input->post('cel1_d4');
						$cel1 .=$this->input->post('cel1_d5');
					}
				
					if($this->input->post('cel2_d3')){
						$cel2 = $this->input->post('cel2_d1');
						$cel2 .=$this->input->post('cel2_d2');
						$cel2 .=$this->input->post('cel2_d3');
						$cel2 .=$this->input->post('cel2_d4');
						$cel2 .=$this->input->post('cel2_d5');
					}
				
					if($this->input->post('radio_d1')){
						$radio = $this->input->post('radio_d1');
						$radio .=$this->input->post('radio_d2');
						$radio .=$this->input->post('radio_d3');
					}
				
					if($this->input->post('radio_id_d2')){
						$radio_id = $this->input->post('radio_id_d1');
						$radio_id .='*';
						$radio_id .=$this->input->post('radio_id_d2');
						$radio_id .='*';
						$radio_id .=$this->input->post('radio_id_d3');
					}
//Alta de Pre Paciente
					$paciente['nombre'] = $this->input->post('nombre');
					$paciente['ap'] = $this->input->post('ap');
					$paciente['am'] = $this->input->post('am');
					if($this->input->post('mail1')){
						$paciente['mail1'] = $this->input->post('mail1');	
					}
					$paciente['tipo'] = 'Nuevo';
					$paciente['servicio_alimentos'] = 'No';
					$paciente['fecha_ini'] = date('Y-m-d');
					if($this->input->post('referencia')){
						$paciente['referencia'] = $this->input->post('referencia');
					}
					if(isset($tel_casa)){
						$paciente['tel_casa'] = $tel_casa;	
					}
					if(isset($tel_oficina)){
						$paciente['tel_oficina'] = $tel_oficina;
						$paciente['ext_oficina'] = $this->input->post('ext_oficina');
					}	
					if(isset($cel1)){
						$paciente['cel1'] = $cel1;
					}
					if(isset($cel2)){
						$paciente['cel2'] = $cel2;	
					}
					if(isset($radio)){
						$paciente['radio'] = $radio;	
					}
					if(isset($radio_id)){
						$paciente['radio_id'] = $radio_id;	
					}
//Alta BD de pre paciente
					$cita['paciente']=$preferencia['paciente']=$id_paciente = $this->cita_modelo->agregar_pre_paciente($paciente);
//Alta Contro de Preferencias
					if($this->input->post('preferencia')=='Si'){
						$aux_hora = $this->input->post('hora');
						
						$aux_h_i = $this->input->post('h_i');
						$aux_m_i = $this->input->post('m_i');
						$aux_ampm_i = $this->input->post('ampm_i');
						
						$aux_h_f = $this->input->post('h_f');
						$aux_m_f = $this->input->post('m_f');
						$aux_ampm_f = $this->input->post('ampm_f');
						
						$aux_lun = $this->input->post('lun');
						$aux_mar = $this->input->post('mar');
						$aux_mie = $this->input->post('mie');
						$aux_jue = $this->input->post('jue');
						$aux_vie = $this->input->post('vie');
						$aux_sab = $this->input->post('sab');
						$aux_dom = $this->input->post('dom');	
//Alta BD de control de preferencias
						//$preferencia['preferencia'] = $this->cita_modelo->agregar_preferencia($preferencia_horario);
						
						for($i=0;$i<sizeof($aux_hora);$i++){
							$preferencia['hora_nombre'] = $aux_hora[$i];
							if($aux_hora[$i]=='E'){
								$preferencia['hora_ini'] = '';
								$preferencia['hora_ini'] .= ($aux_ampm_i[$i]=='pm')&&($aux_h_i[$i]<12)?($aux_h_i[$i]+12):$aux_h_i[$i];
								$preferencia['hora_ini'] .= ':'.$aux_m_i[$i].':00';
								$preferencia['hora_fin'] = '';
								$preferencia['hora_fin'] .= ($aux_ampm_f[$i]=='pm')&&($aux_h_f[$i]<12)?($aux_h_f[$i]+12):$aux_h_f[$i];
								$preferencia['hora_fin'] .= ':'.$aux_m_f[$i].':00';
							}
							$preferencia['dias'] = '';
						
							if(isset($aux_lun[$i])){
								if($preferencia['dias']==''){$preferencia['dias'] .= $aux_lun[$i];}
								else{$preferencia['dias'] .= ','.$aux_lun[$i];}
							}
							if(isset($aux_mar[$i])){
								if($preferencia['dias']==''){$preferencia['dias'] .= $aux_mar[$i];}
								else{$preferencia['dias'] .= ','.$aux_mar[$i];}
							}
							if(isset($aux_mie[$i])){
								if($preferencia['dias']==''){$preferencia['dias'] .= $aux_mie[$i];}
								else{$preferencia['dias'] .= ','.$aux_mie[$i];}
							}
							if(isset($aux_jue[$i])){
								if($preferencia['dias']==''){$preferencia['dias'] .= $aux_jue[$i];}
								else{$preferencia['dias'] .= ','.$aux_jue[$i];}
							}
							if(isset($aux_vie[$i])){
								if($preferencia['dias']==''){$preferencia['dias'] .= $aux_vie[$i];}
								else{$preferencia['dias'] .= ','.$aux_vie[$i];}
							}
							if(isset($aux_sab[$i])){
								if($preferencia['dias']==''){$preferencia['dias'] .= $aux_sab[$i];}
								else{$preferencia['dias'] .= ','.$aux_sab[$i];}
							}
							if(isset($aux_dom[$i])){
								if($preferencia['dias']==''){$preferencia['dias'] .= $aux_dom[$i];}
								else{$preferencia['dias'] .= ','.$aux_dom[$i];}
							}
//Alta de Preferencias Horarias
							$this->cita_modelo->agregar_preferencia_hora($preferencia);
						}
					}
//Alta de Cita
					$cita['status'] = 'Asignada';
					$cita['doctor'] = $this->input->post('doctor');
					$aux_fecha_cita = DateTime::createFromFormat('Y-m-d H:i:s',$this->input->post('fecha_hora'));
					$cita['hora'] = $aux_fecha_cita->format('H:i:s');
					$cita['fecha'] = $aux_fecha_cita->format('Y-m-d');
					$cita['tipo'] = 'Primera';
					$cita['prioridad'] = $this->input->post('prioridad');
					$cita['lista_espera'] = $this->input->post('preferencia');
					$cita['pagada'] = 'No';
					$duracion_cita = $this->cita_modelo->duracion_cita_doctor($cita['doctor']);					
					$aux_duracion_cita = new DateInterval('PT'.$duracion_cita->tiempo_evaluacion_primera.'M');
					$cita['hora_fin'] = $aux_fecha_cita->add($aux_duracion_cita)->format('H:i:s');
//Alta BD Cita
					$paciente['cita'] = $this->cita_modelo->agregar_cita($cita);
					$datos['tipo'] = 'exito';
					$datos['mensaje'] = 'Informaci&oacute;n del Paciente guardada';
					$dia = new DateTime();
					$datos['dias_habiles_generales'] = $this->dias_habiles();
					$datos['resultados'] = $this->cita_modelo->listado_citas_fecha($dia->format('Y-m-d'));
					$datos['menu'] = 'menu_cita';
					$datos['pagina'] = 'cita/cita_listado';
					$this->load->view('plantilla',$datos);
//Fin de Datos validos	
				}else{
//Datos invalidos
					$datos['tipo'] = 'advertencia';
					$datos['mensaje'] = 'Algunos datos proporcionados no son v&aacute;lidos';
					$datos['menu'] = 'menu_cita';
					$datos['pagina'] = 'cita/pre_paciente_agregar';
					
					$datos['doctores'] = $this->usuario_modelo->buscar('and (tipo=1 or tipo=2)');
					$datos['prioridades'] = $this->cita_modelo->prioridades();
					
					$datos['dias_habiles_generales'] = $this->dias_habiles_generales();
					$this->load->view('plantilla', $datos);
				}
//Fin de procesamiento de formulario
			}else{
//No venimos de un formulario
				$datos['menu'] = 'menu_cita';
				$datos['pagina'] = 'cita/pre_paciente_agregar';
				
				$datos['doctores'] = $this->usuario_modelo->buscar('and (tipo=1 or tipo=2)');
				$datos['prioridades'] = $this->cita_modelo->prioridades();
				
				$datos['dias_habiles_generales'] = $this->dias_habiles_generales();
				$this->load->view('plantilla', $datos);
			}
		}
    }
?>