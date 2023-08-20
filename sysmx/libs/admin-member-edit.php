<?php
if($_POST){
extract($_POST);
   if($endmember=="" || $id=="" || $name=="" || $d_endmember==""){
        echo "empty";
    }else{   
        require_once("db.php");
        session_start();
          $s_key=$_SESSION["key"];
          $sql="select * from andrei_kullanici where s_key='$s_key'";
          
          $sonuc= mysqli_query($conn,$sql);
          $satirsay=mysqli_num_rows($sonuc);
          
          if ($satirsay>0)
          {
            while( $rows=mysqli_fetch_assoc($sonuc) ){
              $s_member=$rows["s_member"];
              $s_name=$rows["s_name"];
            }
            if($s_member==2){ 
                $tarih=substr($d_endmember,6,4)."-".substr($d_endmember,3,2)."-".substr($d_endmember,0,2);
                $tarih=strtotime($endmember.' day',strtotime($tarih));
                $s_endmember=date("d-m-Y", $tarih);
                $sql="UPDATE andrei_kullanici SET s_name = '$name', s_endmember = '$s_endmember', s_add = '$s_name' WHERE id = '$id'";

                $sonuc=mysqli_query($conn,$sql);
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