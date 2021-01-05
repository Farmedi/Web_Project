<!doctype html>
<html>
<head>
<link rel="stylesheet" href="myDesign.css">
</head>
    <?php
            function check_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
        ?>
    <?php
            $login = "checked";

            //Error variables
            $errors_login = "";
            $errors_database_login = "";
            $errors_signUp = "";
            $errors_database_signUp = "";


            //Database variables
            $servername = "localhost";
            $username = "pma";
            $password = "";
            $dbname = "web_project";

    ?>

        <?php
            //LOGİN

            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login'])) {
                $em = check_input($_POST["email"]);
                $pw = check_input($_POST["pass"]);
                if (empty($em)) {
                    $errors_login = $errors_login . "* Email is required<br>";
                }
                if (!filter_var($em, FILTER_VALIDATE_EMAIL)) {
                    $errors_login = $errors_login . "* Invalid email format<br>";
                }

                if (empty($pw)) {
                    $errors_login = $errors_login . "* Password is required<br>";
                }
                if (strlen($pw) <= 6) {
                    $errors_login = $errors_login . "* Please enter more than 6 characters<br>";
                }
                
            }
            if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login'])){
                    try {
                    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    $stmt = $conn->prepare("SELECT id,email, password FROM person");
                    $stmt->execute();
                    $stmt->setFetchMode(PDO::FETCH_ASSOC);
                    
                    while($row = $stmt->fetch()) {
                        if($row['email'] == $em && $row['password'] == $pw){
                            session_start();
                            $_SESSION['email_id'] = $row['id'];
                            $_SESSION['user_id'] = $row['id'];
                            jump_homePage();
                        }
                    }
                    $errors_database_login = $errors_database_login . " Girdiğiniz email ya da parola yanlış. Tekrar Deneyiniz.";
                        } catch (PDOException $e) {
                        echo "Error: " . $e->getMessage();
                    }
                    $conn = null;
            }
        ?>

        

        <?php
            //SİGN UP
            $em_sign = filter_input(INPUT_POST,"email_sign");
            $pw_sign_1 = filter_input(INPUT_POST,"pw1");
            $pw_sign_2 = filter_input(INPUT_POST,"pw2");
             if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['signup'])) {
                if (empty($em_sign)) {
                    $errors_signUp= $errors_signUp . "* Email is required<br>";
                }
                if (!filter_var($em_sign, FILTER_VALIDATE_EMAIL)) {
                    $errors_signUp = $errors_signUp . "* Invalid email format<br>";
                }

                if (empty($pw_sign_1 || $pw_sign_2)) {
                    $errors_signUp = $errors_signUp . "* Password is required<br>";
                }
                if (strlen($pw_sign_1) <= 6) {
                    $errors_signUp = $errors_signUp . "* Please enter more than 6 characters<br>";
                    if($pw_sign_1 != $pw_sign_2){
                        $errors_signUp =  $errors_signUp . "* Password does not match<br>";
                    }
                }
            }



            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['signup']) && strlen($errors_signUp) == 0) {
               $servername = "localhost";
               $username = "pma";
               $password = "";
               $dbname = "web_project";


               try {
                   $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                   $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                   $sql = "INSERT INTO person (email, password)
                           VALUES ('$em_sign', '$pw_sign_1')";
                   $conn->exec($sql);
                   $errors_database_signUp = $errors_database_signUp . "Registration successful.<br>";
               } catch (PDOException $e) {
                   echo $sql . "<br>" . $e->getMessage();
               }
               $conn = null;
           }
            ?>




    <div class="login-wrap">
            <div class="login-html">
                    <input id="tab-1" type="radio" name="tab" class="sign-in" checked><label for="tab-1" class="tab">Sign In</label>
                    <input id="tab-2" type="radio" name="tab" class="sign-up" ><label for="tab-2" class="tab">Sign Up</label>
                    <div class="login-form">
                            <div class="sign-in-htm">
                                <form action = "<?php echo check_input($_SERVER["PHP_SELF"]); ?>" method="post">
                                    <div class="group">
                                            <label for="email" class="label">Email Address</label>
                                            <input id="user" name="email" type="text" class="input" <?php if (isset($_POST['login'])) {echo " value='" . $em . "' ";}?>></input>
                                    </div>
                                    <div class="group">
                                            <label for="pass" class="label">Password</label>
                                            <input id="pass" name="pass" type="password" class="input" data-type="password">
                                    </div>
                                    <div class="group">
                                            <input type="submit" class="button" name="login" value="Sign In">
                                    </div>
                                    <div class="hr"></div>
                                    <div class="foot-lnk">
                                            <span style='color:  red;'><?php echo $errors_login ?></span>
                                            <?php if(strlen($errors_login) == 0){
                                                echo "<font color = red> ".$errors_database_login." </font>";
                                            } ?>
                                    </div>
                                </form>
                            </div>
                            <div class="sign-up-htm">
                                <form action = "<?php echo check_input($_SERVER["PHP_SELF"]); ?>" method="post">
                                    <div class="group">
                                            <label for="user" class="label">Email Address</label>
                                            <input id="user" name="email_sign" type="text" class="input"<?php if (isset($_POST['signup'])) {echo " value='" . $em_sign . "' ";}?>></input>
                                    </div>
                                    <div class="group">
                                            <label for="pass" class="label">Password</label>
                                            <input id="pass" type="password" name="pw1" class="input" data-type="password">
                                    </div>
                                    <div class="group">
                                            <label for="pass" class="label">Repeat Password</label>
                                            <input id="pass" type="password" name="pw2" class="input" data-type="password">
                                    </div>
                                    <div class="group">
                                            <input type="submit" class="button" name ="signup" value="Sign Up">
                                    </div>
                                    <div class="hr"></div>
                                    <div class="foot-lnk">
                                            <span style='color:  red;'><?php echo $errors_signUp ?></span>
                                            <?php if(strlen($errors_signUp) == 0){
                                                echo "<font color = green> ".$errors_database_signUp." </font> ";
                                            } ?>
                                    </div>
                                </form>
                            </div>
                    </div>
            </div>
    </div>



        <?php
        function jump_homePage(){
            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login']) && strlen($errors_database_login) == 0) {
                header('Location: homePage.php');
                exit ();
            }
        }
            ?>
</html>
