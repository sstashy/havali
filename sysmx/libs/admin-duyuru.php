<?php
if($_POST){
extract($_POST);
    if($details=="" || $subject==""){
        echo "empty";
    }else{   
        require_once("db.php");
        session_start();
        $key=$_SESSION["key"];
        $sql="select * from andrei_kullanici where s_key='$key'";

        $sonuc= mysqli_query($conn,$sql);
        $satirsay=mysqli_num_rows($sonuc);

        if ($satirsay>0)
        {
          while( $rows=mysqli_fetch_assoc($sonuc) ){
            $s_member=$rows["s_member"];
            $s_name=$rows["s_name"];
          }
          if($s_member==2){
            $s_date=date('d-m-Y');

            $sqlekle="INSERT INTO andrei_duyuru (s_subject, s_details, s_date, s_user) VALUES ('$subject', '$details', '$s_date', '$s_name')";
	        $sonuc=mysqli_query($conn,$sqlekle);

	        if ($sonuc>0){
                echo "success";
	        }else{
                echo "hata";
	        }
          }else{
            echo "hata";
          }
        }else{
            echo "hata";
        }
    }
}
?>