<!DOCTYPE html>
<html lang="en">
<?php
include 'config/db.php';
include 'config/db.php';
date_default_timezone_set('Asia/Bangkok');
$mzone              = $_GET['mzone'];
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

$qry    = "SELECT number_room,mzone,name_th,img_map,path_like FROM cpa_zone_room WHERE mzone = '" . $mzone . "' AND flage = 'Y'  ";
$res    = mysqli_query($conn, $qry);
$result    = mysqli_query($conn, $qry);
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ZOne</title>
    <!-- <meta http-equiv="refresh" content="5;url=index.php"> -->
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
                        <?php
                        while ($row = mysqli_fetch_assoc($res)) {
                            $name_th   = $row['name_th'];
                            $number_room = $row['number_room'];
                            $mzone       = $row['mzone'];
                        ?>
                            <a href="#<?php echo $number_room; ?>" data-toggle="pill">
                                <li class=""><?php echo $name_th; ?></li>
                            </a>
                        <?php
                        }
                        ?>
                    </ul>
                </div>

                <div class="col-xl-6">
                    <div class="tab-content">
                        <div class="tab-pane active" id="gogo">
                            <h3 class="hhead">เลือกจุดให้บริการที่ท่านต้องการทราบ</h3>
                            <hr>
                        </div>
                        <?php
                        while ($sult = mysqli_fetch_assoc($result)) {
                            $name_th        = $sult['name_th'];
                            $number_room    = $sult['number_room'];
                            $mzone          = $sult['mzone'];
                            $img_map        = $sult['img_map'];
                            $path_like      = $sult['path_like'];
                        ?>
                            <div class="tab-pane" id="<?php echo $number_room; ?>">
                                <h3><?php echo $name_th; ?></h3>
                                <p> <img class="box" src="<?php echo  $path_like . "/" . $img_map; ?>" alt=""> </p>
                                <p></p>
                            </div>
                        <?php
                        }
                        ?>

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