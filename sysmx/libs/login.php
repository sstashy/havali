<?php
if($_POST){
require_once("db.php");
include_once("auth-systemcontrol.php");
extract($_POST);
session_start();
if($key!=""){


$sql="select * from andrei_kullanici where s_key=\"$key\"";
$sonuc= mysqli_query($conn,$sql);
$satirsay=mysqli_num_rows($sonuc);
if ($satirsay>0)
{
  while( $rows=mysqli_fetch_assoc($sonuc) ){
    $s_id=$rows["id"];
    $s_ip=$rows["s_ip"];
    $s_os=$rows["s_os"];
    $s_browser=$rows["s_browser"];
    $s_browserdetails=$rows["s_browserdetails"];
    $s_lastlogin=$rows["s_lastlogin"];
    $s_verified=$rows["s_verified"];
    $s_member=$rows["s_member"];
    $s_name=$rows["s_name"];
  }
  $bugun=date('d/m/Y H:i');
  if($s_member == 0){
    echo "stop";
  }
  else if($s_verified == 0){
    echo "banned";
  }
  else if(!$s_ip || !$s_os || !$s_browser || !$s_browserdetails){

    if($s_member==2){
      $_SESSION["name"]=$s_name;
      $_SESSION["lastlogin"]=$s_lastlogin;
      $_SESSION["key"]=$key;
      echo "success";
    }else{

    $sql="UPDATE andrei_kullanici SET s_os = '$os', s_browser = '$browser', s_browserdetails = '$browserdetails', s_lastlogin = '$bugun' WHERE id = '$s_id'";
                     
    $sonuc=mysqli_query($conn,$sql);
    if ($sonuc>0){
        $_SESSION["name"]=$s_name;
        $_SESSION["lastlogin"]=$s_lastlogin;
        $_SESSION["key"]=$key;
        $d_name=$s_name;
        $d_details="Giriş Yaptı. ( Browser Güncellendi )";
        $d_date=date('d-m-Y H:i:s');
        $sql="UPDATE andrei_kullanici SET s_lastlogin = '$bugun' WHERE id = '$s_id'";
        $sonuc=mysqli_query($conn,$sql);
        echo "success";
      }else{
        echo "hata";
      }
    }

  }else if ($s_os==$os && $s_browser==$browser && $s_browserdetails==$browserdetails){
    

    $sql="UPDATE andrei_kullanici SET s_lastlogin = '$bugun' WHERE id = '$s_id'";
                     
    $sonuc=mysqli_query($conn,$sql);
    if ($sonuc>0){    
        $d_name=$s_name;
        $d_details="Giriş Yaptı. ";
        $d_date=date('d-m-Y H:i:s');
        $sqlekle="INSERT INTO andrei_log (s_name, s_details, s_date) VALUES ('$d_name', '$d_details' ,'$d_date')";
        $sonuc=mysqli_query($conn,$sqlekle);
        $_SESSION["name"]=$s_name;
        $_SESSION["lastlogin"]=$s_lastlogin;
        $_SESSION["key"]=$key;
        $sql="UPDATE andrei_kullanici SET s_lastlogin = '$bugun' WHERE id = '$s_id'";
        $sonuc=mysqli_query($conn,$sql);
        echo "success";
      }else{
        echo "hata";
      }
  }else{
    $d_name=$s_name;
    $d_details="Multi üyelik giriş izni verilmedi";
    $d_date=date('d-m-Y H:i:s');
    $sqlekle="INSERT INTO andrei_log (s_name, s_details, s_date) VALUES ('$d_name', '$d_details' ,'$d_date')";
    $sonuc=mysqli_query($conn,$sqlekle);
    echo "multi";
  }

} else{
  echo "nosuccess";
}
}else{
    echo "empty";
}
}
?>