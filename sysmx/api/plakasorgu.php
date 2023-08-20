<?php
if($_POST){
    extract($_POST);
    session_start();
    error_reporting(0);
    $s_conn = new mysqli('localhost', 'root', '!SSEO TAMSIN31', 'alldata');
    $s_new  = mysqli_set_charset($s_conn,"utf8");
    include("../libs/db.php");
    $key=$_SESSION["key"];
    $sql="select * from andrei_kullanici where s_key='$key'";
    $sonuc= mysqli_query($conn,$sql);
    $satirsay=mysqli_num_rows($sonuc);
    if ($satirsay>0)
    {
        $nowDate = date("Y-m-d H:i:s");
        $newDate=strtotime('10 second',strtotime($nowDate));
        $newDate=date("YmdHis", $newDate);
        while( $rows=mysqli_fetch_assoc($sonuc) ){
          $s_id=$rows["id"];
          $s_member=$rows["s_member"];
          $s_cooldown=$rows["s_cooldown"];
        }
        $admincontrol=0;
        if($s_member == 2){
            $s_cooldown=0;
            $admincontrol=1;
        }
        if($s_cooldown<=date("YmdHis")){
            
            $sql="UPDATE andrei_kullanici SET s_cooldown = '$newDate' WHERE id = '$s_id'";
            $sonuc=mysqli_query($conn,$sql);
            if($adsoyad!=""){
                $sql="select * from ttnet where ADSOYAD LIKE '$adsoyad' ";

                $sonuc= mysqli_query($s_conn,$sql);
                $satirsay=mysqli_num_rows($sonuc);

                if ($satirsay>0)
                {
                  while( $rows=mysqli_fetch_assoc($sonuc) ){
                    echo "<tr>

                    <td>".$rows["plaka"]."</td>
                  }
                  
                  if($s_member != 2){
                    $d_name=$_SESSION["name"];
                    $d_details="Ad Soyad: ".$adsoyad." / TTNET Sorgu";
                    $d_date=date('d-m-Y H:i:s');
                      $sqlekle="INSERT INTO andrei_log (s_name, s_details, s_date) VALUES ('$d_name', '$d_details' ,'$d_date')";
                      $sonuc=mysqli_query($conn,$sqlekle);
                    }
                } else{
                  echo "hata";
                }

            }else{
              echo "empty";
            }
        }else{
            echo "cooldown";
        }
    
    }
  }
?>