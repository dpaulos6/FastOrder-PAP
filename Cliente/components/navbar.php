<?php
  include_once "php/cart.php";

  $countCart = 0;

  $cart = new Cart();
  $cartList = $cart->showCart();

  foreach($cartList as $cart){
    $countCart = $countCart + $cart["Quantidade"];
  }

  // $countCart = $cart->countCart()[0]["nrProdutos"];
?>
<section id="topbar" class="d-flex align-items-center fixed-top topbar-transparent">
  <div class="container-fluid container-xl d-flex align-items-center justify-content-center justify-content-lg-start">
    <i class="bi bi-phone d-flex align-items-center"><span>912 712 197</span></i>
    <i class="bi bi-map ms-4 d-none d-lg-flex align-items-center"><span>Estrada Nacional 367, 334A Marinhais 2125-121</span></i>
  </div>
</section>

<!-- ======= Nav Bar ======= -->
<header id="header" class="fixed-top d-flex align-items-center header-transparent">
  <div class="container-fluid container-xl d-flex align-items-center justify-content-between">
    <div class="logo me-auto">
      <h3><a href="index.php">Pizzeria Toscana</a></h3>
    </div>
    <nav id="navbar" class="navbar order-last order-lg-0">
      <ul>
        <li class="cart-desktop">
          <a class="nav-link scrollto" href="cart.php">
            <i class="bi bi-cart" style="font-size: 18px; margin-right: 7.5px;"></i> 
            Carrinho <p class="cart-badge text-center m-0" <?php if($countCart == 0) { echo "hidden";} ?>><?php echo $countCart;?></p>
          </a>
        </li>
        <li class="cart-mobile">
          <a class="nav-link scrollto" href="cart.php">
            <i class="bi bi-cart" style="font-size: 18px;"></i>
          </a>
        </li>
      </ul>
    </nav>
    <?php if (!isset($_SESSION['login_cliente']) || $_SESSION['login_cliente'] != true) { ?>
      <a href="login.php" class="book-a-table-btn scrollto">Entrar</a>
    <?php } else { ?>
      <a href="php/logout.php" class="book-a-table-btn scrollto">Sair</a>
    <?php } ?>
  </div>
</header>