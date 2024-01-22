<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Pages / Register - NiceAdmin Bootstrap Template</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: NiceAdmin
  * Updated: Sep 18 2023 with Bootstrap v5.3.2
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <main>
    <div class="container">

      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

              <div class="d-flex justify-content-center py-4">
                <a href="index.html" class="logo d-flex align-items-center w-auto">
                  <img src="assets/img/logo.png" alt="">
                  <span class="d-none d-lg-block">Esign Pro</span>
                </a>
              </div><!-- End Logo -->

              <div class="card mb-3">

                <div class="card-body">

                  <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4">Create an Account</h5>
                    <p class="text-center small">Enter your personal details to create account</p>
                  </div>
                
                  @if(Session::has('message'))
                    <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
                  @endif
                  <form class="row g-3 needs-validation" id="myform" method="post" action="{{route('save_company')}}" novalidate>
                    @csrf
                    <div class="col-12">
                      <label for="txt_name" class="form-label">Your Name</label>
                      <div id='myform_txt_name_errorloc' class="error_strings"></div>
                      <input type="text" name="txt_name" class="form-control" id="txt_name" required>
                      <div class="invalid-feedback">Please, enter your name!</div>
                    </div>

                    <div class="col-12">
                      <label for="txt_email" class="form-label">Your Email</label>
                      <div id='myform_txt_email_errorloc' class="error_strings"></div>
                      <input type="email" name="txt_email" class="form-control" id="txt_email" required>
                      <div class="invalid-feedback">Please enter a valid Email adddress!</div>
                    </div>

                    <div class="col-12">
                      <label for="txt_password" class="form-label">Password</label>
                      <div id='myform_txt_password_errorloc' class="error_strings"></div>
                      <input type="password" name="txt_password" class="form-control" id="txt_password" required>
                      <div class="invalid-feedback">Please enter your password!</div>
                      <!-- Password Script -->
                      <div id="popover-password">
                            <p><span id="result"></span></p>
                            <div class="progress">
                                <div id="password-strength" 
                                    class="progress-bar" 
                                    role="progressbar" 
                                    aria-valuenow="40" 
                                    aria-valuemin="0" 
                                    aria-valuemax="100" 
                                    style="width:0%">
                                </div>
                            </div>
                            <ul class="list-unstyled">
                                <li class="">
                                    <span class="low-upper-case">
                                        <i class="fas fa-circle" aria-hidden="true"></i>
                                        &nbsp;Lowercase &amp; Uppercase
                                    </span>
                                </li>
                                <li class="">
                                    <span class="one-number">
                                        <i class="fas fa-circle" aria-hidden="true"></i>
                                        &nbsp;Number (0-9)
                                    </span> 
                                </li>
                                <li class="">
                                    <span class="one-special-char">
                                        <i class="fas fa-circle" aria-hidden="true"></i>
                                        &nbsp;Special Character (!@#$%^&*)
                                    </span>
                                </li>
                                <li class="">
                                    <span class="eight-character">
                                        <i class="fas fa-circle" aria-hidden="true"></i>
                                        &nbsp;Atleast 8 Character
                                    </span>
                                </li>
                            </ul>
                      </div>
                      <!-- Password Script -->
                    </div>

                    <div class="col-12">
                      <div class="form-check">
                        <input class="form-check-input" name="terms" type="checkbox" value="" id="acceptTerms" required>
                        <label class="form-check-label" for="acceptTerms">I agree and accept the <a href="#">terms and conditions</a></label>
                        <div class="invalid-feedback">You must agree before submitting.</div>
                      </div>
                    </div>
                    <div class="col-12">
                      <button class="btn btn-primary w-100" id="btn_submit" type="submit" disabled>Create Account</button>
                    </div>
                    <div class="col-12">
                      <p class="small mb-0">Already have an account? <a href="/login">Log in</a></p>
                    </div>
                  </form>

                </div>
              </div>

              <!--<div class="credits">
                Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
              </div>-->

            </div>
          </div>
        </div>

      </section>

    </div>
  </main><!-- End #main -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/chart.js/chart.umd.js"></script>
  <script src="assets/vendor/echarts/echarts.min.js"></script>
  <script src="assets/vendor/quill/quill.min.js"></script>
  <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>

<script src="gen_validatorv4.js" type="text/javascript"></script>
<script type="text/javascript">
    frmvalidator.EnableOnPageErrorDisplay();
    frmvalidator.EnableMsgsTogether();

    frmvalidator.addValidation("txt_name","req","Please enter your Name");
    frmvalidator.addValidation("txt_email","req","Please enter your Email");
    //frmvalidator.addValidation("txt_name","req","Please enter your Name");

    
    
</script>


<!-- Password Script -->
<script src="https://kit.fontawesome.com/1c2c2462bf.js" crossorigin="anonymous"></script>
<style type="text/css">
  /*
  @import url("https://fonts.googleapis.com/css2?family=PT+Sans:ital,wght@0,400;0,700;1,400;1,700&display=swap");
body {
  font-family: "PT Sans", sans-serif;
}

.container {
  background-color: #2bd5e9;
}
*/
h1 {
  margin: 15px 0 25px;
  text-align: center;
  font-size: 30px;
}

input {
  color: #022255 !important;
}

input[type=email]:focus,
input[type=password]:focus,
input[type=text]:focus {
  box-shadow: 0 0 5px rgba(246, 8, 110, 0.8);
  border: 1px solid rgba(246, 8, 110, 0.8);
}

.container {
  width: 100%;
  height: 100vh;
  display: flex;
  justify-content: center;
  align-items: center;
}

.form-horizontal {
  width: 320px;
  background-color: #ffffff;
  padding: 25px 38px;
  border-radius: 12px;
  box-shadow: 2px 2px 15px rgba(0, 0, 0, 0.5);
}

.control-label {
  text-align: left !important;
  padding-bottom: 4px;
}

.progress {
  height: 3px !important;
}

.form-group {
  margin-bottom: 10px;
}

.show-pass {
  position: absolute;
  top: 5%;
  right: 8%;
}

.progress-bar-danger {
  background-color: #e90f10;
}

.progress-bar-warning {
  background-color: #ffad00;
}

.progress-bar-success {
  background-color: #02b502;
}

.login-btn {
  width: 180px !important;
  background-image: linear-gradient(to right, #f6086e, #ff133a) !important;
  font-size: 18px;
  color: #fff;
  margin: 0 auto 5px;
  padding: 8px 0;
}

.login-btn:hover {
  background-image: linear-gradient(to right, rgba(255, 0, 111, 0.8), rgba(247, 2, 43, 0.8)) !important;
  color: #fff !important;
}

.fa-eye {
  color: #022255;
  cursor: pointer;
}

.ex-account p a {
  color: #f6086e;
  text-decoration: underline;
}

.fa-circle {
  font-size: 6px;
}

.fa-check {
  color: #02b502;
}
</style>
<script type="text/javascript">
  let state = false;
  let password = document.getElementById("txt_password");
  let passwordStrength = document.getElementById("password-strength");
  let lowUpperCase = document.querySelector(".low-upper-case i");
  let number = document.querySelector(".one-number i");
  let specialChar = document.querySelector(".one-special-char i");
  let eightChar = document.querySelector(".eight-character i");

  password.addEventListener("keyup", function(){
      let pass = document.getElementById("txt_password").value;
      checkStrength(pass);
  });

  function toggle(){
      if(state){
          document.getElementById("txt_password").setAttribute("type","password");
          state = false;
      }else{
          document.getElementById("txt_password").setAttribute("type","text")
          state = true;
      }
  }

  function myFunction(show){
      show.classList.toggle("fa-eye-slash");
  }

  function checkStrength(password) {
      let strength = 0;

      //If password contains both lower and uppercase characters
      if (password.match(/([a-z].*[A-Z])|([A-Z].*[a-z])/)) {
          strength += 1;
          lowUpperCase.classList.remove('fa-circle');
          lowUpperCase.classList.add('fa-check');
      } else {
          lowUpperCase.classList.add('fa-circle');
          lowUpperCase.classList.remove('fa-check');
      }
      //If it has numbers and characters
      if (password.match(/([0-9])/)) {
          strength += 1;
          number.classList.remove('fa-circle');
          number.classList.add('fa-check');
      } else {
          number.classList.add('fa-circle');
          number.classList.remove('fa-check');
      }
      //If it has one special character
      if (password.match(/([!,%,&,@,#,$,^,*,?,_,~])/)) {
          strength += 1;
          specialChar.classList.remove('fa-circle');
          specialChar.classList.add('fa-check');
      } else {
          specialChar.classList.add('fa-circle');
          specialChar.classList.remove('fa-check');
      }
      //If password is greater than 7
      if (password.length > 7) {
          strength += 1;
          eightChar.classList.remove('fa-circle');
          eightChar.classList.add('fa-check');
      } else {
          eightChar.classList.add('fa-circle');
          eightChar.classList.remove('fa-check');   
      }

      // If value is less than 2
      if (strength < 2) {
          passwordStrength.classList.remove('progress-bar-warning');
          passwordStrength.classList.remove('progress-bar-success');
          passwordStrength.classList.add('progress-bar-danger');
          passwordStrength.style = 'width: 10%';
          document.getElementById('btn_submit').disabled=true;
      } else if (strength == 3) {
          passwordStrength.classList.remove('progress-bar-success');
          passwordStrength.classList.remove('progress-bar-danger');
          passwordStrength.classList.add('progress-bar-warning');
          passwordStrength.style = 'width: 60%';
          document.getElementById('btn_submit').disabled=true;
      } else if (strength == 4) {
          passwordStrength.classList.remove('progress-bar-warning');
          passwordStrength.classList.remove('progress-bar-danger');
          passwordStrength.classList.add('progress-bar-success');
          passwordStrength.style = 'width: 100%';
          document.getElementById('btn_submit').disabled=false;
      }
  }
</script>
<!-- Password Script -->
