<?php
    $servername = "localhost";
    $username = "pma";
    $password = "";
    try {
      $conn = new PDO("mysql:host=$servername", $username, $password);
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      echo "Connected successfully";
    } catch (PDOException $e) {
      echo "Connection failed: " . $e->getMessage();
    }

?>

<?php
    try {
      $conn = new PDO("mysql:host=$servername", $username, $password);
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      $sql = "CREATE DATABASE web_project";
      $conn->exec($sql);
    echo "Database created successfully<br>";
    } catch (PDOException $e) {
      echo $sql . "<br>" . $e->getMessage();
    }
    $conn = null;

?>


<?php 
    $dbname = "web_project";
    try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // table oluşturma
   $sql = "CREATE TABLE Hotels (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        hotel_name VARCHAR(40)
    )";
    
    $conn->exec($sql);
    } catch (PDOException $e) {
        echo $sql . "<br>" . $e->getMessage();
    }
    $conn = null;
?>

<?php
    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conn->beginTransaction();
        $conn->exec("INSERT INTO Hotels (hotel_name)
        VALUES ('Kempinski Hotel Bodrum')");
        $conn->exec("INSERT INTO Hotels (hotel_name)
        VALUES ('Four Seasons Hotel Istanbul')");
        $conn->exec("INSERT INTO Hotels (hotel_name)
        VALUES ('Ariana Sustainable Luxury Lodges')");
        $conn->exec("INSERT INTO Hotels (hotel_name)
        VALUES ('Bodrum Royal Palace')");
        $conn->exec("INSERT INTO Hotels (hotel_name)
        VALUES ('The Land Of Legends Hotel & Theme Park')");
        $conn->exec("INSERT INTO Hotels (hotel_name)
        VALUES ('Rixos Hotel Downtown Antalya')");
        // commit the transaction
        $conn->commit();
        echo "New records created successfully";
    } catch (PDOException $e) {
        $conn->rollback();
        echo "Error: " . $e->getMessage();
    }
        $conn = null;
        
?>



<?php 
    try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // table oluşturma
    $sql = "CREATE TABLE Person (
              id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
              name VARCHAR(40),
              phone_number VARCHAR(11),
              email VARCHAR(40),
              password VARCHAR(40),
              reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP

    )";

    // use exec() because no results are returned
    $conn->exec($sql);
    } catch (PDOException $e) {
    echo $sql . "<br>" . $e->getMessage();
    }
    $conn = null;
?>

<?php 
    try{
        $conn = new PDO("mysql:host=$servername;dbname=$dbname",$username,$password);
        $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $sql = "CREATE TABLE Reservations(
              id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
              FirstName VARCHAR(40) NOT NULL,
              Phone VARCHAR(40) NOT NULL,
              Email VARCHAR(40) NOT NULL,
              CheckInDate VARCHAR(40) NOT NULL,
              CheckOutDate VARCHAR(40) NOT NULL,
              Adults INT(6) NOT NULL,
              Children INT(6) NOT NULL,
              Messages LONGTEXT,
              HotelID INT(6),
              UserID INT(6),
              reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP)";
      $conn->exec($sql);    
     }catch (PDOException $e) {
      }
    $conn = null;
?>
      