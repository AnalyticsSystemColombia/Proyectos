<?php 

	class Conductores extends Controllers{
		public function __construct()
		{
			parent::__construct();
		}

		public function Conductores()
		{
			$data['page_tag'] = "Conductores";
			$data['page_name'] = "Conductores";
			$data['page_title'] = " <small> Conductores</small>";
			$data['page_functions_js'] = "functions_conductores.js";
			$this->views->getView($this,"conductores",$data);
		}

		public function getConductores()
		{
			$arrData = $this->model->selectConductores();

			for ($i=0; $i < count($arrData); $i++) {

				if($arrData[$i]['status'] == 1)
				{
					$arrData[$i]['status'] = '<span class="badge badge-success">Activo</span>';
				}else{
					$arrData[$i]['status'] = '<span class="badge badge-danger">Inactivo</span>';
				}

				$arrData[$i]['options'] = '<div class="text-center">
				<button class="btn btn-primary btn-sm btnEditConductor" rl="'.$arrData[$i]['id'].'" title="Editar"><i class="fas fa-pencil-alt"></i></button>
				<button class="btn btn-danger btn-sm btnDelConductor" rl="'.$arrData[$i]['id'].'" title="Eliminar"><i class="far fa-trash-alt"></i></button>
				</div>';
			}
			echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
			die();
		}

		public function getConductor(int $id)
		{
			$intId = intval(strClean($id));
			if($intId > 0)
			{
				$arrData = $this->model->selectConductor($intId);
				if(empty($arrData))
				{
					$arrResponse = array('status' => false, 'msg' => 'Datos no encontrados.');
				}else{
					$arrResponse = array('status' => true, 'data' => $arrData);
				}
				echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			}
			die();
		}

		public function setConductores(){
			
			$intId = intval($_POST['id']);
			$intCedula =  intval($_POST['txtcedula']);
			$strNombres = strClean($_POST['txtnombres']);
			$strApellidos = strClean($_POST['txtapellido']);
			$strDireccion = strClean($_POST['txtdireccion']);
			$intTelefono = intval($_POST['txttelefono']);
			$strCiudad = strClean($_POST['txtciudad']);
			$intStatus = intval($_POST['listStatus']);

			if($intId == 0)
			{
				//Crear
				$request_conduc = $this->model->insertConductor($intCedula, $strNombres,$strApellidos,$strDireccion,$intTelefono, $strCiudad,$intStatus);
				$option = 1;
			}else{
				//Actualizar
				$request_conduc = $this->model->updateConductor($intId,$intCedula, $strNombres,$strApellidos,$strDireccion,$intTelefono, $strCiudad,$intStatus);
				$option = 2;
			}

			if($request_conduc > 0 )
			{
				if($option == 1)
				{
					$arrResponse = array('status' => true, 'msg' => 'Datos guardados correctamente.');
				}else{
					$arrResponse = array('status' => true, 'msg' => 'Datos Actualizados correctamente.');
				}
			}else if($request_conduc == 'exist'){
				
				$arrResponse = array('status' => false, 'msg' => '¡Atención! El conductor ya existe.');
			}else{
				$arrResponse = array("status" => false, "msg" => 'No es posible almacenar los datos.');
			}
			echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			die();
		}

		public function delConductor()
		{
			if($_POST){
				$intId = intval($_POST['id']);
				$requestDelete = $this->model->deleteConductor($intId);
				if($requestDelete == 'ok')
				{
					$arrResponse = array('status' => true, 'msg' => 'Se ha eliminado el Conductor');
				}else if($requestDelete == 'exist'){
					$arrResponse = array('status' => false, 'msg' => 'No es posible eliminar Conductor.');
				}else{
					$arrResponse = array('status' => false, 'msg' => 'Error al eliminar el Conductor.');
				}
				echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			}
			die();
		}
		public function getSelectConductores(){
			$htmlOptions = "";
			$arrData = $this->model->selectConductores();
			if(count($arrData) > 0){
				for($i=0; $i < count($arrData); $i++){
					$htmlOptions .= '<option value="'.$arrData[$i]['id'].'">'.$arrData[$i]['nombres'].'</option>';
				}
			}
			echo $htmlOptions;
			die();
		}

	}
 ?>