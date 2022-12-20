<?php
	class Pedido {
		//Atributos
		private $idPedido;
		private $idUtilizador;
		private $ValorTotal;
		private $Estado;
		private $Tipo;
		private $CreateDate;

		//Acessores e Modificadores
		public function setIdPedido($value){
			$this->idPedido = $value;
		}
		public function getIdPedido(){
			return $this->idPedido;
		}

		public function setIdUtilizador($value){
			$this->idUtilizador = $value;
		}
		public function getIdUtilizador(){
			return $this->idUtilizador;
		}

		public function setValorTotal($value){
			$this->ValorTotal = $value;
		}
		public function getValorTotal(){
			return $this->ValorTotal;
		}

		public function setEstado($value){
			$this->Estado = $value;
		}
		public function getEstado(){
			return $this->Estado;
		}

		public function setTipo($value){
			$this->Tipo = $value;
		}
		public function getTipo(){
			return $this->Tipo;
		}

		public function setCreateDate($value){
			$this->CreateDate = $value;
		}
		public function getCreateDate(){
			return $this->CreateDate;
		}

		public function createPedido() {
			require("dbconnect.php");

			$sql = "INSERT INTO pedido(idUtilizador, ValorTotal, Estado, Tipo, CreateDate)
      VALUES ('" . $this->idUtilizador . "','" . $this->ValorTotal . "','" . $this->Estado . "','" . $this->Tipo . "','" . $this->CreateDate ."')";

			$connect->exec($sql);
		}

		public function showPedidos(){
			require("dbconnect.php");

			// Instrução SQL para selecionar dados da bd
			$sql = "SELECT * FROM pedido";

			// Preparar instrução 
			$query = $connect->query($sql);
			// Executar a query e gravar resultados
			$pedido = $query->fetchAll(PDO::FETCH_ASSOC);

			// Retornar os dados
			return $pedido;
		}

		public function getById(){
			require("dbconnect.php");

			// Instrução SQL para selecionar dados da bd
			$sql = "SELECT * FROM pedido WHERE idUtilizador =" . $this->idUtilizador;
			// Preparar instrução 
			$query = $connect->query($sql);
			// Executar a query e gravar resultados
			$pedido = $query->fetchAll(PDO::FETCH_ASSOC);
			// Retornar os dados
			return $pedido;
		}

		public function countPedidosAtivos(){
			require("dbconnect.php");
			
			$sql = "SELECT Count(*) as PedidosAtivos FROM pedido WHERE Estado = 'A preparar'";
			// Preparação da instrução á BD
			$query = $connect->query($sql);
			// Execução da query na BD a gravar resultados numa varíavel
			$pedido = $query->fetchAll(PDO::FETCH_ASSOC);

			return $pedido;
		}

		public function countPedidosTotal(){
			require("dbconnect.php");
			
			$sql = "SELECT SUM(ValorTotal) as PedidosTotal FROM pedido";
			// Preparação da instrução á BD
			$query = $connect->query($sql);
			// Execução da query na BD a gravar resultados numa varíavel
			$pedido = $query->fetchAll(PDO::FETCH_ASSOC);

			return $pedido;
		}

		public function countPedidosMensal(){
			require("dbconnect.php");
			
			$sql = "SELECT SUM(ValorTotal) as PedidosMensal FROM pedido WHERE MONTH(CreateDate) = " . date("m") . " AND YEAR(CreateDate) = " . date("Y");
			// Preparação da instrução á BD
			$query = $connect->query($sql);
			// Execução da query na BD a gravar resultados numa varíavel
			$pedido = $query->fetchAll(PDO::FETCH_ASSOC);

			return $pedido;
		}

		
		public function getByPedido(){
			require("dbconnect.php");

			// Instrução SQL para selecionar dados da bd
			$sql = "SELECT * FROM pedido WHERE idPedido =" . $this->idPedido;
			// Preparar instrução 
			$query = $connect->query($sql);
			// Executar a query e gravar resultados
			$pedido = $query->fetchAll(PDO::FETCH_ASSOC);

			// Retornar os dados
			return $pedido;
		}

		public function graficoPedidos(){
			require("dbconnect.php");

			// Instrução SQL para selecionar dados da bd
			$sql = "SELECT IFNULL(SUM(ValorTotal), 0) as ValorTotal, MONTH(DATE_ADD(now(), INTERVAL -11 MONTH)) as Mes, MONTHNAME(DATE_ADD(now(), INTERVAL -11 MONTH)) as MesNome, YEAR(DATE_ADD(now(), INTERVAL -11 MONTH)) as Ano 
							FROM pedido WHERE MONTH(CreateDate) = MONTH(DATE_ADD(now(), INTERVAL -11 MONTH)) AND YEAR(CreateDate) = Year(DATE_ADD(now(), INTERVAL -11 MONTH))
							UNION ALL
							SELECT IFNULL(SUM(ValorTotal), 0) as ValorTotal, MONTH(DATE_ADD(now(), INTERVAL -10 MONTH)) as Mes, MONTHNAME(DATE_ADD(now(), INTERVAL -10 MONTH)) as MesNome, YEAR(DATE_ADD(now(), INTERVAL -10 MONTH)) as Ano 
							FROM pedido WHERE MONTH(CreateDate) = MONTH(DATE_ADD(now(), INTERVAL -10 MONTH)) AND YEAR(CreateDate) = Year(DATE_ADD(now(), INTERVAL -10 MONTH))
							UNION ALL
							SELECT IFNULL(SUM(ValorTotal), 0) as ValorTotal, MONTH(DATE_ADD(now(), INTERVAL -9 MONTH)) as Mes, MONTHNAME(DATE_ADD(now(), INTERVAL -9 MONTH)) as MesNome, YEAR(DATE_ADD(now(), INTERVAL -9 MONTH)) as Ano 
							FROM pedido WHERE MONTH(CreateDate) = MONTH(DATE_ADD(now(), INTERVAL -9 MONTH)) AND YEAR(CreateDate) = Year(DATE_ADD(now(), INTERVAL -9 MONTH))
							UNION ALL
							SELECT IFNULL(SUM(ValorTotal), 0) as ValorTotal, MONTH(DATE_ADD(now(), INTERVAL -8 MONTH)) as Mes, MONTHNAME(DATE_ADD(now(), INTERVAL -8 MONTH)) as MesNome, YEAR(DATE_ADD(now(), INTERVAL -8 MONTH)) as Ano 
							FROM pedido WHERE MONTH(CreateDate) = MONTH(DATE_ADD(now(), INTERVAL -8 MONTH)) AND YEAR(CreateDate) = Year(DATE_ADD(now(), INTERVAL -8 MONTH))
							UNION ALL
							SELECT IFNULL(SUM(ValorTotal), 0) as ValorTotal, MONTH(DATE_ADD(now(), INTERVAL -7 MONTH)) as Mes, MONTHNAME(DATE_ADD(now(), INTERVAL -7 MONTH)) as MesNome, YEAR(DATE_ADD(now(), INTERVAL -7 MONTH)) as Ano 
							FROM pedido WHERE MONTH(CreateDate) = MONTH(DATE_ADD(now(), INTERVAL -7 MONTH)) AND YEAR(CreateDate) = Year(DATE_ADD(now(), INTERVAL -7 MONTH))
							UNION ALL
							SELECT IFNULL(SUM(ValorTotal), 0) as ValorTotal, MONTH(DATE_ADD(now(), INTERVAL -6 MONTH)) as Mes, MONTHNAME(DATE_ADD(now(), INTERVAL -6 MONTH)) as MesNome, YEAR(DATE_ADD(now(), INTERVAL -6 MONTH)) as Ano 
							FROM pedido WHERE MONTH(CreateDate) = MONTH(DATE_ADD(now(), INTERVAL -6 MONTH)) AND YEAR(CreateDate) = Year(DATE_ADD(now(), INTERVAL -6 MONTH))
							UNION ALL
							SELECT IFNULL(SUM(ValorTotal), 0) as ValorTotal, MONTH(DATE_ADD(now(), INTERVAL -5 MONTH)) as Mes, MONTHNAME(DATE_ADD(now(), INTERVAL -5 MONTH)) as MesNome, YEAR(DATE_ADD(now(), INTERVAL -5 MONTH)) as Ano 
							FROM pedido WHERE MONTH(CreateDate) = MONTH(DATE_ADD(now(), INTERVAL -5 MONTH)) AND YEAR(CreateDate) = Year(DATE_ADD(now(), INTERVAL -5 MONTH))
							UNION ALL
							SELECT IFNULL(SUM(ValorTotal), 0) as ValorTotal, MONTH(DATE_ADD(now(), INTERVAL -4 MONTH)) as Mes, MONTHNAME(DATE_ADD(now(), INTERVAL -4 MONTH)) as MesNome, YEAR(DATE_ADD(now(), INTERVAL -4 MONTH)) as Ano 
							FROM pedido WHERE MONTH(CreateDate) = MONTH(DATE_ADD(now(), INTERVAL -4 MONTH)) AND YEAR(CreateDate) = Year(DATE_ADD(now(), INTERVAL -4 MONTH))
							UNION ALL
							SELECT IFNULL(SUM(ValorTotal), 0) as ValorTotal, MONTH(DATE_ADD(now(), INTERVAL -3 MONTH)) as Mes, MONTHNAME(DATE_ADD(now(), INTERVAL -3 MONTH)) as MesNome, YEAR(DATE_ADD(now(), INTERVAL -3 MONTH)) as Ano 
							FROM pedido WHERE MONTH(CreateDate) = MONTH(DATE_ADD(now(), INTERVAL -3 MONTH)) AND YEAR(CreateDate) = Year(DATE_ADD(now(), INTERVAL -3 MONTH))
							UNION ALL
							SELECT IFNULL(SUM(ValorTotal), 0) as ValorTotal, MONTH(DATE_ADD(now(), INTERVAL -2 MONTH)) as Mes, MONTHNAME(DATE_ADD(now(), INTERVAL -2 MONTH)) as MesNome, YEAR(DATE_ADD(now(), INTERVAL -2 MONTH)) as Ano 
							FROM pedido WHERE MONTH(CreateDate) = MONTH(DATE_ADD(now(), INTERVAL -2 MONTH)) AND YEAR(CreateDate) = Year(DATE_ADD(now(), INTERVAL -2 MONTH))
							UNION ALL
							SELECT IFNULL(SUM(ValorTotal), 0) as ValorTotal, MONTH(DATE_ADD(now(), INTERVAL -1 MONTH)) as Mes, MONTHNAME(DATE_ADD(now(), INTERVAL -1 MONTH)) as MesNome, YEAR(DATE_ADD(now(), INTERVAL -1 MONTH)) as Ano 
							FROM pedido WHERE MONTH(CreateDate) = MONTH(DATE_ADD(now(), INTERVAL -1 MONTH)) AND YEAR(CreateDate) = Year(DATE_ADD(now(), INTERVAL -1 MONTH))
							UNION ALL
							SELECT IFNULL(SUM(ValorTotal), 0) as ValorTotal, MONTH(now()) as Mes, MONTHNAME(now()) as MesNome, YEAR(now()) as Ano 
							FROM pedido WHERE MONTH(CreateDate) = MONTH(now()) AND YEAR(CreateDate) = Year(now());";
			// Preparar instrução 
			$query = $connect->query($sql);
			// Executar a query e gravar resultados
			$pedido = $query->fetchAll(PDO::FETCH_ASSOC);

			// Retornar os dados
			return $pedido;
		}

		public function updateEstado() {
			require("dbconnect.php");

			// Instrução SQL para registar o produto
			$sql = "UPDATE pedido SET Estado = '" . $this->Estado . "' WHERE idPedido =" . $this->idPedido;

			//Executar instrução SQL na base de dados
			$connect->exec($sql);
		}
	}