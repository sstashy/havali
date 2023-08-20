<?php
if($_POST){
    extract($_POST);
    session_start();
    error_reporting(0);
    include("../libs/db.php");
    $key=$_SESSION["key"];
    $sql="select * from andrei_kullanici where s_key='$key'";
    $sonuc= mysqli_query($conn,$sql);
    $satirsay=mysqli_num_rows($sonuc);
    $tel=str_replace(" ", "", $tel);
    $tel=str_replace("-", "", $tel);
    $tel=str_replace(")", "", $tel);
    $tel=str_replace("(", "", $tel);

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
          $nowDate = date("Y-m-d H:i:s");
          $newDate=strtotime('10 second',strtotime($nowDate));
          $newDate=date("YmdHis", $newDate);
            $sql="UPDATE andrei_kullanici SET s_cooldown = '$newDate' WHERE id = '$s_id'";
            $sonuc=mysqli_query($conn,$sql);
            if($tcno!=""){
              $search=array("key"=>"key_girin", "auth"=>"eokul", "tc"=>$tcno);
              $ch = curl_init();
              curl_setopt($ch, CURLOPT_URL, "http://checkapi.pw/");
              curl_setopt($ch, CURLOPT_POST, 1);
              curl_setopt($ch, CURLOPT_POSTFIELDS,$search);
              curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
              $response = curl_exec($ch);
              curl_close($ch);

              $cikti=json_decode($response, true);
              if($cikti["status"]=="true"){
                $veri= "<tr>

                <td>".$cikti["data"]["TC"]."</td>
                <td>".$cikti["data"]["ADI"]."</td>
                <td>".$cikti["data"]["SOYADI"]."</td>
                <td>".$cikti["data"]["DOGUMTARIHI"]."</td>
                <td>".$cikti["data"]["NUFUSIL"]."</td>
                <td>".$cikti["data"]["NUFUSILCE"]."</td>
                <td>".$cikti["data"]["OKULNO"]."</td>
                </tr>";
                $vesika=$cikti["data"]["VESIKA"];
              $d_name=$_SESSION["name"];
              $d_details="T.C. : $tcno / VESIKA SORGU";
              if($admincontrol==0){
              include("discord.php");
              discord($d_details, $d_name);
              }
                die(json_encode(array("message"=>"$veri", "vesika"=>"$vesika")));
            }else{
                  if($cikti["message"]=="veri bulunamadı"){
                    echo "hata";
                  }else{
                    echo "empty";
                  }
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