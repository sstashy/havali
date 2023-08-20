<?php
if($_POST){
extract($_POST);
    if($endmember=="" || $key=="" || $name=="" || $member==""){
      die(json_encode(array("status"=>"empty")));
    }else{   
        require_once("db.php");
        session_start();
        
        $sql="select * from andrei_kullanici where s_key='$key'";

        $sonuc= mysqli_query($conn,$sql);
        $satirsay=mysqli_num_rows($sonuc);

        if ($satirsay>0)
        {
          echo "mevcut";
        }else {
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

              $tarih = date("Y-m-d");
              $tarih=strtotime($endmember.' day',strtotime($tarih));
              $s_endmember=date("d-m-Y", $tarih);
              include("../api/discord.php");
              $metin="**Yeni bir anahtar oluşturuldu:** $key \n**Gün Sayısı:** $endmember";
              discord($metin, $s_name);
            
            $sqlekle="INSERT INTO andrei_kullanici (s_name, s_key, s_verified, s_member, s_endmember, s_add) VALUES ('$name', '$key', '1', '$member', '$s_endmember', '$s_name')";
	          $sonuc=mysqli_query($conn,$sqlekle);
            
	          if ($sonuc>0){
                  die(json_encode(array("status"=>"success", "mesaj"=>"Sistem: Başarıyla Anahtar Oluşturuldu")));
	          }else{
              die(json_encode(array("status"=>"hata")));

	          }
            }else{
              die(json_encode(array("status"=>"hata")));

            }
          }else{
            die(json_encode(array("status"=>"hata")));
          }
        }
    }
}
?>