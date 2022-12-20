<?php 
    session_start();

    include_once "../Admin/assets/php/products.php";
    include_once "php/cart.php";

    $precoTotal = 0;

    //Cart
    $cart = new Cart();
    $cartList = $cart->showCart();
?>

<!DOCTYPE html>
<html>

<head>
    <?php include_once "components/head-tag.html" ?>
    <title>FastOrder - CheckOut</title>
    <link rel="stylesheet" href="css/cartstyle.css">
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;900&display=swap" rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="css/nice-select.css" type="text/css">
    <link rel="stylesheet" href="css/jquery-ui.min.css" type="text/css">
    <link rel="stylesheet" href="css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="css/slicknav.min.css" type="text/css">
</head>

<body class="sub_page">
    <?php include_once "components/navbar.php" ?>

    <div id="preloder" class="preloader">
        <div class="loader"></div>
    </div>

    <!-- Checkout Section Begin -->
    <br><br><br>
    <section class="checkout spad">
        <div class="container">
            <div class="checkout__form">
                <h4>Billing Details</h4>
                <form action="#">
                    <div class="row">
                        <div class="col-lg-8 col-md-6">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Nome Próprio<span>*</span></p>
                                        <input type="text">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Apelido<span>*</span></p>
                                        <input type="text">
                                    </div>
                                </div>
                            </div>
                            <div class="checkout__input">
                                <p>Morada<span>*</span></p>
                                <input type="text" placeholder="Número ou nome do edifício e nome da rua"
                                    class="checkout__input__add">
                                <input type="text"
                                    placeholder="Apartamento, suite, código de acesso ao edifício (opcional)">
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Cidade<span>*</span></p>
                                        <input type="text">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Codigo Postal<span>*</span></p>
                                        <input type="text">
                                    </div>
                                </div>
                            </div>
                            <div class="checkout__input">
                                <p>Numero de Contribuinte<span></span></p>
                                <input type="text">
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Número de Telefone<span>*</span></p>
                                        <input type="text">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Email<span></span></p>
                                        <input type="text">
                                    </div>
                                </div>
                            </div>
                            <div class="checkout__input">
                                <p>Notas Adicionais<span></span></p>
                                <input type="text"
                                    placeholder="Notas sobre o seu pedido, por ex. notas especiais para entrega.">
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="checkout__order">
                                <h4>O seu Pedido</h4>
                                <div class="checkout__order__products">Produtos <span>Preço</span></div>
                                <ul>
                                    <?php foreach($cartList as $cart){ 
                                        $produto = new Product();
                                        $produto->setIdProduto($cart["idProduto"]);
                                        $produtoSelect = $produto->getById()[0]; 
                                        
                                        $precoTotal = $precoTotal + $produtoSelect["Preco"];
                                    ?>
                                        <li><?php echo $produtoSelect["NomeProduto"]; ?><span><?php echo $produtoSelect["Preco"] ?>€</span>
                                        </li>
                                    <?php } ?>
                                </ul>
                                <div class="checkout__order__total">Total <span><?php echo number_format($precoTotal, 2); ?>€</span></div>
                                <button type="submit" class="site-btn">Adicionar Pedido</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <!-- Checkout Section End -->

    <!-- ======= Footer ======= -->
    <?php include "components/footer.html"; ?>
    <!-- ===== End Footer ===== -->

    <!-- Js Plugins -->
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.nice-select.min.js"></script>
    <script src="js/jquery-ui.min.js"></script>
    <script src="js/jquery.slicknav.js"></script>
    <script src="js/mixitup.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/main.js"></script>


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