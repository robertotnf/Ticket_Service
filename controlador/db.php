<?php
class BaseDeDatos
{

	public $host;
	public $port;
	public $db;
	public $user;
	public $pass;
	public $pdo;

	public function __construct()
	{
		$this->host = "localhost";
		$this->port = "3306";
		$this->db = "serviceticket";
		$this->user = "root";
		$this->pass = "";
		$this->pdo = new PDO("mysql:host=$this->host;port=$this->port;dbname=$this->db", $this->user, $this->pass);
	}

	function insertarUsuario($email, $contrasena, $tecnico, $departamento)
	{
		$consulta = $this->pdo->prepare("INSERT INTO `usuarios` (`email`, `password`, `tecnico`, `departamento`) VALUES ( :email, :contrasena, :tecnico, :departamento)");
		$array = [
			":email" => $email,
			":contrasena" => md5($contrasena),
			":tecnico" => $tecnico,
			":departamento" => $departamento
		];
		$consulta->execute($array);
		return $this->comprobarUsuario($email, $contrasena);
	}

	function comprobarUsuario($email, $password)
	{

		$consulta = $this->pdo->prepare("SELECT id,email,tecnico,departamento FROM `usuarios` WHERE email = :email AND password= :password");
		$array = [
			":email" => $email,
			":password" => md5($password)
		];
		$consulta->execute($array);
		return $consulta->fetchAll();
	}

	function listarCategorias()
	{
		$consulta = $this->pdo->prepare("SELECT * FROM categoria");
		$consulta->execute();
		$res = $consulta->fetchAll();
		return $res;
	}

	function listarProblematica()
	{
		$consulta = $this->pdo->prepare("SELECT * FROM problematica");
		$consulta->execute();
		$res = $consulta->fetchAll();
		return $res;
	}

	function listarEstados()
	{
		$consulta = $this->pdo->prepare("SELECT * FROM estado");
		$consulta->execute();
		$res = $consulta->fetchAll();
		return $res;
	}

	function listarDepartamentos()
	{
		$consulta = $this->pdo->prepare("SELECT * FROM departamento");
		$consulta->execute();
		$res = $consulta->fetchAll();
		return $res;
	}

	function insertarIncidencia($usuario, $departamento, $asunto, $descripcion, $categoria, $problematica, $estado, $fechaInicio)
	{
		$consulta = $this->pdo->prepare("INSERT INTO `incidencia`(`usuario`, departamento, `asunto`, `descripcion`, categoria , problematica, estado, `fecha_inicio`)
		 VALUES (:usuario,:departamento,:asunto,:descripcion,:categoria,:problematica,:estado,:fecha_inicio)");
		$array = [
			":usuario" => $usuario,
			":departamento" => $departamento,
			":asunto" => $asunto,
			":descripcion" => $descripcion,
			":categoria" => $categoria,
			":problematica" => $problematica,
			":estado" => $estado,
			":fecha_inicio" => $fechaInicio,
		];
		$consulta->execute($array);
	}

	function listarIncidencias($usuario, $departamento, $texto, $categoria, $problematica, $estado)
	{
		$sql = "SELECT 
		incidencia.id, 
		usuarios.email, 
		(SELECT email FROM usuarios WHERE id = incidencia.usuario_res) as tecnico_email,
		departamento.nom_dep, 
		incidencia.asunto, 
		incidencia.descripcion, 
		categoria.categoria, 
		problematica.problematica, 
		estado.estado,
		incidencia.estado as id_estado, 
		incidencia.resolucion, 
		incidencia.fecha_inicio, 
		incidencia.fecha_fin,
		incidencia.usuario_res, 
		incidencia.usuario
		 FROM incidencia
		 INNER JOIN usuarios ON  incidencia.usuario = usuarios.id 
		 INNER JOIN departamento ON incidencia.departamento = departamento.cod
		 INNER JOIN categoria ON incidencia.categoria = categoria.id
		 INNER JOIN problematica ON incidencia.problematica = problematica.id
		 INNER JOIN estado ON incidencia.estado = estado.id 
		 WHERE incidencia.departamento = :departamento ";

		$params = [];
		$params['departamento'] = $departamento;

		if ($categoria != -1) {
			$sql .= " AND incidencia.categoria LIKE :categoria";
			$params['categoria'] = $categoria;
		}
		if ($problematica != -1) {
			$sql .= " AND incidencia.problematica LIKE :problematica";
			$params['problematica'] = $problematica;
		}

		if (!empty($texto)) {
			$sql .= " AND (UPPER(asunto) LIKE :texto OR UPPER(descripcion) LIKE :texto OR UPPER(resolucion) LIKE :texto ) ";
			$params['texto'] = "%" . strtoupper($texto) . "%";
		}

		if ($estado != -1) {
			$sql .= " AND incidencia.estado LIKE :estado";
			$params['estado'] = $estado;
		}
		if (!empty($usuario)) {
			if ($usuario["tecnico"] == 1) {
				$sql .= " AND usuario_res LIKE :usuario ";
			} else {
				$sql .= " AND usuario LIKE :usuario ";
			}
			$params['usuario'] = $usuario["id"];
		}

		$stmt = $this->pdo->prepare($sql);
		$stmt->execute($params);

		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	function getIncidencia($idIncidencia)
	{
		$consulta = $this->pdo->prepare("SELECT incidencia.id, email, departamento.nom_dep, incidencia.departamento as id_departamento, incidencia.asunto, incidencia.descripcion , categoria.categoria,incidencia.categoria as id_categoria, problematica.problematica,incidencia.problematica as id_problematica, estado.estado, incidencia.resolucion, incidencia.fecha_inicio, incidencia.usuario_res
		 FROM incidencia
		 INNER JOIN usuarios ON  incidencia.usuario = usuarios.id 
		 INNER JOIN departamento ON incidencia.departamento = departamento.cod
		 INNER JOIN categoria ON incidencia.categoria = categoria.id
		 INNER JOIN problematica ON incidencia.problematica = problematica.id
		 INNER JOIN estado ON incidencia.estado = estado.id WHERE incidencia.id = :idIncidencia");
		$array = [
			":idIncidencia" => $idIncidencia
		];

		$consulta->execute($array);
		return $consulta->fetchAll()[0];
	}

	function setIncidencia($id_incidencia, $id_estado, $resolucion, $usuario_res)
	{
		if ($id_estado == 3 || $id_estado == 4) {
			$consulta = $this->pdo->prepare("UPDATE incidencia SET estado = :estado, resolucion = :resolucion, usuario_res = :usuario_res, fecha_fin = NOW() WHERE id = :id_incidencia");
		} else {
			$consulta = $this->pdo->prepare("UPDATE incidencia SET estado = :estado, resolucion = :resolucion, usuario_res = :usuario_res WHERE id = :id_incidencia");
		}
		$array = [
			":id_incidencia" => $id_incidencia,
			":estado" => $id_estado,
			":resolucion" => $resolucion,
			":usuario_res" => $usuario_res
		];
		$consulta->execute($array);
	}

	function editarIncidencia($id_incidencia, $usuario, $departamento, $descripcion, $categoria, $problematica)
	{
		$consulta = $this->pdo->prepare("UPDATE incidencia SET usuario = :usuario, departamento = :departamento, descripcion =:descripcion,
		categoria = :categoria, problematica = :problematica WHERE id = :id_incidencia");
		$array = [
			"id_incidencia" => $id_incidencia,
			":usuario" => $usuario,
			":departamento" => $departamento,
			":descripcion" => $descripcion,
			":categoria" => $categoria,
			":problematica" => $problematica
		];
		$consulta->execute($array);
	}

	function cancelarIncidencia($id_incidencia)
	{
		$consulta = $this->pdo->prepare("UPDATE incidencia SET estado = 4, fecha_fin = NOW() WHERE id = :id_incidencia");
		$array = [
			"id_incidencia" => $id_incidencia
		];
		$consulta->execute($array);
	}


	function totalIncidenciasEstado()
	{
		$consulta = $this->pdo->prepare("SELECT (SELECT COUNT(estado) FROM incidencia  WHERE estado = 1),(SELECT COUNT(estado) FROM incidencia  WHERE estado = 2),(SELECT COUNT(estado) FROM incidencia  WHERE estado = 3),(SELECT COUNT(estado) FROM incidencia  WHERE estado = 4) FROM DUAL;");

		$consulta->execute();
		$fila = $consulta->fetchAll()[0];
		$sumaTotal = $fila[0] + $fila[1] + $fila[2] + $fila[3];
		$array = [
			"totales" => $sumaTotal,
			"abiertas"	=> $fila[0],
			"enProceso" => $fila[1],
			"cerradas" => $fila[2],
			"canceladas" => $fila[3],
			"pAbiertas" => $this->porcentajes($fila[0], $sumaTotal),
			"pEnProceso" => $this->porcentajes($fila[1], $sumaTotal),
			"pCerradas" => $this->porcentajes($fila[2], $sumaTotal),
			"pCanceladas" => $this->porcentajes($fila[3], $sumaTotal)
		];
		return $array;
	}


	function porcentajes($datos, $sumaTotal)
	{
		if ($sumaTotal == 0) return 0;
		return number_format($datos / $sumaTotal * 100, 0);
	}
}
$db = new BaseDeDatos();
