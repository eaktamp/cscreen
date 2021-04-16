<!DOCTYPE html>
<html lang="en">
<?php
include 'config/db.php';
date_default_timezone_set('Asia/Bangkok');
$id                 =  $_POST['num_zone_id'];
$ip_key             =  $_SERVER['REMOTE_ADDR'];
$text_key           = $id;
$date_key           = DATE('Y-m-d');
$time_key           = DATE('H:i:s');
$datetimeupdate     = DATE('Y-m-d H:i:s');
$path_station       = "main_app";
$app_id             = "เครื่องหน้า OPD";
$page_view          = $_SERVER['PHP_SELF'];
$sql = "INSERT INTO cpa_log_key (ip_key,text_key,date_key,time_key,datetimeupdate,app_id,page_view,path_station) VALUES ('$ip_key','$text_key','$date_key','$time_key','$datetimeupdate','$app_id','$page_view','$path_station')";
mysqli_query($conn, $sql);
$qry = "SELECT name_main,mzone,path_img,img_name FROM cpa_m_zone WHERE status_mzone = '1' ORDER BY order_group ASC LIMIT 12  ";
$res = mysqli_query($conn, $qry);
?>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Search Service Zone Hospital.</title>
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Kanit&display=swap" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link href="css/st.css" rel="stylesheet">
    <link href="css/index_css.css" rel="stylesheet">
    <script src="js/jquery-1.10.2.js" type="text/javascript"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script type="text/javascript">
        $(function() {
            $("#num_zone_id").on("keypress", function(e) {
                var code = e.keyCode ? e.keyCode : e.which;

                if (code > 57) {
                    return false;
                } else if (code < 48 && code != 8) {
                    return false;
                }
            });
        });
        function validateForm() {
            var x = document.forms["from_zone"]["num_zone_id"].value;
            if (x == "") {
                swal("เลือกหมายเลข!", "ไม่ได้เลือกหมายเลขที่ต้องการค้นหา!", "warning");
                return false;
            }
        }
    </script>
</head>
<body>
    <nav class=" navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand logo-nav" href="#">
                    <img src="img/logo.png" alt="">
                </a>
            </div>
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav navbar-right margin-top ">
                    <li class="aopp">
                    <a href="insert_card.php" class="button_slide slide_left">ตรวจสอบนัดหมาย</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container ">
<div class="zone">ค้นหาจุดให้บริการ ระบุหมายเลข หรือ ค้นหาตามรายการ </div>
        <div class="row">
            <div class="col-md-6 col-sm- mr-top-50 box-input">
                <form name="calculator" id="from_zone" name="from_zone" action="localtion_pzone.php" method="GET" onsubmit="return validateForm()">  
                        <input id="num_zone_id" name="num_zone_id" class="inp" value="" autocomplete=off type="text" readonly>
                 
            </div>
            <div class="col-md-6 col-sm- mr-top-50">
                <h3 class="fr_main">เลือกหมายเลขห้องที่ให้บริการ</h3>
                <p>
                    <ul>
                        <a href="#" class="btn btn-primary btn-lg" role="button" value="0" onClick="document.calculator.num_zone_id.value+='0'">0</a>
                        <a href="#" class="btn btn-primary btn-lg" role="button" value="1" onClick="document.calculator.num_zone_id.value+='1'">1</a>
                        <a href="#" class="btn btn-primary btn-lg" role="button" value="2" onClick="document.calculator.num_zone_id.value+='2'">2</a>
                        <a href="#" class="btn btn-primary btn-lg" role="button" value="3" onClick="document.calculator.num_zone_id.value+='3'">3</a>
                        <a href="#" class="btn btn-primary btn-lg" role="button" value="4" onClick="document.calculator.num_zone_id.value+='4'">4</a>
                    </ul>
                </p>
                <ul>
                    <a href="#" class="btn btn-primary btn-lg" role="button" value="5" onClick="document.calculator.num_zone_id.value+='5'">5</a>
                    <a href="#" class="btn btn-primary btn-lg" role="button" value="6" onClick="document.calculator.num_zone_id.value+='6'">6</a>
                    <a href="#" class="btn btn-primary btn-lg" role="button" value="7" onClick="document.calculator.num_zone_id.value+='7'">7</a>
                    <a href="#" class="btn btn-primary btn-lg" role="button" value="8" onClick="document.calculator.num_zone_id.value+='8'">8</a>
                    <a href="#" class="btn btn-primary btn-lg" role="button" value="9" onClick="document.calculator.num_zone_id.value+='9'">9</a>
                </ul>
                <p>
                    <input type="submit" name="sub_zone" id="sub_zone" class="btn-reset btn-info btn-lg" value="ค้นหา">
                    <input type="reset" class="btn-submit btn-primary btn-lg" value="แก้ไขหมายเลข">
                </p>
            </div>
            </form>
        </div>
        <div class="row">
            <h3 class="fr_sub" style="margin-left:30px;">จุดให้บริการ</h3>
            <hr />
            <?php while ($row = mysqli_fetch_assoc($res)) {
                $name_main = $row['name_main'];
                $path_img  = $row['path_img'];
                $img_name  = $row['img_name'];
                $mzone     = $row['mzone'];
                $rloop     = bin2hex(openssl_random_pseudo_bytes(100));
                $rloop2    = bin2hex(openssl_random_pseudo_bytes(50));
            ?>
                <div class="col-md-2 col-sm-2 text-center hover_img">
                    <a href="localtion_zone.php?location=<?php echo $rloop; ?>&mzone=<?php echo $mzone; ?>&key=<?php echo $rloop2; ?> ">
                        <img src="<?php echo $path_img . "/" . $img_name; ?>" class="img-responsive">
                    </a>
                    <h4><?php echo $name_main; ?></h4>
                </div>
            <?php
            }
            ?>
        </div>
    </div>
    <script src="js/jquery-1.10.2.js"></script>
    <script src="js/bootstrap.js"></script>
</body>
</html>