<?php 
  include_once "../../assets/php/products.php";
  include_once "../../assets/php/users.php";
  include_once "../../assets/php/categories.php";

  //Products
  $product = new Product();
  $products = $product->listProduct();

  $productSort = true;

  if (isset($_GET["checkSort"])){
    $sortProduct = new Product();
    $sortProducts = $sortProduct->sortProduct($_GET["checkSort"]);

    $productSort = false;
  } else {
    $productSort = true;
  }

  //Categories
  $category = new Category();
  $categories = $category->listCategory();

  //Users
  $user = new user();
  $users = $user->listUser();

?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
  <meta name="author" content="Creative Tim">
  <title>FastOrder - Menu</title>
  <!-- Favicon -->
  <link rel="icon" href="../../assets/img/brand/favicon.png" type="image/png">
  <!-- Fonts -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
  <!-- Icons -->
  <link rel="stylesheet" href="../../assets/vendor/nucleo/css/nucleo.css" type="text/css">
  <link rel="stylesheet" href="../../assets/vendor/fontawesome-free-6.1.1-web/css/all.min.css" type="text/css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp">
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined">
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons+Round">
  <!-- Argon CSS -->
  <link rel="stylesheet" href="../../assets/css/argon.css?v=1.2.0" type="text/css">
</head>

<body>
  <!-- Sidenav -->
  <nav class="sidenav navbar navbar-vertical  fixed-left  navbar-expand-xs navbar-light bg-white" id="sidenav-main">
    <div class="scrollbar-inner">
      <!-- Brand -->
      <div class="sidenav-header  align-items-center">
        <a class="navbar-brand" href="../dashboard.php">
          <img src="../../assets/img/brand/blue.png" class="navbar-brand-img" alt="...">
        </a>
      </div>
      <div class="navbar-inner">
        <!-- Collapse -->
        <div class="collapse navbar-collapse" id="sidenav-collapse-main">
          <!-- Nav items -->
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link" href="../dashboard.php">
                <i class="ni fas fa-desktop text-default"></i>
                <span class="nav-link-text">Dashboard</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="../pedidos.php">
                <i class="ni fas fa-shopping-basket text-default"></i>
                <span class="nav-link-text">Pedidos</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="../produtos.php">
                <i class="ni fas fa-tag text-default"></i>
                <span class="nav-link-text">Produtos</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="../categorias.php">
                <i class="ni fas fa-list-ul text-default"></i>
                <span class="nav-link-text">Categorias</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="../utilizadores.php">
                <i class="ni fas fa-user text-default"></i>
                <span class="nav-link-text">Utilizadores</span>
              </a>
            </li>
          </ul>
          <hr class="my-3">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link active" href="menu.php">
                <i class="fas fa-utensils text-default"></i>
                <span class="nav-link-text">Menu</span>
              </a>
            </li>
          </ul>
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
                        <img alt="Image placeholder" src="../../assets/img/theme/team-1.jpg" class="avatar rounded-circle">
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
          <ul class="navbar-nav align-items-center  ml-auto ml-md-0 ">
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
                <div class="col-9 col-md-9 col-xl-9 mb-0">
                  <h3 class="mb-0 p-2 text-lg">Ementa</h3>
                </div>
                <div class="col-2 col-md-2 col-xl-2 mb-0 text-right align-items-center">
                  <div class="p-3">
                    Categorias
                  </div>
                </div>
                <div class="col-1 col-md-1 col-xl-1 p-1 text-left">
                  <div class="dropdown">
                    <a class="btn btn-sm text-lg text-default m-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="fas fa-sort-down"></i>
                    </a>
                    <div name="checkSort" class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                      <a class="dropdown-item" href="menu.php" value="0">Todos</a>
                      <?php foreach ($categories as $category) { ?>
                        <a class="dropdown-item" href="menu.php?checkSort=<?php echo $category["idCategoria"] ?>" value="<?php echo $category["idCategoria"] ?>"><?php echo $category["NomeCategoria"]; ?></a>
                      <?php } ?>
                      <!-- <button class="dropdown-item" href="#myModalDel" data-toggle="modal">Eliminar</button> -->
                    </div>
                  </div>
                </div>
              </div>  
            </div>
            <!-- Light table -->
            <div class="table-responsive">
              <table class="table align-items-center table-flush">
                <thead class="thead-light">
                  <tr>
                    <th scope="col" class="sort" data-sort="name">Imagem</th>
                    <th scope="col" class="sort" data-sort="name">Nome do Produto</th>
                    <th scope="col" class="sort" data-sort="name">Preço</th>
                    <th scope="col"></th>
                  </tr>
                </thead>
                <tbody class="list">
                  <?php if ($productSort == true) { ?>
                    <?php foreach ($products as $product) { ?>
                      <tr>
                        <td scope="row">
                          <div class="media align-items-center">
                            <div class="media-body">
                              <img src="../../../FastOrder_Produtos/<?php echo $product["Imagem"]; ?>" alt="<?php echo $product["NomeProduto"]; ?>" class="productImg">
                            </div>
                          </div>
                        </td>
                        <td scope="row">
                          <div class="media align-items-center">
                            <div class="media-body">
                              <span class="name mb-0 text-lg"><?php echo $product["NomeProduto"]; ?></span>
                            </div>
                          </div>
                        </td>
                        <td scope="row">
                          <div class="media align-items-center">
                            <div class="media-body">
                              <span class="name mb-0 text-lg"><?php echo $product["Preco"]; ?> €</span>
                            </div>
                          </div>
                        </td>
                        <td scope="row">
                          <div class="media align-items-center">
                            <div class="media-body">
                              <a class="btn btn-sm text-lg text-default m-0 p-3" href="produtoDetalhes.php?idProduto=<?php echo $product["idProduto"]; ?>">
                                <i class="fas fa-caret-right"></i>
                              </a>
                            </div>
                          </div>
                        </td>
                      </tr>
                    <?php } ?>
                  <?php } else { ?>
                    <?php foreach ($sortProducts as $sortProduct) { ?>
                      <tr>
                        <td scope="row">
                          <div class="media align-items-center">
                            <div class="media-body">
                              <img src="../../assets/img/<?php echo $sortProduct["Imagem"]; ?>" alt="<?php echo $sortProduct["NomeProduto"]; ?>" class="productImg">
                            </div>
                          </div>
                        </td>
                        <td scope="row">
                          <div class="media align-items-center">
                            <div class="media-body">
                              <span class="name mb-0 text-lg"><?php echo $sortProduct["NomeProduto"]; ?></span>
                            </div>
                          </div>
                        </td>
                        <td scope="row">
                          <div class="media align-items-center">
                            <div class="media-body">
                              <span class="name mb-0 text-lg"><?php echo $sortProduct["Preco"]; ?> €</span>
                            </div>
                          </div>
                        </td>
                        <td scope="row">
                          <div class="media align-items-center">
                            <div class="media-body">
                              <a class="btn btn-sm text-lg text-default m-0 p-3" href="produtoDetalhes.php?idProduto=<?php echo $sortProduct["idProduto"]; ?>">
                                <i class="fas fa-caret-right"></i>
                              </a>
                            </div>
                          </div>
                        </td>
                      </tr>
                    <?php } ?>
                  <?php } ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
      <!-- Modals -->
      <div id="myModalDel" class="modal fade">
        <div class="modal-dialog modal-confirm">
          <div class="modal-content">
            <div class="modal-header flex-column">
              <div class="icon-box">
                <i class="material-icons">&#xE5CD;</i>
              </div>						
              <h4 class="modal-title w-100">Atenção!</h4>	
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
              <p>Tem a certeza que deseja eliminar este registo? Este ação não pode ser desfeita!</p>
            </div>
            <div class="modal-footer justify-content-center">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
              <a href="utilizadores.php?Delete=" type="button" name="Delete" value="" class="btn btn-danger text-white">Confirmar</a>
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
  <script src="../../assets/vendor/jquery/dist/jquery.min.js"></script>
  <script src="../../assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="../../assets/vendor/js-cookie/js.cookie.js"></script>
  <script src="../../assets/vendor/jquery.scrollbar/jquery.scrollbar.min.js"></script>
  <script src="../../assets/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js"></script>
  <!-- Argon JS -->
  <script src="../../assets/js/argon.js?v=1.2.0"></script>
</body>

</html>

