<?php

namespace App\Persistence;

class UserDAO{
	private $idUsuario;
	private $nombre;
	private $pais;
	private $email;
	private $password;

	public function __construct($pIdUsuario = "", $pNombre = "", $pPais = "", $pEmail = "", $pPassword = ""){
		$this -> idUsuario = $pIdUsuario;
		$this -> nombre = $pNombre;
		$this -> pais = $pPais;
		$this -> email = $pEmail;
		$this -> password = $pPassword;
	}

	function logIn($email, $password){
		return "select idUsuario, nombre, pais, email, password
				from Usuario
				where email = '" . $email . "' and password = '" . md5($password) . "'";
	}

	function insert(){
		return "insert into Usuario(nombre, pais, email, password)
				values('" . $this -> nombre . "', '" . $this -> pais . "', '" . $this -> email . "', md5('" . $this -> password . "'))";
	}

	function update(){
		return "update Usuario set 
				nombre = '" . $this -> nombre . "',
				pais = '" . $this -> pais . "',
				email = '" . $this -> email . "'	
				where idUsuario = '" . $this -> idUsuario . "'";
	}

	function updatePassword($password){
		return "update Usuario set 
				password = '" . md5($password) . "'
				where idUsuario = '" . $this -> idUsuario . "'";
	}

	function existEmail($email){
		return "select idUsuario, nombre, pais, email, password
				from Usuario
				where email = '" . $email . "'";
	}

	function recoverPassword($email, $password){
		return "update Usuario set 
				password = '" . md5($password) . "'
				where email = '" . $email . "'";
	}

	function select() {
		return "select idUsuario, nombre, pais, email, password
				from Usuario
				where idUsuario = '" . $this -> idUsuario . "'";
	}

	function selectAll() {
		return "select idUsuario, nombre, pais, email, password
				from Usuario";
	}

	function selectAllOrder($orden, $dir){
		return "select idUsuario, nombre, pais, email, password
				from Usuario
				order by " . $orden . " " . $dir;
	}

	function search($search) {
		return "select idUsuario, nombre, pais, email, password
				from Usuario
				where nombre like '%" . $search . "%' or pais like '%" . $search . "%' or email like '%" . $search . "%'";
	}

	function delete(){
		return "delete from Usuario
				where idUsuario = '" . $this -> idUsuario . "'";
	}
}
?>
