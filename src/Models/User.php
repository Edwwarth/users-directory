<?php
namespace App\Models;

use App\Persistence\UserDAO;
use App\Persistence\Connection;

class User {
	private $idUsuario;
	private $nombre;
	private $pais;
	private $email;
	private $password;
	private $usuarioDAO;
	private $connection;

	function getIdUsuario() {
		return $this -> idUsuario;
	}

	function setIdUsuario($pIdUsuario) {
		$this -> idUsuario = $pIdUsuario;
	}

	function getNombre() {
		return $this -> nombre;
	}

	function setNombre($pNombre) {
		$this -> nombre = $pNombre;
	}

	function getPais() {
		return $this -> pais;
	}

	function setPais($pPais) {
		$this -> pais = $pPais;
	}

	function getEmail() {
		return $this -> email;
	}

	function setEmail($pEmail) {
		$this -> email = $pEmail;
	}

	function getPassword() {
		return $this -> password;
	}

	function setPassword($pPassword) {
		$this -> password = $pPassword;
	}

	public function __construct($pIdUsuario = "", $pNombre = "", $pPais = "", $pEmail = "", $pPassword = ""){
		$this -> idUsuario = $pIdUsuario;
		$this -> nombre = $pNombre;
		$this -> pais = $pPais;
		$this -> email = $pEmail;
		$this -> password = $pPassword;
		$this -> usuarioDAO = new UserDAO($this -> idUsuario, $this -> nombre, $this -> pais, $this -> email, $this -> password);
		$this -> connection = new Connection();
	}

	function logIn($email, $password){
		$this -> connection -> open();
		$this -> connection -> run($this -> usuarioDAO -> logIn($email, $password));
		if($this -> connection -> numRows()==1){
			$result = $this -> connection -> fetchRow();
			$this -> idUsuario = $result[0];
			$this -> nombre = $result[1];
			$this -> pais = $result[2];
			$this -> email = $result[3];
			$this -> password = $result[4];
			$this -> connection -> close();
			return true;
		}else{
			$this -> connection -> close();
			return false;
		}
		return true;
	}

	function insert(){
		$this -> connection -> open();
		$this -> connection -> run($this -> usuarioDAO -> insert());
		$this -> connection -> close();
	}


	function existEmail($email){
		$this -> connection -> open();
		$this -> connection -> run($this -> usuarioDAO -> existEmail($email));
		if($this -> connection -> numRows()==1){
			$this -> connection -> close();
			return true;
		}else{
			$this -> connection -> close();
			return false;
		}
	}

	function search($search){
		$this -> connection -> open();
		$this -> connection -> run($this -> usuarioDAO -> search($search));
		$usuarios = array();
		while ($result = $this -> connection -> fetchRow()){
			array_push($usuarios, new User($result[0], $result[1], $result[2], $result[3], $result[4]));
		}
		$this -> connection -> close();
		return $usuarios;
	}

}
?>
