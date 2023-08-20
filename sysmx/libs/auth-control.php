<?php
include("db.php");
session_start();
$key=$_SESSION["key"];
$sql="select * from andrei_kullanici where s_key='$key'";
                
$sonuc= mysqli_query($conn,$sql);
$satirsay=mysqli_num_rows($sonuc);

if ($satirsay>0)
{
  while( $rows=mysqli_fetch_assoc($sonuc) ){
    $s_id=$rows["id"];
    $s_name=$rows["s_name"];
    $s_member=$rows["s_member"];
    $s_endmember=$rows["s_endmember"];
    $s_verified=$rows["s_verified"];
    if($rows["s_member"]==1){
        $uyelik_adi="Üye";
    }
    if($rows["s_member"]==2){
        $uyelik_adi="Founder";
    }
  }
  if($s_endmember==0){
    $uyelik_kalan_gun="Sınırsız";
  }else{
  $uyelik_kalan_gun = (strtotime($s_endmember) - strtotime(date('d-m-Y'))) / 86400;
  $uyelik_kalan_gun=(int) number_format($uyelik_kalan_gun, 2, '.', '');
}
  if($s_verified==0){
    unset($_SESSION["lastlogin"]);
    unset($_SESSION["key"]);
    header("Location:../index.php?banned=1");

  }
  else if($s_member == 0){
    unset($_SESSION["lastlogin"]);
    unset($_SESSION["key"]);
    header("Location:../index.php?stop=1");
  }
  else if($uyelik_kalan_gun<0){
   $sql="UPDATE andrei_kullanici SET s_member = '0' WHERE id = '$s_id'";
                     
    $sonuc=mysqli_query($conn,$sql);
    if ($sonuc>0){
        unset($_SESSION["lastlogin"]);
        unset($_SESSION["key"]);
        header("Location:../index.php?stop=1");
      }
  }
} else{
    unset($_SESSION["key"]);
    header("Location:../index.php");
}
?>