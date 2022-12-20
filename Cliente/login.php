<?php 
  include_once "../Admin/assets/php/users.php";
  $loginError = false;
  $passrecup = false;

  $pageWasRefreshed = isset($_SERVER['HTTP_CACHE_CONTROL']) && $_SERVER['HTTP_CACHE_CONTROL'] === 'max-age=0';
  if($pageWasRefreshed){
    if (strpos($_SERVER['REQUEST_URI'], "passrecup") !== false){
      header("location: login.php");
    }
  }

  session_start();

  if(isset($_GET["passrecup"])){
    $passrecup = true;
  }

  if (isset($_POST["submit"])){
    $NomeUtilizador = $_POST["username"];
    $Password = $_POST["password"];

    $user = new User();
    $user->setNomeUtilizador($NomeUtilizador);
    $user->setPassword($Password);

    $login = $user->verificaLogin();

    if ($login == true){
      $_SESSION['login_cliente'] = true;
      //$_SESSION['profile'] = $login[0]["Perfil"];
      
      header('Location: index.php');
    } else {
      $loginError = true;
    }
  }
?>

<!DOCTYPE html>
<html>

<head>
  <?php include_once "components/head-tag.html" ?>
  <title>FastOrder - Entrar</title>
</head>

<body class="sub_page">
  <?php include_once "components/navbar.php" ?>

  <div id="preloder" class="preloader">
    <div class="loader"></div>
  </div>

  <br><br><br><br>

  <!-- login section -->
  <section class="ftco-section">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-7 col-lg-6">
					<div class="wrap">
						<div class="img" style="background-image: url(images/bg-1.jpg);" hidden></div>
						<div class="login-wrap p-4 p-md-5">
              <a href="index.php" class="return-link w-100">
                <i class="fas fa-chevron-left" style="font-size: 20px;"></i>
              </a>
              <div class="d-flex">
                <div class="w-100">
                  <h3 class="mb-4 text-center">Entrar</h3>
                </div>
								<div class="w-100" hidden>
									<p class="social-media d-flex justify-content-end">
										<a href="#" class="social-icon d-flex align-items-center justify-content-center"><span class="fa fa-facebook"></span></a>
										<a href="#" class="social-icon d-flex align-items-center justify-content-center"><span class="fa fa-twitter"></span></a>
									</p>
								</div>
              </div>
              <?php if ($loginError == true) { ?>
                <div class="alert alert-danger" role="alert">
                  O utilizador ou palavra-passe estão incorretos!
                </div>
              <?php } if ($passrecup == true) { ?>
                <div class="alert alert-success" role="alert">
                  Email enviado com sucesso!
                </div>
              <?php } ?>
              <form action="#" class="signin-form" method="POST">
                <div class="form-group mt-3">
                  <input name="username" type="text" class="form-control" required>
                  <label class="form-control-placeholder" for="username">Nome de utilizador</label>
                </div>
                <div class="form-group">
                  <input name="password" id="password-field" type="password" class="form-control" required>
                  <label class="form-control-placeholder" for="password">Palavra-passe</label>
                  <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                </div>
                <div class="form-group">
                  <input name="submit" type="submit" value="Entrar" class="form-control btn btn-primary rounded submit px-3">
                </div>
                <div class="form-group d-md-flex">
                  <div class="w-50 text-left" hidden>
                    <label class="checkbox-wrap checkbox-primary mb-0">Recordar
                    <input type="checkbox">
                    <span class="checkmark"></span>
										</label>
									</div>
                  <!-- <div class="w-50 text-md-right"></div> -->
									<div class="w-100">
										<a href="forgotpassword.php">Esqueceu a palavra-passe?</a>
									</div>
                </div>
              </form>
              <p class="text-center">Ainda não tem conta? <a href="register.php">Crie uma</a></p>
            </div>
          </div>
				</div>
			</div>
		</div>
	</section>

  <!-- ======= Footer ======= -->
  <?php include "components/footer.html"; ?>
  <!-- End Footer -->
  
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
  

  <!-- jQery -->
  <script src="js/jquery-3.4.1.min.js"></script>
  <!-- popper js -->
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <!-- bootstrap js -->
  <script src="js/bootstrap.js"></script>
  <script src="js/login.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
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