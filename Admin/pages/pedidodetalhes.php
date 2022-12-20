<?php 
  require("../assets/php/requirelogin.php");
  
  include_once "../assets/php/pedido.php";
  include_once "../assets/php/pedido_detalhes.php";
  include_once "../assets/php/users.php";
  include_once "../assets/php/products.php";

  $pedido = new Pedido();
  $pedido->setIdPedido($_GET["idPedido"]);
  $pedidoGet = $pedido->getByPedido()[0];
  
  $pedido_detalhes = new Pedido_Detalhes();
  $pedido_detalhes->setIdPedido($_GET["idPedido"]);
  $pedido_detalhesList = $pedido_detalhes->showByPedido();

  if(isset($_POST["change-preparing"])){
    $pedido->setEstado("A preparar");
    $pedido->updateEstado();
    header("Refresh:0");
  }

  if(isset($_POST["change-delivering"])){
    $pedido->setEstado("Pronto a entregar");
    $pedido->updateEstado();
    header("Refresh:0");
  }

  if(isset($_POST["change-delivered"])){
    $pedido->setEstado("Entregue");
    $pedido->updateEstado();
    header("Refresh:0");
  }

  if(isset($_POST["change-closed"])){
    $pedido->setEstado("Fechado");
    $pedido->updateEstado();
    header("Refresh:0");
  }
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
  <meta name="author" content="Creative Tim">
  <title>FastOrder - Detalhes do Pedido</title>
  <!-- Favicon -->
  <link rel="icon" href="../assets/img/brand/favicon.png" type="image/png">
  <!-- Fonts -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
  <!-- Icons -->
  <link rel="stylesheet" href="../assets/vendor/nucleo/css/nucleo.css" type="text/css">
  <link rel="stylesheet" href="../assets/vendor/fontawesome-free-6.1.1-web/css/all.min.css" type="text/css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp">
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined">
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons+Round">
  <!-- Argon CSS -->
  <link rel="stylesheet" href="../assets/css/argon.css" type="text/css">
</head>

<body>
  <!-- Sidenav -->
  <nav class="sidenav navbar navbar-vertical fixed-left navbar-expand-xs navbar-light bg-white" id="sidenav-main">
    <div class="scrollbar-inner">
      <!-- Brand -->
      <div class="sidenav-header  align-items-center">
        <a class="navbar-brand" href="dashboard.php">
          <img src="../assets/img/brand/FASTORDER.png" class="navbar-brand-img" alt="...">
        </a>
      </div>
      <div class="navbar-inner">
        <!-- Collapse -->
        <div class="collapse navbar-collapse" id="sidenav-collapse-main">
          <!-- Nav items -->
          <?php include_once "sidebar-html.php"; ?>
        </div>
      </div>
    </div>
  </nav>
  <!-- Main content -->
  <div class="main-content" id="panel">
    <!-- Topnav -->
    <nav class="navbar navbar-top navbar-expand navbar-dark bg-primary border-bottom">
      <div class="container-fluid">
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <!-- Search form -->
          <form class="navbar-search navbar-search-light form-inline mr-sm-3" id="navbar-search-main">
            <div class="form-group mb-0">
              <div class="input-group input-group-alternative input-group-merge">
                <div class="input-group-prepend">
                  
                </div>
                
              </div>
            </div>
            <button type="button" class="close" data-action="search-close" data-target="#navbar-search-main" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </form>
          <!-- Navbar links -->
          <ul class="navbar-nav align-items-center  ml-md-auto ">
            <li class="nav-item d-xl-none">
              <!-- Sidenav toggler -->
              <div class="pr-3 sidenav-toggler sidenav-toggler-dark" data-action="sidenav-pin" data-target="#sidenav-main">
                <div class="sidenav-toggler-inner">
                  <i class="sidenav-toggler-line"></i>
                  <i class="sidenav-toggler-line"></i>
                  <i class="sidenav-toggler-line"></i>
                </div>
              </div>
            </li>
            <li class="nav-item d-sm-none">
              <a class="nav-link" href="#" data-action="search-show" data-target="#navbar-search-main">
                <i class="ni ni-zoom-split-in"></i>
              </a>
            </li>
            <li class="nav-item dropdown">
              <div class="dropdown-menu dropdown-menu-xl  dropdown-menu-right  py-0 overflow-hidden">
                <!-- Dropdown header -->
                <div class="px-3 py-3">
                  <h6 class="text-sm text-muted m-0">Você tem <strong class="text-primary">0</strong> notificações.</h6>
                </div>
                <!-- List group -->
                <div class="list-group list-group-flush">
                  <a href="#!" class="list-group-item list-group-item-action">
                    <div class="row align-items-center">
                      <div class="col-auto">
                        <!-- Avatar -->
                        <img alt="Image placeholder" src="../assets/img/theme/team-1.jpg" class="avatar rounded-circle">
                      </div>
                      <div class="col ml--2">
                        <div class="d-flex justify-content-between align-items-center">
                          <div>
                            <h4 class="mb-0 text-sm">John Snow</h4>
                          </div>
                          <div class="text-right text-muted">
                            <small>2 hrs ago</small>
                          </div>
                        </div>
                        <p class="text-sm mb-0">Let's meet at Starbucks at 11:30. Wdyt?</p>
                      </div>
                    </div>
                  </a>
                </div>
                <a href="#!" class="dropdown-item text-center text-primary font-weight-bold py-3">View all</a>
              </div>
            </li>
          </ul>
          <ul class="navbar-nav align-items-center  ml-auto ml-md-0">
            <li class="nav-item dropdown">
              <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">  
                <i class="fas fa-user"></i>
              </a>
              <div class="dropdown-menu  dropdown-menu-right ">
                <a href="../assets/php/logout.php" class="dropdown-item">
                  <i class="ni ni-user-run"></i>
                  <span>Logout</span>
                </a>
              </div>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <!-- Header -->
    <div class="header bg-primary pb-6">
      <div class="container-fluid">
        <div class="header-body">
          <div class="row align-items-center py-4">
            <div class="col-lg-6 col-7"></div>
            <div class="col-lg-6 col-5 text-right"></div>
          </div>
        </div>
      </div>
    </div>
    <!-- Page content -->
    <div class="container-fluid mt--6">
      <form action="" method="post">
      <div class="row">
        <div class="col">
          <div class="card">
            <!-- Card header -->
            <div class="card-header border-0">
              <div class="row">
                <div class="col-8 col-md-8 col-xl-8 mb-0">
                  <h3 class="mb-0 p-2">Pedido <?php echo $pedidoGet["idPedido"];?></h3>
                </div>
                <div class="col-4 col-md-4 col-xl-4 mb-0">
                  <h5 class="mb-0 p-2">Estado atual: <?php echo $pedidoGet["Estado"]; ?></h5>
                </div>
              </div>
              <br>
              <div class="row text-center">
                <div class="col-3 col-md-3 col-xl-3 mb-0">
                  <h4 class="mb-0 p-2">Definir pedido como: </h4>
                </div>
                <div class="col-3 col-md-3 col-xl-3 mb-0" <?php if($pedidoGet["Estado"] == "A preparar"){echo "hidden";} ?>>
                  <button type="submit" name="change-preparing" class="btn btn-primary">A preparar</button>
                </div>
                <div class="col-3 col-md-3 col-xl-3 mb-0" <?php if($pedidoGet["Estado"] == "Pronto a entregar"){echo "hidden";} ?>>
                  <button type="submit" name="change-delivering" class="btn btn-delivery">Pronto a entregar</button>
                </div>
                <div class="col-3 col-md-3 col-xl-3 mb-0" <?php if($pedidoGet["Estado"] == "Entregue"){echo "hidden";} ?>>
                  <button type="submit" name="change-delivered" class="btn btn-success">Entregue</button>
                </div>
                <div class="col-3 col-md-3 col-xl-3 mb-0" <?php if($pedidoGet["Estado"] == "Fechado"){echo "hidden";} ?>>
                  <button type="submit" name="change-closed" class="btn btn-danger">Fechado</button>
                </div>
              </div>
            </div>    
            <!-- Light table -->
            <div class="table-responsive">
              <table class="table align-items-center table-flush">
                <thead class="thead-light">
                  <tr>
                    <th scope="col" class="sort" data-sort="Produto">Produto</th>
                    <th scope="col" class="sort" data-sort="Quantidade">Quantidade</th>
                    <th scope="col" class="sort" data-sort="Preco">Preço</th>
                    <th scope="col">Notas</th>
                  </tr>
                </thead>
                <tbody class="list">
                  <?php
                    foreach ($pedido_detalhesList as $pedido_detalhes) { 
                      $produto = new Product();
                      $produto->setIdProduto($pedido_detalhes["idProduto"]);
                      $produtoGet = $produto->getById()[0];
                  ?>
                    <tr style="height: 125px;">
                      <th scope="row">
                        <div class="media align-items-center">
                          <div class="media-body">
                            <span class="name mb-0 text-lg">
                              <?php echo $produtoGet["NomeProduto"]; ?> <text style="color: #6C6C6C; margin-left: 0.25rem; font-size: 14px;"><?php echo $pedido_detalhes["Tamanho"] ?></text>
                            </span>
                          </div>
                        </div>
                      </th>
                      <td class="budget" style="font-size: 18px">
                        <?php echo $pedido_detalhes["Quantidade"]; ?>
                      </td>
                      <td style="font-size: 18px">
                        <?php echo number_format($pedido_detalhes["Quantidade"] * $pedido_detalhes["Preco"],2) ?> €
                      </td>
                      <td style="overflow: wrap; font-size: 18px">
                        <span>
                          <?php echo $pedido_detalhes["Notas"]; ?>
                        </span>
                      </td>
                    </tr>
                  <?php } ?>
                </tbody>
              </table>
            </div>
          </div>
          <div class="row text-center">
            <div class="col-lg-4"></div>
            <div class="col-lg-4">
              <a href="pedidos.php" class="btn btn-primary mt-3">Voltar</a>
            </div>
          </div>
        </div>
      </form>
      </div>
      
      <!-- Footer -->
      <footer class="footer pt-0">
        <div class="row align-items-center justify-content-lg-between">
          <div class="col-lg-6">
          </div>
          <div class="col-lg-6">
          </div>
        </div>
      </footer>
    </div>
  </div>
  <!-- Argon Scripts -->
  <!-- Core -->
  <script src="../assets/vendor/jquery/dist/jquery.min.js"></script>
  <script src="../assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/vendor/js-cookie/js.cookie.js"></script>
  <script src="../assets/vendor/jquery.scrollbar/jquery.scrollbar.min.js"></script>
  <script src="../assets/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js"></script>
  <!-- Argon JS -->
  <script src="../assets/js/argon.js?v=1.2.0"></script>
</body>

</html>