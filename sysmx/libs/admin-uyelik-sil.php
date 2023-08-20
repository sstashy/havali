<?php
if($_POST){
extract($_POST); 
error_reporting(0) ; 
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
            $sql="DELETE FROM andrei_kullanici WHERE s_key = '$subject_delete'";
	          $sonuc=mysqli_query($conn,$sql);
	          if ($sonuc==0)
	          	echo "hata";
	          else
	          	echo "success";	
              include("../api/discord.php");
              $metin="$subject_delete kullanıcısının anahtarı silindi";
              discord($metin, $s_name);
          }else{
            echo "hata";
          }
        }else{
            echo "hata";
        }
}
?>