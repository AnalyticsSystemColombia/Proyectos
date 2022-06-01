<?php 

	class ConductoresModel extends Mysql
	{
		public  $intId;
		public  $intCedula;
		public  $strNombres;	
		public  $strApellidos;
		public	$strDireccion;
		public	$intTelefono;
		public	$intCiudad;
		public  $intStatus;

		public function __construct()
		{
			parent::__construct();
		}

		public function selectConductores()
		{
			//extraer conductores
		    $sql = "SELECT *, CONCAT('',nombres,'', apellidos) as Nombres FROM conductores WHERE status != 0";
			$request = $this->select_all($sql);
			return $request;
		}

		public function selectConductor(int $id)
		{
			$this->id = $id;
			$sql = "SELECT * FROM conductores WHERE id = $this->id";
			$request = $this->select($sql);
			return $request;
		}

		public function insertConductor(int $Cedula, string $Nombres, string $Apellidos,string $Direccion, int $Telefono, string $Ciudad, int $Status )
		{

			$return = "";
			$this->intCedula =$Cedula;
			$this->strNombres =$Nombres;	
			$this->strApellidos = $Apellidos;
			$this->strDireccion =$Direccion;
			$this->intTelefono =$Telefono;
			$this->strCiudad =$Ciudad;
			$this->intStatus = $Status;
			$sql = "SELECT * FROM conductores WHERE cedula = '{$this->intCedula}' ";
			$request = $this->select_all($sql);

			if(empty($request))
			{
				$query_insert  = "INSERT INTO conductores(cedula,nombres,apellidos,direccion, telefono, ciudad,status) VALUES(?,?,?,?,?,?,?)";
	        	$arrData = array(
					$this->intCedula,
					$this->strNombres,
					$this->strApellidos,
					$this->strDireccion,
					$this->intTelefono,
					$this->strCiudad,
				    $this->intStatus);
	        	$request_insert = $this->insert($query_insert,$arrData);
	        	$return = $request_insert;
			}else{
				$return = "exist";
			}
			return $return;
		}	

		public function updateConductor(int $id, int $Cedula, string $Nombres, string $Apellidos,
		string $Direccion, int $Telefono, string $Ciudad, int $status ){
			$this->intId = $id;
			$this->intCedula =$Cedula;
			$this->strNombres =$Nombres;	
			$this->strApellidos = $Apellidos;
			$this->strDireccion =$Direccion;
			$this->intTelefono =$Telefono;
			$this->strCiudad =$Ciudad;
            $this->intStatus = $status;

			$sql = "SELECT * FROM conductores WHERE cedula = '$this->intCedula' AND id != $this->intId";
			$request = $this->select_all($sql);

			if(empty($request))
			{
				$sql = "UPDATE conductores SET cedula = ?, nombres = ?, apellidos = ?, direccion = ?, telefono = ?, ciudad = ?, status = ? WHERE id = $this->intId";
				$arrData = array(
					$this->intCedula,
					$this->strNombres,
					$this->strApellidos,
					$this->strDireccion,
					$this->intTelefono,
					$this->strCiudad,
				    $this->intStatus
				);
				$request = $this->update($sql,$arrData);
			}else{
				$request = "exist";
			}
		    return $request;			
		}
		public function deleteConductor(){
			$this->intId = $id;
			$sql = "SELECT * FROM conductores WHERE id = $this->intId";
			$request = $this->select_all($sql);
			if(empty($request))
			{
				$sql = "UPDATE conductores SET status = ? WHERE id = $this->intId ";
				$arrData = array(0);
				$request = $this->update($sql,$arrData);
				if($request)
				{
					$request = 'ok';	
				}else{
					$request = 'error';
				}
			}else{
				$request = 'exist';
			}
			return $request;
		}
	}
 ?>