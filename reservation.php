<!DOCTYPE HTML>
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
      $user_id = $_SESSION["user_id"];
       ?> 
    
      <?php
        $hotelID=$_GET['hot_id'];  
        $servername = "localhost";
        $username = "pma";
        $password = "";
        $dbname = "web_project";

        try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $data1 = $conn->prepare("SELECT hotel_name FROM hotels WHERE id = '$hotelID'");
        $data1->execute();
        $data1->setFetchMode(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        }
                   
            
    ?>
    
     
    <?php
       while ($row = $data1->fetch()) {
            $hotel_name = $row['hotel_name'];
        }
        $conn = null;
  
    ?>
      
      <?php
        $errors_reserve="";
        $successful_reserve="";
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['Reserve'])) {
         $name_error = filter_input(INPUT_POST,"name");
         $phone_error = filter_input(INPUT_POST,"phone");
         $email_error = filter_input(INPUT_POST,"email");
         $datecheckOut_error = filter_input(INPUT_POST,"checkout_date");
         $datecheckIn_error = filter_input(INPUT_POST,"checkin_date");
           if (empty($email_error)) {
               $errors_reserve= $errors_reserve . "* Email is required<br>";
           }      
           if (empty($name_error)) {
               $errors_reserve= $errors_reserve . "* Name is required<br>";
           }
           if (empty($phone_error)) {
               $errors_reserve= $errors_reserve . "* Phone is required<br>";
           }
           if (empty($datecheckIn_error)) {
               $errors_reserve= $errors_reserve . "* Check-in date is required<br>";
           }
           if (empty($datecheckOut_error)) {
               $errors_reserve= $errors_reserve . "* Check-out date is required<br>";
           }
           if (strlen($phone_error) < 11 || strlen($phone_error) > 11 ) {
               $errors_reserve = $errors_reserve . "* Phone number only can 11 number with 0<br>";      
           }
       }?>
    <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['Reserve']) && strlen($errors_reserve)==0){
        
            $fn = $_POST["name"];
            $ph = $_POST["phone"];
            $em = $_POST["email"];
            $cıd = $_POST["checkin_date"];
            $cod = $_POST["checkout_date"];
            $ad = $_POST["adults"];
            $ch = $_POST["children"];
            $msg = $_POST["message"];          

  
        $servername = "localhost";
        $username = "pma";
        $password = "";
        $dbname = "web_project";
        try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO Reservations (FirstName, Phone,Email,CheckInDate,CheckOutDate,Adults,Children,Messages,HotelID,UserID)
                    VALUES ('$fn', '$ph', '$em','$cıd','$cod','$ad','$ch','$msg','$hotelID','$user_id')";
            $conn->exec($sql);
            $successful_reserve = $successful_reserve ."Successful Reserve!";
        } catch (PDOException $e) {
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
                        <li><a href="profile.php">Profile</a></li>
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
            <?php echo '<h1 class="heading mb-3">' . $hotel_name .'</h1>';?>
            <ul class="custom-breadcrumbs mb-4">
              <li><a href="homePage.php">Home</a></li>
              <li>&bullet;</li>
              <li>Reservation</li>
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

    <section class="section contact-section" id="next">
      <div class="container">
        <div class="row">
          <div class="col-md-7" data-aos="fade-up" data-aos-delay="100">

            <form action="#" method="post" class="bg-white p-md-5 p-4 mb-5 border">
              <div class="row">
                <div class="col-md-6 form-group">
                  <label class="text-black font-weight-bold" for="name">Name</label>
                  <input type="text" name= "name" id="name" class="form-control" >
                </div>
                <div class="col-md-6 form-group">
                  <label class="text-black font-weight-bold" for="phone">Phone</label>
                  <input type="text" name="phone" id="phone" class="form-control ">
                </div>
              </div>

              <div class="row">
                <div class="col-md-12 form-group">
                  <label class="text-black font-weight-bold" for="email">Email</label>
                  <input type="email" name="email" id="email" class="form-control ">
                </div>
              </div>

              <div class="row">
                <div class="col-md-6 form-group">
                  <label class="text-black font-weight-bold" for="checkin_date">Date Check In</label>
                  <input type="text" name="checkin_date" id="checkin_date" class="form-control">
                </div>
                <div class="col-md-6 form-group">
                  <label class="text-black font-weight-bold" for="checkout_date">Date Check Out</label>
                  <input type="text" name="checkout_date" id="checkout_date" class="form-control">
                </div>
              </div>

              <div class="row">
                <div class="col-md-6 form-group">
                  <label for="adults" class="font-weight-bold text-black">Adults</label>
                  <div class="field-icon-wrap">
                    <div class="icon"><span class="ion-ios-arrow-down"></span></div>
                    <select  name="adults" id="adults" class="form-control">
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="4+">4+</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-6 form-group">
                  <label for="children" class="font-weight-bold text-black">Children</label>
                  <div class="field-icon-wrap">
                    <div class="icon"><span class="ion-ios-arrow-down"></span></div>
                    <select  name="children" id="children" class="form-control">
                      <option value="0">0</option>
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3+">3+</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="row mb-4">
                <div class="col-md-12 form-group">
                  <label class="text-black font-weight-bold" for="message">Notes</label>
                  <textarea name="message" id="message" class="form-control " cols="30" rows="8"></textarea>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6 form-group">
                    <a href="homePage.php">
                        <button type="submit" name ="Reserve" class="btn btn-primary text-white py-3 px-5 font-weight-bold">Reserve Now</button>
                    </a>
                </div>
              </div>
                <div class="foot-lnk">
                    <span style='color:  red;'><?php echo $errors_reserve; ?></span>
                    <span style='color:  green;'><?php if(strlen($errors_reserve) == 0){echo $successful_reserve;}?></span>
                </div>
            </form> 
          </div>
        </div>
      </div>
    </section>
    
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
