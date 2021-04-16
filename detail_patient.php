<!DOCTYPE html>
<html>
<title>Detail Patient Oapp</title>
<meta charset="UTF-8">
<!-- https://openbase.io/js/thai-smartcard-reader -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="css/detail_patient.css">
<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Roboto'>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="https://fonts.googleapis.com/css2?family=Prompt:wght@300&display=swap" rel="stylesheet">
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>



  <?php
  include 'config/db.php';
  include 'config/autoload.php';
  $url = $url_java;
  $contents  = file_get_contents($url);
  $results   = json_decode($contents);
  $cid =  $results->cid;
  $todate = DATE('Y-m-d');
  date_default_timezone_set('Asia/Bangkok');
  include 'config/pg_con.class.php';
  include 'config/func.class.php';
?>

<script type="text/JavaScript">
// function timedRefresh(timeoutPeriod) {
// 	setTimeout("location.reload(true);",timeoutPeriod);
// }
</script>
</head>
<?php
//if (isset($cid)){
  ?>

<body class="w3-light-grey">
<!-- <body onLoad="JavaScript:timedRefresh(10000);" class="w3-light-grey"> -->

<?php 
  $id                 =  $_POST['num_zone_id'];
  $ip_key             =  $_SERVER['REMOTE_ADDR'];
  $text_key           =  $cid;
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

  $bd = " SELECT birthday,extract(year from age(current_date,birthday)) as age_p 
FROM patient 
WHERE 1 = 1  
AND cid = '$cid' ";
  $patient_bd    = pg_query($con, $bd);
  $res_bd     = pg_fetch_array($patient_bd);
  $result_bd = $res_bd['birthday'];
  $age_p = $res_bd['age_p'];

  $vst_sql = " SELECT a.vstdate
  FROM ovst AS a
  inner join patient as b  ON a.hn = b.hn
  WHERE 1 = 1  
  -- AND a.vstdate <> now()
  AND b.cid = '$cid'
  ORDER BY a.vstdate DESC
  limit 1 ";
  $row_vst    = pg_query($con, $vst_sql);
  $result_ost = pg_fetch_array($row_vst);
  $last_ovst  = $result_ost['vstdate'];

  $vst_num = " SELECT count(*) AS total
  FROM ovst AS a
  inner join patient as b  ON a.hn = b.hn
  WHERE 1 = 1  
  AND b.cid = '$cid'";
  $row_num    = pg_query($con, $vst_num);
  $result_num = pg_fetch_array($row_num);
  $num_row   = $result_num['total'];

  $vst_oapp = "  SELECT count(*) as oapp_total
  FROM oapp as a
  inner join patient as b on a.hn = b.hn
  WHERE 1 = 1
  AND b.cid = '$cid'
  AND a.oapp_status_id <> '4' ";
  $row_oapp    = pg_query($con, $vst_oapp);
  $result_oapp = pg_fetch_array($row_oapp);
  $num_oapp   = $result_oapp['oapp_total'];

  $sql = " SELECT * FROM patient WHERE 1 = 1 AND cid = '$cid' ";
  $row = pg_query($con, $sql);
  $result = pg_fetch_array($row);
  $hn     = $result['hn'];
  $cid    = $result['cid'];
  $pname  = $result['pname'];
  $fname  = $result['fname'];
  $lname  = $result['lname'];
  $sql_oapp    = "  SELECT 	o.nextdate as nextdate,	o.nexttime as nexttime
        ,C.NAME AS clinic_name
       ,o.hn
       ,p.cid
       ,o.an
       ,CAST (	concat ( P.pname, P.fname, '  ', P.lname ) AS VARCHAR ( 250 )) AS patientname
          ,CONCAT(ROUND(s.bps,0),'/',ROUND(s.bpd,0)) as bp
       ,P.mobile_phone_number as tel
       ,d.NAME AS doctor 
       ,K.department as dep
       ,o.app_cause
       ,o.note
       ,o.vstdate as oapp_date
       ,CONCAT(pp.pttype,' ',pp.name) as ins
       ,o3.NAME as user_key
       ,o.perform_text,o.lab_list_text
       ,o.update_datetime
     FROM oapp o
       LEFT JOIN vn_stat v ON v.vn = o.vn
       LEFT JOIN opdscreen s on s.vn = v.vn
       LEFT OUTER JOIN patient P ON P.hn = o.hn
       LEFT OUTER JOIN clinic C ON C.clinic = o.clinic
       LEFT OUTER JOIN doctor d ON d.code = o.doctor
       LEFT OUTER JOIN kskdepartment K ON K.depcode = o.depcode
       LEFT OUTER JOIN opduser o3 ON o3.loginname = o.app_user
       LEFT JOIN pttype as pp ON pp.pttype = v.pttype
     WHERE	1 = 1 
     AND o.nextdate  >=  NOW() 
    -- AND o.nextdate = '2020-06-18'
     AND p.cid = '$cid'
     -- AND p.cid ='3250800150395'
     AND (( o.oapp_status_id < 4 ) OR o.oapp_status_id IS NULL ) 
     ORDER BY	o.nextdate ASC";
  $row_oapp    = pg_query($con, $sql_oapp);

  ?>
  <div class="w3-content w3-margin-top" style="max-width:1400px;">
    <div class="w3-row-padding">
      <div class="w3-third">
        <div class="w3-white w3-text-grey w3-card-4">
          <div class="w3-display-container pic">
            <a href="index.php">
              <img class="sphere" src="<?php echo $pic_java . "" . $results->cid; ?>">
            </a>
            <div class="w3-display-bottomleft w3-container w3-text-black cen">
            </div>
            <hr>
          </div>

          <div class="w3-container">
            <p><i class="fa fa-user fa-fw w3-margin-right w3-large w3-text-teal"></i>
              <span class="patient_s">ชื่อ-สกุล : </span>
              <span class="pat"><?php echo $pname . '' . $fname . '  ' . $lname; ?></span>
            </p>
            <p><i class="fa fa-address-book fa-fw w3-margin-right w3-large w3-text-teal"></i>
              <span class="patient_s">เลขบัตรประชาชน : </span>
              <span class="pat"><?php echo $cid; ?></span>
            </p>
            <p><i class="fa fa-user fa-fw w3-margin-right w3-large w3-text-teal"></i>
              <span class="patient_s">HN : </span>
              <span class="pat"><?php echo $hn; ?></span>
            </p>
            <p><i class="fa fa-user fa-fw w3-margin-right w3-large w3-text-teal"></i>
              <span class="patient_s">เกิดเมื่อ : </span>
              <span class="pat"><?php echo thaiDateFULL($result_bd) . "&nbsp;<span class='age'> อายุ " . $age_p . " ปี&nbsp;</span>"; ?></span>
            </p>
            <hr>
            <div class="w3-container  w3-pale-red">
              <p class="font-in">มารับบริการล่าสุด</p>
              <h2 class="font-in"><?php echo  thaiDateFULL($last_ovst); ?> </h2>
            </div>
            <hr>
            <div class="w3-container w3-cyan">
              <p class="font-in">จำนวนการมารับบริการ (ครั้ง)</p>
              <h2 class="font-in"><?php echo $num_row; ?></h2>
            </div>
            <hr>
            <div class="w3-container w3-pale-green">
              <p class="font-in">จำนวนการนัด (ครั้ง)</p>
              <h2 class="font-in"><?php echo $num_oapp; ?></h2>
            </div>
            <br>

          </div>
        </div><br>
      </div>
      <div class="w3-twothird">
        <div class="w3-container w3-card w3-white w3-margin-bottom">
          <h2 class="w3-text-grey grey-hh w3-padding-16"><i class="fa fa-calendar fa-fw w3-margin-right w3-xxlarge w3-text-teal"></i>การนัดหมาย</h2>
          <div class="w3-container">
            <?php while ($result_oapp = pg_fetch_array($row_oapp)) {
              $clinic     =  $result_oapp['clinic_name'];
              $nextdate   =  $result_oapp['nextdate'];
              $nexttime   =  $result_oapp['nexttime'];
              $hn         =  $result_oapp['hn'];
              $cid        =  $result_oapp['cid'];
              $an         =  $result_oapp['an'];
              $patientname =  $result_oapp['patientname'];
              $bp         =  $result_oapp['bp'];
              $tel        =  $result_oapp['tel'];
              $doctor     =  $result_oapp['doctor'];
              $dep        =  $result_oapp['dep'];
              $app_cause  =  $result_oapp['app_cause'];
              $note       =  $result_oapp['note'];
              $oapp_date  =  $result_oapp['oapp_date'];
              $ins        =  $result_oapp['ins'];
              $user_key   =  $result_oapp['user_key'];
              $perform_text = $result_oapp['perform_text'];
              $lab_list_text = $result_oapp['lab_list_text'];
              $update_datetime = $result_oapp['update_datetime'];
              $exp        =  round(abs(strtotime($todate) - strtotime($nextdate)) / 60 / 60 / 24);
            ?>
              <h5 class="w3-opacity"><b><?php echo $clinic; ?> </b></h5>
              <h6 class="w3-text-teal"><i class="fa  fa-calendar-check-o fa-fw w3-margin-right"></i><?php echo "วันที่ " . thaiDateFULL($nextdate) . " เวลา " . $nexttime . " น. "; ?>&nbsp;<span class="w3-tag w3-pink w3-round"> อีก <?php echo $exp; ?> วัน ถึงกำหนดนัด</span></h6>
              <div class="w3-container w3-hide-medium w3-teal fon_s">
                <p><i class="fa fa-user-md fa-fw w3-margin-right"></i>แพทย์ผู้นัด <?php echo $doctor; ?></p>
                <p><i class="fa fa-plus-square fa-fw w3-margin-right"></i>สิทธิการรักษา <?php echo $ins; ?></p>
                <p><i class="fa fa-stethoscope fa-fw w3-margin-right"></i><?php echo $app_cause; ?></p>
                <p><i class="fa fa-medkit fa-fw w3-margin-right"></i><?php echo $perform_text; ?></p>
                <p><i class="fa fa-heartbeat fa-fw w3-margin-right"></i><?php echo $lab_list_text; ?></p>
              </div>
              <br>
              <div class="useradd"><?php echo "ผู้บันทึกรายการนัด : <span class='uk'>" . $user_key . "</span> Datetime : <span class='up'>" . $update_datetime . "</span>"; ?></div>
              <hr style="height:2px;border-width:0;color:#8AD587;background-color:#8AD587">
            <?php
            }
            ?>
          </div>
        </div>
      </div>
    </div>
    <!-- <footer class="w3-container w3-teal w3-center w3-margin-top">
      <p>Find me on social media.</p>
      <i class="fa fa-facebook-official w3-hover-opacity"></i>
      <i class="fa fa-instagram w3-hover-opacity"></i>
      <i class="fa fa-snapchat w3-hover-opacity"></i>
      <i class="fa fa-pinterest-p w3-hover-opacity"></i>
      <i class="fa fa-twitter w3-hover-opacity"></i>
      <i class="fa fa-linkedin w3-hover-opacity"></i>
      <p>Powered by <a href="#" target="_blank">w3.css</a></p>
    </footer> -->
          <?php 
       //   }
          ?>

</body>
<script>
 // swal("เลือกหมายเลข!", "ไม่ได้เลือกหมายเลขที่ต้องการค้นหา!", "warning");
 //window.location = "index.php";
  </script>
</html>