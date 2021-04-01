<?php 
// if (isset($_POST['id0'])){ 
//      a();
// }
// function a(){

    
$grade = array();
$id = array();
$mid = array();
$final = array();
$score = array();
$all = array();
for($i=0;$i<10;$i++){
    // echo $_POST['id'.$i]." ".$_POST['mid'.$i]." ".$_POST['final'.$i]." ".$_POST['score'.$i];    
    if(($_POST['id'.$i] != '') && ($_POST['mid'.$i]  != '') && ($_POST['final'.$i] != '') && ($_POST['score'.$i]) != ''){
        
    // echo $_POST['id'.$i]."<br>";
    @$id[$i] = $_POST['id'.$i];
    @$mid[$i] = $_POST['mid'.$i];
    @$final[$i] = $_POST['final'.$i];
    @$score[$i] = $_POST['score'.$i];
    @$all[$i] = $mid[$i] + $final[$i] + $score[$i] ;
    if ($all[$i] < 50 )
        $grade[$i] = 'F';
    else   if ($all[$i] < 55 )
    $grade[$i] = 'D';
    else   if ($all[$i] < 60 )
    $grade[$i] = 'D+';
    else   if ($all[$i] < 65 )
    $grade[$i] = 'C';
    else   if ($all[$i] < 70 )
    $grade[$i] = 'C+';
    else   if ($all[$i] < 75 )
    $grade[$i] = 'B';
    else   if ($all[$i] < 80 )
    $grade[$i] = 'B+';
    else   
    $grade[$i] = 'A';
    echo "นักศึกษา ID $id[$i] คะแนน Midterm = $mid[$i] คะแนน Final = $final[$i] คะแนนเก็บ = $score[$i] คะแนนรวมทั้งหมดเท่ากับ $all[$i] เกรด : $grade[$i]<br>";
    }
    echo "<hr>";
}
// }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<form action="test3.php" method="POST">
    <?php
    
    for($i = 0;$i < 10; $i++){
        ?> ใส่รหัส นศ. <input type="text"  name="id<?php echo $i; ?>">
        ใส่คะแนน midterm. <input type="number" min = '0' max ='30'  name="mid<?php echo $i ; ?>">
        ใส่คะแนน final <input type="number" min='0' max='40'  name="final<?php echo $i ; ?>">
        ใส่คะแนนเก็บ <input type="number" min='0' max='30'  name="score<?php echo $i ;  ?>"><br>  
     <?php }
    
    ?>
    <input type="submit" name="" id="" >
</form>

</body>
</html>