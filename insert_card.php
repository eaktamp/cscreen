<!DOCTYPE html>
<html lang="en">
<meta charset="UTF-8">
<title>API SmartCard Reader Patient</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="https://fonts.googleapis.com/css2?family=Kanit:wght@300&display=swap" rel="stylesheet">
<link href="css/insert_card.css" rel="stylesheet">

<head>
    <?php
    include 'config/autoload.php';
    $url = $url_java;
    $contents  = file_get_contents($url);
    $results   = json_decode($contents);
    $cid = "";
    $cid = $results->cid;
    ?>
    <script src="js/jquery.min.js"></script>
    <script type="text/javascript">
        setInterval(function() {
            console.log(<?php echo $cid; ?>);
            var a = '<?php echo $cid; ?>';
            if (a == "" || a == null) {
                console.log("Loadding Smartcard");
                location.reload("insert_card.php");
            } else if (a != "" || a != null) {
                $("#loadtime").html('<div class="loader"></div>');
                setTimeout("window.location = 'detail_patient.php?cid=<?php echo $cid; ?>';", 5000);
            }
        }, 3000);
    </script>
</head>

<body>
    <div class="jumbotron text-center">
        <div class="container">
            <h1>กรุณาเสียบบัตรประชาชน</h1>
            <p style="color:#888;">Please insert your ID card.</p>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <h2>
                    <?php
                    if ($cid != "") {
                        echo "<div class='loadtime' id='loadtime'>กำลังโหลดข้อมูล กรุณารอสักครู่...</div>";
                    } else {
                        echo "<div class='box'><img src='img/smartcardicon.jpg'></div>";
                    }
                    ?>
                </h2>
            </div>
        </div>
        <br> <br> <br>
        <div class="row">
            <div class="col-md-4 col-sm-4 col-xs-4"> <a href="#" class=""></a> </div>
            <div class="col-md-4 col-sm-4 col-xs-4"> <a href="#" class="btn btn-sm animated-button thar-three" onclick="like_index()">ยกเลิกการทำรายการ</a> </div>
            <div class="col-md-4 col-sm-4 col-xs-4"> <a href="#" class=""></a> </div>
        </div>
        <!-- <footer class="jumbotron text-center">
  <div class="container">
    <p style="color:#888">test<a href="#">designify.me</a></p>
    </div>
  </footer> -->
        <script>
            function like_index() {
                window.location.href = "index.php";
            }
        </script>
</body>

</html>