<?php
session_start();
require_once("host.php");


class MYSQL {
	private $oConBD = null;

	public function __construct(){
		global $usuarioBD , $passBD, $ipBD, $nombreBD, $rq;

		$this->usuarioBD = $usuarioBD;
		$this->passBD = $passBD;
		$this->ipBD = $ipBD;
		$this->nombreBD = $nombreBD;
		$this->$rq = $rq;

	}




	//Vamos a utlilzar la sintaxis PDO de Conexion
	public function conexBDPDO(){
		try{
			$this->oConBD = new PDO("mysql:host=".$this->ipBD.";dbname=". $this->nombreBD , $this->usuarioBD, $this->passBD);

			return true;
		}catch(PDOException $e){
			echo "Error de Conexion: ". $e->getMessage(). "\n";
			return false;
		}
	}

	//Codigo sirve para traer los parametros para las vistas de slos pacientes diarios
	public function TotalPacientesDiarios(){
		$pacientesDiarios = 0;
		$hoy =  date('Y-m-d');
		// $anio =  date('Y');
		try{
			$strQuery = "SELECT count(*) as pacienteDiario  FROM comprobantes  where created_at LIKE '%".$hoy."%' AND estatus = 1";
			//$strQuery = "SELECT COUNT(*) from clientes WHERE year(FechaIngreso)= $anio AND month(FechaIngreso)= $mes ";
			if($this->conexBDPDO()){
				$pQuery =$this->oConBD->prepare($strQuery);
				$pQuery->execute();
				$pacientesDiarios= $pQuery->fetchColumn();
			}
		}catch(PDOException $e){
			echo "MYSQL.TotalPacientesDiarios: ". $e->getMessage(). "\n";
			return -1;
		}
		return $pacientesDiarios;
	}

	public function TotalPacientesMensuales(){
		$pacientesMensuales = 0;
		$mes =  date('Y-m');
		// $anio =  date('Y');
		try{
			$strQuery = "SELECT count(*) as pacienteMensual  FROM comprobantes  where created_at LIKE '%".$mes."%' AND estatus = 1";
			//$strQuery = "SELECT COUNT(*) from clientes WHERE year(FechaIngreso)= $anio AND month(FechaIngreso)= $mes ";
			if($this->conexBDPDO()){
				$pQuery =$this->oConBD->prepare($strQuery);
				$pQuery->execute();
				$pacientesMensuales= $pQuery->fetchColumn();
			}
		}catch(PDOException $e){
			echo "MYSQL.TotalPacientesMensuales: ". $e->getMessage(). "\n";
			return -1;
		}
		return $pacientesMensuales;
	}

	public function TotalIngresosDiarios(){
		$montoDiario = 0;
		$hoy =  date('Y-m-d');
		// $anio =  date('Y');
		try{
			$strQuery = "SELECT sum(monto) as totalDiario  FROM comprobantes  where created_at LIKE '%".$hoy."%' AND estatus = 1";
			//$strQuery = "SELECT COUNT(*) from clientes WHERE year(FechaIngreso)= $anio AND month(FechaIngreso)= $mes ";
			if($this->conexBDPDO()){
				$pQuery =$this->oConBD->prepare($strQuery);
				$pQuery->execute();
				$montoDiario= $pQuery->fetchColumn();
			}
		}catch(PDOException $e){
			echo "MYSQL.TotalIngresosDiarios: ". $e->getMessage(). "\n";
			return -1;
		}
		return $montoDiario;
	}

	public function TotalIngresosMensuales(){
		$montoMensual = 0;
		$mes =  date('Y-m');
		// $anio =  date('Y');
		try{
			$strQuery = "SELECT sum(monto) as totalMensual  FROM comprobantes  where created_at LIKE '%".$mes."%' AND estatus = 1";
			//$strQuery = "SELECT COUNT(*) from clientes WHERE year(FechaIngreso)= $anio AND month(FechaIngreso)= $mes ";
			if($this->conexBDPDO()){
				$pQuery =$this->oConBD->prepare($strQuery);
				$pQuery->execute();
				$montoMensual= $pQuery->fetchColumn();
			}
		}catch(PDOException $e){
			echo "MYSQL.TotalIngresosMensuales: ". $e->getMessage(). "\n";
			return -1;
		}
		return $montoMensual;
	}

	
	
}
class Grafica{
	public $totalProducido = 0;
	public $totalProbado = 0;
	public $totalFaltante = 0;
	public $totalBanco = 0;
}
