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
            ":contrasena" => $contrasena
		];
		$consulta->execute($array);
		
    }
}