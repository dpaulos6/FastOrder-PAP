<?php 
    session_start();
    include_once "../Admin/assets/php/products.php";
    include_once "php/cart.php";

    $precoTotal = 0;

    //Cart
    $cart = new Cart();
    $cartList = $cart->showCart();
    $countCart = $cart->countCart()[0]["nrProdutos"];

    if(isset($_POST["refreshCart"])){
        $num = 0;
        foreach($cartList as $cart){
            $idPedidoTemp = $_POST["idPedidoTemp"][$num];
            $Quantidade = $_POST["quantity"][$num];

            $cart = new Cart();
            $cart->setIdPedidoTemp($idPedidoTemp);
            $cart->setQuantidade($Quantidade);

            $cart->editCart();

            $num = $num + 1;
        }
        header("Refresh:0");
    }

    if(isset($_POST["gotoCheckout"])){
        $num = 0;
        foreach($cartList as $cart){
            $idPedidoTemp = $_POST["idPedidoTemp"][$num];
            $Quantidade = $_POST["quantity"][$num];

            $cart = new Cart();
            $cart->setIdPedidoTemp($idPedidoTemp);
            $cart->setQuantidade($Quantidade);

            $cart->editCart();

            $num = $num + 1;
        }
        header("location: checkout.php");
    }


    if (isset($_POST["clearCart"])){
        $cart->clearCart();
        header("location: cart.php");
    }


    if (isset($_GET["cartDelete"])){
        $cart->cartDelete($_GET["cartDelete"]);
        header("location: cart.php");
    }
?>

<!DOCTYPE html>
<html>

<head>
    <?php include_once "components/head-tag.html" ?>
    <title>FastOrder - Carrinho</title>
    <link rel="stylesheet" href="css/cartstyle.css">
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/preloader.scss">
</head>


<body class="sub_page">
    <?php include_once "components/navbar.php" ?>

    <div id="preloder" class="preloader">
        <div class="loader"></div>
    </div>

    <div class="position-fixed top-0 end-0 p-3" style="z-index: 999">
        <div id="cartRefesh" class="toast align-items-center text-white bg-sucess border-0 fade" role="alert"
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

    <br><br><br><br>

    <!-- Shoping Cart Section Begin -->
    <section class="shoping-cart spad">
        <form action="" method="post">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <br>
                        <h2 class="text-center">Confirmar Pedido</h2>
                        <br><br><br>
                        <a href="index.php" class="secondary-btn" style="border: 0;">Voltar</a>
                        <div class="shoping__cart__table">
                            <table>
                                <thead>
                                    <tr>
                                        <th>Produtos</th>
                                        <th>Quantidade</th>
                                        <th>Preço</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if($countCart == 0) {  ?>
                                    <tr>
                                        <td class="shoping__cart__item" colspan="4">
                                            <img src="img/cart/cart-1.jpg" alt="">
                                            <h5>O carrinho está vazio! Adicione produtos <a href="index.php"
                                                    class="custom-text-link">aqui</a>.</h5>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                    <?php foreach($cartList as $cart) { 
                                        $produto = new Product();
                                        $produto->setIdProduto($cart["idProduto"]);
                                        $produtoSelect = $produto->getById()[0];

                                        $precoTotal = $precoTotal + ($cart["Preco"]*$cart["Quantidade"]);
                                    ?>
                                    <tr>
                                        <td class="shoping__cart__item">
                                            <img src="../FastOrder_Produtos/<?php echo $produtoSelect["Imagem"]; ?>"
                                                width="100">
                                            <h5><?php echo $produtoSelect["NomeProduto"]; ?></h5>
                                            <span class="pizza-size">
                                                <?php echo $cart["Tamanho"] ?>
                                            </span>
                                        </td>
                                        <td class="shoping__cart__quantity">
                                            <div class="quantity">
                                                <input type="number" name="quantity[]"
                                                    value="<?php echo $cart["Quantidade"]; ?>" min="1" max="99">
                                            </div>
                                        </td>
                                        <td class="shoping__cart__price">
                                            <?php 
                                                echo number_format($cart["Preco"]*$cart["Quantidade"], 2);
                                            ?>€
                                        </td>
                                        <td class="shoping__cart__item__close text-center">
                                            <a href="cart.php?cartDelete=<?php echo $cart["idPedidoTemp"];?>"
                                                class="remove-from-cart-btn">
                                                <i class="bi bi-x-lg"></i>
                                            </a>
                                        </td>
                                        <input type="hidden" name="idPedidoTemp[]"
                                            value="<?php echo $cart["idPedidoTemp"];?>">
                                    </tr>
                                    <?php } ?>

                                    <tr>
                                        <td class="shoping__cart__item">
                                            <img src="img/cart/cart-3.jpg" alt="">
                                            <h5><b>Total</b></h5>
                                        </td>
                                        <td class="shoping__cart__price">
                                        </td>
                                        <td class="shoping__cart__total">
                                            <?php echo number_format($precoTotal, 2); ?>€
                                        </td>
                                        <td class="shoping__cart__item__close text-center">
                                            <button type="button" class="remove-from-cart-btn" title="Limpar carrinho"
                                                data-bs-toggle="modal" data-bs-target="#clearCartModal">
                                                <i class="bi bi-trash3"></i>
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <?php if($countCart != 0) { ?>
                    <div class="row">
                        <div class="col-lg-2"></div>
                        <div class="col-lg-4 col-md-6">
                            <div class="">
                                <button type="submit" name="refreshCart" class="primary-btn" style="width: 100%;border: 0;">
                                    Atualizar carrinho
                                </button>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="">
                                <button type="submit" name="gotoCheckout" class="primary-btn"style="width: 100%;border: 0;">
                                    Continuar para o pagamento
                                </button>
                            </div>
                        </div>
                    </div>
                <?php } else { echo "<br>"; } ?>
            </div>
        </form>

    </section>
    <!-- Shoping Cart Section End -->

    <div id="clearCartModal" class="modal fade" style="overflow-y: hidden;">
        <div class="modal-dialog modal-dialog-centered modal-confirm">
            <div class="modal-content">
                <div class="modal-header flex-column text-center" style="border: 0;">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="icon-box" style="font-size: 250%; margin: auto; color: rgb(220, 53, 69);">
                        <i class="bi bi-exclamation-triangle-fill"></i>
                    </div>
                    <h4 class="modal-title w-100">Atenção!</h4>
                </div>
                <div class="modal-body text-center">
                    <p style="font-size: 20px ;overflow-wrap: break-word !important;">
                        Tem a certeza que deseja limpar o carrinho? <br>
                        Este ação não pode ser desfeita!
                    </p>
                </div>
                <div class="modal-footer justify-content-center" style="border: 0;">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <form action="" method="post">
                        <button type="submit" name="clearCart" class="btn btn-danger">Confirmar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

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
    <!-- isotope js -->
    <script src="https://unpkg.com/isotope-layout@3.0.4/dist/isotope.pkgd.min.js"></script>
    <!-- custom js -->
    <script src="js/fastorder.js"></script>
    <script src="js/custom.js"></script>
    <script src="js/login.js"></script>


</body>

</html>