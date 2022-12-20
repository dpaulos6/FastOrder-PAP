<?php
	class User {
		//Atributos
		private $idUtilizador;
		private $NomeUtilizador;
		private $Nome;
		private $Apelido;
		private $Morada;
		private $Cidade;
		private $CodigoPostal;
		private $Contribuinte;
		private $Telefone;
		private $Email;
		private $Password;
		private $Perfil;

		//Acessores e Modificadores
		public function setIdUtilizador($value){
			$this->idUtilizador = $value;
		}
		public function getIdUtilizador(){
			return $this->idUtilizador;
		}

		public function setNomeUtilizador($value){
			$this->NomeUtilizador = $value;
		}
		public function getNomeUtilizador(){
			return $this->NomeUtilizador;
		}

		public function setNome($value){
			$this->Nome = $value;
		}
		public function getNome(){
			return $this->Nome;
		}

		public function setApelido($value){
			$this->Apelido = $value;
		}
		public function getApelido(){
			return $this->Apelido;
		}

		public function setMorada($value){
			$this->Morada = $value;
		}
		public function getMorada(){
			return $this->Morada;
		}

		public function setCidade($value){
			$this->Cidade = $value;
		}
		public function getCidade(){
			return $this->Cidade;
		}

		public function setCodigoPostal($value){
			$this->CodigoPostal = $value;
		}
		public function getCodigoPostal(){
			return $this->CodigoPostal;
		}

		public function setContribuinte($value){
			$this->Contribuinte = $value;
		}
		public function getContribuinte(){
			return $this->Contribuinte;
		}

		public function setTelefone($value){
			$this->Telefone = $value;
		}
		public function getTelefone(){
			return $this->Telefone;
		}

		public function setEmail($value){
			$this->Email = $value;
		}
		public function getEmail(){
			return $this->Email;
		}

		public function setPassword($value){
			$this->Password = $value;
		}
		public function getPassword(){
			return $this->Password;
		}

		public function setPerfil($value){
			$this->Perfil = $value;
		}
		public function getPerfil(){
			return $this->Perfil;
		}

		public function verificaLogin() {
			require("dbconnect.php");

			$sql = "SELECT * FROM Utilizador WHERE NomeUtilizador = '" . $this->NomeUtilizador . "' and Password = '" . $this->Password . "'";

			// Preparação da instrução á BD
			$query = $connect->query($sql);
			// Execução da query na BD a gravar resultados numa varíavel
			$users = $query->fetchAll(PDO::FETCH_ASSOC);

			return $users;
		}

		public function createUser() {
			require("dbconnect.php");

			$sql = "INSERT INTO utilizador(NomeUtilizador, Nome, Apelido, Morada, Cidade, CodigoPostal, Contribuinte, Telefone, Email, Password, Perfil) 
				VALUES ('" . $this->NomeUtilizador . "','" . $this->Nome . "','" . $this->Apelido . "','" . $this->Morada . "','" . $this->Cidade . "','" 
				. $this->CodigoPostal . "'," . $this->Contribuinte . "," . $this->Telefone . ",'" . $this->Email . "','" . $this->Password . "','" . $this->Perfil . "')";

			$connect->exec($sql);
		}

		public function deleteUser($idUtilizador) {
			require("dbconnect.php");

			$sql = "DELETE FROM utilizador WHERE idUtilizador = " . $idUtilizador;

			$connect->exec($sql);
		}
		
		public function listUser() {
			require("dbconnect.php");

			// Instrução SQL para ler todos os carros da BD
			$sql = "SELECT * FROM utilizador" ; 
			// Preparação da instrução á BD
			$query = $connect->query($sql);
			// Execução da query na BD a gravar resultados numa varíavel
			$users = $query->fetchAll(PDO::FETCH_ASSOC);

			// Devolver resultado 
			return $users;
		}

		public function editUser() {
			require("dbconnect.php");

			// Instrução SQL para registar o utilizador
			$sql = "UPDATE utilizador SET NomeUtilizador = '" . $this->NomeUtilizador . "', Email='" . $this->Email . "', Password='" . $this->Password . "', Perfil='" . $this->Perfil . "' WHERE idUtilizador =" . $this->idUtilizador;

			//Executar instrução SQL na base de dados
			$connect->exec($sql);
		}

		public function getById(){
			require("dbconnect.php");

			// Instrução SQL para selecionar dados da bd
			$sql = "SELECT * FROM utilizador WHERE idUtilizador =" . $this->idUtilizador;
			// Preparar instrução 
			$query = $connect->query($sql);
			// Executar a query e gravar resultados
			$user = $query->fetchAll(PDO::FETCH_ASSOC);
			// Retornar os dados
			return $user;
		}

		public function countUsers(){
			require("dbconnect.php");

			// Instrução SQL para selecionar dados da bd
			$sql = "SELECT COUNT(idUtilizador) AS total FROM utilizador";

			// Preparar instrução 
			$query = $connect->query($sql);

			// Executar a query e gravar resultados
			$user = $query->fetchAll(PDO::FETCH_ASSOC);

			// Retornar os dados
			return $user;
		}

		public function userPermission(){
			require("dbconnect.php");

			// Instrução SQL para selecionar dados da bd
			$sql = "SELECT * FROM utilizador WHERE Perfil = Administrador";
			// Preparar instrução 
			$query = $connect->query($sql);
			// Executar a query e gravar resultados
			$user = $query->fetchAll(PDO::FETCH_ASSOC);
			// Retornar os dados
			return $user;
		}

		public function checkEmail(){
			require("dbconnect.php");

			// Instrução SQL para selecionar dados da bd
			$sql = "SELECT * FROM utilizador WHERE Email = '" . $this->Email . "'";
			// Preparar instrução 
			$query = $connect->query($sql);
			// Executar a query e gravar resultados
			$user = $query->fetchAll(PDO::FETCH_ASSOC);
			// Retornar os dados
			return $user;
		}

		public function checkUser(){
			require("dbconnect.php");

			// Instrução SQL para selecionar dados da bd
			$sql = "SELECT * FROM utilizador WHERE NomeUtilizador = '" . $this->NomeUtilizador . "'";
			// Preparar instrução 
			$query = $connect->query($sql);
			// Executar a query e gravar resultados
			$user = $query->fetchAll(PDO::FETCH_ASSOC);
			// Retornar os dados
			return $user;
		}
	}