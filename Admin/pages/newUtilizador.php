<?php 
  require("../assets/php/requirelogin.php");
  require("../assets/php/permissions.php");
  
  include_once "../assets/php/users.php";
  $userError = false;
  $userLenght = false;
  $emailError = false;
  $passwordError = false;
  $passwordLength = false;

  $userCheck = true;

  if (isset($_POST["submit"])){
    $NomeUtilizador = $_POST["NomeUtilizador"];
    if(preg_match("/[^a-zÃ -Ã0-9A-Z._]+/", $NomeUtilizador)){
      $userError = true;
    } else if (strlen($NomeUtilizador) > 0){
      $userError = false;
    } else {
      $userError = true;
    }

    $Email = $_POST["Email"];
    if(preg_match("/[^a-z0-9A-Z@._]+/", $Email)){
      $emailError = true;
    } else if (strlen($Email) > 0){
      $emailError = false;
    } else {
      $emailError = true;
    }

    $Password = $_POST["Password"];
    if(preg_match("/[^a-z0-9A-Z._]+/", $Password)){
      $passwordError = true;
    } else if (strlen($Password) > 0){
      $passwordError = false;
    } else {
      $passwordError = true;
    }

    $Perfil = $_POST["Perfil"];

    $user = new User();
    $user->setNomeUtilizador($NomeUtilizador);
    $user->setEmail($Email);
    $user->setPassword($Password);
    $user->setPerfil($Perfil);

    if (strlen($NomeUtilizador) > 16) {
      $userLenght = true;
    } else {
      $userLenght = false;
    }

    if (strlen($Password) > 32) {
      $passwordLength = true;
    } else {
      $passwordLength = false;
    }

    if ($userError == false && $emailError == false && $passwordError == false && $userLenght == false && $passwordLength == false) {
      $userCheck = true;
    } else {
      $userCheck = false;
    }

    if ($userCheck == true) {
      $user->createUser();

      header ("location: utilizadores.php");
    }
  }

?>


<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
  <meta name="author" content="Fast Order">
  <title>FastOrder - Utilizadores</title>
  <!-- Favicon -->
  <link rel="icon" href="../assets/img/brand/favicon.png" type="image/png">
  <!-- Fonts -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
  <!-- Icons -->
  <link rel="stylesheet" href="../assets/vendor/nucleo/css/nucleo.css" type="text/css">
  <link rel="stylesheet" href="../assets/vendor/fontawesome-free-6.1.1-web/css/all.min.css" type="text/css">
  <!-- Argon CSS -->
  <link rel="stylesheet" href="../assets/css/argon.css?v=1.2.0" type="text/css">
</head>

<body>
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
            <div class="pr-3 sidenav-toggler sidenav-toggler-dark active" data-action="sidenav-pin" data-target="#sidenav-main">
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
                <h6 class="text-sm text-muted m-0">You have <strong class="text-primary">13</strong> notifications.</h6>
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
                  <!--<a href="#!" class="list-group-item list-group-item-action">
                    <div class="row align-items-center">
                      <div class="col-auto">-->
              </div>
              <!-- View all -->
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
  </nav><s></s>
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
    
    <!-- Header -->
    <div class="header pb-6 d-flex align-items-center bg-primary" style="min-height: 100px; background-size: cover; background-position: center top;">
      <!-- Header container -->
      <div class="container-fluid d-flex align-items-center">
        <div class="row">
        </div>
      </div>
    </div>
    <!-- Page content -->
    <div class="container-fluid mt--6">
      <div class="row">
        <div class="col-xl-8 order-xl-1 center">
          <div class="card">
            <div class="card-header">
              <div class="row align-items-center">
                <div class="col-8">
                  <h3 class="mb-0">Novo Utilizador</h3>
                </div>
              </div>
            </div>
            <div class="card-body">
              <form role="form" method="POST">
              <?php if ($userCheck == false) { ?>
                <div class="form-group mb-3">
                  <div class="alert alert-danger" role="alert">
                    <?php if ($userError == true) {
                      echo "O nome de utilizador está inválido.<br>";
                    } 
                    if ($emailError == true) {
                      if ($userError == true) {
                        echo "<br>";
                      }
                      echo "O email está inválido.<br>";
                    } 
                    if ($passwordError == true) {
                      if ($userError == true || $emailError == true) {
                        echo "<br>";
                      }
                      echo "A password está inválida.";
                    }
                    if ($userLenght == true) {
                      if ($userError == true || $emailError == true || $passwordError == true) {
                        echo "<br>";
                      }
                      echo "O nome de utilizador não pode ter mais que 16 caractéres.";
                    }
                    if ($passwordLength == true) {
                      if ($userError == true || $emailError == true || $passwordError == true || $userLenght == true) {
                        echo "<br>";
                      }
                      echo "A password não pode ter mais que 32 caractéres.";
                    }
                    ?>
                  </div>
                </div>
                <?php } ?>
                <div class="form-group mb-3">
                  <div class="input-group input-group-merge input-group-alternative">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-single-02"></i></span>
                    </div>
                    <input name="NomeUtilizador" class="form-control" placeholder="Nome de Utilizador" type="username" required>
                  </div>
                </div>
                <div class="form-group mb-3">
                  <div class="input-group input-group-merge input-group-alternative">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                    </div>
                    <input name="Email" class="form-control" placeholder="Email" type="email" required>
                  </div>
                </div>
                <div class="form-group mb-3">
                  <div class="input-group input-group-merge input-group-alternative">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                    </div>
                    <input type="password" name="Password" id="myPassword" class="form-control" placeholder="Password" required>
                  </div>
                  <input type="checkbox" class="align-items-start" onclick="passwordShow()"><text class="text-sm text-gray">Mostrar Palavra-passe</text> 
                </div>
                <div class="form-group mb-3">
                  <div class="input-group input-group-merge input-group-alternative">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                    </div>
                    <select name="Perfil" class="form-control">
                      <option value="Administrador">Administrador</option>
                      <option value="Funcionário">Funcionário</option>
                    </select>
                  </div>
                </div>
                <div class="text-center">
                  <input type="submit" name="submit" class="btn btn-primary mt-3" value="Adicionar" />
                </div>
              </form>
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
  <!-- My Scripts -->
  <script src="../assets/js/password.js"></script>
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