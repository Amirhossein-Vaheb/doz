<?php
require_once "function.php";

$con=mysqli_connect("localhost","root","","form");
if(!$con)
{
    die("not conect");
}


$nameplayer1="";
$nameplayer2="";
$countgame="";
$price="";
$wallet="";
$massage="";
$id="";
$countgameupdate="";
$priceupdate="";

if(isset($_POST['send']))
{
    $nameplayer1=$_POST['player1'];
    $nameplayer2=$_POST['player2'];
    $countgame=$_POST['count'];
    $price=$_POST['price'];
    $query=mysqli_query($con," INSERT INTO doz (namePlayer1, namePlayer2, countWin, price, walletplayer1,walletplayer2) VALUES ('$nameplayer1', '$nameplayer2', $countgame, $price, 100000 , 100000)");

}
if (isset($_POST['update']))
{
    $id=$_POST['id'];
    $countgameupdate=$_POST['countupdate'];
    $priceupdate=$_POST['priceupdate'];
    mysqli_query($con , "update doz set countWin =$countgameupdate , price =$priceupdate   where id = $id ");
}
$select=mysqli_query($con , "select * from doz");



?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <link rel="stylesheet" href="css/form.css">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
        <form action="" method="post" id="game">
    <label>Player1:</label>
    <input type="text" name="player1" id="player1" required>
    <br>
    <label>Player2:</label>
    <input type="text" name="player2" id="player2" required>
    <br>
    <label>CountGame:</label>
    <input type="number" name="count" id="count" required>
    <br>
    <label>Price:</label>
    <input type="number" name="price" id="price" required>
    <br>
    <input type="submit" name="send" id="send" value="ثبت">
            <br>
            <a href="doz.php" style="text-decoration: none;font-size: 25px">برگشت به بازی</a>
        </form>

        <form method="post" id="game">
            <label>id:</label>
            <input type="number" name="id" required>
            <br>
            <label>CountGame:</label>
            <input type="number" name="countupdate" id="count" required>
            <br>
            <label>Price:</label>
            <input type="number" name="priceupdate" id="price" required>
            <br>
            <input type="submit" name="update" class="update" value="تغییر">
            <br>
            <a href="doz.php" style="text-decoration: none;font-size: 25px">برگشت به بازی</a>
        </form>

        <form action="doz.php" method="get" id="game">
            <label>idgame:</label>
            <input type="number" name="id" required>
            <br>
            <input type="submit" name="code" class="update" value="کد بازی">
            </form>

        <table class="styled-table">
            <tr>
                <th>id</th>
                <th>nameplayer1</th>
                <th>nameplayer2</th>
                <th>countgame</th>
                <th>price</th>
                <th>walletplayer1</th>
                <th>walletplayer2</th>
            </tr>
            <?php
            while ($ar=mysqli_fetch_array($select))
            {
                ?>
                <tr class="active-row">
                        <td><?=$ar[0] ?></td>
                        <td><?=$ar[1] ?></td>
                        <td><?=$ar[2] ?></td>
                        <td><?=$ar[3] ?></td>
                        <td><?=$ar[4] ?></td>
                        <td><?=$ar[5] ?></td>
                        <td><?=$ar[6] ?></td>
                </tr>

                <?php
            }
            ?>
        </table>
</body>
</html>



