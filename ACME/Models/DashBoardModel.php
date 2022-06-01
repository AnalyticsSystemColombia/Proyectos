<?php 
class DashBoardModel extends Mysql{

public function __construct(){
  parent::__construct();

}
//relaciòn conductor y propietario
public function informe(){
   
    $sql = "SELECT v.id_conductor, v.placa, v.marca, v.conductor, v.propietario, concat(c.nombres,'', c.apellidos) AS Nombres, c.id 
    FROM vehiculos v 
    INNER JOIN conductores c
    ON v.id_conductor = c.id
    WHERE v.status != 0";
    $request = $this->select_all($sql);
    return $request;
}

}
?>