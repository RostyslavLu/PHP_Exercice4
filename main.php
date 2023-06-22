<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    $mon=$_POST['mon'];
    $tue=$_POST['tue'];
    $wed=$_POST['wed'];
    $thu=$_POST['thu'];
    $fri=$_POST['fri'];
    $sat=$_POST['sat'];
    $sun=$_POST['sun'];
    $hourpay=$_POST['hourpay'];
    $dataUser=array('mon'=>$mon, 'tue'=>$tue, 'wed'=>$wed, 'thu'=>$thu, 'fri'=>$fri, 'sat'=>$sat, 'sun'=>$sun);
    foreach ($dataUser as $day => $hour) {
        $hours[]=$hour;
    }
    include 'salaryplus.php';
    //$hours=[8, 10, 8, 10, 8, 8, 8];
    showTable($hourpay, $hours);
    ?>
</body>
</html>