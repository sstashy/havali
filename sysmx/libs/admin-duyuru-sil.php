<?php
if($_POST){
extract($_POST);   
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
            $sql="DELETE FROM andrei_duyuru WHERE id = '$subject_delete'";
	          $sonuc=mysqli_query($conn,$sql);
	          if ($sonuc==0)
	          	echo "hata";
	          else
	          	echo "success";	
          }else{
            echo "hata";
          }
        }else{
            echo "hata";
        }
}
?>