<?php
  include_once "../Admin/assets/php/users.php";
  $userError = false;
  $userLenght = false;
  $emailError = false;
  $passwordError = false;
  $passwordLength = false;

  $userCheck = true;

  if (isset($_POST["submit"])){
    $NomeUtilizador = $_POST["username"];
    if(preg_match("/[^a-z0-9A-Z._]+/", $NomeUtilizador)){
      $userError = true;
    } else if(strlen($NomeUtilizador) > 0) {
      $userError = false;
    } else if (strlen($NomeUtilizador) < 3 || strlen($NomeUtilizador) > 24){
      $userLenght = true;
    } else {
      $userError = true;
    }

    $Email = $_POST["email"];
    if(preg_match("/[^a-z0-9A-Z@._]+/", $Email)){
      $emailError = true;
    } else if (strlen($Email) > 0){
      $emailError = false;
    } else {
      $emailError = true;
    }

    $Password = $_POST["password"];
    if(preg_match("/[^a-z0-9A-Z._]+/", $Password)){
      $passwordError = true;
    } else if(strlen($Password) > 0) {
      $passwordError = false;
    } else if (strlen($Password) < 8 || strlen($Password) > 32){
      $passwordLength = true;
    } else {
      $passwordError = true;
    }

    $Perfil = "Cliente";

    $user = new User();
    $user->setNomeUtilizador($NomeUtilizador);
    $user->setEmail($Email);
    $user->setPassword($Password);
    $user->setPerfil($Perfil);

    if ($userError == false && $emailError == false && $passwordError == false && $userLenght == false && $passwordLength == false) {
      $userCheck = true;
    } else {
      $userCheck = false;
    }

    var_dump($userError);
    echo "<br>";
    var_dump($userLenght);
    echo "<br>";
    var_dump($emailError);
    echo "<br>";
    var_dump($passwordError);
    echo "<br>";
    var_dump($passwordLength);
    echo "<br>";

    if ($userCheck == true) {
      $user->createUser();

      header("location: login.php");
    }
  }

?>

<!DOCTYPE html>
<html>

<head>
  <?php include_once "components/head-tag.html" ?>
  <title>FastOrder - Criar Conta</title>
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
                  <h3 class="mb-4 text-center">Criar conta</h3>
                </div>
								<div class="w-100" hidden>
									<p class="social-media d-flex justify-content-end">
										<a href="#" class="social-icon d-flex align-items-center justify-content-center"><span class="fa fa-facebook"></span></a>
										<a href="#" class="social-icon d-flex align-items-center justify-content-center"><span class="fa fa-twitter"></span></a>
									</p>
								</div>
              </div>
              <form class="signin-form" method="POST">
                <div class="form-group mt-3">
                  <input name="username" type="text" class="form-control" required>
                  <label class="form-control-placeholder" for="username">Nome de utilizador</label>
                </div>
                <div class="form-group mt-3">
                  <input name="fname" type="text" class="form-control" required>
                  <label class="form-control-placeholder" for="fname">Nome</label>
                </div>
                <div class="form-group mt-3">
                  <input name="lname" type="text" class="form-control" required>
                  <label class="form-control-placeholder" for="lname">Apelido</label>
                </div>
                <div class="form-group">
                  <input name="email" type="text" class="form-control" required>
                  <label class="form-control-placeholder" for="email">Email</label>
                </div>
                <div class="form-group">
                  <input name="password" id="password-field" type="password" class="form-control" required>
                  <label class="form-control-placeholder" for="password">Palavra-passe</label>
                  <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                </div>
                <div class="form-group">
                  <input name="submit" type="submit" value="Criar conta" class="form-control btn btn-primary rounded submit px-3">
                </div>
              </form>
              <p class="text-center">Já tem conta? <a href="login.php">Entrar</a></p>
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
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  <!-- owl slider -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
  <!-- isotope js -->
  <script src="https://unpkg.com/isotope-layout@3.0.4/dist/isotope.pkgd.min.js"></script>
  <!-- nice select -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/js/jquery.nice-select.min.js"></script>
  <!-- custom js -->
  <script src="js/fastorder.js"></script>
  <script src="js/login.js"></script>
  <script src="js/custom.js"></script>
  <!-- End Google Map -->

</body>

</html>