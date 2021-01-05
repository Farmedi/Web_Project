<!DOCTYPE HTML>
<?php ob_start();?>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Sogo Hotel by Colorlib.com</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <meta name="author" content="" />
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=|Roboto+Sans:400,700|Playfair+Display:400,700">

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/animate.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/aos.css">
    <link rel="stylesheet" href="css/bootstrap-datepicker.css">
    <link rel="stylesheet" href="css/jquery.timepicker.css">
    <link rel="stylesheet" href="css/fancybox.min.css">

    <link rel="stylesheet" href="fonts/ionicons/css/ionicons.min.css">
    <link rel="stylesheet" href="fonts/fontawesome/css/font-awesome.min.css">

    <!-- Theme Style -->
    <link rel="stylesheet" href="css/style.css">
  </head>
  <body>
      <?php
      session_start();
      $email_id3 = $_SESSION["email_id"];
    ?>
       
      <?php
            $errors_edit="";
            $successful_edit="";
      ?>
       <?php
          $servername = "localhost";
          $username = "pma";
          $password = "";
          $dbname = "web_project";

          try {
          $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
          $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          $data1 = $conn->prepare("SELECT name,id,email,reg_date,phone_number FROM Person WHERE id = '$email_id3'");
          $data1->execute();
          $data1->setFetchMode(PDO::FETCH_ASSOC);

          } catch (PDOException $e) {
          echo "Error: " . $e->getMessage();
          }
          $conn = null;         
            
    ?>
    
      
   
    <?php
       while ($row = $data1->fetch()) {
            $name = $row['name'];
            $email = $row['email'];
            $id = $row['id'];
            $reg_date = $row['reg_date'];
            $phone_number = $row['phone_number'];
          }
  
    ?>
      <?php
           
             if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['edit_button'])) {
              $name_error = filter_input(INPUT_POST,"name_input");
              $phone_error = filter_input(INPUT_POST,"phone_input");
              $email_error = filter_input(INPUT_POST,"email_input");
                if (empty($email_error)) {
                    $errors_edit= $errors_edit . "* Email is required<br>";
                }
                if (!filter_var($email_error, FILTER_VALIDATE_EMAIL)) {
                    $errors_edit = $errors_edit . "* Invalid email format<br>";
                }

                if (empty($name_error)) {
                    $errors_edit= $errors_edit . "* Name is required<br>";
                }
                if (empty($phone_error)) {
                    $errors_edit= $errors_edit . "* Phone is required<br>";
                }
                if (strlen($phone_error) < 11 || strlen($phone_error) > 11 ) {
                    $errors_edit = $errors_edit . "* Phone number only can 11 number with 0<br>";      
                }
            }?>
      <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['edit_button'])  && strlen($errors_edit) == 0) {
          $servername = "localhost";
          $username = "pma";
          $password = "";
          $dbname = "web_project";

          try {
          $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
          $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          
          $sql = "UPDATE person SET name='$_POST[name_input]',phone_number='$_POST[phone_input]',email='$_POST[email_input]' WHERE id='$email_id3'";
          
          
          $conn->exec($sql);
          header("refresh:1; url=profile.php");
          $successful_edit = $successful_edit . "Successful Edit!";
          echo "<script>window.alert('Successful Edit!')</script>";
          
          } catch (PDOException $e) {
          echo "Error: " . $e->getMessage().'<br>';
          }
          $conn = null;
        }
        ?>

    <header class="site-header js-site-header">
      <div class="container-fluid">
        <div class="row align-items-center">
          <div class="col-6 col-lg-4 site-logo" data-aos="fade"><a href="homePage.php">SFDF Tourism</a></div>
          <div class="col-6 col-lg-8">


            <div class="site-menu-toggle js-site-menu-toggle"  data-aos="fade">
              <span></span>
              <span></span>
              <span></span>
            </div>
            <!-- END menu-toggle -->

            <div class="site-navbar js-site-navbar">
              <nav role="navigation">
                <div class="container">
                  <div class="row full-height align-items-center">
                    <div class="col-md-6 mx-auto">
                      <ul class="list-unstyled menu">
                        <li><a href="homePage.php">Home</a></li>
                        <li class="active"><a href="profile.php">Profile</a></li>
                        <li><a href="reservations.php">Reservation</a></li>
                      </ul>
                    </div>
                  </div>
                </div>
              </nav>
            </div>
          </div>
        </div>
      </div>
    </header>
    <!-- END head -->

    <section class="site-hero inner-page overlay" style="background-image: url(images/hero_4.jpg)" data-stellar-background-ratio="0.5">
      <div class="container">
        <div class="row site-hero-inner justify-content-center align-items-center">
          <div class="col-md-10 text-center" data-aos="fade">
            <h1 class="heading mb-3">Profile</h1>
            <ul class="custom-breadcrumbs mb-4">
              <li><a href="homePage.php">Home</a></li>
              <li>&bullet;</li>
            <li>Profile</li>
            </ul>
          </div>
        </div>
      </div>

      <a class="mouse smoothscroll" href="#next">
        <div class="mouse-icon">
          <span class="mouse-wheel"></span>
        </div>
      </a>
    </section>
    <!-- END section -->

    <section class="section Profile-section" id="next">
      <div class="container">
        <div class="row">
          <div class="col-md-7" data-aos="fade-up" data-aos-delay="100">

            <form action="#" method="post" class="bg-white p-md-5 p-4 mb-5 border">
              <div class="row">
                <div class="col-md-6 form-group">
                  <label for="name_input">Name</label>
                  <input type="text" name="name_input" class="form-control "<?php echo " value='" .$name ."' ";?>>
                </div>
                <div class="col-md-6 form-group">
                  <label for="phone_input">Phone</label>
                  <input type="text" name="phone_input" class="form-control " <?php echo " value='" .$phone_number ."' ";?>>
                </div>
              </div>

              <div class="row">
                <div class="col-md-12 form-group">
                  <label for="email_input">Email</label>
                  <input type="email" name="email_input" class="form-control " <?php echo " value='" .$email ."' ";?>>
                </div>
              </div>
              <div class="row mb-4">
                <div class="col-md-12 form-group">
                    <label for="reg_date" >Registration Time</label><br>
                 <input type="label" name="reg_date" class="form-control " <?php echo " value='" .$reg_date ."' ";?>></input>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6 form-group">
                  <input type="submit" value="Edit" name="edit_button" class="btn btn-primary text-white font-weight-bold">
                </div>
              </div>
                <div class="row">
                <div class="col-md-6 form-group">
                  <input type="submit" value="Delete Profile" name="delete_button" class="btn btn-primary text-white font-weight-bold">
                </div>
              </div>
                <div class="hr"></div>
                                    <div class="foot-lnk">
                                        <span style='color:  red;'><?php echo $errors_edit; ?></span>
                                    </div>
            </form>
            
          </div>
        </div>
      </div>
    </section>
  
 
<?php
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_button'])) {
          $servername = "localhost";
          $username = "pma";
          $password = "";
          $dbname = "web_project";
          try {
          $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
          $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          $sql = "DELETE FROM person WHERE id='$email_id3'";
          $conn->exec($sql);
          echo "<br>";
          header("refresh:1; url=index.php");
          
          } catch (PDOException $e) {
          echo "Error: " . $e->getMessage().'<br>';
          }
          $conn = null;
        }
        ?>


   <section class="section bg-image overlay" style="background-image: url('images/hero_4.jpg');">
        <div class="container" >
          <div class="row align-items-center">
            <div class="col-12 col-md-6 text-center mb-4 mb-md-0 text-md-left" data-aos="fade-up">
              <h2 class="text-white font-weight-bold">A Best Place To Stay. Reserve Now!</h2>
            </div>
          </div>
        </div>
      </section>

    <footer class="section footer-section">
      <div class="container">
        <div class="row pt-5">
          <p class="col-md-6 text-left">
            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
            Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="icon-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank" >Colorlib</a>
            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
          </p>

          <p class="col-md-6 text-right social">
            <a href="#"><span class="fa fa-tripadvisor"></span></a>
            <a href="#"><span class="fa fa-facebook"></span></a>
            <a href="#"><span class="fa fa-twitter"></span></a>
            <a href="#"><span class="fa fa-linkedin"></span></a>
            <a href="#"><span class="fa fa-vimeo"></span></a>
          </p>
        </div>
      </div>
    </footer>

    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/jquery-migrate-3.0.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/jquery.stellar.min.js"></script>
    <script src="js/jquery.fancybox.min.js"></script>


    <script src="js/aos.js"></script>

    <script src="js/bootstrap-datepicker.js"></script>
    <script src="js/jquery.timepicker.min.js"></script>



    <script src="js/main.js"></script>
  </body>
</html>
 <?php ob_flush(); ?> 