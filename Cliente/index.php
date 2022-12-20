  <?php
  session_start();
  session_id();


  include_once "../Admin/assets/php/categories.php";
  include_once "../Admin/assets/php/products.php";
  include_once "../Admin/assets/php/users.php";
  include_once "php/cart.php";

  $precoTotal = 0;
  $loginVerify = false;

  //Cart
  $cart = new Cart();
  $cartList = $cart->showCart();

  if (isset($_POST["submit"])){
    if (!isset($_SESSION['login_cliente']) || $_SESSION['login_cliente'] != true) {
      $loginVerify = true;
    } else {
      $loginVerify = false;
    }
  }

  if (isset($_GET["addToCart"])){
    $sessionID = session_id();  
    $idProduto = $_GET["idProduto"];
    $Quantidade = $_GET["Quantidade"];
    $Preco = $_GET["Preco"];
    $dt = date_create()->format('Y-m-d');

    $cart = new Cart();
    $cart->setSessionID($sessionID);
    $cart->setIdProduto($idProduto);
    $cart->setQuantidade($Quantidade);
    $cart->setPreco($Preco);
    $cart->setCreateDate($dt);

    $duplicate = $cart->checkDuplicate();

    if(count($duplicate) > 0){
      $cart->setQuantidade($duplicate[0]["Quantidade"] + 1);
      $cart->updateItem();
    } else {
      $cart->setQuantidade($Quantidade);
      $cart->createCart();
    }
    $cart->deleteOneDay();
    header("location: index.php");
  }
  
  //Produtos
  $produto = new Product ();
  $produtoList = $produto->listProduct();

  //Categorias
  $categoria = new Category ();
  $categoriaList = $categoria->listCategory();
?>

  <!DOCTYPE html>
  <html>

  <head>
    <?php include_once "components/head-tag.html" ?>
    <title>FastOrder - Menu</title>
  </head>

  <body class="sub_page">
    <?php include_once "components/navbar.php" ?>

    <div id="preloder" class="preloader">
      <div class="loader"></div>
    </div>

    <div class="position-fixed top-0 end-0 p-3" style="z-index: 999">
      <div id="liveToast" class="toast align-items-center text-white bg-primary border-0 fade" role="alert"
        aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
          <div class="toast-body m-auto">
            Carrinho atualizado com sucesso!
          </div>
          <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
            aria-label="Close"></button>
        </div>
      </div>
    </div>

    <!-- ======= Food Section ======= -->
    <section class="food_section layout_padding">
      <div class="container">
        <div class="heading_container heading_center">
          <h2>
            <br><br>
            A nossa Ementa
          </h2>
        </div>

        <!-- <button type="button" class="btn btn-primary" id="liveToastBtn">Show live toast</button> -->

        <ul class="scrollmenu filters_menu">
          <li class="active" data-filter="*">Todos</li>
          <?php foreach($categoriaList as $categoria) { 
          $printList = str_replace(' ','', $categoria["NomeCategoria"]);
          ?>
          <li data-filter=".<?php echo strtolower($printList);?>">
            <?php echo $categoria["NomeCategoria"] ?>
          </li>
          <?php } ?>
        </ul>

        <div class="filters-content">
          <div class="row">
            <?php foreach($produtoList as $produto) { 
            $category = new Category();
            $category->setIdCategoria($produto["idCategoria"]);
            $categorySelect = $category->selectCategory()[0];

            $printProduct = str_replace(' ','', $categorySelect["NomeCategoria"]);?>
            <div class="col-lg-6 col-sm-12 all <?php echo strtolower($printProduct);?>">
              <div class="media align-items-center food-card" style="max-height: 200px; min-height: 200px;">
                <img class="mr-1 mr-sm-1" src="../FastOrder_Produtos/<?php echo $produto["Imagem"] ?>" alt=""
                  width="auto" height="auto" object-fit: cover;">
                <div class="media-body">
                  <div class="d-flex food-card-title">
                    <h4><?php echo $produto["NomeProduto"] ?></h4>
                  </div>
                  <p><?php if($produto["idCategoria"] == 1){echo "A partir de ";} echo "<b>" . $produto["Preco"];?>€
                    </b></p>
                </div>
                <?php if($produto["idCategoria"] == 5 || $produto["idCategoria"] == 6 || $produto["idCategoria"] == 7) { ?>
                <a href="index.php?addToCart&idProduto=<?php echo $produto["idProduto"]?>&Quantidade=1&Preco=<?php echo $produto["Preco"]?>"
                  class="add-to-cart-btn ml-auto">
                  <i class="bi bi-cart-check"></i>
                </a>
                <?php } else { ?>
                <a href="productselection.php?id=<?php echo $produto["idProduto"]?>" class="add-to-cart-btn ml-auto">
                  <i class="bi bi-cart-plus"></i>
                </a>
                <?php } ?>
              </div>
            </div>
            <?php } ?>
          </div>
        </div>
      </div>
    </section>
    <!-- ===== End Food Section ===== -->

    <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact">
      <div class="container">
        <div class="info-wrap">
          <div class="row">
            <div class="col-lg-4 col-md-6 info">
              <i class="bi bi-geo-alt"></i>
              <h4>Endereço:</h4>
              <p>Estrada Nacional 367<br>334A Marinhais 2125-121</p>
            </div>
            <div class="col-lg-4 col-md-6 info mt-4 mt-lg-0">
              <i class="bi bi-clock"></i>
              <h4>Horário de Funcionamento:</h4>
              <p>Terça-Domingo:<br>12:00-15:00/18:00-22:00</p>
            </div>
            <div class="col-lg-4 col-md-6 info mt-4 mt-lg-0">
              <i class="bi bi-phone"></i>
              <h4>Telefone:</h4>
              <p>912 712 197</p>
            </div>
          </div>
        </div>
        <div class="map">
          <iframe style="border:0; width: 100%; height: 350px;"
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d14739.897297962772!2d-8.714828492810454!3d39.04537621354119!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd18e30805c0f999%3A0xfeb116ebe242f02e!2sPizzeria%20Toscana!5e0!3m2!1spt-PT!2spt!4v1646648100962!5m2!1spt-PT!2spt"
            frameborder="0" allowfullscreen></iframe>
        </div>
      </div>
    </section>
    <!-- ===== End Contact Section ===== -->

    <!-- ======= Footer ======= -->
    <?php include "components/footer.html"; ?>
    <!-- ===== End Footer ===== -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
        class="bi bi-arrow-up-short"></i></a>

    <!-- jQery -->
    <script src="js/jquery-3.4.1.min.js"></script>
    <!-- popper js -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
      integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <!-- bootstrap js -->
    <script src="js/bootstrap.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
    <!-- owl slider -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <!-- isotope js -->
    <script src="https://unpkg.com/isotope-layout@3.0.4/dist/isotope.pkgd.min.js"></script>
    <!-- nice select -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/js/jquery.nice-select.min.js"></script>
    <!-- custom js -->
    <script src="js/fastorder.js"></script>
    <script src="js/custom.js"></script>
    <script src="js/login.js"></script>

  </body>

  </html>