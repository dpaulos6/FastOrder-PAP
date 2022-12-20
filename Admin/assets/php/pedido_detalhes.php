<?php
	class Pedido_Detalhes {
		//Atributos
		private $idPedido_Detalhes;
		private $idUtilizador;
		private $Quantidade;
		private $Preco;
		private $idPedido;
		private $Notas;
		private $Tamanho;

		//Acessores e Modificadores
		public function setIdPedido_Detalhes($value){
			$this->idPedido_Detalhes = $value;
		}
		public function getIdPedido_Detalhes(){
			return $this->idPedido_Detalhes;
		}

		public function setIdProduto($value){
			$this->idProduto = $value;
		}
		public function getIdProduto(){
			return $this->idProduto;
		}

		public function setQuantidade($value){
			$this->Quantidade = $value;
		}
		public function getQuantidade(){
			return $this->Quantidade;
		}

		public function setPreco($value){
			$this->Preco = $value;
		}
		public function getPreco(){
			return $this->Preco;
		}

		public function setIdPedido($value){
			$this->idPedido = $value;
		}
		public function getIdPedido(){
			return $this->idPedido;
		}

		public function setNotas($value){
			$this->Notas = $value;
		}
		public function getNotas(){
			return $this->Notas;
		}

		public function setTamanho($value){
			$this->Tamanho = $value;
		}
		public function getTamanho(){
			return $this->Tamanho;
		}

		public function createDetails() {
			require("dbconnect.php");

			$sql = "INSERT INTO pedido_detalhes(idProduto, Quantidade, Preco, idPedido, Notas, Tamanho) 
			VALUES ('" . $this->idProduto . "','" . $this->Quantidade . "','" . $this->Preco . "','" . $this->idPedido . "','" . $this->Notas . "','" . $this->Tamanho . "')";

			$connect->exec($sql);
		}

		public function deleteDetails($idPedido_Detalhes) {
			require("dbconnect.php");

			$sql = "DELETE FROM pedido_detalhes WHERE idPedido_Detalhes = " . $idPedido_Detalhes;

			$connect->exec($sql);
		}

		public function listDetails() {
			require("dbconnect.php");

			// Instrução SQL para ler todos os pedido_detalhes da BD
			$sql = "SELECT * FROM pedido_detalhes ORDER BY idProduto"; 
			// Preparação da instrução á BD
			$query = $connect->query($sql);
			// Execução da query na BD a gravar resultados numa varíavel
			$Detailss = $query->fetchAll(PDO::FETCH_ASSOC);

			// Devolver resultado 
			return $Detailss;
		}

		public function showByPedido() {
			require("dbconnect.php");

			// Instrução SQL para ler todos os pedido_detalhes da BD
			$sql = "SELECT * FROM pedido_detalhes WHERE idPedido = " . $this->idPedido; 
			// Preparação da instrução á BD
			$query = $connect->query($sql);
			// Execução da query na BD a gravar resultados numa varíavel
			$Detailss = $query->fetchAll(PDO::FETCH_ASSOC);

			// Devolver resultado 
			return $Detailss;
		}

		public function getByPedido() {
			require("dbconnect.php");

			// Instrução SQL para ler todos os pedido_detalhes da BD
			$sql = "SELECT FROM pedido_detalhes WHERE idPedido = " . $this->idPedido; 
			// Preparação da instrução á BD
			$query = $connect->query($sql);
			// Execução da query na BD a gravar resultados numa varíavel
			$Detailss = $query->fetchAll(PDO::FETCH_ASSOC);

			// Devolver resultado 
			return $Detailss;
		}
	}