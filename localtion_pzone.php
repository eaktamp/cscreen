<!DOCTYPE html>
<html lang="en">
<?php
include 'config/db.php';
include 'config/db.php';
date_default_timezone_set('Asia/Bangkok');
$number_room              = $_GET['num_zone_id'];
$ip_key             = $_SERVER['REMOTE_ADDR'];
$text_key           = $id;
$date_key           = DATE('Y-m-d');
$time_key           = DATE('H:i:s');
$datetimeupdate     = DATE('Y-m-d H:i:s');
$path_station       = $_GET['mzone'];
$app_id             = "เครื่องหน้า OPD";
$page_view          = $_SERVER['PHP_SELF'];
$path_s             = "172.16.28.28";
$sql = "INSERT INTO cpa_log_key (ip_key,text_key,date_key,time_key,datetimeupdate,app_id,page_view,path_station) VALUES ('$ip_key','$text_key','$date_key','$time_key','$datetimeupdate','$app_id','$page_view','$path_station')";
mysqli_query($conn, $sql);

$qry    = "SELECT number_room,mzone,name_th,img_map,path_like FROM cpa_zone_room WHERE number_room = '" . $number_room . "' AND flage = 'Y'  ";
$result = mysqli_query($conn, $qry);
$sult   = mysqli_fetch_assoc($result);
     $name_th        = $sult['name_th'];
     $number_room    = $sult['number_room'];
     $mzone          = $sult['mzone'];
     $img_map        = $sult['img_map'];
     $path_like      = $sult['path_like'];
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ZOne</title>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link href="https://fonts.googleapis.com/css2?family=Kanit&display=swap" rel="stylesheet">
    <link href="css/location_zone.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

</head>

<body>
    <div class="tabs">
        <div class="container-filid tab-menu">
            <div class="row">
                <div class="col-xl-3">
                    <ul class="nav nav-pills nav-stacked flex-column">
                        <div class="goindex" onclick="like_index()">
                            <span  id="#gogo" >กลับเมนูหลัก</span>  
                        </div>
                    </ul>
                </div>                 
                            <div class="tab-pane">
                                <h3><?php echo "จุดให้บริการ : ".$name_th; ?></h3>
                                <p> <img class="box" src="<?php echo  $path_like . "/" . $img_map; ?>" alt=""> </p>
                                <p></p>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script>
function like_index() {
           window.location.href = "index.php";
        }
        </script>
</html>