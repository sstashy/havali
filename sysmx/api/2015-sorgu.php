<?php
if($_POST){
    extract($_POST);
    session_start();
    error_reporting(0);
    $s_conn = new mysqli('localhost', 'root', '1212SEO TAMSIN', 'secmen');
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
            if($tcno!=""){
                $sql="select * from secmen2015 where TC='$tcno'";

                $sonuc= mysqli_query($s_conn,$sql);
                $satirsay=mysqli_num_rows($sonuc);

                if ($satirsay>0)
                {
                  while( $rows=mysqli_fetch_assoc($sonuc) ){
                    echo "<tr>

                    <td>".$rows["TC"]."</td>
                    <td>".$rows["ADI"]."</td>
                    <td>".$rows["SOYADI"]."</td>
                    <td>".$rows["CINSIYETI"]."</td>
                    <td>".$rows["ANAADI"]."</td>
                    <td>".$rows["BABAADI"]."</td>
                    <td>".$rows["DOGUMYERI"]."</td>
                    <td>".$rows["DOGUMTARIHI"]."</td>
                    <td>".$rows["NUFUSILI"]."</td>
                    <td>".$rows["NUFUSILCESI"]."</td>
                    <td>".$rows["ADRESIL"]."</td>
                    <td>".$rows["ADRESILCE"]."</td>
                    <td>".$rows["MAHALLE"]."</td>
                    <td>".$rows["CADDE"]."</td>
                    <td>".$rows["KAPINO"]."</td>
                    <td>".$rows["DAIRENO"]."</td>
                    </tr>";
                  }
                  if($s_member != 2){
                  $d_name=$_SESSION["name"];
                  $d_details="TC: ".$tcno." / 2015 Sorgu";
                  $d_date=date('d-m-Y H:i:s');
                    $sqlekle="INSERT INTO andrei_log (s_name, s_details, s_date) VALUES ('$d_name', '$d_details' ,'$d_date')";
                    $sonuc=mysqli_query($conn,$sqlekle);
                    }
                } else{
                  echo "tchata";
                }

            }else{
                if($ad!="" && $soyad!="" && $il != ""){
                    if($ilce!=""){
                        $sql_ilce="AND ADRESILCE LIKE '$ilce'";
                    }
                    if($mahalle!=""){
                        $sql_mahalle="AND MAHALLE LIKE '$mahalle' ";
                    }
                    if($caddesokak!=""){
                        $sql_cadde="AND CADDE LIKE '$caddesokak'";
                    }
                    if($kapino!=""){
                        $sql_kapino="AND KAPINO LIKE '$kapino'";
                    }
                    if($daireno!=""){
                        $sql_daireno="AND DAIRENO LIKE '$daireno'";
                    }
                    if($anaadi!=""){
                        $sql_anaadi="AND ANAADI LIKE '$anaadi'";
                    }
                    if($babaadi!=""){
                        $sql_babaadi="AND BABAADI LIKE '$babaadi'";
                    }
                    if($dogumtarihi!=""){
                        $dogumtarihi=substr($dogumtarihi, 6,4)."-".substr($dogumtarihi, 3,2)."-".substr($dogumtarihi, 0,2);
                        $sql_dogumtarihi="AND DOGUMTARIHI LIKE '$dogumtarihi'";
                    }
                    $sql="select * from secmen2015 where ADI LIKE '$ad' AND SOYADI LIKE '$soyad' AND ADRESIL LIKE '$il' $sql_ilce $sql_mahalle $sql_cadde $sql_kapino $sql_daireno $sql_anaadi $sql_babaadi $sql_dogumtarihi";

                    $sonuc= mysqli_query($s_conn,$sql);
                    $satirsay=mysqli_num_rows($sonuc);

                    if ($satirsay>0)
                    {
                      while( $rows=mysqli_fetch_assoc($sonuc) ){
                        if($rows["CINSIYETI"]=="E"){
                            $cinsiyet="Erkek";
                        } else if ($rows["CINSIYETI"]=="K"){
                            $cinsiyet="Kadın";
                        }else{
                            $cinsiyet="Diğer";
                        }
                        $dgtarihi=$rows["DOGUMTARIHI"];
                        $dgtarihi=substr($dgtarihi, 8,2)."-".substr($dgtarihi, 5,2)."-".substr($dgtarihi, 0,4);


                        echo "<tr>
                    
                        <td>".$rows["TC"]."</td>
                        <td>".$rows["ADI"]."</td>
                        <td>".$rows["SOYADI"]."</td>
                        <td>".$cinsiyet."</td>
                        <td>".$rows["ANAADI"]."</td>
                        <td>".$rows["BABAADI"]."</td>
                        <td>".$rows["DOGUMYERI"]."</td>
                        <td>".$dgtarihi."</td>
                        <td>".$rows["NUFUSILI"]."</td>
                        <td>".$rows["NUFUSILCESI"]."</td>
                        <td>".$rows["ADRESIL"]."</td>
                        <td>".$rows["ADRESILCE"]."</td>
                        <td>".$rows["MAHALLE"]."</td>
                        <td>".$rows["CADDE"]."</td>
                        <td>".$rows["KAPINO"]."</td>
                        <td>".$rows["DAIRENO"]."</td>
                        </tr>";
                      }
                      $d_name=$_SESSION["name"];
                      $d_details="Ad: ".$ad." Soyad: ".$soyad."İl: ".$il."/ 2015 Sorgu";
                      $d_date=date('d-m-Y H:i:s');
                        $sqlekle="INSERT INTO andrei_log (s_name, s_details, s_date) VALUES ('$d_name', '$d_details' ,'$d_date')";
                        $sonuc=mysqli_query($conn,$sqlekle);
                  
                    } else{
                        echo "hata";
                      }
                }else{
                    echo "empty";
                }
            }
        }else{
            echo "cooldown";
        }
    
    }
  }
?>