<?php 

error_reporting(0);
if (mysql_connect('localhost', $_COOKIE["log"], $_COOKIE["pas"]) && $_COOKIE["log"] == 'manager')
{
    if (mysql_select_db('details_make'))
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
                            Ввод:  
                        </div>
                    </div>

                    <div class="ribbon-edge-topleft"></div>
                    <div class="ribbon-edge-topright"></div>
                    <div class="ribbon-edge-bottomleft"></div>
                    <div class="ribbon-edge-bottomright"></div>
                    <div class="ribbon-back-left"></div>
                    <div class="ribbon-back-right"></div>
                    <div class="form-signin">';
                   
                    echo '<form action="../PHP/success_query.php" method="post" class=in>';
                    echo 'Название деталей: <p class=small>';
                    echo '<input type=text maxlength="20" placeholder="Название"
                            name="details_name" pattern="[0-9a-zA-Z]{0,30}" required><p class=small>';
                    echo 'Материал детали:';
                    echo '<p class=small><input type=text maxlength="20" placeholder="Материал"
                            name="details_material" pattern="[0-9a-zA-Z]{0,30}" required><p class=small>';
                    echo 'Вес детали:';
                    echo '<p class=small><input type=text maxlength="10" placeholder="Вес"
                            name="details_weight" pattern="[0-9]{0,10}" required><p class=small>';
                    echo 'Стоимость детали:';
                    echo '<p class=small><input type=text maxlength="10" placeholder="Стоимость"
                            name="details_cost" pattern="[0-9]{0,10}" required><p class=small>';
                    echo 'Количество деталей:';
                    echo '<p class=small><input type=text maxlength="20" placeholder="Количество"
                            name="details_number" pattern="[0-9]{0,20}" required><p class=small>';
                    echo 'Дата в формате ГГГГ-ММ-ДД:';
                    echo '<p class=small><input type=text maxlength="10" placeholder="Дата"
                            name="details_data" pattern="\d{4}-\d{2}-\d{2}" required><p class=small>';
         echo '<p class=big><input name="new_part" type="submit" value="Ввод" class="button_small"></p>';
         echo '</form>';
         echo ' <form action="../PHP/manager.php" method="post"> 
                <input name="return" type="submit" value="Назад" class="button_small">
                </form>';
         echo ' <br><form action="../PHP/exit.php" method="post">
                <p class=small><input type="submit" value="Выход" class="button_small"></p>
                </form>
        </body>
        </html> ';
    }
    else
    {
        header("location: ../err/error_dbase.html");
        exit();
    }
}
else
{
    header("location: ../err/error_base.html");
    exit();
}
?>