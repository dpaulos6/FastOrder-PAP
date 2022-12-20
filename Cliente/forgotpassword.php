<?php
  session_start();
  require 'mailer/PHPMailerAutoload.php';
  require 'mailer/class.phpmailer.php';

  include_once "../Admin/assets/php/users.php";
  $loginError = false;
  $notfound = false;

  function randomPassword() {
    $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
    $pass = array(); //remember to declare $pass as an array
    $alphaLength = strlen($alphabet); //put the length -1 in cache
    for ($i = 0; $i < 16; $i++) {
      $n = rand(8, $alphaLength);
      $pass[] = $alphabet[$n];
    }
    return implode($pass); //turn the array into a string
  }

  if (isset($_POST["submit"])){
    $email = $_POST["email"];

    $user = new User();
    $user->setEmail($email);
    $emailCheck = $user->checkEmail();

    if(count($emailCheck) > 0){
      $fastorderemail = "fastorderepsm@gmail.com";
      $fastorderpass = "xtc6tw93";

      $password = $emailCheck[0]["Password"];

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

      $assunto = "Recuperação da palavra-passe";
      // Corpo do Email
      $mensagem = "A sua palavra-passe: <b>" . $password . "</b><br>";

      $mail->isHTML(true);

      $mail->Subject = $assunto;
      $mail->Body = nl2br($mensagem);
      $mail->AltBody = nl2br(strip_tags($mensagem));

      //envia com pass aleatoria
      //
      if (!$mail->send()) {
        echo 'Não foi possível enviar a mensagem.<br>';
        echo 'Erro: ' . $mail->ErrorInfo;
      } else {
        header('Location: login.php?passrecup=true');
      }
    } else {
      $notfound = true;
    }
  }
?>

<!DOCTYPE html>
<html>

<head>
  <?php include_once "components/head-tag.html" ?>
  <title>FastOrder - Esqueceu Palavra-Passe</title>
</head>

<body class="sub_page">
  <?php include_once "components/navbar.php" ?>

  <div id="preloder" class="preloader">
    <div class="loader"></div>
  </div>

  <br><br><br><br><br><br>

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
                  <h3 class="mb-4 text-center">Repor Palavra-Passe</h3>
                </div>
								<div class="w-100" hidden>
									<p class="social-media d-flex justify-content-end">
										<a href="#" class="social-icon d-flex align-items-center justify-content-center"><span class="fa fa-facebook"></span></a>
										<a href="#" class="social-icon d-flex align-items-center justify-content-center"><span class="fa fa-twitter"></span></a>
									</p>
								</div>
              </div>
              <?php if ($notfound == true) { ?>
                  <div class="alert alert-danger" role="alert">
                    O email inserido não existe.
                  </div>
                <?php } ?>
              <form action="#" class="signin-form" method="POST">
                <div class="form-group mt-3">
                  <input name="email" type="email" class="form-control" required>
                  <label class="form-control-placeholder" for="email">Email</label>
                </div>
                <div class="form-group">
                  <input name="submit" type="submit" value="Enviar Email" class="form-control btn btn-primary rounded submit px-3">
                </div>
              </form>
              <p class="text-center">Ainda não tem conta? <a href="register.php">Crie uma</a></p>
            </div>
          </div>
				</div>
			</div>
		</div>
	</section>

  <br><br>

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