<!doctype html>
<html class="no-js" lang="tr">

<head>
    <?php
        $page_title="Aile Sorgu";
        include("libs/auth-control.php");
        include("inc/head_dashboard.php");
    ?>
    <style>
        table thead tr th {
            text-align: center !important;
        }
        table tbody tr td {
            text-align: center !important;
        }
    </style>
</head>

<body class="skin-dark">

    <div class="main-wrapper">

        <?php include("inc/header.php");
        include("inc/sidebar.php");?>

        <!-- Content Body Start -->
        <div class="content-body">
            <div class="box-head">
                <h3 class="title">Aile Sorgu</h3>
            </div>
            <div class="row">
                <div class="col-12 mb-30">
                    <div class="box">
                        <div class="box-body">
                            <div class="row mbn-20">

                               <!--Form Field-->
                               <div class="col-12 mb-15" style="text-align:center;">
                               <form method="post">
                               <div class="col-lg-12 col-12 mb-20">
                                    <div class="row mbn-15">
                                        <div class="col-12 mb-15">
                                        <div id="tc">
                                                            <input required="required" type="text" maxlength="11" class="form-control" id="tc" placeholder="___________" data-mask="99999999999" name="tc"/><br>
                                                            <center>
                            <button type="submit" name="ara" id="search" class="button button-info">Sorgula </button>
                                    </div>
                                    </div>
                                </div>
                                </div>
                                </div>
</form>
                                <!--Form Field-->




                              



                                <div class="table-responsive">
                                <table id="zero-conf" class="table table-hover" style="width:100%">
                                <thead>
			<tr>
                <th>Yakınlık</th>
				<th>TCKN</th>
				<th>Adı</th>
				<th>Soyadı</th>
				<th>Doğum Tarihi</th>
				<th>Anne Adı</th>
				<th>Anne TCKN</th>
				<th>Baba Adı</th>
				<th>Baba TCKN</th>
				<th>İkametgah İl</th>
                <th>İkametgah İlçe</th>
			</tr>
		</thead>
 
        <tbody>
                                        <?php
         
         $baglanti = new mysqli('localhost', 'root', '', '101m', 3366);
         
         $baglanti->set_charset("utf8");
         if (isset($_POST["ara"])) {
         $str = $_POST["tc"];
         $sth = $baglanti->prepare("SELECT * FROM `101m`");
               $sql = "SELECT * FROM `101m` WHERE `TC` = '$str'";
               $result = $baglanti->query($sql);
     
         while($row = $result->fetch_assoc()) {
           echo "<tr>
               <td> KENDİSİ </td>
               <td>" . $row["TC"] . "</td>
               <td>" . $row["ADI"] . "</td>
               <td>" . $row["SOYADI"] . "</td>
               <td>" . $row["DOGUMTARIHI"] . "</td>
               <td>" . $row["ANNEADI"] . "</td>
               <td>" . $row["ANNETC"] . "</td>
               <td>" . $row["BABAADI"] . "</td>
               <td>" . $row["BABATC"] . "</td>
               <td>" . $row["NUFUSIL"] . "</td>
               <td>" . $row["NUFUSILCE"] . "</td>

           </tr>";
           $sqlcocugu = "SELECT * FROM `101m` WHERE NOT `TC` = '". $row["TC"] ."'  AND (`BABATC` = '" . $row["TC"] ."' OR `ANNETC` = '" . $row["TC"] ."' ) ";
           $resultcocugu = $baglanti->query($sqlcocugu);
 
           $sqlkardesi = "SELECT * FROM `101m` WHERE NOT `TC` = '". $row["TC"] ."'  AND (`BABATC` = '" . $row["BABATC"] ."' OR `ANNETC` = '" . $row["ANNETC"] ."' ) ";
           $resultkardesi = $baglanti->query($sqlkardesi);
           $sqlbabasi = "SELECT * FROM `101m` WHERE `TC` = '" . $row["BABATC"] ."' ";
           $resultbabasi = $baglanti->query($sqlbabasi);
           $sqlanasi = "SELECT * FROM `101m` WHERE `TC` = '" . $row["ANNETC"] ."' ";
           $resultanasi = $baglanti->query($sqlanasi);
 
           $sqlkendicocugu = "SELECT * FROM `101m` WHERE NOT `TC` = '". $row["TC"] ."'  AND (`BABATC` = '" . $row["TC"] ."' OR `ANNETC` = '" . $row["TC"] ."' ) ";
           $resultkendicocugu = $baglanti->query($sqlkendicocugu);
           while($row = $resultkendicocugu->fetch_assoc()) {
               echo "<tr>
                   <td> ÇOCUĞU </td>
                   <td>" . $row["TC"] . "</td>
                   <td>" . $row["ADI"] . "</td>
                   <td>" . $row["SOYADI"] . "</td>
                   <td>" . $row["DOGUMTARIHI"] . "</td>
                   <td>" . $row["ANNEADI"] . "</td>
                   <td>" . $row["ANNETC"] . "</td>
                   <td>" . $row["BABAADI"] . "</td>
                   <td>" . $row["BABATC"] . "</td>
                   <td>" . $row["NUFUSIL"] . "</td>
                   <td>" . $row["NUFUSILCE"] . "</td>
    
               </tr>";
               $sqlkendikendicocugu = "SELECT * FROM `101m` WHERE NOT `TC` = '". $row["TC"] ."'  AND (`BABATC` = '" . $row["TC"] ."' OR `ANNETC` = '" . $row["TC"] ."' ) ";
               $resultkendikendicocugu = $baglanti->query($sqlkendikendicocugu);    
               while($row = $resultkendikendicocugu->fetch_assoc()) {
                   
                   $sqlkendikendikendicocugu = "SELECT * FROM `101m` WHERE NOT `TC` = '". $row["TC"] ."'  AND (`BABATC` = '" . $row["TC"] ."' OR `ANNETC` = '" . $row["TC"] ."' ) ";
                   $resultkendikendikendicocugu = $baglanti->query($sqlkendikendikendicocugu);    
                   while($row = $resultkendikendikendicocugu->fetch_assoc()) {
                  
                       
                   }
               }
           }
           while($row = $resultkardesi->fetch_assoc()) {
               echo "<tr>
                   <td> KARDEŞİ </td>
                   <td>" . $row["TC"] . "</td>
                   <td>" . $row["ADI"] . "</td>
                   <td>" . $row["SOYADI"] . "</td>
                   <td>" . $row["DOGUMTARIHI"] . "</td>
                   <td>" . $row["ANNEADI"] . "</td>
                   <td>" . $row["ANNETC"] . "</td>
                   <td>" . $row["BABAADI"] . "</td>
                   <td>" . $row["BABATC"] . "</td>
                   <td>" . $row["NUFUSIL"] . "</td>
                   <td>" . $row["NUFUSILCE"] . "</td>
    
               </tr>";
               $sqlkardescocugu = "SELECT * FROM `101m` WHERE NOT `TC` = '". $row["TC"] ."'  AND (`BABATC` = '" . $row["TC"] ."' OR `ANNETC` = '" . $row["TC"] ."' ) ";
               $resultkardescocugu = $baglanti->query($sqlkardescocugu);
               while($row = $resultkardescocugu->fetch_assoc()) {
                  
                   
                   $sqlkardeskardescocugu = "SELECT * FROM `101m` WHERE NOT `TC` = '". $row["TC"] ."'  AND (`BABATC` = '" . $row["TC"] ."' OR `ANNETC` = '" . $row["TC"] ."' ) ";
                   $resultkardeskardescocugu = $baglanti->query($sqlkardeskardescocugu);    
                   while($row = $resultkardeskardescocugu->fetch_assoc()) {
                      
                       $sqlkardeskardeskardescocugu = "SELECT * FROM `101m` WHERE NOT `TC` = '". $row["TC"] ."'  AND (`BABATC` = '" . $row["TC"] ."' OR `ANNETC` = '" . $row["TC"] ."' ) ";
                       $resultkardeskardeskardescocugu = $baglanti->query($sqlkardeskardeskardescocugu);    
                       while($row = $resultkardeskardeskardescocugu->fetch_assoc()) {
                      
                           
                       }
                   }
               }
 
           }
 
           while($row = $resultbabasi->fetch_assoc()) {
               echo "<tr>
                   <td> BABASI </td>
                   <td>" . $row["TC"] . "</td>
                   <td>" . $row["ADI"] . "</td>
                   <td>" . $row["SOYADI"] . "</td>
                   <td>" . $row["DOGUMTARIHI"] . "</td>
                   <td>" . $row["ANNEADI"] . "</td>
                   <td>" . $row["ANNETC"] . "</td>
                   <td>" . $row["BABAADI"] . "</td>
                   <td>" . $row["BABATC"] . "</td>
                   <td>" . $row["NUFUSIL"] . "</td>
                   <td>" . $row["NUFUSILCE"] . "</td>
    
               </tr>";
               $sqlbabakardesi = "SELECT * FROM `101m` WHERE NOT `TC` = '". $row["TC"] ."'  AND (`BABATC` = '" . $row["BABATC"] ."' OR `ANNETC` = '" . $row["ANNETC"] ."' ) ";
               $resultbabakardesi = $baglanti->query($sqlbabakardesi);
               $sqlbabababasi = "SELECT * FROM `101m` WHERE `TC` = '" . $row["BABATC"] ."' ";
               $resultbabababasi = $baglanti->query($sqlbabababasi);
               $sqlbabaanasi = "SELECT * FROM `101m` WHERE `TC` = '" . $row["ANNETC"] ."' ";
               $resultbabaanasi = $baglanti->query($sqlbabaanasi);
 
               while($row = $resultbabakardesi->fetch_assoc()) {
                     
                   $sqlbabakardescocugu = "SELECT * FROM `101m` WHERE NOT `TC` = '". $row["TC"] ."'  AND (`BABATC` = '" . $row["TC"] ."' OR `ANNETC` = '" . $row["TC"] ."' ) ";
                   $resultbabakardescocugu = $baglanti->query($sqlbabakardescocugu);
                   while($row = $resultbabakardescocugu->fetch_assoc()) {
                       
                       $sqlbabakardesbabakardescocugu = "SELECT * FROM `101m` WHERE NOT `TC` = '". $row["TC"] ."'  AND (`BABATC` = '" . $row["TC"] ."' OR `ANNETC` = '" . $row["TC"] ."' ) ";
                       $resultbabakardesbabakardescocugu = $baglanti->query($sqlbabakardesbabakardescocugu);    
                       while($row = $resultbabakardesbabakardescocugu->fetch_assoc()) {
                          
                           $sqlbabakardesbabakardesbabakardescocugu = "SELECT * FROM `101m` WHERE NOT `TC` = '". $row["TC"] ."'  AND (`BABATC` = '" . $row["TC"] ."' OR `ANNETC` = '" . $row["TC"] ."' ) ";
                           $resultbabakardesbabakardesbabakardescocugu = $baglanti->query($sqlbabakardesbabakardesbabakardescocugu);    
                           while($row = $resultbabakardesbabakardesbabakardescocugu->fetch_assoc()) {
                              
                               
                           }
                       }
 
                   }
               }
       
                   while($row = $resultbabababasi->fetch_assoc()) {
                  
                       $sqlbabakardesi = "SELECT * FROM `101m` WHERE NOT `TC` = '". $row["TC"] ."'  AND (`BABATC` = '" . $row["BABATC"] ."' OR `ANNETC` = '" . $row["ANNETC"] ."' ) ";
                       $resultbabakardesi = $baglanti->query($sqlbabakardesi);
                       $sqlbabababasi = "SELECT * FROM `101m` WHERE `TC` = '" . $row["BABATC"] ."' ";
                       $resultbabababasi = $baglanti->query($sqlbabababasi);
                       $sqlbabaanasi = "SELECT * FROM `101m` WHERE `TC` = '" . $row["ANNETC"] ."' ";
                       $resultbabaanasi = $baglanti->query($sqlbabaanasi);
       
                       while($row = $resultbabakardesi->fetch_assoc()) {
                          
                           $sqlbabababakardescocugu = "SELECT * FROM `101m` WHERE NOT `TC` = '". $row["TC"] ."'  AND (`BABATC` = '" . $row["TC"] ."' OR `ANNETC` = '" . $row["TC"] ."' ) ";
                           $resultbabababakardescocugu = $baglanti->query($sqlbabababakardescocugu);
                           while($row = $resultbabababakardescocugu->fetch_assoc()) {
                               
                               $sqlbabababakardesbabababakardescocugu = "SELECT * FROM `101m` WHERE NOT `TC` = '". $row["TC"] ."'  AND (`BABATC` = '" . $row["TC"] ."' OR `ANNETC` = '" . $row["TC"] ."' ) ";
                               $resultbabababakardesbabababakardescocugu = $baglanti->query($sqlbabababakardesbabababakardescocugu);    
                               while($row = $resultbabababakardesbabababakardescocugu->fetch_assoc()) {
                                  
                                   $sqlbabababakardesbabababakardesbabababakardescocugu = "SELECT * FROM `101m` WHERE NOT `TC` = '". $row["TC"] ."'  AND (`BABATC` = '" . $row["TC"] ."' OR `ANNETC` = '" . $row["TC"] ."' ) ";
                                   $resultbabababakardesbabababakardesbabababakardescocugu = $baglanti->query($sqlbabababakardesbabababakardesbabababakardescocugu);    
                                   while($row = $resultbabababakardesbabababakardesbabababakardescocugu->fetch_assoc()) {
                                     
                                       
                                   }
                               }
                           }
                       }
           
                       while($row = $resultbabababasi->fetch_assoc()) {
                           
                           
                       }
                       while($row = $resultbabaanasi->fetch_assoc()) {
                          
                           
                       }
 
                   }
                   while($row = $resultbabaanasi->fetch_assoc()) {
                       
                       $sqlbabakardesi = "SELECT * FROM `101m` WHERE NOT `TC` = '". $row["TC"] ."'  AND (`BABATC` = '" . $row["BABATC"] ."' OR `ANNETC` = '" . $row["ANNETC"] ."' ) ";
                       $resultbabakardesi = $baglanti->query($sqlbabakardesi);
                       $sqlbabababasi = "SELECT * FROM `101m` WHERE `TC` = '" . $row["BABATC"] ."' ";
                       $resultbabababasi = $baglanti->query($sqlbabababasi);
                       $sqlbabaanasi = "SELECT * FROM `101m` WHERE `TC` = '" . $row["ANNETC"] ."' ";
                       $resultbabaanasi = $baglanti->query($sqlbabaanasi);
       
                       while($row = $resultbabakardesi->fetch_assoc()) {
                           
                           $sqlbabaannekardescocugu = "SELECT * FROM `101m` WHERE NOT `TC` = '". $row["TC"] ."'  AND (`BABATC` = '" . $row["TC"] ."' OR `ANNETC` = '" . $row["TC"] ."' ) ";
                           $resultbabaannekardescocugu = $baglanti->query($sqlbabaannekardescocugu);
                           while($row = $resultbabaannekardescocugu->fetch_assoc()) {
                               
                               $sqlbabaannekardesbabaannekardescocugu = "SELECT * FROM `101m` WHERE NOT `TC` = '". $row["TC"] ."'  AND (`BABATC` = '" . $row["TC"] ."' OR `ANNETC` = '" . $row["TC"] ."' ) ";
                               $resultbabaannekardesbabaannekardescocugu = $baglanti->query($sqlbabaannekardesbabaannekardescocugu);    
                               while($row = $resultbabaannekardesbabaannekardescocugu->fetch_assoc()) {
                                  
                                   $sqlbabaannekardesbabaannekardesbabaannekardescocugu = "SELECT * FROM `101m` WHERE NOT `TC` = '". $row["TC"] ."'  AND (`BABATC` = '" . $row["TC"] ."' OR `ANNETC` = '" . $row["TC"] ."' ) ";
                                   $resultbabaannekardesbabaannekardesbabaannekardescocugu = $baglanti->query($sqlbabaannekardesbabaannekardesbabaannekardescocugu);    
                                   while($row = $resultbabaannekardesbabaannekardesbabaannekardescocugu->fetch_assoc()) {
                                     
                                       
                                   }
                               }
                           }
 
                       }
           
                       while($row = $resultbabababasi->fetch_assoc()) {
                        
                           
                       }
                       while($row = $resultbabaanasi->fetch_assoc()) {
                         
                           
                       }
 
                   }
               }
           }
           while($row = $resultanasi->fetch_assoc()) {
               echo "<tr>
                   <td> ANNESİ </td>
                   <td>" . $row["TC"] . "</td>
                   <td>" . $row["ADI"] . "</td>
                   <td>" . $row["SOYADI"] . "</td>
                   <td>" . $row["DOGUMTARIHI"] . "</td>
                   <td>" . $row["ANNEADI"] . "</td>
                   <td>" . $row["ANNETC"] . "</td>
                   <td>" . $row["BABAADI"] . "</td>
                   <td>" . $row["BABATC"] . "</td>
                   <td>" . $row["NUFUSIL"] . "</td>
                   <td>" . $row["NUFUSILCE"] . "</td>
    
               </tr>";
               $sqlannekardesi = "SELECT * FROM `101m` WHERE NOT `TC` = '". $row["TC"] ."'  AND (`BABATC` = '" . $row["BABATC"] ."' OR `ANNETC` = '" . $row["ANNETC"] ."' ) ";
               $resultannekardesi = $baglanti->query($sqlannekardesi);
               $sqlannebabasi = "SELECT * FROM `101m` WHERE `TC` = '" . $row["BABATC"] ."' ";
               $resultannebabasi = $baglanti->query($sqlannebabasi);
               $sqlanneanasi = "SELECT * FROM `101m` WHERE `TC` = '" . $row["ANNETC"] ."' ";
               $resultanneanasi = $baglanti->query($sqlanneanasi);
 
               while($row = $resultannekardesi->fetch_assoc()) {
                 
                   $sqlannekardescocugu = "SELECT * FROM `101m` WHERE `BABATC` = '" . $row["TC"] ."' OR `ANNETC` = '" . $row["TC"] ."' ";
                   $resultannekardescocugu = $baglanti->query($sqlannekardescocugu);
                   while($row = $resultannekardescocugu->fetch_assoc()) {
                     
                       $sqlannekardesannekardescocugu = "SELECT * FROM `101m` WHERE NOT `TC` = '". $row["TC"] ."'  AND (`BABATC` = '" . $row["TC"] ."' OR `ANNETC` = '" . $row["TC"] ."' ) ";
                       $resultannekardesannekardescocugu = $baglanti->query($sqlannekardesannekardescocugu);    
                       while($row = $resultannekardesannekardescocugu->fetch_assoc()) {
                        
                           $sqlannekardesannekardesannekardescocugu = "SELECT * FROM `101m` WHERE NOT `TC` = '". $row["TC"] ."'  AND (`BABATC` = '" . $row["TC"] ."' OR `ANNETC` = '" . $row["TC"] ."' ) ";
                           $resultannekardesannekardesannekardescocugu = $baglanti->query($sqlannekardesannekardesannekardescocugu);    
                           while($row = $resultannekardesannekardesannekardescocugu->fetch_assoc()) {
                            
                               
                           }
                       }
 
                   }
               }
   
               while($row = $resultannebabasi->fetch_assoc()) {
                   
                   $sqlbabakardesi = "SELECT * FROM `101m` WHERE NOT `TC` = '". $row["TC"] ."'  AND (`BABATC` = '" . $row["BABATC"] ."' OR `ANNETC` = '" . $row["ANNETC"] ."' ) ";
                   $resultbabakardesi = $baglanti->query($sqlbabakardesi);
                   $sqlbabababasi = "SELECT * FROM `101m` WHERE `TC` = '" . $row["BABATC"] ."' ";
                   $resultbabababasi = $baglanti->query($sqlbabababasi);
                   $sqlbabaanasi = "SELECT * FROM `101m` WHERE `TC` = '" . $row["ANNETC"] ."' ";
                   $resultbabaanasi = $baglanti->query($sqlbabaanasi);
   
                   while($row = $resultbabakardesi->fetch_assoc()) {
                     
                       $sqlannebabakardescocugu = "SELECT * FROM `101m` WHERE NOT `TC` = '". $row["TC"] ."'  AND (`BABATC` = '" . $row["TC"] ."' OR `ANNETC` = '" . $row["TC"] ."' ) ";
                       $resultannebabakardescocugu = $baglanti->query($sqlannebabakardescocugu);
                       while($row = $resultannebabakardescocugu->fetch_assoc()) {
                         
                           $sqlannebabakardesannebabakardescocugu = "SELECT * FROM `101m` WHERE NOT `TC` = '". $row["TC"] ."'  AND (`BABATC` = '" . $row["TC"] ."' OR `ANNETC` = '" . $row["TC"] ."' ) ";
                           $resultannebabakardesannebabakardescocugu = $baglanti->query($sqlannebabakardesannebabakardescocugu);    
                           while($row = $resultannebabakardesannebabakardescocugu->fetch_assoc()) {
                            
                               $sqlannebabakardesannebabakardesannebabakardescocugu = "SELECT * FROM `101m` WHERE NOT `TC` = '". $row["TC"] ."'  AND (`BABATC` = '" . $row["TC"] ."' OR `ANNETC` = '" . $row["TC"] ."' ) ";
                               $resultannebabakardesannebabakardesannebabakardescocugu = $baglanti->query($sqlannebabakardesannebabakardesannebabakardescocugu);    
                               while($row = $resultannebabakardesannebabakardesannebabakardescocugu->fetch_assoc()) {
                                 
                                   
                               }
                           }
 
                       }
                   }
       
                   while($row = $resultbabababasi->fetch_assoc()) {
                     
                       
                   }
                   while($row = $resultbabaanasi->fetch_assoc()) {
                     
                       
                   }
               }
               while($row = $resultanneanasi->fetch_assoc()) {
                  
                   $sqlannekardesi = "SELECT * FROM `101m` WHERE NOT `TC` = '". $row["TC"] ."'  AND (`BABATC` = '" . $row["BABATC"] ."' OR `ANNETC` = '" . $row["ANNETC"] ."' ) ";
                   $resultannekardesi = $baglanti->query($sqlannekardesi);
                   $sqlannebabasi = "SELECT * FROM `101m` WHERE `TC` = '" . $row["BABATC"] ."' ";
                   $resultannebabasi = $baglanti->query($sqlannebabasi);
                   $sqlanneanasi = "SELECT * FROM `101m` WHERE `TC` = '" . $row["ANNETC"] ."' ";
                   $resultanneanasi = $baglanti->query($sqlanneanasi);
   
                   while($row = $resultannekardesi->fetch_assoc()) {
                     
                       $sqlanneannekardescocugu = "SELECT * FROM `101m` WHERE NOT `TC` = '". $row["TC"] ."'  AND (`BABATC` = '" . $row["TC"] ."' OR `ANNETC` = '" . $row["TC"] ."' ) ";
                       $resultanneannekardescocugu = $baglanti->query($sqlanneannekardescocugu);
                       while($row = $resultanneannekardescocugu->fetch_assoc()) {
                     
                           $sqlanneannekardesanneannekardescocugu = "SELECT * FROM `101m` WHERE NOT `TC` = '". $row["TC"] ."'  AND (`BABATC` = '" . $row["TC"] ."' OR `ANNETC` = '" . $row["TC"] ."' ) ";
                           $resultanneannekardesanneannekardescocugu = $baglanti->query($sqlanneannekardesanneannekardescocugu);    
                           while($row = $resultanneannekardesanneannekardescocugu->fetch_assoc()) {
                         
                               $sqlanneannekardesanneannekardesanneannekardescocugu = "SELECT * FROM `101m` WHERE NOT `TC` = '". $row["TC"] ."'  AND (`BABATC` = '" . $row["TC"] ."' OR `ANNETC` = '" . $row["TC"] ."' ) ";
                               $resultanneannekardesanneannekardesanneannekardescocugu = $baglanti->query($sqlanneannekardesanneannekardesanneannekardescocugu);    
                               while($row = $resultanneannekardesanneannekardesanneannekardescocugu->fetch_assoc()) {
                                
                                   $sqlanneannekardesanneannekardesanneannekardesanneannekardescocugu = "SELECT * FROM `101m` WHERE NOT `TC` = '". $row["TC"] ."'  AND (`BABATC` = '" . $row["TC"] ."' OR `ANNETC` = '" . $row["TC"] ."' ) ";
                                   $resultanneannekardesanneannekardesanneannekardesanneannekardescocugu = $baglanti->query($sqlanneannekardesanneannekardesanneannekardesanneannekardescocugu);    
                                   while($row = $resultanneannekardesanneannekardesanneannekardesanneannekardescocugu->fetch_assoc()) {
                               
                                       
                               }
 
                           }
                       }
 
                   }
       
                   while($row = $resultannebabasi->fetch_assoc()) {
                       
                   }
                   while($row = $resultanneanasi->fetch_assoc()) {
                      
                   }
                   }
               }
 
           }
       }
 
   
       ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div><!-- Content Body End -->
        <?php include("inc/footer.php");?>


    </div>
    <script>
    $("#search").click(function() {

        $.Toast.showToast({
            "title": "Sorgulanıyor...",
            "icon": "loading",
            "duration": 60000
        });
        });
    </script>
    <!-- JS
============================================ -->

    <!-- Global Vendor, plugins & Activation JS -->
    <script src="assets/js/vendor/modernizr-3.6.0.min.js"></script>
    <script src="assets/js/vendor/jquery-3.3.1.min.js"></script>
    <script src="assets/js/vendor/popper.min.js"></script>
    <script src="assets/js/vendor/bootstrap.min.js"></script>
    <!--Plugins JS-->
    <script src="assets/js/plugins/perfect-scrollbar.min.js"></script>
    <script src="assets/js/plugins/tippy4.min.js.js"></script>
    <!--Main JS-->
    <script src="assets/js/main.js"></script>

    <!-- Plugins & Activation JS For Only This Page -->

    <!--Moment-->
    <script src="assets/js/plugins/moment/moment.min.js"></script>

    <!--Daterange Picker-->
    <script src="assets/js/plugins/daterangepicker/daterangepicker.js"></script>
    <script src="assets/js/plugins/daterangepicker/daterangepicker.active.js"></script>

    <!--Echarts-->
    <script src="assets/js/plugins/chartjs/Chart.min.js"></script>
    <script src="assets/js/plugins/chartjs/chartjs.active.js"></script>

    <!--VMap-->
    <script src="assets/js/plugins/vmap/jquery.vmap.min.js"></script>
    <script src="assets/js/plugins/vmap/maps/jquery.vmap.world.js"></script>
    <script src="assets/js/plugins/vmap/maps/samples/jquery.vmap.sampledata.js"></script>
    <script src="assets/js/plugins/vmap/vmap.active.js"></script>
    <script src="assets/js/plugins/sweetalert/sweetalert.min.js"></script>
    <script src="assets/js/plugins/sweetalert/sweetalert.active.js"></script>
    <script src="assets/js/plugins/jquery.toast/jquery.toast.js"></script>
    
    <script src="assets/js/plugins/moment/moment.min.js"></script>
    <script src="assets/js/plugins/inputmask/bootstrap-inputmask.js"></script>

</body>

</html>