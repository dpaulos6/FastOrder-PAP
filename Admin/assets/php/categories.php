<?php
	class Category {
		//Atributos
		private $idCategoria;
		private $NomeCategoria;

		//Acessores e Modificadores
		public function setIdCategoria($value){
			$this->idCategoria = $value;
		}
		public function getIdCategoria(){
			return $this->idCategoria;
		}

		public function setNomeCategoria($value){
			$this->NomeCategoria = $value;
		}
		public function getNomeCategoria(){
			return $this->NomeCategoria;
		}

		public function createCategory() {
			require("dbconnect.php");

			$sql = "INSERT INTO categoria(NomeCategoria) VALUES ('" . $this->NomeCategoria . "')";

			$connect->exec($sql);
		}

		public function deleteCategory($idCategoria) {
			require("dbconnect.php");

			$sql = "DELETE FROM categoria WHERE idCategoria = " . $idCategoria;

			$connect->exec($sql);
		}

		public function editCategory() {
			require("dbconnect.php");

			// Instrução SQL para registar o categoria
			$sql = "UPDATE categoria SET NomeCategoria = '" . $this->NomeCategoria . "' WHERE idCategoria =" . $this->idCategoria;

			//Executar instrução SQL na base de dados
			$connect->exec($sql);
		}

		public function listCategory() {
			require("dbconnect.php");

			// Instrução SQL para ler todos os carros da BD
			$sql = "SELECT * FROM categoria" ; 
			// Preparação da instrução á BD
			$query = $connect->query($sql);
			// Execução da query na BD a gravar resultados numa varíavel
			$categories = $query->fetchAll(PDO::FETCH_ASSOC);

			// Devolver resultado 
			return $categories;
		}

		public function categorySort($idCategoria) {
			require("dbconnect.php");

			// Instrução SQL para ler todos os carros da BD
			$sql = "SELECT * FROM categoria WHERE idCategoria = " . $idCategoria; 
			// Preparação da instrução á BD
			$query = $connect->query($sql);
			// Execução da query na BD a gravar resultados numa varíavel
			$categories = $query->fetchAll(PDO::FETCH_ASSOC);

			// Devolver resultado 
			return $categories;
		}

		public function getById(){
			require("dbconnect.php");

			// Instrução SQL para selecionar dados da bd
			$sql = "SELECT * FROM categoria WHERE idCategoria =" . $this->idCategoria;

			// Preparar instrução 
			$query = $connect->query($sql);

			// Executar a query e gravar resultados
			$categories = $query->fetchAll(PDO::FETCH_ASSOC);

			// Retornar os dados
			return $categories;
		}

		public function selectCategory(){
			require("dbconnect.php");

			// Instrução SQL para selecionar dados da bd
			$sql = "SELECT * FROM categoria WHERE idCategoria =" . $this->idCategoria;

			// Preparar instrução 
			$query = $connect->query($sql);
			// Executar a query e gravar resultados
			$categoria = $query->fetchAll(PDO::FETCH_ASSOC);

			// Retornar os dados
			return $categoria;
		}
	}