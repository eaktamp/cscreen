<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
#bg {
  position: fixed; 
  top: 0; 
  left: 0; 
  min-width: 100%;
  min-height: 100%;
}
    </style>
</head>
<body>
<img src="img/gb.png" id="bg" alt="" onclick="help()" >
<script>
function help() {
    window.location = "check.php";
}
</script>
</body>
</html>