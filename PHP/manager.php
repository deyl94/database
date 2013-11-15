<?php

error_reporting(0);
if (mysql_connect('localhost', $_COOKIE["log"], $_COOKIE["pas"]) && $_COOKIE["log"] == 'manager')
{
    echo '
    <!DOCTYPE html>
    <html>
    <head>
        <title></title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" type="text/css" href="../details.css" >
        <link rel="stylesheet" type="text/css" href="../manager.css" >
    </head>
    <body>
        <div class="style1">
            <div class="ribbon">
                <div class="ribbon-front">
                    <div class="front-text">
                        Меню:  
                    </div>
                </div>

                <div class="ribbon-edge-topleft"></div>
                <div class="ribbon-edge-topright"></div>
                <div class="ribbon-edge-bottomleft"></div>
                <div class="ribbon-edge-bottomright"></div>
                <div class="ribbon-back-left"></div>
                <div class="ribbon-back-right"></div>
                <div class="form-signin">
            
            <form action="../PHP/part.php">
            <p><input name="work" type="submit" value="Партии" class="button"></p>
            </form>
            <form action="../PHP/manufactory.php">
            <p><input name="manufactory" type="submit" value=Мастерские class="button"></p>
            </form>
            <form action="../PHP/billet.php">
            <p><input name="rep" type="submit" value="Заготовки" class="button"></p>
            </form>
            <form action="../PHP/details.php">
            <p><input name="details" type="submit" value="Детали" class="button"></p>
            </form>
            <br>
            <form action="../PHP/exit.php" method="post">
            <p><input type="submit" name="submit50" value="Выход" class="button_small"></p>
            </form>
    </body>
    </html> ';
}
else
{
    header("location: ../err/error_base.html");
    exit();
}
?>