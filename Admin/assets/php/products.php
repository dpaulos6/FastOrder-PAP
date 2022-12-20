<?php
	
	class Product {
		//Atributos
		private $idProduto;
		private $NomeProduto;
		private $idCategoria;
		private $Preco;
		private $Imagem;

		//Acessores e Modificadores
		public function setIdProduto($value){
			$this->idProduto = $value;
		}

		public function getIdProduto(){
			return $this->idProduto;
		}

		public function setNomeProduto($value){
			$this->NomeProduto = $value;
		}

		public function getNomeProduto(){
			return $this->NomeProduto;
		}

		public function setIdCategoria($value){
			$this->idCategoria = $value;
		}

		public function getIdCategoria(){
			return $this->idCategoria;
		}

		public function setPreco($value){
			$this->Preco = $value;
		}

		public function getPreco(){
			return $this->Preco;
		}


		public function setImagem($value){
			$this->Imagem = $value;
		}

		public function getImagem(){
			return $this->Imagem;
		}

		public function createProduct() {
			require("dbconnect.php");

			$sql = "INSERT INTO produtos(NomeProduto, Preco, idCategoria, Imagem) VALUES ('" . $this->NomeProduto . "','" . $this->Preco . "'," . $this->idCategoria . ", '" . $this->Imagem . "')";

			$connect->exec($sql);
		}

		public function deleteProduct($idProduto) {
			require("dbconnect.php");

			$sql = "DELETE FROM produtos WHERE idProduto = " . $idProduto;

			$connect->exec($sql);
		}

		public function listProduct() {
			require("dbconnect.php");

			// Instrução SQL para ler todos os produtos da BD
			$sql = "SELECT * FROM produtos ORDER BY idCategoria, NomeProduto"; 
			// Preparação da instrução á BD
			$query = $connect->query($sql);
			// Execução da query na BD a gravar resultados numa varíavel
			$products = $query->fetchAll(PDO::FETCH_ASSOC);

			// Devolver resultado 
			return $products;
		}

		public function sortProduct($idCategoria) {
			require("dbconnect.php");

			// Instrução SQL para ler todos os produtos da BD
			$sql = "SELECT * FROM produtos WHERE idCategoria = " . $idCategoria; 
			// Preparação da instrução á BD
			$query = $connect->query($sql);
			// Execução da query na BD a gravar resultados numa varíavel
			$sort = $query->fetchAll(PDO::FETCH_ASSOC);

			// Devolver resultado 
			return $sort;
		}

		public function productDetails() {
			require("dbconnect.php");

			$sql = "SELECT * FROM produtos WHERE idProduto = " . $this->idProduto;

			// Preparação da instrução á BD
			$query = $connect->query($sql);
			// Execução da query na BD a gravar resultados numa varíavel
			$produtos = $query->fetchAll(PDO::FETCH_ASSOC);

			return $produtos;
		}

		public function editProduct() {
			require("dbconnect.php");

			// Instrução SQL para registar o produto
			$sql = "UPDATE produtos SET NomeProduto = '" . $this->NomeProduto . "', Preco='" . $this->Preco . "', Imagem='" . $this->Imagem . "' WHERE idProduto =" . $this->idProduto;

			//Executar instrução SQL na base de dados
			$connect->exec($sql);
		}

		public function getById(){
			require("dbconnect.php");

			// Instrução SQL para selecionar dados da bd
			$sql = "SELECT * FROM produtos WHERE idProduto =" . $this->idProduto;

			// Preparar instrução 
			$query = $connect->query($sql);
			// Executar a query e gravar resultados
			$produtos = $query->fetchAll(PDO::FETCH_ASSOC);

			// Retornar os dados
			return $produtos;
		}

		public function getDrinks(){
			require("dbconnect.php");

			// Instrução SQL para selecionar dados da bd
			$sql = "SELECT * FROM produtos WHERE idCategoria = 5 ORDER BY NomeProduto";

			// Preparar instrução 
			$query = $connect->query($sql);
			// Executar a query e gravar resultados
			$produtos = $query->fetchAll(PDO::FETCH_ASSOC);

			// Retornar os dados
			return $produtos;
		}
	}