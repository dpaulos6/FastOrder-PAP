<?php 
  require("../assets/php/requirelogin.php");
  //require("../assets/php/permissions.php");
  
  include_once "../assets/php/products.php";
  include_once "../assets/php/categories.php";
  
  if (isset($_GET["Delete"])){
    $product = new Product();
    $product->deleteProduct($_GET["Delete"]);

    unlink("../../FastOrder_Produtos/" . $_GET["imagename"]);

    header("location: produtos.php");
  }

  $product = new Product();
  $products = $product->listProduct();
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
  <meta name="author" content="Creative Tim">
  <title>FastOrder - Produtos</title>
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
      <div class="row">
        <div class="col">
          <div class="card">
            <!-- Card header -->
            <div class="card-header border-0">
              <div class="row">
                <div class="col-11 col-md-11 col-xl-11 mb-0">
                  <h3 class="mb-0 p-2 ">Produtos</h3>
                </div>
                <div class="col-1 col-md-1 col-xl-1 mb-0 col-auto text-right">
                  <a href="newProduto.php">
                    <span class="material-icons-round text-xl text-green btn btn-sm" style="margin-right: 0.25rem;">
                      add
                    </span>
                  </a>
                </div>
              </div>
            </div>    
            <!-- Light table -->
            <div class="table-responsive">
              <table class="table align-items-center table-flush">
                <thead class="thead-light">
                  <tr>
                    <th scope="col" class="sort" data-sort="name">Nome</th>
                    <th scope="col" class="sort" data-sort="budget">Preço</th>
                    <th scope="col" class="sort" data-sort="status">Imagem</th>
                    <th scope="col" class="sort" data-sort="status">Categoria</th>
                    <th scope="col"></th>
                  </tr>
                </thead>
                <tbody class="list">
                  <?php foreach ($products as $product) { ?>
                    <tr>
                      <th scope="row">
                        <div class="media align-items-center">
                          <div class="media-body">
                            <span class="name mb-0 text-lg"><?php echo $product["NomeProduto"]; ?></span>
                          </div>
                        </div>
                      </th>
                      <td class="budget">
                        <?php if($product["idCategoria"] == 1) { ?>
                          <span class="name mb-0 text-lg">Individual: <?php echo $product["Preco_Individual"]; ?>€</span> <br>
                          <span class="name mb-0 text-lg">Média: <?php echo $product["Preco_Media"]; ?>€</span> <br>
                          <span class="name mb-0 text-lg">Familiar: <?php echo $product["Preco_Familiar"]; ?>€</span>
                        <?php } else { ?>
                          <span class="name mb-0 text-lg"><?php echo $product["Preco"]; ?>€</span>
                          <?php } ?>
                        </td>
                      <td>
                        <img src="../../FastOrder_Produtos/<?php echo $product["Imagem"]; ?>" alt="<?php echo $product["NomeProduto"]; ?>" class="productImg">
                      </td>
                      <td>
                        <input type="hidden" value="<?php echo $product["idCategoria"]; ?>">
                        <?php 
                          $category = new Category();
                          $category->setIdCategoria($product["idCategoria"]);
                          $categorySelect = $category->selectCategory()[0];
                        ?>
                        <span class="name mb-0 text-lg"><?php echo $categorySelect["NomeCategoria"]; ?></span>
                      </td>
                      <td class="text-right">
                        <div class="dropdown">
                          <a class="btn btn-lg btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v"></i>
                          </a>
                          <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                            <a class="dropdown-item" href="editProdutos.php?id=<?php echo $product["idProduto"]; ?>" >Editar</a>
                            <button class="dropdown-item" href="#myModalDel<?php echo $product["idProduto"]; ?>" data-toggle="modal">Eliminar</button>
                          </div>
                        </div>
                        <!-- Modal Confirm Delete -->
                        <div id="myModalDel<?php echo $product["idProduto"]; ?>" class="modal fade">
                          <div class="modal-dialog modal-dialog-centered modal-confirm">
                            <div class="modal-content">
                              <div class="modal-header flex-column">
                                <div class="icon-box">
                                  <i class="material-icons">&#xE5CD;</i>
                                </div>						
                                <h4 class="modal-title w-100">Atenção!</h4>	
                                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                              </div>
                              <div class="modal-body">
                                <p style="overflow-wrap: break-word !important;">Tem a certeza que deseja eliminar <strong class="deleteText" style="overflow-wrap: break-word !important;"><?php echo $product["NomeProduto"]; ?></strong>?<br> Este ação não pode ser desfeita!</p>
                              </div>
                              <div class="modal-footer justify-content-center">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                <a href="produtos.php?Delete=<?php echo $product["idProduto"];?>&imagename=<?php echo $product["Imagem"];?>" type="button" name="Delete" value="<?php echo $product["idProduto"]; ?>" class="btn btn-danger text-white">Confirmar</a>
                              </div>
                            </div>
                          </div>
                        </div>
                      </td>
                    </tr>
                  <?php } ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
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