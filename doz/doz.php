<?php require_once "function.php" ?>
<?php
$con=mysqli_connect("localhost","root","","form");
if(!$con)
{
    die("not conect");
}
$id=0;
if (isset($_GET['code'])){
    $id=$_GET['id'];
}
$select = mysqli_query($con,"select * from doz where id= $id");

$rows = [];
while ($ar = mysqli_fetch_array($select)) {
    $rows[] = $ar;
}
?>





<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/style.css">
    <title>Document</title>
</head>
<body>
<div class="wallet">wallet O=
    <?php
    foreach ($rows as $ar) {
        echo $ar[5];
    }
    ?>
</div>

<div class="wallet">wallet X=
    <?php
    foreach ($rows as $ar) {
        echo $ar[6];
    }
    ?>
</div>

<div class="container">
    <form method="post" id="game">
        <?php echo createGame();?>
        <?php echo massage_winer();?>
        <?php echo resetBtn();?>
        <br>
        <a href="form.php" style="text-decoration: none">تنطیمات</a>
    </form>
</div>

</body>
</html>
