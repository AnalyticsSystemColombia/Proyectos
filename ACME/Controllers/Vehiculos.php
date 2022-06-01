<?php 

class Vehiculos extends Controllers{
	public function __construct(){
		parent::__construct();
	}
	public function Vehiculos(){

		$data['page_tag'] = "Vehiculos";
		$data['page_title'] = "Vehiculos";
		$data['page_name'] = "Vehiculos";
		$data['page_functions_js'] = "functions_vehiculos.js";
		$this->views->getView($this,"vehiculos",$data);
	}

	public function setVehiculos(){
		if($_POST){
			if(empty($_POST['txtplaca']) || empty($_POST['listCondu']) || empty($_POST['txtmarca']) || empty($_POST['txtcolor']) || empty($_POST['listTipo']) || empty($_POST['txtpropietario']) || empty($_POST['listStatus']) ){
				$arrResponse = array("status" => false, "msg" => 'Datos incorrectos.');
			}else{ 
				$id_conductor = intval($_POST['id_conductor']);
				$strplaca = strClean($_POST['txtplaca']);
				$intCondu = intval(strClean($_POST['listCondu']));
				$strmarca = strClean($_POST['txtmarca']);
				$strcolor = strClean($_POST['txtcolor']);
				$strtipo = intval(strClean($_POST['listTipo']));
				$intpropi = strClean($_POST['txtpropietario']);
				$intStatus = intval(strClean($_POST['listStatus']));
				$request_veh ="";
				if($id_conductor == 0){
					$option = 1;
						$request_veh = $this->model->insertVehiculos(
						$strplaca,
						$intCondu, 
						$strmarca, 
						$strcolor, 
						$strtipo,
						$intpropi,  
						$intStatus );
					
				}else{
					$option = 2;
						$request_veh = $this->model->updateVehiculo($id_conductor,
						$strplaca, 
						$intCondu,
						$strmarca, 
						$strcolor, 
						$strtipo,
						$intpropi, 
						$intStatus);
					
				}
				if($request_veh > 0 ){
					if($option == 1){
						$arrResponse = array('status' => true, 'msg' => 'Datos guardados correctamente.');
					}else{
						$arrResponse = array('status' => true, 'msg' => 'Datos Actualizados correctamente.');
					}
				}else if($request_veh == 'exist'){
					$arrResponse = array('status' => false, 'msg' => '¡Atención! el Vehiculo ya esta asignado, ingrese otro.');		
				}else{
					$arrResponse = array("status" => false, "msg" => 'No es posible almacenar los datos.');
				}
			}
			echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
		}
		die();
	}

	public function getVehiculos()
	{
		$arrData = $this->model->selectVehiculos();
		for ($i=0; $i < count($arrData); $i++) {
			if($arrData[$i]['status'] == 1)
			{
				$arrData[$i]['status'] = '<span class="badge badge-success">Activo</span>';
			}else{
				$arrData[$i]['status'] = '<span class="badge badge-danger">Inactivo</span>';
			}
			if($arrData[$i]['tipo'] == 1){
                $arrData[$i]['tipo'] = '<span class="badge badge-success">Publico</span>';
			}else{
				$arrData[$i]['tipo'] = '<span class="badge badge-danger">Privado</span>';
			}
			
			$arrData[$i]['options'] = '<div class="text-center">
				<button class="btn btn-primary btn-sm btnEditVehiculos" rl="'.$arrData[$i]['id_conductor'].'" title="Editar"><i class="fas fa-pencil-alt"></i></button>
				<button class="btn btn-danger btn-sm btnDelVehiculo" rl="'.$arrData[$i]['id_conductor'].'" title="Eliminar"><i class="far fa-trash-alt"></i></button>
				</div>';
		}
		echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
		die();
	}
		

	public function getVehiculo($id_conductor){	
		
			$id_conductor = intval($id_conductor);
			if($id_conductor > 0){
				$arrData = $this->model->selectVehiculo($id_conductor);
				if(empty($arrData)){
					$arrResponse = array('status' => false, 'msg' => 'Datos no encontrados.');
				}else{
					$arrResponse = array('status' => true, 'data' => $arrData);
				}
				echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			}
		
		die();
	}

	public function delVehiculo(){
		if($_POST){
			$id_conductor = intval($_POST['id_conductor']);
			$requestDelete = $this->model->deleteVehiculo($id_conductor);
			if($requestDelete){
				$arrResponse = array('status' => true, 'msg' => 'Se ha eliminado el vehiculo');
			}else{
				$arrResponse = array('status' => false, 'msg' => 'Error al eliminar el vehiculo.');
		}
			echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
		}
		die();
	}

}
 ?>