<?php

 session_start();
$id=0;
if (isset($_GET['code'])){
    $id=$_GET['id'];
}

$_SESSION['countwiner']=$_SESSION['countwiner'] ?? 0;

$con=mysqli_connect("localhost","root","","form");
$select = mysqli_query($con,"select * from doz where id= $id ");

//$rows = [];
//while ($ar = mysqli_fetch_array($select)) {
//    $rows[] = $ar;
//}

while ($ar = mysqli_fetch_array($select))
{
    global $id;
    if ($ar['countWin'] == $_SESSION['countwiner'])
    {

       if($_SESSION['countwino1']>$_SESSION['countwinx1'])
       {
           $ar[5]=$ar[4]+$ar[5];
           $ar[6]=$ar[6]-$ar[4];
          mysqli_query($con , "update doz set walletplayer1 = $ar[5], walletplayer2 = $ar[6]  where id = $id ");

           $_SESSION['countwinx1']=0;
           $_SESSION['countwino1']=0;
       }

       elseif ($_SESSION['countwinx1']>$_SESSION['countwino1'])
       {
           $ar[5]=$ar[5]-$ar[4];
           $ar[6]=$ar[4]+$ar[6];
           mysqli_query($con , "update doz set walletplayer1 = $ar[5], walletplayer2 = $ar[6]  where id = $id ");
           $_SESSION['countwinx1']=0;
           $_SESSION['countwino1']=0;
       }

       elseif ($_SESSION['countwino1']==$_SESSION['countwinx1'])
       {
           $_SESSION['countwinx1']=0;
           $_SESSION['countwino1']=0;
       }
    }
    else
    {
         echo "";
    }
}

//function resetcount()
//{
//    global $rows;
//    foreach ($rows as $ar)
//    {
//        if (!$ar['countWin'] == $_SESSION['countwiner']) {
//            return "<input type='submit' name='resetcount' value='اعداد برد صفر شود' id='resetcount'>";
//        }
//    }
//}



$player=['X','O'];
clear();
function clear()
{
    if(isset($_POST['start']) || !isset($_SESSION['status']))
    {
        gamestart();
    }
    character();
}


function gameStart()
{
    global $player;
    $_SESSION['status']='start';
    $_SESSION['countwinx1'] = $_SESSION['countwinx1'] ?? 0;
    $_SESSION['countwino1'] = $_SESSION['countwino1'] ?? 0;

    $_SESSION['countwinx']=$_SESSION['countwinx1'];
    $_SESSION['countwino']=$_SESSION['countwino1'];
    $_SESSION['game']=[
        1=>null,
        2=>null,
        3=>null,
        4=>null,
        5=>null,
        6=>null,
        7=>null,
        8=>null,
        9=>null,
    ];
    if(isset($_SESSION['lastwiner']))
    {
        $_SESSION['character']=$_SESSION['lastwiner'];
    }
    else
    {
        $randon=rand(0,1);
        $_SESSION['character']= $player[$randon];
    }
}

function checkePlayer($_player)
{
    if($_SESSION['character']===$_player)
    {
        return ' active';
    }
    return null;
}

function createGame()
{
    $element=null;
    $countx=$_SESSION['countwinx'];
    $counto=$_SESSION['countwino'];

    $element.="<div class='row win'>";
    $element.="<div class='span'>WIN O ($counto)</div>";
    $element.="<div class='span'>WIN X ($countx)</div>";
    $element.="</div>";

    $element.="<div class='row title'>";
    $element.="<div class='span6".checkeplayer('O')."'>player1(<span class='cO'>O</span>)</div>";
    $element.="<div class='span6".checkeplayer('X')."'>player2(<span class='cX'>X</span>)</div>";
    $element.="</div>";



    foreach($_SESSION['game'] as $cell=>$value)
    {
        $classname=null;
        if($value)
        {
            $classname='c'.$value;
        }

        $element .="           <input type='submit' class='cell $classname' value='$value' name='cell$cell'";

        if($value)
        {
            $element .= " disabled";
        }
        else if($_SESSION['status']=='winer' || $_SESSION['status']=='draw')
        {
            $element .= " disabled";
        }
        $element .= ">\n";
    }
    return $element;
}


function character()
{
    if($_SESSION['status']=='winer' || $_SESSION['status']=='draw')
    {
        return null;
    }
    foreach($_SESSION['game'] as $cell=>$value)
    {
        if (isset($_POST['cell'.$cell]))
        {
            $_SESSION['status']='inprogress';
            if ($_SESSION['game'][$cell]==null)
            {

                $_SESSION['game'][$cell] = $_SESSION['character'];
                if ($_SESSION['character'] === 'X')
                {
                    $_SESSION['character'] = 'O';
                }
                else
                {
                    $_SESSION['character'] = 'X';
                }

            }
        }
    }
}

function check_winer()
{
    global $select;
    $g=$_SESSION['game'];
    $winer=false;
    if (   $g[1] && $g[1] == $g[2] && $g[2] == $g[3]
        || $g[4] && $g[4] == $g[5] && $g[5] == $g[6]
        || $g[7] && $g[7] == $g[8] && $g[8] == $g[9]

        || $g[1] && $g[1] == $g[4] && $g[4] == $g[7]
        || $g[2] && $g[2] == $g[5] && $g[5] == $g[8]
        || $g[3] && $g[3] == $g[6] && $g[3] == $g[9]

        || $g[1] && $g[1] == $g[5] && $g[5] == $g[9]
        || $g[3] && $g[3] == $g[5] && $g[5] == $g[7] )
    {
        if($_SESSION['character']=='X')
        {
            $winer='O';
            $_SESSION['countwino1']++;
        }
        else
        {
            $winer='X';
            $_SESSION['countwinx1']++;
        }
        $_SESSION['countwiner']=$_SESSION['countwino1']+$_SESSION['countwinx1'];

    }
    return $winer;
}

function massage_winer()
{
    if($_SESSION['status']==='start')
    {
        return null;
    }
    $result_game=check_winer();
    $result='';
    if($result_game)
    {
        $_SESSION['status']='winer';
        $_SESSION['lastwiner']=$result_game;
        $result = "<div id='massage'>win $result_game</div>\n";
    }
    else if(!in_array(null,$_SESSION['game']))
    {
        $_SESSION['status']='draw';
        $_SESSION['lastwiner']=null;
        $result = "<div id='massage'>Draw</div>\n";
    }
    else
    {
        $_SESSION['status']='inprogress';
    }
    return $result;
}

function resetBtn()
{
    $resetvalue='start';
    $result=null;
    if($_SESSION['status']=='inprogress')
    {
        $resetvalue='reset';
    }
    else if($_SESSION['status']=='winer' || $_SESSION['status']=='draw')
    {
        $resetvalue='playAgain!';
    }
    if ($_SESSION['status']!=='start')
    {
        $result = "<input type='submit' name='start' value='$resetvalue' id='resetbtn'>\n";
    }
    return $result;
}


