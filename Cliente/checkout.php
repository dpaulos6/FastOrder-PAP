<?php 
    session_start();
    require 'mailer/PHPMailerAutoload.php';
    require 'mailer/class.phpmailer.php';

    include_once "../Admin/assets/php/categories.php";
    include_once "../Admin/assets/php/users.php";
    include_once "../Admin/assets/php/products.php";
    include_once "../Admin/assets/php/pedido.php";
    include_once "../Admin/assets/php/pedido_detalhes.php";
    include_once "php/cart.php"; 

    function randomPassword( $length = 8 ) {
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$&*()_-+;:,.?";
        $password = substr( str_shuffle( $chars ), 0, $length );
        return $password;
    }

    $precoTotal = 0;
    $userFound = false;

    //Cart
    $cart = new Cart();
    $cartList = $cart->showCart();

    foreach($cartList as $cart){
        $precoTotal = $precoTotal + ($cart["Preco"]*$cart["Quantidade"]);
    }

    if(isset($_POST["finalizarPedido"])){
        $NomeUtilizador = strtolower($_POST["fname"]) . strtolower($_POST["lname"]) . random_int(0000, 9999);
        $fname = $_POST["fname"];
        $lname = $_POST["lname"];
        $morada = $_POST["main_address"] . ", Lote: " . $_POST["optional_address"];
        $cidade = $_POST["city"];
        $postalCode = $_POST["postal_code"];
        $contribuinte = $_POST["contribuinte"];
        $phonenumber = $_POST["phonenumber"];
        $email = $_POST["email"];
        $password = randomPassword();
        $perfil = "Cliente";
        $notas = $_POST["notas"];
        
        $users = new User();
        $users->setNomeUtilizador(str_replace(' ','',$NomeUtilizador));
        $users->setNome($fname);
        $users->setApelido($lname);
        $users->setMorada($morada);
        $users->setCidade($cidade);
        $users->setCodigoPostal($postalCode);
        if(strlen($contribuinte > 0)){
            $users->setContribuinte($contribuinte);
        } else {
            $users->setContribuinte(0);
        }
        $users->setTelefone($phonenumber);
        $users->setEmail($email);
        $users->setPassword($password);
        $users->setPerfil($perfil);

        $userCount = $users->checkUser();
        while(count($userCount) > 0){
            $NomeUtilizador = strtolower($_POST["fname"]) . strtolower($_POST["lname"]) . random_int(0000, 9999);
            $users->setNomeUtilizador(str_replace(' ','',$NomeUtilizador));
        }

        $userCheck = $users->checkEmail();


        if(count($userCheck) <= 0){
            $fastorderemail = "fastorderepsm@gmail.com";
            $fastorderpass = "xtc6tw93";

            $mail = new PHPMailer();
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            //$mail->SMTPDebug = 2;  // debugging: 1 = errors and messages, 2 = messages only
            $mail->SMTPAuth = true;
            $mail->SMTPAutoTLS = false;
            $mail->SMTPSecure = 'tls';
            $mail->Username = $fastorderemail;
            $mail->Password = $fastorderpass;
            $mail->Port = 587;
            $mail->From = $fastorderemail;
            $mail->FromName = 'FastOrder';
            $mail->addAddress($email); //preencher com email inserido

            $assunto = "Registo automatico de utilizador";
            // Corpo do Email
            $mensagem = "Olá " . $fname . " " . $lname . ", <br>";
            $mensagem .= "Nome de utilizador: <b> " . $NomeUtilizador . "</b><br>";
            $mensagem .= "Password: <b> " . $password . " <br>";

            $mail->isHTML(true);

            $mail->Subject = $assunto;
            $mail->Body = nl2br($mensagem);
            $mail->AltBody = nl2br(strip_tags($mensagem));

            //envia com pass aleatoria
            //
            if (!$mail->send()) {
                echo 'Não foi possível enviar a mensagem.<br>';
                echo 'Erro: ' . $mail->ErrorInfo;
            }

            // $users->createUser();
        } else {
            $userFound = true;
        }

        $users->createUser();


        $users->setNomeUtilizador($NomeUtilizador);
        $findUser = $users->checkUser()[0];

        $dt = date_create()->format('Y-m-d');


        $pedido = new Pedido();
        $pedido->setIdUtilizador($findUser["idUtilizador"]);
        $pedido->setValorTotal($precoTotal);
        $pedido->setEstado("A preparar");
        $pedido->setTipo("Delivery");
        $pedido->setCreateDate($dt);

        $pedido->createPedido();

        $pedidoId = $pedido->getById()[0];

        $pedido_detalhes = new Pedido_Detalhes();
        foreach($cartList as $cart){
            $pedido_detalhes->setIdProduto($cart["idProduto"]);
            $pedido_detalhes->setQuantidade($cart["Quantidade"]);
            $pedido_detalhes->setPreco($cart["Preco"]);
            $pedido_detalhes->setIdPedido($pedidoId["idPedido"]);
            $pedido_detalhes->setTamanho($cart["Tamanho"]);
            $pedido_detalhes->setNotas($notas);

            $pedido_detalhes->createDetails();
        }
        $cart = new Cart();
        $cart->deleteSessionID(session_id());

        header("Location: index.php");
    }
?>

<!DOCTYPE html>
<html>

<head>
    <?php include_once "components/head-tag.html" ?>
    <title>FastOrder - CheckOut</title>
    <link rel="stylesheet" href="css/cartstyle.css">
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;900&display=swap" rel="stylesheet">
</head>

<body class="sub_page">
    <?php include_once "components/navbar.php" ?>

    <div id="preloder" class="preloader">
        <div class="loader"></div>
    </div>

    <!-- Checkout Section Begin -->
    <br><br><br>
    <section class="checkout spad">
        <form action="" method="post">
            <div class="container">
                <div class="checkout__form">
                    <?php if ($userFound == true) { ?>
                        <div class="alert alert-danger" role="alert">
                            O email inserido não existe ou já está em uso.
                        </div>
                    <?php } ?>
                    <h4>Detalhes de Pagamentos</h4>
                    <form action="#">
                        <div class="row">
                            <div class="col-lg-8 col-md-6">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="checkout__input">
                                            <p>Nome Próprio<span>*</span></p>
                                            <input type="text" name="fname" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="checkout__input">
                                            <p>Apelido<span>*</span></p>
                                            <input type="text" name="lname" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="checkout__input">
                                    <p>Morada<span>*</span></p>
                                    <input type="text" name="main_address" placeholder="Número ou nome do edifício e nome da rua"
                                        class="checkout__input__add" required>
                                    <input type="text" name="optional_address"
                                        placeholder="Apartamento, suite, código de acesso ao edifício (opcional)">
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="checkout__input">
                                            <p>Cidade<span>*</span></p>
                                            <input type="text" name="city" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="checkout__input">
                                            <p>Codigo Postal<span>*</span></p>
                                            <input type="text" name="postal_code" inputmode="numeric" pattern="^(?(^00000(|-0000))|(\d{5}(|-\d{4})))$" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="checkout__input">
                                            <p>Hora de Entrega<span>*</span></p>
                                            <input type="time" name="deliver_date" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="checkout__input">
                                            <p>Numero de Contribuinte<span style="font-size: 12.5px;margin-left: .5rem; opacity: 0.7;">Opcional</span></p>
                                            <input type="text" name="contribuinte">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="checkout__input">
                                            <p>Número de Telefone<span>*</span></p>
                                            <input type="tel" name="phonenumber" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="checkout__input">
                                    <p>Email<span>*</span></p>
                                    <input type="text" name="email" required>
                                </div>
                                <div class="checkout__input">
                                    <p>Notas Adicionais<span style="font-size: 12.5px;margin-left: .5rem; opacity: 0.7;">Opcional</span></p>
                                    <input type="text" name="notas"
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
                                        ?>
                                            <li>
                                                <?php echo $cart["Quantidade"] ?>x
                                                <?php echo $produtoSelect["NomeProduto"]; ?>
                                                <span><?php echo number_format($cart["Preco"]*$cart["Quantidade"], 2) ?>€</span>
                                            </li>
                                        <?php } ?>
                                    </ul>
                                    <div class="checkout__order__total">Total <span><?php echo number_format($precoTotal, 2); ?>€</span></div>
                                    <button type="submit" name="finalizarPedido" class="site-btn">Finalizar</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </form>
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