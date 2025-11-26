<?php
class BaseDeDatos{

	public $host;
	public $port;
	public $db;
	public $user;
	public $pass;
	public $pdo;

	public function __construct(){
		$this->host="localhost";
		$this->port="3306";
		$this->db="serviceticket";
		$this->user="root";
		$this->pass="";
		$this->pdo = new PDO("mysql:host=$this->host;port=$this->port;dbname=$this->db",$this->user,$this->pass);
	}

    function insertarUsuario ($email,$contrasena){
       $consulta = $this->pdo->prepare("INSERT INTO `usuarios` (`email`, `password`) VALUES ( :email, :contrasena)");
		$array = [
			":email" => $email,
            ":contrasena" => md5($contrasena)
		];
		$consulta->execute($array);
		
    }

	function comprobarUsuario($email,$password){
		$consulta = $this->pdo->prepare("SELECT count(*) AS res FROM `usuarios` WHERE email = :email AND password= :password");
		$array = [
			":email" => $email,
            ":password" => md5($password)
		];
		$consulta->execute($array);
		$res = $consulta->fetchAll();
		if($res == 0){
			return false;
		}else{
			return true;
		}

	}
}