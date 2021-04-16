<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Search Service Zone Hospital.</title>
    <link rel="stylesheet" type="text/css" href="css/style_page.css">
    <link href="https://fonts.googleapis.com/css2?family=Kanit&display=swap" rel="stylesheet">
    <?php
    include 'config/db.php';
    date_default_timezone_set('Asia/Bangkok');
    $id                 =  $_POST['num_zone_id'];
    $ip_key             =  $_SERVER['REMOTE_ADDR'];
    $text_key           = $id;
    $date_key           = DATE('Y-m-d');
    $time_key           = DATE('H:i:s');
    $datetimeupdate     = DATE('Y-m-d H:i:s');
    $app_id             = "เครื่องหน้า OPD";
    $path_station       = "key_number";
    $page_view          = $_SERVER['PHP_SELF'];
    $sql = "INSERT INTO cpa_log_key (ip_key,text_key,date_key,time_key,datetimeupdate,app_id,page_view,path_station) VALUES ('$ip_key','$text_key','$date_key','$time_key','$datetimeupdate','$app_id','$page_view','$path_station')";
    mysqli_query($conn, $sql);

    $qry = "SELECT * FROM cpa_zone_room WHERE number_room = '" . $id . "' AND flage = 'Y'  ";
    $res = mysqli_query($conn, $qry);
    $row = mysqli_fetch_assoc($res);
    $name_th =    $row['name_th'];
    $id =    $row['id'];
    ?>
</head>
<body>
    <div class="nav">
        <nav>
            <a href="index.php">กลับหน้าค้นหา</a>
            <a href="#section1">รายละเอียด</a>
            <a href="#section2">แผนที่</a>
            <a href="#section3">ผังหน่วยงาน</a>
            <a href="#section4">บริการ</a>
        </nav>
    </div>
    <div id="section1" class="section">
        <div class="text-wr">
            <h1 class="title">
                <div class="title-top"></div>
                <div class="title-tx">

                    <div class="hero-image">
                        <div class="hero-text">
                            <img src="img/tip5nq.png" alt="">
                             <h3><?php echo "หมายเลข <span class='sid'>".$id."</span> จุดบริการ <span class='sid'>".$name_th."</span>"; ?></h3>
                        </div>
                    </div>
                </div>
            </h1>
        </div>
    </div>
    <div id="section2" class="section">
        <div class="text-wr">
            <h1 class="title">Section 2</h1>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor.</p>
        </div>
    </div>


    <div id="section3" class="section">
        <div class="text-wr">
            <h1 class="title">Section 3</h1>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor.</p>
        </div>
    </div>


    <div id="section4" class="section">
        <div class="text-wr">
            <h1 class="title">Section 4</h1>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor.</p>
        </div>
    </div>

    <?php mysqli_close($conn); ?>
    <script src="dist/slideNav.js" type="text/javascript"></script>
    <script>
        window.slide = new SlideNav({
            changeHash: true
        });
    </script>
</body>

</html>







</body>

</html>