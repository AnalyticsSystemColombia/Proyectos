<?php 

	class VehiculosModel extends Mysql{
		private $id_conductor;
		private $strplaca;
		private $intCondu;
		private $strmarca;
		private $strcolor;
		private $strtipo;
		private $intpropi;
		private $intStatus;

	public function __construct()
	{
		parent::__construct();
	}	

	public function insertVehiculos(string $placa, int $conductor, string $marca, string $color, string $tipo, string $propietario, int $status){

		$this->strplaca = $placa;
		$this->intCondu = $conductor;
		$this->strmarca = $marca;
		$this->strcolor = $color;
		$this->strtipo = $tipo;
		$this->intpropi = $propietario;
		$this->intStatus = $status;
		$return = 0;

		$sql = "SELECT * FROM vehiculos WHERE 
				placa = '{$this->strplaca}'";
		$request = $this->select_all($sql);

		if(empty($request))
		{
			$query_insert  = "INSERT INTO vehiculos(placa,id_conductor,marca,color,tipo,propietario,status) 
								VALUES(?,?,?,?,?,?,?)";
			$arrData = array($this->strplaca,
							$this->intCondu,
							$this->strmarca,
							$this->strcolor,
							$this->strtipo,
							$this->intpropi,
							$this->intStatus);
			$request_insert = $this->insert($query_insert,$arrData);
			$return = $request_insert;
		}else{
			$return = "exist";
		}
		return $return;
	}
	public function selectVehiculos(){
		$sql = "SELECT v.id_conductor, v.placa,v.marca,v.color,v.tipo,v.conductor,v.propietario, v.status,c.nombres,c.id 
				FROM vehiculos v 
				INNER JOIN conductores c
				ON v.id_conductor = c.id
				WHERE v.status != 0 ";
				$request = $this->select_all($sql);
				return $request;
	}
		
	public function selectVehiculo(int $id_conductor)
	{
		$this->id_conductor = $id_conductor;
		$sql = "SELECT v.id_conductor, v.placa,v.marca,v.color,v.tipo,v.conductor,v.propietario, v.status,c.nombres,c.id 
				FROM vehiculos v 
				INNER JOIN conductores c
				ON v.id_conductor = c.id
				WHERE v.id_conductor = $this->id_conductor ";
		$request = $this->select($sql);
		return $request;
	}

	public function updateVehiculo(string $id_conductor,string $placa, int $conductor, string $marca, string $color, string $tipo, string $propietario, int $status){

		$this->id_conductor = $id_conductor;
		$this->strplaca = $placa;
		$this->intCondu = $conductor;
		$this->strmarca = $marca;
		$this->strcolor = $color;
		$this->strtipo = $tipo;
		$this->intpropi = $propietario;
		$this->intStatus = $status;

		$sql = "SELECT * FROM vehiculos WHERE (id_conductor = '{$this->intCondu}')";
		$request = $this->select_all($sql);

		if(empty($request))
		{
		$sql = "UPDATE vehiculos SET placa=?, id_conductor=?, marca=?, color=?, tipo=?, propietario=?,  status=? 
				WHERE id_conductor = $this->intCondu ";
		$arrData = array($this->strplaca,
						$this->intCondu,
						$this->strmarca,
						$this->strcolor,
						$this->strtipo,
						$this->intpropi,
						$this->intStatus);
			$request = $this->update($sql,$arrData);
		}else{
			$request = "exist";
		}
		return $request;
	
	}
	
	public function deleteVehiculo(int $id_conductor)
	{
		$this->id_conductor = $id_conductor;
		$sql = "UPDATE vehiculos SET status = ? WHERE id_conductor = $this->id_conductor ";
		$arrData = array(0);
		$request = $this->update($sql,$arrData);
		return $request;
	}

	}
 ?>