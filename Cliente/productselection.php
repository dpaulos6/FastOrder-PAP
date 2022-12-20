<?php 
  session_start();

  include_once "../Admin/assets/php/products.php";
  include_once "php/cart.php";

  $checkedsize = "individual";

  $product = new Product();
  $produtoListDrinks = $product->getDrinks();

  $cart = new Cart();
  $cartList = $cart->showCart();

  if (isset($_GET["id"])){
    $produto = new Product();
    $produto->setIdProduto($_GET["id"]);
    $produtoGet = $produto->getById()[0];
  }

  if(isset($_POST["addToCart"])){
    $sessionID = session_id();  
    $idProduto = $_POST["idProduto"];
    $Quantidade = $_POST["quantity"];
    $dt = date_create()->format('Y-m-d');

    if($produtoGet["idCategoria"] == 1){
      if($_POST["select"] == "Individual"){
        $Preco = $_POST["price-individual"];
        $Tamanho = "Individual";
      } else if($_POST["select"] == "Media"){
        $Preco = $_POST["price-medio"];
        $Tamanho = "Média";
      } else if($_POST["select"] == "Familiar"){
        $Preco = $_POST["price-familiar"];
        $Tamanho = "Familiar";
      }
    } else {
      $Preco = $_POST["PrecoProd"];
      $Tamanho = null;
    }

    $cart = new Cart();
    $cart->setSessionID($sessionID);
    $cart->setIdProduto($idProduto);
    $cart->setTamanho($Tamanho);
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

    if($_POST["drink-input"] != "null"){
      $sessionID = session_id();  
      $idProduto = $_POST["drink-input"];
      $Quantidade = $_POST["quantity"];
      $Preco = $_POST["Preco"];

      $cart = new Cart();
      $cart->setSessionID($sessionID);
      $cart->setIdProduto($idProduto);
      $cart->setQuantidade($Quantidade);
      $cart->setPreco($Preco);
      $cart->setCreateDate($dt);

      $cart->createCart();
    }
    $cart->deleteOneDay();
    header("location: index.php");
  }
?>

<!DOCTYPE html>
<html>

<head>
  <?php include_once "components/head-tag.html" ?>
  <title>FastOrder - Personalizar <?php echo $produtoGet["NomeProduto"] ?></title>
</head>

<body class="sub_page"></body>
<?php include_once "components/navbar.php" ?>

<div id="preloder" class="preloader">
  <div class="loader"></div>
</div>

<br><br><br><br>

<!-- food section -->
<section class="">
  <form action="" method="post">
    <div class="container">
      <div class="heading_container heading_center">
        <h2>
          Personalizar Pedido
        </h2>
        <br>
      </div>
      <div class="media align-items-center product-selection">
        <div class="row" style="width: 110%;">
          <div class="col-12">
            <div class="text-center">
              <input type="hidden" name="idProduto" value="<?php echo $produtoGet["idProduto"];?>">
              <input type="hidden" name="PrecoProd" value="<?php echo $produtoGet["Preco"];?>">
              <img src="../FastOrder_Produtos/<?php echo $produtoGet["Imagem"]; ?>" alt="" width="200">
              <h3 class="text-center">
                <?php echo $produtoGet["NomeProduto"];?>
                <text class="food-quantity-input">
                  <input type="number" name="quantity" value="1" min="1" max="99">
                </text>
              </h3>
            </div>
            <br><br>
            <div class="row mt-4" <?php if($produtoGet["idCategoria"] != 1) { echo "hidden"; } ?>>
              <h4 class="text-center">Tamanho</h4>
              <div class="wrapper text-center" style="width: 100%;">
                <input type="radio" name="select" id="option-1" value="Individual" checked>
                <input type="hidden" name="price-individual" value="<?php echo $produtoGet["Preco_Individual"] ?>">
                <label for="option-1" class="option option-1">
                  <span>Individual - <?php echo $produtoGet["Preco_Individual"] ?>€</span> 
                </label>
                <input type="radio" name="select" id="option-2" value="Media">
                <input type="hidden" name="price-medio" value="<?php echo $produtoGet["Preco_Media"] ?>">
                <label for="option-2" class="option option-2">
                  <span>Média - <?php echo $produtoGet["Preco_Media"] ?>€</span>
                </label>
                <input type="radio" name="select" id="option-3" value="Familiar">
                <input type="hidden" name="price-familiar" value="<?php echo $produtoGet["Preco_Familiar"] ?>">
                <label for="option-3" class="option option-3">
                  <span>Familiar - <?php echo $produtoGet["Preco_Familiar"] ?>€</span>
                </label>
              </div>
            </div>
            <br>
            <div class="row mt-4">
              <h4 class="text-center">Bebidas</h4>
            </div>

            <div class="row">
              <div class="col-lg-2 col-md-2 col-6 nopad text-center mt-1 mb-1">
                <label class="image-radio">
                  <img src="https://cdn-icons-png.flaticon.com/512/59/59836.png" width="125" height="125" style="max-width: 125px; max-height: 125px; object-fit: cover; padding: 25px;">
                  <input type="radio" name="drink-input" value="null" checked/>
                  <h5></h5>
                </label>
              </div>
              <?php foreach ($produtoListDrinks as $product) { ?>
              <div class="col-lg-2 col-md-2 col-6 nopad text-center mt-1 mb-1">
                <label class="image-radio">
                  <img src="../FastOrder_Produtos/<?php echo $product["Imagem"]; ?>" width="125" height="125"
                    style="max-width: 125px; max-height: 125px; object-fit: cover;">
                  <input type="radio" name="drink-input" value="<?php echo $product["idProduto"] ?>" />
                  <input type="hidden" name="Preco" value="<?php echo $product["Preco"] ?>">
                  <h5><?php echo $product["NomeProduto"]; ?></h5>
                </label>
              </div>
              <?php } ?>
            </div>  

            <div class="options align-items-center justify-content-center text-center">
              <a href="index.php" class="back-a-table-btn" style="border: 0; text-align:center">Voltar</a>
              <input type="submit" name="addToCart" value="Adicionar Pedido" class="book-a-table-btn" style="border: 0; text-align:center" />
            </div>
          </div>
        </div>
      </div>
    </div>
  </form>
</section>

<!-- ======= Footer ======= -->
<?php include "components/footer.html"; ?>
<!-- End Footer -->

<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
    class="bi bi-arrow-up-short"></i></a>

<!-- jQery -->
<script src="js/jquery-3.4.1.min.js"></script>
<!-- popper js -->
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
  integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<!-- bootstrap js -->
<script src="js/bootstrap.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
  integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<!-- owl slider -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
<!-- isotope js -->
<script src="https://unpkg.com/isotope-layout@3.0.4/dist/isotope.pkgd.min.js"></script>
<!-- nice select -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/js/jquery.nice-select.min.js"></script>
<!-- custom js -->
<script src="js/fastorder.js"></script>
<script src="js/custom.js"></script>
<!-- End Google Map -->

</body>

</html>