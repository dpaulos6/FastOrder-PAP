<?php
  class Cart {
    //Atributos
		private $idPedidoTemp;
		private $sessionID;
		private $idProduto;
		private $Quantidade;
		private $Tamanho;
		private $Preco;
		private $HoraEntrega;
		private $CreateDate;

    //Acessores e Modificadores
		public function setIdPedidoTemp($value){
			$this->idPedidoTemp = $value;
		}
		public function getIdPedidoTemp(){
			return $this->idPedidoTemp;
		}

    public function setSessionID($value){
			$this->sessionID = $value;
		}
		public function getSessionID(){
			return $this->sessionID;
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

		public function setTamanho($value){
			$this->Tamanho = $value;
		}
		public function getTamanho(){
			return $this->Tamanho;
		}

    public function setPreco($value){
			$this->Preco = $value;
		}
		public function getPreco(){
			return $this->Preco;
		}

		public function setHoraEntrega($value){
			$this->HoraEntrega = $value;
		}
		public function getHoraEntrega(){
			return $this->HoraEntrega;
		}

		public function setCreateDate($value){
			$this->CreateDate = $value;
		}
		public function getCreateDate(){
			return $this->CreateDate;
		}

    //Funçóes ou Procedimentos
    public function createCart() {
			require("../Admin/assets/php/dbconnect.php");

			$sql = "INSERT INTO pedido_detalhes_temp(sessionID, idProduto, Quantidade, Tamanho, Preco, CreateDate)
				VALUES ('" . $this->sessionID . "', '" . $this->idProduto . "', '" . $this->Quantidade . "', '" . $this->Tamanho . "', '" . $this->Preco . "', '" . $this->CreateDate . "')";

			$connect->exec($sql);
		}

		public function checkDuplicate() {
			require("../Admin/assets/php/dbconnect.php");

			$sql = "SELECT * FROM pedido_detalhes_temp WHERE idProduto = " . $this->idProduto . " and Tamanho = '" . $this->Tamanho . "' and sessionID ='" . $this->sessionID . "'";
			// Preparação da instrução á BD
			$query = $connect->query($sql);
			// Execução da query na BD a gravar resultados numa varíavel
			$cart = $query->fetchAll(PDO::FETCH_ASSOC);

			return $cart;
		}

		public function showCart() {
			require("../Admin/assets/php/dbconnect.php");
			
			$sql = "SELECT * FROM pedido_detalhes_temp WHERE sessionID = '" . session_id() . "'";
			$query = $connect->query($sql);
			$cart = $query->fetchAll(PDO::FETCH_ASSOC);

			return $cart;
		}
		
		public function countCart() {
			require("../Admin/assets/php/dbconnect.php");

			$sql = "SELECT COUNT(*) as nrProdutos FROM pedido_detalhes_temp WHERE sessionID = '" . session_id() . "'";
			$query = $connect->query($sql);
			$cart = $query->fetchAll(PDO::FETCH_ASSOC);

			return $cart;
		}

		public function clearCart() {
			require("../Admin/assets/php/dbconnect.php");

			$sql = "DELETE FROM pedido_detalhes_temp WHERE sessionID = '" . session_id() . "'";

			$connect->exec($sql);
		}

		public function cartDelete($id) {
			require("../Admin/assets/php/dbconnect.php");

			$sql = "DELETE FROM pedido_detalhes_temp WHERE idPedidoTemp = " . $id;

			$connect->exec($sql);
		}

		public function deleteSessionID() {
			require("../Admin/assets/php/dbconnect.php");

			$sql = "DELETE FROM pedido_detalhes_temp WHERE sessionID = '" . session_id() . "'";

			$connect->exec($sql);
		}

		public function listCart() {
			require("../Admin/assets/php/dbconnect.php");

			$sql = "SELECT * FROM pedido_detalhes_temp";
			// Preparação da instrução á BD
			$query = $connect->query($sql);
			// Execução da query na BD a gravar resultados numa varíavel
			$cart = $query->fetchAll(PDO::FETCH_ASSOC);

			return $cart;
		}

		public function editCart() {
			require("../Admin/assets/php/dbconnect.php");

			// Instrução SQL para registar o produto
			$sql = "UPDATE pedido_detalhes_temp SET Quantidade = '" . $this->Quantidade . "' WHERE idPedidoTemp =" . $this->idPedidoTemp;

			//Executar instrução SQL na base de dados
			$connect->exec($sql);
		}

		public function updateItem() {
			require("../Admin/assets/php/dbconnect.php");

			// Instrução SQL para registar o produto
			$sql = "UPDATE pedido_detalhes_temp SET Quantidade = '" . $this->Quantidade . "' WHERE idProduto =" . $this->idProduto . " and Tamanho ='" . $this->Tamanho . "' and sessionID ='" . $this->sessionID . "'";

			//Executar instrução SQL na base de dados
			$connect->exec($sql);
		}

		public function deleteOneDay(){
			require("../Admin/assets/php/dbconnect.php");

			// Instrução SQL para apagar o produto
			$sql = "DELETE FROM pedido_detalhes_temp WHERE CreateDate<=DATE_SUB(NOW(), INTERVAL 1 DAY)";

			// Executar instrução SQL na base de dados
			$connect->exec($sql);
		}
  }
?>