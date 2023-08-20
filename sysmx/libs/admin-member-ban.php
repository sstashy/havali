<?php
if($_POST){
extract($_POST);
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
        if($deger=="ban"){
          $sql="UPDATE andrei_kullanici SET s_verified = '0', s_add = '$s_name' WHERE id = '$id'";   
          $sonuc=mysqli_query($conn,$sql);
          if ($sonuc>0){
            include("../api/discord.php");
            $metin="Bir kullanıcıya ban atıldı !";
            discord($metin, $s_name);
            echo "success";
          }else{
            echo "hata";
          }
        }else if ($deger=="unban"){
          
          $sql="UPDATE andrei_kullanici SET s_verified = '1', s_add = '$s_name' WHERE id = '$id'";   
          $sonuc=mysqli_query($conn,$sql);
          if ($sonuc>0){
            include("../api/discord.php");
            $metin="Bir kullanıcının banı açıldı !";
            discord($metin, $s_name);
            echo "success";
          }else{
            echo "hata";
          }

        }else if ($deger=="multi"){
          
          $sql="UPDATE andrei_kullanici SET s_os = '', s_ip = '', s_browser = '', s_browserdetails = '', s_add = '$s_name' WHERE id = '$id'";   
          $sonuc=mysqli_query($conn,$sql);
          if ($sonuc>0){
            echo "success";
          }else{
            echo "hata";
          }

        }
      }else{
        echo "hata";
      }
    }else{
        echo "hata";
    }
}
?>