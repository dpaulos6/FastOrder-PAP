<?php
  require("../assets/php/requirelogin.php");

  include_once "../assets/php/pedido.php";
  include_once "../assets/php/pedido_detalhes.php";
  include_once "../assets/php/users.php";
  include_once "../assets/php/products.php";

  $pedido = new Pedido();
  $countPedidoTotal = $pedido->countPedidosTotal()[0]["PedidosTotal"];
  $countPedidoAtivos = $pedido->countPedidosAtivos()[0]["PedidosAtivos"];
  $countPedidoMensal = $pedido->countPedidosMensal()[0]["PedidosMensal"];

?>
  <!DOCTYPE html>
  <html>

  <head>
    <meta http-equiv="refresh" content="5">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
    <meta name="author" content="Creative Tim">
    <title>FastOrder - Painel Principal</title>
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
    <!-- Page plugins -->
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
              <div class="col-lg-6 col-7">
                <h6 class="h2 text-white d-inline-block mb-0">Painel Principal </h6>
                <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                </nav>
              </div>
            </div>
            <!-- Card stats -->
            <div class="row">
              <div class="col-xl-4 col-md-4">
                <div class="card card-stats">
                  <!-- Card body -->
                  <div class="card-body">
                    <div class="row">
                      <div class="col">
                        <h5 class="card-title text-uppercase text-muted mb-0">Vendas totais</h5>
                        <span class="h2 font-weight-bold mb-0"><?php echo $countPedidoTotal;?> €</span>
                      </div>
                      <div class="col-auto">
                        <div class="icon icon-shape text-white bg-primary rounded-circle shadow">
                          <i class="fas fa-money-bill-wave-alt"></i>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-xl-4 col-md-4">
                <div class="card card-stats">
                  <!-- Card body -->
                  <div class="card-body">
                    <div class="row">
                      <div class="col">
                        <h5 class="card-title text-uppercase text-muted mb-0">Pedidos Mensais (<?php echo "Dia " . date("d");?>)</h5>
                        <span class="h2 font-weight-bold mb-0"><?php echo $countPedidoMensal;?> €</span>
                      </div>
                      <div class="col-auto">
                        <div class="icon icon-shape text-white bg-primary rounded-circle shadow">
                          <i class="fas fa-money-bill-wave-alt"></i>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-xl-4 col-md-4">
                <div class="card card-stats">
                  <!-- Card body -->
                  <div class="card-body">
                    <div class="row">
                      <div class="col">
                        <h5 class="card-title text-uppercase text-muted mb-0">Pedidos em preparação</h5>
                        <span class="h2 font-weight-bold mb-0"><?php echo $countPedidoAtivos;?></span>
                      </div>
                      <div class="col-auto">
                        <div class="icon icon-shape text-white bg-primary rounded-circle shadow">
                          <i class="fas fa-hand-pointer"></i>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Page content -->
      <div class="container-fluid mt--6">
        <div class="row">
          <div class="col-xl-8">  
            <div class="card bg-default">
              </div>
            </div>
          </div>
          <div class="col-xl-12">
            <div class="card">
              <div class="card-header bg-transparent">
                <div class="row align-items-center">
                  <div class="col">
                    <h6 class="text-uppercase text-muted ls-1 mb-1">Performance</h6>
                    <h5 class="h3 mb-0">Total vendas</h5>
                  </div>
                </div>
              </div>
              <div class="card-body">
                <!-- Chart -->
                <div class="col-md-12 chart">
                  <canvas id="myChart"></canvas>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- Footer -->
        <footer class="footer pt-0">
          <div class="row align-items-center justify-content-lg-between">
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
    <!-- Optional JS -->
    <script src="../assets/vendor/chart.js/dist/Chart.min.js"></script>
    <script src="../assets/vendor/chart.js/dist/Chart.extension.js"></script>
    <!-- Argon JS -->
    <script src="../assets/js/argon.js"></script>

    <?php
      $grafico = $pedido->graficoPedidos();
    ?>

    <script>
      var $labels = [];

      var $valores = [];

      <?php foreach($grafico as $mes){ ?>

        $labels.push("<?php echo $mes["MesNome"] ?>");

        $valores.push(<?php echo number_format($mes["ValorTotal"],2) ?>);

      <?php } ?>

      // var $labels = ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Outubro', 'Novembro', 'Dezembro'];

      // var $valores = [25, 20, 30, 22, 17, 29, 45, 19, 31, 34, 23, 10];

      var xValues = $labels;
      var yValues = $valores;

      var bgColors = [
        'rgba(255, 0, 0, 0.2)',
        'rgba(0, 153, 0, 0.2)',
        'rgba(26, 198, 255, 0.2)',
        'rgba(255, 102, 0, 0.2)',
        'rgba(214, 51, 255, 0.2)',
        'rgba(117, 117, 163, 0.2)',
        'rgba(255, 204, 0, 0.2)',
        'rgba(57, 230, 0, 0.2)',
        'rgba(255, 0, 191, 0.2)',
        'rgba(179, 89, 0, 0.2)',
        'rgba(0, 92, 230, 0.2)',
        'rgba(128, 128, 128, 0.2)'
      ];

      var bdColors = [
        'rgba(255, 0, 0, 1)',
        'rgba(0, 153, 0, 1)',
        'rgba(26, 198, 255, 1)',
        'rgba(255, 102, 0, 1)',
        'rgba(214, 51, 255, 1)',
        'rgba(117, 117, 163, 1)',
        'rgba(255, 204, 0, 1)',
        'rgba(57, 230, 0, 1)',
        'rgba(255, 0, 191, 1)',
        'rgba(179, 89, 0, 1)',
        'rgba(0, 92, 230, 1)',
        'rgba(128, 128, 128, 1)'
      ];

      var ctx = document.getElementById("myChart").getContext('2d');
      var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
          labels: xValues,
          datasets: [{
            label: 'Total (€)',
            data: yValues,
            backgroundColor: bgColors,
            borderColor: bdColors,
            borderWidth: 1
          }]
        },
        options: {
          scales: {
            yAxes: [{
              ticks: {
                beginAtZero: true
              }
            }]
          }
        }
      });
    </script>
  </body>

  </html>