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
        $first_name = "";
        $hotel_name = "";
        $phone = "";
        $email = "";
        $check_in_date = "";
        $check_out_date = "";
        $adults = "";
        $children = "";
        $messages = "";
        $reg_date = "";
        $hotel_id = "";
        
       ?>
      
      <?php 
        session_start();
        $user_id = $_SESSION["user_id"];
        $servername = "localhost";
        $username = "pma";
        $password = "";
        $dbname = "web_project";

        try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $data1 = $conn->prepare("SELECT FirstName,Phone,Email,CheckInDate,CheckOutDate,Adults,Children,Messages,HotelID,reg_date FROM reservations WHERE UserID = '$user_id'");
        $data1->execute();
        $data1->setFetchMode(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        }
                   
    ?>
    
    <?php
           while ($row = $data1->fetch()) {
               if($row != NULL){
                $first_name = $row['FirstName'];
                $phone = $row['Phone'];
                $email = $row['Email'];
                $check_in_date = $row['CheckInDate'];
                $check_out_date = $row['CheckOutDate'];
                $adults = $row['Adults'];
                $children = $row['Children'];
                $messages = $row['Messages'];
                $reg_date = $row['reg_date'];
                $hotel_id = $row['HotelID'];
            }
           }
            $conn = null;

    ?>
      
    <?php 
        $servername = "localhost";
        $username = "pma";
        $password = "";
        $dbname = "web_project";

        try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $data1 = $conn->prepare("SELECT hotel_name FROM hotels WHERE id = '$hotel_id'");
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
                        <li class="active"><a href="reservations.php">Reservation</a></li>
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
            <h1 class="heading mb-3">My Reservations</h1>
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
          <div class="col-md-5" data-aos="fade-up" data-aos-delay="200">
            <div class="row">
              <div class="col-md-10 ml-auto contact-info">
                <?php 
                if($first_name == ""){
                    echo '<h1><span class="text-black">You don\'t have any reservation</span></h1>'; 
                }else{
                  echo '<p><span class="d-block">Name:</span> <span class="text-black">' .$first_name . '</span></p>'; 
                  echo '<p><span class="d-block">Otel Name:</span> <span class="text-black">' . $hotel_name . '</span></p>'; 
                  echo '<p><span class="d-block">Phone:</span> <span class="text-black">' . $phone . '</span></p>' ;
                  echo '<p><span class="d-block">Data Check In:</span> <span class="text-black">' . $check_in_date . '</span></p>'; 
                  echo '<p><span class="d-block">Data Check Out:</span> <span class="text-black">' . $check_out_date . '</span></p>'; 
                  echo '<p><span class="d-block">Adults:</span> <span class="text-black">' . $adults . '</span></p>'; 
                  echo '<p><span class="d-block">Children:</span> <span class="text-black">' . $children . '</span></p>'; 
                  echo '<p><span class="d-block">Notes:</span> <span class="text-black">' . $messages . '</span></p>'; 
                }
                  ?>
              </div>
            </div>
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
