<?php
   $servername = "localhost";
   $username = "root";
   $password = "";
   $dbname = "andreibaba";
   $conn = new mysqli($servername, $username, $password, $dbname, 2835);
   $new  = mysqli_set_charset($conn,"utf8");
   if ($conn->connect_error){
     die("Bağlantı Sağlanamadı : ". $conn->connect_error);
  
   }
?>